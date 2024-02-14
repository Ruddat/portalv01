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

        return view('backend.pages.admin.addedit.additive-add', $data);
    }

    public function saveAdditive(Request $request)
    {


        // Validates
        $request->validate([
            'additive_nr' => 'required|min:1',
            'additive_art' => 'required|min:5',
            'additive_title' => 'required|min:5',
            'additive_description' => 'required|min:10',
            'additive_image' => 'required|image|mimes:png,jpg,jpeg,svg', // Korrigierte Validierung für das Bild
        ], [
            'additive_nr.required' => 'Bitte geben Sie die Nummer des Zusatzstoffs ein',
            'additive_art.required' => 'Bitte geben Sie die Art des Zusatzstoffs ein',
            'additive_art.min' => 'Die Art des Zusatzstoffs muss mindestens 5 Zeichen lang sein',
          //  'additive_art.unique' => 'Die Art des Zusatzstoffs existiert bereits',
            'additive_title.required' => 'Bitte geben Sie den Titel des Zusatzstoffs ein',
            'additive_description.required' => 'Bitte geben Sie die Beschreibung des Zusatzstoffs ein',
            'additive_image.required' => 'Bitte laden Sie das Bild des Zusatzstoffs hoch',
           // 'additive_image.image' => 'Das Bild des Zusatzstoffs muss eine Bilddatei sein',
          //  'additive_image.mimes' => 'Das Bild des Zusatzstoffs muss eine Bilddatei im Format png, jpg, jpeg oder svg sein'
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

}
