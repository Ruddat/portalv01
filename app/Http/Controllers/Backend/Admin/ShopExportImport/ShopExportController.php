<?php

namespace App\Http\Controllers\Backend\Admin\ShopExportImport;

use Illuminate\Http\Request;
use App\Exports\FullShopDataExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelExcel;

class ShopExportController extends Controller
{
    public function export($shopId)
    {
        return Excel::download(new FullShopDataExport($shopId), 'shop_data.xlsx');
    }
}
