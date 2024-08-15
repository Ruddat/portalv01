<?php

namespace App\Http\Controllers\TestComponent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    //
    public function printReceipt()
    {
        // Zugriff auf den Drucker-Service
        $printer = app('printer');

        // Druckbefehl senden
        $printer->text("Hello World!\n");
        $printer->cut();
        $printer->close();

        return response()->json(['status' => 'printed']);
    }
}
