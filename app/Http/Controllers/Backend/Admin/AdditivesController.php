<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\ModAdditives;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AdditivesController extends Controller
{
    //
    public function AdditivesList(Request $request)
    {


        $additives = ModAdditives::all(); // Holen Sie alle Zusatzstoffe aus der Datenbank

        $data = [
            'pageTitle' => 'Zusatzstoffe',
            'additives' => $additives // Fügen Sie die Zusatzstoffe-Daten dem Array hinzu, das an die Ansicht übergeben wird
        ];

        return view('backend.pages.admin.additives-list', $data);
    }

    public function addAdditive(Request $request)
    {

        $data = [
            'pageTitle' => 'Add Additive'
        ];

        return view('backend.pages.admin.additives-form', $data);
    }

    public function saveAdditive(Request $request)
    {


        // Validates
        $request->validate([
            'additive_nr' => 'required|min:1|max:10',
            'additive_art' => 'required|min:5',
            'additive_title' => 'required|min:5',
            'additive_description' => 'required|min:10',
            'additive_image' => 'required|image|mimes:png,jpg,jpeg,svg', // Korrigierte Validierung für das Bild
        ], [
            'additive_nr.required' => 'Bitte geben Sie die Nummer des Zusatzstoffs ein',
            'additive_nr.min' => 'Die Nummer des Zusatzstoffs muss mindestens 1 Zeichen lang sein',
            'additive_nr.max' => 'Die Nummer des Zusatzstoffs darf maximal 10 Zeichen lang sein',
            'additive_art.required' => 'Bitte geben Sie die Art des Zusatzstoffs ein',
            'additive_art.min' => 'Die Art des Zusatzstoffs muss mindestens 5 Zeichen lang sein',
            'additive_title.required' => 'Bitte geben Sie den Titel des Zusatzstoffs ein',
            'additive_title.min' => 'Der Titel des Zusatzstoffs muss mindestens 5 Zeichen lang sein',
            'additive_description.required' => 'Bitte geben Sie die Beschreibung des Zusatzstoffs ein',
            'additive_image.required' => 'Bitte laden Sie ein Bild des Zusatzstoffs hoch',

        ]);

     //   dd($request->all());

        // Bild hochladen
        if ($request->hasFile('additive_image') ){
            $path = 'uploads/images/additives'; // Pfad zum Speichern des Bildes
            $file = $request->file('additive_image'); // Bilddatei
            $file_name = 'additive_' . time() . '.' . $file->getClientOriginalExtension(); // Bildname

            if (!File::exists(public_path($path))){
                File::makeDirectory(public_path($path), 0777, true);
            }

            $upload = $file->move(public_path($path), $file_name); // Bild hochladen
//dd($upload);

            if ($upload){
                $additive = new ModAdditives(); // Neues Modell für den Zusatzstoff
                $additive->additive_nr = $request->additive_nr;
                $additive->additive_art = $request->additive_art;
                $additive->additive_title = $request->additive_title;
             //   $additive->additive_slug = Str::slug($request->additive_title);
                $additive->additive_description = $request->additive_description;
            //    $additive->lang = $request->lang;
           //     $additive->ordering = $request->ordering;
           //     $additive->published = $request->published;
                $additive->additive_date = date('Y-m-d H:i:s');
                $additive->additive_image = $path . '/' . $file_name; // Bildpfad speichern
                $saved = $additive->save(); // Zusatzstoff speichern

                if ($saved){
                    $request->session()->flash('success', 'Zusatzstoff erfolgreich hinzugefügt');
                    return redirect()->back()->with('success', 'Zusatzstoff erfolgreich hinzugefügt');

                }else{
                    $request->session()->flash('error', 'Der Zusatzstoff konnte nicht gespeichert werden');
                    return redirect()->back()->withInput();
                }

            }else{
                $request->session()->flash('error', 'Das Bild konnte nicht hochgeladen werden');
                return redirect()->back()->withInput();
            }
        }



      //  return redirect()->route('admin.additives-list'); // Weiterleitung zur Liste der Zusatzstoffe
    }

    public function editAdditive($id)
    {
        $additive = ModAdditives::findOrFail($id);
        $data = [
            'pageTitle' => 'Edit Additive',
            'additive' => $additive
        ];

        return view('backend.pages.admin.additives-form', $data);
    }

    public function updateAdditive(Request $request, $id)
    {
        // Validates
        $request->validate([
            'additive_nr' => 'required|min:1',
            'additive_art' => 'required|min:5',
            'additive_title' => 'required|min:5',
            'additive_description' => 'required|min:10',
            'additive_image' => 'nullable|image|mimes:png,jpg,jpeg,svg', // Falls ein neues Bild hochgeladen wird
        ], [
            'additive_nr.required' => 'Bitte geben Sie die Nummer des Zusatzstoffs ein',
            'additive_art.required' => 'Bitte geben Sie die Art des Zusatzstoffs ein',
            'additive_art.min' => 'Die Art des Zusatzstoffs muss mindestens 5 Zeichen lang sein',
            'additive_title.required' => 'Bitte geben Sie den Titel des Zusatzstoffs ein',
            'additive_description.required' => 'Bitte geben Sie die Beschreibung des Zusatzstoffs ein',
        ]);

        $additive = ModAdditives::findOrFail($id);

        // Bild aktualisieren, wenn ein neues Bild hochgeladen wird
        if ($request->hasFile('additive_image')) {
            $path = 'uploads/images/additives';
            $file = $request->file('additive_image');
            $file_name = 'additive_' . time() . '.' . $file->getClientOriginalExtension();
            $upload = $file->move(public_path($path), $file_name);

            if ($upload) {
                // Löschung des alten Bildes
                if (File::exists(public_path($additive->additive_image))) {
                    File::delete(public_path($additive->additive_image));
                }

                // Bildpfad aktualisieren
                $additive->additive_image = $path . '/' . $file_name;
            }
        }

        $additive->additive_nr = $request->additive_nr;
        $additive->additive_art = $request->additive_art;
        $additive->additive_title = $request->additive_title;
        $additive->additive_description = $request->additive_description;

        $saved = $additive->save();

        if ($saved) {
            return redirect()->route('admin.additives-list')->with('success', 'Additiv erfolgreich aktualisiert');
        } else {
            return redirect()->back()->withInput()->with('error', 'Fehler beim Aktualisieren des Additivs');
        }
    }


    public function deleteAdditive(Request $request)
    {
        $additive = ModAdditives::findOrFail($request->id); // Finden Sie das Additiv anhand der ID

        // delete the image
        if (File::exists(public_path($additive->additive_image))) {
            File::delete(public_path($additive->additive_image));
        }

        $deleted = $additive->delete(); // Löschen Sie das Additiv

        if ($deleted){
            $request->session()->flash('success', 'Additiv erfolgreich gelöscht');
            return redirect()->back();
        }else{
            $request->session()->flash('error', 'Additiv konnte nicht gelöscht werden');
            return redirect()->back();
        }
    }

    public function toggleAdditiveStatus(Request $request)
    {
        // Überprüfen Sie zunächst, ob die Anfrage gültig ist

        $request->validate([
            'id' => 'required|exists:mod_additives,id'
        ]);

        // Finden Sie den Zusatzstoff in der Datenbank
        $additive = ModAdditives::findOrFail($request->id);

        // Aktualisieren Sie den Status des Zusatzstoffs
        $additive->published = !$additive->published; // Invertieren Sie den aktuellen Status

        // Speichern Sie die Änderungen in der Datenbank
        $additive->save();

        // Geben Sie eine JSON-Antwort zurück
        return response()->json([
            'success' => true,
            'published' => $additive->published
        ]);
    }

}
