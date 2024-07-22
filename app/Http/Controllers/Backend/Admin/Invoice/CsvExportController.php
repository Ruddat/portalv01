<?php

namespace App\Http\Controllers\Backend\Admin\Invoice;

use Illuminate\Http\Request;
use App\Models\ModSysCsvExports;
use App\Http\Controllers\Controller;

class CsvExportController extends Controller
{
    public function download($id)
    {
        // Retrieve the CSV entry from the database
        $csv = ModSysCsvExports::findOrFail($id);

        // Get the CSV content and filename from the database record
        $csvContent = $csv->file_content;
        $filename = $csv->filename;

        // Return the CSV content as a download response
        return response($csvContent, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}
