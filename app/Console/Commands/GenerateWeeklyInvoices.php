<?php

namespace App\Console\Commands;

use PDF;
use Storage;
use Carbon\Carbon;
use App\Models\ModShop;
use App\Models\ModOrders;
use App\Models\ModSysStornos;
use App\Models\ModSysInvoices;
use Illuminate\Console\Command;

class GenerateWeeklyInvoices extends Command
{

        protected $signature = 'invoices:generate {startOfWeek?} {endOfWeek?}';
        protected $description = 'Generates weekly invoices for shops';

        protected $paypal_express_fee_fixed;
        protected $paypal_express_fee_percent;
        protected $sales_commission;

        public function __construct()
        {
            parent::__construct();
        }

        public function handle()
        {
            // Fetch additional settings
            $this->paypal_express_fee_fixed = get_settings()->paypal_express_fee_fixed;
            $this->paypal_express_fee_percent = get_settings()->paypal_express_fee_percentage;
            $this->sales_commission = get_settings()->sales_commission;

            // Set start of the week to Sunday and end of the week to Saturday
        // Check if arguments were provided
        $startOfWeek = $this->argument('startOfWeek');
        $endOfWeek = $this->argument('endOfWeek');

        if ($startOfWeek && $endOfWeek) {
            // Use provided arguments
            $startOfWeek = Carbon::parse($startOfWeek)->toDateString();
            $endOfWeek = Carbon::parse($endOfWeek)->toDateString();
        } else {
            // Use the current week if no arguments are provided
            $startOfWeek = Carbon::now()->startOfWeek(Carbon::SUNDAY)->toDateString();
            $endOfWeek = Carbon::now()->endOfWeek(Carbon::SATURDAY)->toDateString();
        }

        $now = Carbon::now();

        
            // Fetch orders within the week
            $orders = ModOrders::whereBetween('order_date', [$startOfWeek, $endOfWeek])->get();

            // Fetch stornos within the week
            $stornos = ModSysStornos::whereBetween('created_at', [$startOfWeek, $endOfWeek])->get();

            // Group orders by shop
            $groupedOrders = $orders->groupBy('parent');
            // Group stornos by shop
            $groupedStornos = $stornos->groupBy('shop_id');

            foreach ($groupedOrders as $shopId => $shopOrders) {
                // Calculate totals for each payment type and counts
                $cashAmount = $this->calculatePaymentTypeAmount($shopOrders, 'cash');
                $cashCount = $shopOrders->where('payment_type', 'cash')->count();

                $ecCardAmount = $this->calculatePaymentTypeAmount($shopOrders, 'ec-card');
                $ecCardCount = $shopOrders->where('payment_type', 'ec-card')->count();

                $paypalAmount = $this->calculatePaymentTypeAmount($shopOrders, 'paypal');
                $paypalCount = $shopOrders->where('payment_type', 'paypal')->count();

                $otherAmounts = $this->calculateOtherPaymentAmounts($shopOrders, ['cash', 'ec-card', 'paypal']);
                $otherCount = $shopOrders->whereNotIn('payment_type', ['cash', 'ec-card', 'paypal'])->count();

                $totalAmount = $cashAmount + $ecCardAmount + $paypalAmount + $otherAmounts;

                // Subtract stornos from total amount
                $totalStornoAmount = 0;
                $newStornoAmount = 0;
                if ($groupedStornos->has($shopId)) {
                    $shopStornos = $groupedStornos->get($shopId);
                    foreach ($shopStornos as $storno) {
                        if (!$storno->included_in_invoice) {
                            $newStornoAmount += $storno->refund_amount;
                            // Mark the storno as included in the invoice
                            $storno->included_in_invoice = true;
                            $storno->save();
                        }
                    }
                }

                $totalStornoAmount = $newStornoAmount;

                // Calculate additional summary details
                $totalOrders = $shopOrders->count();
                $averageOrderValue = $totalOrders > 0 ? $totalAmount / $totalOrders : 0;

                // Calculate Paypal fee
                $paypalFee = $this->calculatePaypalFee($shopOrders);

                // Get shop-specific sales commission if available
                $shop = ModShop::find($shopId);
                $commission = ($shop && $shop->charge !== null && $shop->charge > 0) ? $shop->charge : $this->sales_commission;
                // Calculate commission amount
                $commissionAmount = ($commission / 100) * $totalAmount;

                // Prepare JSON data
                $orderJsonData = $this->formatOrderDataToJson($shopOrders);

                $invoiceJsonData = [
                    'total_amount' => $totalAmount,
                    'cash_amount' => $cashAmount,
                    'cash_count' => $cashCount,
                    'ec_card_amount' => $ecCardAmount,
                    'ec_card_count' => $ecCardCount,
                    'paypal_amount' => $paypalAmount,
                    'paypal_count' => $paypalCount,
                    'paypal_fee' => $paypalFee,
                    'other_amounts' => $otherAmounts,
                    'other_count' => $otherCount,
                    'total_orders' => $totalOrders,
                    'average_order_value' => $averageOrderValue,
                    'commission' => $commission,
                    'commission_amount' => $commissionAmount,
                    'refund_amount' => $totalStornoAmount, // Add storno amount to invoice data
                ];

                // Check if an invoice already exists for the current week
                $existingInvoice = ModSysInvoices::where('shop_id', $shopId)
                    ->where('start_date', $startOfWeek)
                    ->where('end_date', $endOfWeek)
                    ->first();

                if ($existingInvoice) {
                    // Use existing invoice number
                    $invoiceNumber = $existingInvoice->invoice_number;
                    $invoiceData = $existingInvoice->toArray();
                    // Update the existing invoice data
                    $invoiceJsonData['refund_amount'] += $existingInvoice->refund_amount; // Add new stornos to existing refund amount
                    $invoiceData = array_merge($invoiceData, $invoiceJsonData);
                    $invoiceData['order_json_data'] = $orderJsonData;
                    $invoiceData['invoice_json_data'] = json_encode($invoiceJsonData);
                    $invoiceData['generated_at'] = $now;
                    $filePath = $existingInvoice->pdf_path; // Use existing PDF path
                } else {
                    // Generate a unique invoice number
                    $latestInvoice = ModSysInvoices::orderBy('invoice_number', 'desc')->first();
                    $invoiceNumber = $latestInvoice ? $latestInvoice->invoice_number + 1 : 1;
                    $filePath = 'uploads/shops/' . $shopId . '/invoice_' . $invoiceNumber . '_' . $startOfWeek . '_' . $endOfWeek . '.pdf';

                    $invoiceData = array_merge($invoiceJsonData, [
                        'shop_id' => $shopId,
                        'start_date' => $startOfWeek,
                        'end_date' => $endOfWeek,
                        'generated_at' => $now,
                        'order_json_data' => $orderJsonData,
                        'invoice_json_data' => json_encode($invoiceJsonData),
                        'payment_json_data' => json_encode([]), // Placeholder for future payment data
                        'invoice_number' => $invoiceNumber,
                        'pdf_path' => $filePath // Add PDF path to invoice data
                    ]);
                }

                // Generate PDF
                $pdf = PDF::loadView('pdf.invoice', [
                    'shopId' => $shopId,
                    'shop' => $shop, // Shop-Daten an die Ansicht übergeben
                    'startOfWeek' => $startOfWeek,
                    'endOfWeek' => $endOfWeek,
                    'orders' => json_decode($orderJsonData, true),
                    'invoiceData' => $invoiceData // Hier stellen wir sicher, dass das gesamte Array übergeben wird
                ])->setPaper('a4', 'portrait');

                // Save PDF to storage
                Storage::put($filePath, $pdf->output());

                if ($existingInvoice) {
                    // Update the existing invoice
                    $existingInvoice->update($invoiceData);
                } else {
                    // Create a new invoice
                    ModSysInvoices::create($invoiceData);
                }

                // Mark stornos as included in invoice
                if ($groupedStornos->has($shopId)) {
                    $shopStornos = $groupedStornos->get($shopId);
                    $shopStornos->each->update(['included_in_invoice' => true]);
                }
            }

            $this->info('Weekly invoices have been generated successfully!');
        }

        private function calculatePaymentTypeAmount($orders, $paymentType)
        {
            // Calculate the total amount for a specific payment type
            return $orders->where('payment_type', $paymentType)->sum(function($order) {
                return $order->price_products + $order->price_bottles + $order->price_shipping;
            });
        }

        private function calculateOtherPaymentAmounts($orders, $excludedTypes)
        {
            // Calculate the total amount for payment types not in the excluded list
            return $orders->whereNotIn('payment_type', $excludedTypes)->sum(function($order) {
                return $order->price_products + $order->price_bottles + $order->price_shipping;
            });
        }

        private function calculatePaypalFee($orders)
        {
            // Calculate the total Paypal fee
            return $orders->where('payment_type', 'paypal')->sum('price_payment');
        }

        private function formatOrderDataToJson($orders)
        {
            $formattedOrders = $orders->map(function ($order) {
                return [
                    'order_nr' => $order->order_nr,
                    'name' => mb_substr($order->name, 0, 3) . 'xx',
                    'surname' => mb_substr($order->surname, 0, 3) . 'xx',
                    'company' => $order->company ? mb_substr($order->company, 0, 3) . 'xx' : '',
                    'department' => $order->department,
                    'shipping_zip_id' => $order->shipping_zip_id,
                    'shipping_street' => $order->shipping_street,
                    'shipping_house_no' => $order->shipping_house_no,
                    'shipping_zip' => $order->shipping_zip,
                    'shipping_city' => $order->shipping_city,
                ];
            });
            return $formattedOrders->toJson();
        }
    }
