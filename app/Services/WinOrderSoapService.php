<?php

namespace app\Services;

use Log;
use SoapFault;
use Illuminate\Support\Facades\DB;

class WinOrderSoapService
{
    /**
     * GetNewOrders SOAP Methode
     */
    public function GetNewOrders($username, $password)
    {
        Log::info('GetNewOrders called with username: ' . $username . ' and password: ' . $password);

        if ($username !== 'rudi123' || $password !== 'rudi123') {
            Log::error('Invalid credentials');
            throw new SoapFault('Server', 'Invalid credentials');
        }

        $order = DB::table('mod_orders')
            ->where('order_tracking_status', 999999)
            ->where('parent', '501') // Beispiel Shop-ID
            ->first();

        if (!$order) {
            Log::info('No order found');
            return '';
        }

        $orderXml = "<?xml version=\"1.0\"?><Order>
            <OrderID>{$order->id}</OrderID>
            <OrderNumber>{$order->order_nr}</OrderNumber>
            <CustomerName>{$order->name}</CustomerName>
            <CustomerSurname>{$order->surname}</CustomerSurname>
            <PriceTotal>{$order->price_total}</PriceTotal>
            <ShippingCity>{$order->shipping_city}</ShippingCity>
            <ShippingStreet>{$order->shipping_street}</ShippingStreet>
            <ShippingZip>{$order->shipping_zip}</ShippingZip>
            <ShippingCountryCode>{$order->shipping_country_code}</ShippingCountryCode>
        </Order>";

        Log::info('Order found: ' . $orderXml);

        return $orderXml;
    }

    /**
     * SendTrackingStatus SOAP Methode
     */
    public function SendTrackingStatus($username, $password, $orderId, $trackingStatus)
    {
        Log::info('SendTrackingStatus called with username: ' . $username . ', password: ' . $password . ', orderId: ' . $orderId . ', trackingStatus: ' . $trackingStatus);

        // Authentifizierung
        if ($username !== 'rudi123' || $password !== 'rudi123') {
            Log::error('Invalid credentials');
            throw new SoapFault('Server', 'Invalid credentials');
        }

        // Tracking-Status aktualisieren
        DB::table('mod_orders')
            ->where('id', $orderId)
            ->update(['order_tracking_status' => $trackingStatus]);

        Log::info('Tracking status updated for orderId: ' . $orderId);

        return true;
    }
}
