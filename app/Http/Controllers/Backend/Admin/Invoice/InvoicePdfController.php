<?php

namespace App\Http\Controllers\Backend\Admin\Invoice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class InvoicePdfController extends Controller
{
    //
    public function show($shopId, $fileName)
    {
        $filePath = "uploads/shops/{$shopId}/{$fileName}";

        if (Storage::exists($filePath)) {
            return response()->file(storage_path('app/' . $filePath));
        }

        abort(404);
    }

}
