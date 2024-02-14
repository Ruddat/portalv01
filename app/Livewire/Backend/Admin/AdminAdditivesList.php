<?php

namespace App\Livewire\Backend\Admin;

use Livewire\Component;
use App\Models\ModAdditives;


class AdminAdditivesList extends Component
{

    public $additiveId;

    public function render()
    {
        return view('livewire.backend.admin.admin-additives-list', [
            'additives' => ModAdditives::orderBy('ordering', 'ASC')->get()
        ]);
    }
    public function editAdditive($id)
    {
        // Hier können Sie die Logik für das Bearbeiten des Additivs implementieren
        // Zum Beispiel Weiterleitung zur Bearbeitungsseite
        return redirect()->route('admin.edit-additive', ['id' => $id]);
    }

    public function deleteAdditive($id)
    {
        // Hier können Sie die Logik für das Löschen des Additivs implementieren
        // Zum Beispiel Löschen des Additivs aus der Datenbank
        ModAdditives::find($id)->delete();
        // JavaScript-Aufruf, um die Seite neu zu laden
        $this->dispatch('reloadPage');
    }

}
