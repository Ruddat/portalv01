<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\ModBottles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BottlesController extends Controller
{
    //
    Public function BottlesList(Request $request)
    {

        // Hole alle Flaschen aus der Datenbank
        $bottles = ModBottles::all();

        $data = [
            'pageTitle' => 'Bottles deposit',
            'bottles' => $bottles
        ];

        return view('backend.pages.admin.bottles-list', $data);
    }


    public function addBottle(Request $request)
    {

        $data = [
            'pageTitle' => 'Add Bottle'
        ];

        return view('backend.pages.admin.bottles-form', $data);
    }

    public function saveBottle(Request $request)
    {

     //   dd($request->all());
        // Validate the request
        $request->validate([
            'bottle_title' => 'required|min:5',
            'bottle_value' => 'required|numeric|min:0'
        ], [
            'bottle_title.required' => 'Please enter the bottle title',
            'bottle_title.min' => 'The bottle title must be at least 5 characters long',
            'bottle_value.required' => 'Please enter the bottle value',
            'bottle_value.numeric' => 'The bottle value must be a number',
            'bottle_value.min' => 'The bottle value must be at least 0',
        ]);

        // Create a new instance of ModBottles
        $bottle = new ModBottles();

        // Set the properties of the ModBottles instance
        $bottle->bottles_title = $request->bottle_title;
        $bottle->bottles_value = $request->bottle_value;
        //$bottle->published = $request->published;
        $bottle->date = date('Y-m-d H:i:s');

        // Save the ModBottles instance to the database
        $bottle->save();

        // Redirect to the bottles list page
        // return redirect()->route('admin.bottles-list')->with('success', 'Bottle added successfully');
        return back()->with('success', 'Bottle added successfully');
    }

    public function editBottle(Request $request, $id)
    {
        $bottle = ModBottles::find($id);

        $data = [
            'pageTitle' => 'Edit Bottle',
            'bottle' => $bottle
        ];

        return view('backend.pages.admin.bottles-form', $data);
    }


    public function updateBottle(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'bottle_title' => 'required|min:5',
            'bottle_value' => 'required|numeric|min:0'
        ], [
            'bottle_title.required' => 'Please enter the bottle title',
            'bottle_title.min' => 'The bottle title must be at least 5 characters long',
            'bottle_value.required' => 'Please enter the bottle value',
            'bottle_value.numeric' => 'The bottle value must be a number',
            'bottle_value.min' => 'The bottle value must be at least 0',
        ]);

        // Find the bottle in the database
        $bottle = ModBottles::find($id);

        // Set the properties of the ModBottles instance
        $bottle->bottles_title = $request->bottle_title;
        $bottle->bottles_value = $request->bottle_value;
      //  $bottle->published = $request->published;
        $bottle->date = date('Y-m-d H:i:s');

        // Save the ModBottles instance to the database
        $bottle->save();

        // Redirect to the bottles list page
        return redirect()->route('admin.bottles-list')->with('success', 'Bottle updated successfully');
    }

    public function toggleBottleStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:mod_bottles,id'
        ]);

        // Finden Sie den Zusatzstoff in der Datenbank
        $bottle = ModBottles::findOrFail($request->id);

        // Aktualisieren Sie den Status des Zusatzstoffs
        $bottle->published = !$bottle->published; // Invertieren Sie den aktuellen Status

        // Speichern Sie die Änderungen in der Datenbank
        $bottle->save();

        // Geben Sie eine JSON-Antwort zurück
        return response()->json([
            'success' => true,
            'published' => $bottle->published
        ]);
    }

    public function deleteBottle(Request $request)
    {
        // Find the bottle in the database
        $bottle = ModBottles::find($request->id);

        // Delete the ModBottles instance from the database
        $bottle->delete();

        // Redirect to the bottles list page
        return redirect()->route('admin.bottles-list')->with('success', 'Bottle deleted successfully');
    }
}
