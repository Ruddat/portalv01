<?php

namespace App\Providers;

use Mike42\Escpos\Printer;
use Illuminate\Support\ServiceProvider;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class PrinterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->singleton('printer', function ($app) {
//            $connector = new NetworkPrintConnector("192.168.0.100", 9100); // Ersetze durch deine Drucker IP-Adresse und Port
            $connector = new WindowsPrintConnector("Epson ET-2810 Series"); // Ersetze durch den Namen deines Druckers


            return new Printer($connector);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
