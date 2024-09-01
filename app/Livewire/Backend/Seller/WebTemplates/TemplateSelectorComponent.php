<?php

namespace App\Livewire\Backend\Seller\WebTemplates;

use Livewire\Component;
use App\Models\ModSharedTemplates;
use App\Models\ModSharedTemplateCss;
use App\Models\ModSharedUserTemplates;
use App\Models\ModSharedTemplateImages;
use Illuminate\Support\Facades\Storage;
use App\Models\ModSharedTemplateJs; // Modell für JS-Dateien
use App\Models\ModSharedTemplateCsses; // Modell für CSS-Dateien

class TemplateSelectorComponent extends Component
{
    public $shopId;
    public $templates; // Alle verfügbaren Templates
    public $selectedTemplates = []; // IDs der ausgewählten Templates

    public function mount($shopId)
    {
        $this->shopId = $shopId;
        $this->templates = ModSharedTemplates::all(); // Lade alle Templates

        // Lade die ausgewählten Templates aus der Datenbank
        $this->selectedTemplates = ModSharedUserTemplates::where('shop_id', $this->shopId)
            ->where('user_id', auth()->id())
            ->pluck('template_id')
            ->toArray();
    }

    public function selectTemplate($templateId)
    {
        if (!in_array($templateId, $this->selectedTemplates)) {
            $this->selectedTemplates[] = $templateId;

            // Template-Daten in die neue Tabelle eintragen
            ModSharedUserTemplates::create([
                'user_id' => auth()->id(),
                'shop_id' => $this->shopId,
                'template_id' => $templateId,
                'selected_sections' => null, // Initial oder später ausgefüllt
            ]);

            // Kopiere die Template-Daten in den Shop-Ordner
            $this->copyTemplateToShop($templateId);
        }
    }

    public function copyTemplateToShop($templateId)
    {
        // Bilder kopieren
        $this->copyImages($templateId);

        // CSS-Dateien kopieren
        $this->copyCssFiles($templateId);

        // JS-Dateien kopieren
        $this->copyJsFiles($templateId);

        session()->flash('message', 'Template erfolgreich ausgewählt und Daten kopiert.');
    }

    protected function copyImages($templateId)
    {
        $templateImages = ModSharedTemplateImages::where('template_id', $templateId)->get();
        $shopTemplatePath = "uploads/shops/{$this->shopId}/templates/template_$templateId/images";

        Storage::disk('public')->makeDirectory($shopTemplatePath, 0755, true);

        foreach ($templateImages as $image) {
            $sourceFile = $image->file_path;
            $fileName = basename($sourceFile);
            $destinationFile = "$shopTemplatePath/$fileName";

            if (Storage::disk('public')->exists($sourceFile)) {
                Storage::disk('public')->copy($sourceFile, $destinationFile);
            } else {
                session()->flash('error', "Die Datei $fileName existiert nicht im Quellverzeichnis.");
            }
        }
    }

    protected function copyCssFiles($templateId)
    {
        $templateCssFiles = ModSharedTemplateCss::where('template_id', $templateId)->get();
        $shopCssPath = "uploads/shops/{$this->shopId}/templates/template_$templateId/css";

        Storage::disk('public')->makeDirectory($shopCssPath, 0755, true);

        foreach ($templateCssFiles as $cssFile) {
            $sourceFile = $cssFile->file_path;
            $fileName = basename($sourceFile);
            $destinationFile = "$shopCssPath/$fileName";

            if (Storage::disk('public')->exists($sourceFile)) {
                Storage::disk('public')->copy($sourceFile, $destinationFile);
            } else {
                session()->flash('error', "Die CSS-Datei $fileName existiert nicht im Quellverzeichnis.");
            }
        }
    }

    protected function copyJsFiles($templateId)
    {
        $templateJsFiles = ModSharedTemplateJs::where('template_id', $templateId)->get();
        $shopJsPath = "uploads/shops/{$this->shopId}/templates/template_$templateId/js";

        Storage::disk('public')->makeDirectory($shopJsPath, 0755, true);

        foreach ($templateJsFiles as $jsFile) {
            $sourceFile = $jsFile->file_path;
            $fileName = basename($sourceFile);
            $destinationFile = "$shopJsPath/$fileName";

            if (Storage::disk('public')->exists($sourceFile)) {
                Storage::disk('public')->copy($sourceFile, $destinationFile);
            } else {
                session()->flash('error', "Die JS-Datei $fileName existiert nicht im Quellverzeichnis.");
            }
        }
    }

    public function removeTemplate($templateId)
    {
        $this->selectedTemplates = array_filter($this->selectedTemplates, function($id) use ($templateId) {
            return $id !== $templateId;
        });

        $shopTemplatePath = "uploads/shops/{$this->shopId}/templates/template_$templateId";
        Storage::disk('public')->deleteDirectory($shopTemplatePath);

        ModSharedUserTemplates::where('user_id', auth()->id())
            ->where('shop_id', $this->shopId)
            ->where('template_id', $templateId)
            ->delete();

        session()->flash('message', 'Template erfolgreich entfernt.');
    }

    public function previewTemplate($templateId)
    {
        return redirect()->route('seller.web-templates.preview', ['shopId' => $this->shopId, 'templateId' => $templateId]);
    }

    public function render()
    {
        return view('livewire.backend.seller.web-templates.template-selector-component', [
            'templates' => $this->templates,
            'selectedTemplates' => $this->selectedTemplates
        ]);
    }
}
