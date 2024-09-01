<?php

namespace App\Http\Controllers\Backend\Admin\DesignTemplates;

use Illuminate\Http\Request;
use App\Models\ModSharedTemplates;
use App\Http\Controllers\Controller;

class DesignTemplatesController extends Controller
{
    public function index()
    {
        $templates = ModSharedTemplates::all();
        return view('backend.pages.admin.templates.admin-templates', compact('templates'));
    }
}
