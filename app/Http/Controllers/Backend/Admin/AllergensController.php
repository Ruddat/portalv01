<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\ModAllergens;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AllergensController extends Controller
{
    //
    public function AllergensList(Request $request)
    {

        $additives = ModAllergens::all(); // Holen Sie alle Zusatzstoffe aus der Datenbank

        $data = [
            'pageTitle' => 'Allergene',
            'additives' => $additives // Fügen Sie die Zusatzstoffe-Daten dem Array hinzu, das an die Ansicht übergeben wird
        ];

        return view('backend.pages.admin.allergens-list', $data);
    }

    public function addAllergen(Request $request)
    {

        $data = [
            'pageTitle' => 'Add Allergen'
        ];

        return view('backend.pages.admin.allergens-form', $data);
    }



    public function saveAllergen(Request $request)
    {

     //   dd($request->all());

        // Validate the request
        $request->validate([
            'allergen_short_title' => 'required|min:5',
            'allergen_title' => 'required|min:10',
        ], [
            'allergen_short_title.required' => 'Bitte geben Sie die Nummer des Allergens ein',
            'allergen_short_title.min' => 'Die Nummer des Allergens muss mindestens 5 Zeichen lang sein',
            'allergen_title.required' => 'Bitte geben Sie den Titel des Allergens ein',
            'allergen_title.min' => 'Der Titel des Allergens muss mindestens 10 Zeichen lang sein',
        ]);

        // Create a new instance of ModAllergens
        $allergen = new ModAllergens();

        // Set the properties of the ModAllergens instance
        $allergen->allergenic_short_title = $request->allergen_short_title;
        $allergen->allergenic_title = $request->allergen_title;
        // $allergen->published = $request->published;
        $allergen->date = date('Y-m-d H:i:s');

        // Save the ModAllergens instance to the database
        $allergen->save();

        // Redirect the user to the list of allergens

        return redirect()->route('admin.allergens-list')->with('success', 'Allergen wurde erfolgreich hinzugefügt');
    }


    public function editAllergen(Request $request, $id)
    {
        // Find the allergen in the database
        $allergen = ModAllergens::findOrFail($id);

        // Prepare the data to be passed to the view
        $data = [
            'pageTitle' => 'Edit Allergen',
            'allergen' => $allergen
        ];


       // dd($data);

        // Load the view and pass the data
        return view('backend.pages.admin.allergens-form', $data);
    }

    public function updateAllergen(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'allergen_short_title' => 'required|min:3',
            'allergen_title' => 'required|min:10',
        ], [
            'allergen_short_title.required' => 'Bitte geben Sie den Titel des Allergens ein',
            'allergen_short_title.min' => 'Der Titel des Allergens muss mindestens 3 Zeichen lang sein',
            'allergen_title.required' => 'Bitte geben Sie den Titel des Allergens ein',
            'allergen_title.min' => 'Der Titel des Allergens muss mindestens 10 Zeichen lang sein',
        ]);

        // Find the allergen in the database
        $allergen = ModAllergens::findOrFail($id);

        // Update the properties of the ModAllergens instance
        $allergen->allergenic_short_title = $request->allergen_short_title;
        $allergen->allergenic_title = $request->allergen_title;
        // $allergen->published = $request->published;

        // Save the ModAllergens instance to the database
        $allergen->save();

        // Redirect the user to the list of allergens
        return redirect()->route('admin.allergens-list')->with('success', 'Allergen wurde erfolgreich aktualisiert');
    }


    public function deleteAllergen(Request $request)
    {
        // Validate the request
        $request->validate([
            'id' => 'required|exists:mod_allergens,id'
        ]);

        // Find the allergen in the database
        $allergen = ModAllergens::findOrFail($request->id);

        // Delete the allergen from the database
        $allergen->delete();

        // Redirect the user to the list of allergens
        return redirect()->route('admin.allergens-list')->with('success', 'Allergen wurde erfolgreich gelöscht');
    }

    public function toggleAllergenStatus(Request $request)
    {
        // Überprüfen Sie zunächst, ob die Anfrage gültig ist

        $request->validate([
            'id' => 'required|exists:mod_allergens,id'
        ]);

        // Finden Sie den Zusatzstoff in der Datenbank
        $allergen = ModAllergens::findOrFail($request->id);

        // Aktualisieren Sie den Status des Zusatzstoffs
        $allergen->published = !$allergen->published; // Invertieren Sie den aktuellen Status

        // Speichern Sie die Änderungen in der Datenbank
        $allergen->save();

        // Geben Sie eine JSON-Antwort zurück
        return response()->json([
            'success' => true,
            'published' => $allergen->published
        ]);
    }








}
