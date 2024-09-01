<?php

namespace App\Livewire\Backend\Seller\WebTemplates;

use Livewire\Component;
use App\Models\ModSharedTemplates;
use App\Models\ModSharedTemplateJs;
use App\Models\ModSharedTemplateCss;
use App\Models\ModSharedUserTemplates;
use App\Models\ModSharedTemplateSections;

class TemplatePreviewComponent extends Component
{
    public $shopId;
    public $templateId;
    public $templateData;
    public $templateContent;

    public function mount($shopId, $templateId)
    {
        $this->shopId = $shopId;
        $this->templateId = $templateId;

        // Lade das Template und seine zugehörigen Daten
        $this->templateData = ModSharedTemplates::find($templateId);

        if ($this->templateData) {
            $this->templateData->css = ModSharedTemplateCss::where('template_id', $templateId)->get();
            $this->templateData->js = ModSharedTemplateJs::where('template_id', $templateId)->get();
            $this->templateData->sections = ModSharedTemplateSections::where('template_id', $templateId)->get();

            // Hier wird der Inhalt der Sektionen zusammengeführt und die Pfade angepasst
            $this->templateContent = $this->mergeAndReplaceSections();
        }
    }

    protected function mergeAndReplaceSections()
    {
        // Zusammenführen der Inhalte der Sektionen
        $content = '';

        foreach ($this->templateData->sections as $section) {
            $content .= $section->content;
        }

        // Definiere den korrekten Pfad für die Bilder
        $shopAssetPath = asset("storage/uploads/shops/{$this->shopId}/templates/template_{$this->templateId}/images");

        // Ersetze alle statischen Pfade durch den dynamischen Pfad
        $content = str_replace("assets/images/shapes", $shopAssetPath, $content);
        $content = str_replace("assets/images/background", $shopAssetPath, $content);
        $content = str_replace("assets/images/about", $shopAssetPath, $content);
        $content = str_replace("assets/images/offer", $shopAssetPath, $content);
        return $content;
    }

    public function render()
    {
        return view('livewire.backend.seller.web-templates.template-preview-component', [
            'templateContent' => $this->templateContent,
            'templateData' => $this->templateData,
        ]);
    }
}
