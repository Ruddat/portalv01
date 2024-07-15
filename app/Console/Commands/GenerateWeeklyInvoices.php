<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\ModShop;
use App\Models\ModOrders;
use App\Models\ModSysInvoices;
use Illuminate\Console\Command;
use PDF;
use Storage;

class GenerateWeeklyInvoices extends Command
{
    protected $signature = 'invoices:generate';
    protected $description = 'Generates weekly invoices for shops';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Set start of the week to Sunday and end of the week to Saturday
        $startOfWeek = Carbon::now()->startOfWeek(Carbon::SUNDAY)->toDateString();
        $endOfWeek = Carbon::now()->endOfWeek(Carbon::SATURDAY)->toDateString();
        $now = Carbon::now();

        // Fetch orders within the week
        $orders = ModOrders::whereBetween('order_date', [$startOfWeek, $endOfWeek])->get();

        // Group orders by shop
        $groupedOrders = $orders->groupBy('parent');

        foreach ($groupedOrders as $shopId => $shopOrders) {
            // Calculate totals for each payment type
            $cashAmount = $this->calculatePaymentTypeAmount($shopOrders, 'cash');
            $ecCardAmount = $this->calculatePaymentTypeAmount($shopOrders, 'ec-card');
            $paypalAmount = $this->calculatePaymentTypeAmount($shopOrders, 'paypal');
            $otherAmounts = $this->calculateOtherPaymentAmounts($shopOrders, ['cash', 'ec-card', 'paypal']);
            $totalAmount = $cashAmount + $ecCardAmount + $paypalAmount + $otherAmounts;

            // Calculate additional summary details
            $totalOrders = $shopOrders->count();
            $averageOrderValue = $totalOrders > 0 ? $totalAmount / $totalOrders : 0;

            // Prepare JSON data
            $orderJsonData = $this->formatOrderDataToJson($shopOrders);

            $invoiceJsonData = [
                'total_amount' => $totalAmount,
                'cash_amount' => $cashAmount,
                'ec_card_amount' => $ecCardAmount,
                'paypal_amount' => $paypalAmount,
                'other_amounts' => $otherAmounts,
                'total_orders' => $totalOrders,
                'average_order_value' => $averageOrderValue,
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
                $invoiceData['total_amount'] = $totalAmount;
                $invoiceData['cash_amount'] = $cashAmount;
                $invoiceData['ec_card_amount'] = $ecCardAmount;
                $invoiceData['paypal_amount'] = $paypalAmount;
                $invoiceData['other_amounts'] = $otherAmounts;
                $invoiceData['total_orders'] = $totalOrders;
                $invoiceData['average_order_value'] = $averageOrderValue;
                $invoiceData['order_json_data'] = $orderJsonData;
                $invoiceData['invoice_json_data'] = json_encode($invoiceJsonData);
                $invoiceData['generated_at'] = $now;
                $filePath = $existingInvoice->pdf_path; // Use existing PDF path
            } else {
                // Generate a unique invoice number
                $latestInvoice = ModSysInvoices::orderBy('invoice_number', 'desc')->first();
                $invoiceNumber = $latestInvoice ? $latestInvoice->invoice_number + 1 : 1;
//                $filePath = 'uploads/shops/' . $shopId . '/invoice_' . $invoiceNumber . '_' . $startOfWeek . '_' . $endOfWeek . '.pdf';
                $filePath = 'uploads/shops/' . $shopId . '/invoice_' . $invoiceNumber . '_' . $startOfWeek . '_' . $endOfWeek . '.pdf';

                $invoiceData = [
                    'shop_id' => $shopId,
                    'total_amount' => $totalAmount,
                    'cash_amount' => $cashAmount,
                    'ec_card_amount' => $ecCardAmount,
                    'paypal_amount' => $paypalAmount,
                    'other_amounts' => $otherAmounts,
                    'total_orders' => $totalOrders,
                    'average_order_value' => $averageOrderValue,
                    'start_date' => $startOfWeek,
                    'end_date' => $endOfWeek,
                    'generated_at' => $now,
                    'order_json_data' => $orderJsonData,
                    'invoice_json_data' => json_encode($invoiceJsonData),
                    'payment_json_data' => json_encode([]), // Placeholder for future payment data
                    'invoice_number' => $invoiceNumber,
                    'pdf_path' => $filePath // Add PDF path to invoice data
                ];
            }

            // Generate PDF
            $pdf = PDF::loadView('pdf.invoice', [
                'shopId' => $shopId,
                'startOfWeek' => $startOfWeek,
                'endOfWeek' => $endOfWeek,
                'orders' => json_decode($orderJsonData, true),
                'invoiceData' => $invoiceJsonData
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
