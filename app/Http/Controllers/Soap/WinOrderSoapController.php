<?php

namespace App\Http\Controllers\Soap;

use Log;
use Exception;
use SoapFault;
use SoapServer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\WinOrderSoapService;

class WinOrderSoapController
{
    public function handle(Request $request)
    {
        $wsdl = public_path('soap/winOrderWsdl.xml');

//dd($wsdl);


        try {
            $server = new SoapServer($wsdl, [
                'uri' => 'urn:WinOrderEShop'
            ]);
dd($server);

            $server->setClass(WinOrderSoapService::class);
            $server->handle();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
