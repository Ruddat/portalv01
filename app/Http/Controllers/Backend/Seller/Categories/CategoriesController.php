<?php

namespace App\Http\Controllers\Backend\Seller\Categories;

use App\Models\ModCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

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

    public function addCategory(Request $request)
    {
        $data = [
            'pageTitle' => 'Add Category',
        ];
        return view('backend.pages.seller.categories.add-category', $data);
    }

    public function storeCategory(Request $request)
    {
        $data = [
            'pageTitle' => 'Store Category',
        ];


      //  dd($request);

        // validate the form data
        $request->validate([
            'category_name' => 'required|min:5',
         //   'category_description' => 'required|min:50',
            'category_image' => 'required|image|mimes:png,jpg,jpeg,svg',
        ],[
            'category_name.required' => 'Category name is required',
            'category_name.min' => 'Category name must be at least 5 characters',
            'category_description.required' => 'Category description is required',
            'category_description.min' => 'Category description must be at least 50 characters',
            'category_image.required' => 'Category image is required',
            'category_image.image' => 'Category image must be an image',
            'category_image.mimes' => 'Category image must be a file of type: png, jpg, jpeg, svg',
        ]);

        // store the form data
        if ($request->hasFile('category_image')) {
            $path = 'images/categories/';
            $file = $request->file('category_image');
            $filename = time() . '_' . $file->getClientOriginalExtension();

            if(!File::exists(public_path($path))) {
                File::makeDirectory(public_path($path), 0777, true, true);
            }

            // upload the image
            $upload = $file->move(public_path($path),$filename);

            if($upload) {



                // Save the category image to the database
                $currentShopId = session('currentShopId');

                $category = new ModCategory();
                $category->shop_id = $currentShopId;
                $category->category_name = $request->category_name;
                //$category->category_description = $request->category_description;
                $category->category_image = $filename;
                $saved = $category->save();

                if ($saved) {
                    return redirect()->back()->with('success', 'Category added successfully');
                }else {
                    return redirect()->back()->with('error', 'Error adding category');
                }


            }else{
                return redirect()->back()->with('error', 'Error uploading image');
            }
        }


        return view('backend.pages.seller.categories.store-category', $data);
    }


    public function editCategory(Request $request)
    {
        $data = [
            'pageTitle' => 'Edit Category',
        ];
        return view('backend.pages.seller.categories.edit-category', $data);
    }

    public function addSubCategory(Request $request)
    {
        $data = [
            'pageTitle' => 'Add Sub Category',
        ];
        return view('backend.pages.seller.categories.add-sub-category', $data);
    }

    public function editSubCategory(Request $request)
    {
        $data = [
            'pageTitle' => 'Edit Sub Category',
        ];
        return view('backend.pages.seller.categories.edit-sub-category', $data);
    }

}
