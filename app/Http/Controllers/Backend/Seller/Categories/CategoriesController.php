<?php

namespace App\Http\Controllers\Backend\Seller\Categories;

use App\Models\ModCategory;
use Illuminate\Http\Request;
use App\Models\ModProductSizes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class CategoriesController extends Controller
{
    //
    public function catSubcatList(Request $request)
    {

                // Überprüfen, ob die Shop-ID in der Session vorhanden ist
                $currentShopId = Session::get('currentShopId');
                if ($currentShopId === null) {
                // Fehlermeldung für den Fall, dass kein aktiver Shop ausgewählt wurde
                $errorMessage = 'Please select a shop or no active shop selected.';
                return redirect()->route('seller.dashboard')->with('fail', $errorMessage);
                }

     $data = [
        'pageTitle' => 'Category & Sub categories Management',
     ];
        return view('backend.pages.seller.categories.cat-subcat-list', $data);
    }

    public function addCategory(Request $request)
    {


                        // Überprüfen, ob die Shop-ID in der Session vorhanden ist
                        $currentShopId = Session::get('currentShopId');
                        if ($currentShopId === null) {
                        // Fehlermeldung für den Fall, dass kein aktiver Shop ausgewählt wurde
                        $errorMessage = 'Please select a shop or no active shop selected.';
                        return redirect()->route('seller.dashboard')->with('fail', $errorMessage);
                        }

        // Laden der Größen mit sortierten Untergrößen und unter Berücksichtigung der Shop-ID
        $sizes = ModProductSizes::where('parent', 0)
            ->where('shop_id', $currentShopId)
            ->orderBy('ordering')
            ->get();


        $data = [
            'pageTitle' => 'Add Category',
            'categoryImage' => '', // Leeres Bild für die Vorschau
            'sizes' => $sizes, // Größen für die Dropdown-Liste
        ];
        return view('backend.pages.seller.categories.add-category', $data);
    }

    public function storeCategory(Request $request)
    {

       // dd($request->all());

        // Überprüfen, ob die Shop-ID in der Session vorhanden ist
        $currentShopId = Session::get('currentShopId');
        if ($currentShopId === null) {
        // Fehlermeldung für den Fall, dass kein aktiver Shop ausgewählt wurde
        $errorMessage = 'Please select a shop or no active shop selected.';
        return redirect()->route('seller.dashboard')->with('fail', $errorMessage);
        }

        $data = [
            'pageTitle' => 'Store Category',
        ];

        // validate the form data
        $request->validate([
            'category_name' => 'required|min:5',
            'category_description' => 'nullable|min:5',
            'category_image' => 'required|image|mimes:png,jpg,jpeg,svg',
        ],[
            'category_name.required' => 'Category name is required',
            'category_name.min' => 'Category name must be at least 5 characters',
            'category_description.required' => 'Category description is required',
            'category_description.min' => 'Category description must be at least 5 characters',
            'category_image.required' => 'Category image is required',
            'category_image.image' => 'Category image must be an image',
            'category_image.mimes' => 'Category image must be a file of type: png, jpg, jpeg, svg',
        ]);

        // store the form data
        if ($request->hasFile('category_image')) {
            $shopId = $currentShopId; // Hier die Shop-ID entsprechend deiner Anwendung setzen
            $path = 'uploads/shops/'.$shopId.'/images/category/';
            $file = $request->file('category_image');
            $originalFilename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $filename = time().'_'.$originalFilename;

            if (!File::exists(public_path($path))) {
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
                $category->category_description = $request->category_description;
                $category->category_image = $filename;
                $category->ordering = 100000;
                $category->sizes_category = $request->size_id;
                $category->show_in_list = true;
                $category->published = true;

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

        // Save the category image to the database
        $currentShopId = session('currentShopId');

//        dd($currentShopId);

        $category_id = $request->id;
        $category = ModCategory::findOrFail($category_id);

                // Laden der Größen mit sortierten Untergrößen und unter Berücksichtigung der Shop-ID
                $sizes = ModProductSizes::where('parent', 0)
                ->where('shop_id', $currentShopId)
                ->orderBy('ordering')
                ->get();



        $data = [
            'pageTitle' => 'Edit Category',
            'category' => $category,
            'sizes' => $sizes, // Größen für die Dropdown-Liste
        ];


        return view('backend.pages.seller.categories.edit-category', $data);
    }


    public function updateCategory(Request $request)
    {
        $categoryId = $request->category_id;
        $category = ModCategory::findOrFail($categoryId);

        // Validate the form data
        $request->validate([
            'category_name' => 'required|min:5',
            'category_image' => 'nullable|image|mimes:png,jpg,jpeg,svg',
        ], [
            'category_name.required' => 'Category name is required',
            'category_name.min' => 'Category name must be at least 5 characters',
            'category_image.image' => 'Category image must be an image',
            'category_image.mimes' => 'Category image must be a file of type: png, jpg, jpeg, svg',
        ]);

        $data = [
            'pageTitle' => 'Update Category',
        ];
//dd($category);
        if ($request->hasFile('category_image')) {
            $shopId = $category->shop_id;
            $path = 'uploads/shops/'.$shopId.'/images/category/';
            $file = $request->file('category_image');
            $originalFilename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $filename = time().'_'.$originalFilename;

            if (!File::exists(public_path($path))) {
                File::makeDirectory(public_path($path), 0777, true, true);
            }

            // Upload des Bildes
            $upload = $file->move(public_path($path), $filename);

            if ($upload) {
                // Lösche altes Kategoriebild vom Server
                if (File::exists(public_path($path.$category->category_image))) {
                    File::delete(public_path($path.$category->category_image));
                }

                // Aktualisiere Kategorieinformationen
                $category->category_name = $request->category_name;
                $category->category_image = $filename;
                $category->category_slug = null;
                $saved = $category->save();
            } else {
                return redirect()->route('seller.manage-categories.edit-category', ['id' => $categoryId])
                    ->with('fail', 'Something went wrong.');
            }
        } else {
            // Update category info
            $category->category_name = $request->category_name;
            $category->category_description = $request->category_description;
            $category->sizes_category = $request->size_id;
            $category->category_slug = null;
            $saved = $category->save();
        }

        if ($saved) {
            return redirect()->route('seller.manage-categories.edit-category', ['id' => $categoryId])
                ->with('success', ucfirst($request->category_name).' category has been updated.');
        } else {
            return redirect()->route('seller.manage-categories.edit-category', ['id' => $categoryId])
                ->with('fail', 'Something went wrong. Try again later.');
        }
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


    public function updateOrdering(Request $request)
    {
        // update order
        $positions = $request->positions;

        try {
            foreach ($positions as $position) {
                ModCategory::where('id', $position[0]) // Kategorie-ID
                           ->update(['ordering' => $position[1]]);
            }

            // Erfolgreiche Antwort zurückgeben
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Bei Fehlern Fehlermeldung zurückgeben
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function toggleShowInList(Request $request)
    {
        // Überprüfen, ob eine Kategorie-ID in der Anfrage vorhanden ist
        if ($request->has('id')) {
            // Kategorie-ID aus der Anfrage extrahieren
            $categoryId = $request->id;

            // Hier sollten Sie Ihre eigene Logik zum Umschalten des Status implementieren
            // Zum Beispiel, wenn der aktuelle Status true ist, setzen Sie ihn auf false und umgekehrt
            // Angenommen, Sie haben ein Eloquent-Modell für Ihre Kategorien mit dem Namen ModCategory
            $category = ModCategory::findOrFail($categoryId);
            $category->show_in_list = !$category->show_in_list;
            $category->save();

            // Erfolgreiche Antwort zurückgeben
            return response()->json(['success' => true, 'showInList' => $category->show_in_list]);
        } else {
            // Fehlermeldung zurückgeben, wenn keine Kategorie-ID vorhanden ist
            return response()->json(['success' => false, 'message' => 'Category ID not provided.']);
        }
    }

    public function toggleCategoryStatus(Request $request)
    {
        // Überprüfen, ob eine Kategorie-ID in der Anfrage vorhanden ist
        if ($request->has('id')) {
            // Kategorie-ID aus der Anfrage extrahieren
            $categoryId = $request->id;

            // Hier sollten Sie Ihre eigene Logik zum Umschalten des Status implementieren
            // Zum Beispiel, wenn der aktuelle Status true ist, setzen Sie ihn auf false und umgekehrt
            // Angenommen, Sie haben ein Eloquent-Modell für Ihre Kategorien mit dem Namen ModCategory
            $category = ModCategory::findOrFail($categoryId);
            $category->published = !$category->published;
            $category->save();

            // Erfolgreiche Antwort zurückgeben
            return response()->json(['success' => true, 'published' => $category->published]);
        } else {
            // Fehlermeldung zurückgeben, wenn keine Kategorie-ID vorhanden ist
            return response()->json(['success' => false, 'message' => 'Category ID not provided.']);
        }
    }

}
