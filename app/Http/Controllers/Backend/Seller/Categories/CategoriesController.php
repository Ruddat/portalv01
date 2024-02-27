<?php

namespace App\Http\Controllers\Backend\Seller\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    //
    public function catSubcatList(Request $request)
    {

     $data = [
        'pageTitle' => 'Category & Sub categories Management',
     ];


        return view('backend.pages.seller.categories.cat-subcat-list', $data);
    }
}
