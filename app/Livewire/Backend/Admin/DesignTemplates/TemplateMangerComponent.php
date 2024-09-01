<?php

namespace App\Livewire\Backend\Admin\DesignTemplates;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\ModSharedTemplates;
use App\Models\ModSharedTemplateJs;
use App\Models\ModSharedTemplateCss;
use App\Models\ModSharedTemplateImages;
use Illuminate\Support\Facades\Storage;
use App\Models\ModSharedTemplateSections;

class TemplateMangerComponent extends Component
{
    use WithFileUploads;

    public $templates;
    public $showCreateForm = false;

    public $templateId;
    public $sections = [];
    public $newSection = ['name' => '', 'content' => '', 'type' => 'section', 'editable' => true];

    public $templateName;
    public $description;
    public $previewImage;
    public $htmlSkeleton;
    public $cssFiles = [];
    public $jsFiles = [];
    public $imageFiles = []; // Hinzugefügt für das Hochladen von Bildern

    public $editable;

    public function mount($templateId = null)
    {
        $this->templates = ModSharedTemplates::all();

        if ($templateId) {
            $this->templateId = $templateId;
            $this->sections = ModSharedTemplateSections::where('template_id', $templateId)->get()->toArray();
        }
    }

    public function render()
    {
        return view('livewire.backend.admin.design-templates.template-manger-component', [
            'templates' => $this->templates
        ]);
    }

    public function showCreateTemplateForm()
    {
        $this->resetForm();
        $this->showCreateForm = true;
    }

    public function hideCreateTemplateForm()
    {
        $this->showCreateForm = false;
    }

    public function saveTemplate()
    {
        $uploadDirectory = 'uploads/templates/' . Str::slug($this->templateName);

        if (!Storage::disk('public')->exists($uploadDirectory)) {
            Storage::disk('public')->makeDirectory($uploadDirectory);
        }

        // Speichere das Vorschaubild mit seinem echten Namen
        $previewImageName = $this->previewImage->getClientOriginalName();
        $previewImagePath = $this->previewImage->storeAs($uploadDirectory, $previewImageName, 'public');

        // Speichere das Template in der Datenbank
        $template = ModSharedTemplates::create([
            'name' => $this->templateName,
            'description' => $this->description,
            'html_skeleton' => $this->htmlSkeleton,
            'preview_image' => $previewImagePath
        ]);

        // Speichere die CSS-Dateien mit ihren echten Namen
        foreach ($this->cssFiles as $css) {
            $cssFileName = $css->getClientOriginalName();
            $cssFilePath = $css->storeAs($uploadDirectory . '/css', $cssFileName, 'public');

            ModSharedTemplateCss::create([
                'template_id' => $template->id,
                'file_path' => $cssFilePath
            ]);
        }

        // Speichere die JS-Dateien mit ihren echten Namen
        foreach ($this->jsFiles as $js) {
            $jsFileName = $js->getClientOriginalName();
            $jsFilePath = $js->storeAs($uploadDirectory . '/js', $jsFileName, 'public');

            ModSharedTemplateJs::create([
                'template_id' => $template->id,
                'file_path' => $jsFilePath
            ]);
        }

        // Speichere die Bilddateien mit ihren echten Namen
        foreach ($this->imageFiles as $image) {
            $imageFileName = $image->getClientOriginalName();
            $imageFilePath = $image->storeAs($uploadDirectory . '/images', $imageFileName, 'public');

            ModSharedTemplateImages::create([
                'template_id' => $template->id,
                'file_path' => $imageFilePath
            ]);
        }

        session()->flash('message', 'Template erfolgreich erstellt!');
        $this->hideCreateTemplateForm();
        $this->mount();
    }

    public function resetForm()
    {
        $this->templateName = '';
        $this->description = '';
        $this->previewImage = null;
        $this->htmlSkeleton = '';
        $this->cssFiles = [];
        $this->jsFiles = [];
        $this->imageFiles = [];
    }

    public function addSection()
    {
        $this->sections[] = $this->newSection;
    }

    public function removeSection($index)
    {
        // Prüfen, ob der Abschnitt eine ID hat (existiert in der Datenbank)
        if (isset($this->sections[$index]['id'])) {
            // Abschnitt aus der Datenbank löschen
            ModSharedTemplateSections::destroy($this->sections[$index]['id']);
        }

        // Abschnitt aus dem Array entfernen
        unset($this->sections[$index]);

        // Array neu indizieren, um Lücken zu vermeiden
        $this->sections = array_values($this->sections);
    }

    public function saveSections()
    {
        foreach ($this->sections as $sectionData) {
            if (isset($sectionData['id'])) {
                $section = ModSharedTemplateSections::find($sectionData['id']);
                $section->update($sectionData);
            } else {
                ModSharedTemplateSections::create(array_merge($sectionData, ['template_id' => $this->templateId]));
            }
        }

        session()->flash('message', 'Sections erfolgreich gespeichert!');
    }

    public function editTemplate($templateId)
    {
        // Setze die Template-ID
        $this->templateId = $templateId;

        // Lade die Abschnitte (Sections) für das ausgewählte Template
        $this->sections = ModSharedTemplateSections::where('template_id', $templateId)->get()->toArray();
    }

    public function deleteTemplate($templateId)
    {
        // Hole das Template
        $template = ModSharedTemplates::find($templateId);

        if (!$template) {
            session()->flash('error', 'Template nicht gefunden.');
            return;
        }

        // Lösche alle zugehörigen CSS-Dateien
        $cssFiles = ModSharedTemplateCss::where('template_id', $templateId)->get();
        foreach ($cssFiles as $cssFile) {
            // Datei vom Dateisystem löschen
            Storage::disk('public')->delete($cssFile->file_path);
            // Eintrag aus der Datenbank löschen
            $cssFile->delete();
        }

        // Lösche alle zugehörigen JS-Dateien
        $jsFiles = ModSharedTemplateJs::where('template_id', $templateId)->get();
        foreach ($jsFiles as $jsFile) {
            // Datei vom Dateisystem löschen
            Storage::disk('public')->delete($jsFile->file_path);
            // Eintrag aus der Datenbank löschen
            $jsFile->delete();
        }

        // Lösche alle zugehörigen Abschnitte
        $sections = ModSharedTemplateSections::where('template_id', $templateId)->get();
        foreach ($sections as $section) {
            $section->delete();
        }

        // Lösche alle zugehörigen Bilder
        $imageFiles = ModSharedTemplateImages::where('template_id', $templateId)->get();
        foreach ($imageFiles as $imageFile) {
            // Datei vom Dateisystem löschen
            Storage::disk('public')->delete($imageFile->file_path);
            // Eintrag aus der Datenbank löschen
            $imageFile->delete();
        }

        // Lösche das Vorschaubild vom Dateisystem
        Storage::disk('public')->delete($template->preview_image);

        // Lösche das Verzeichnis des Templates (inkl. aller darin befindlichen Dateien)
        $uploadDirectory = 'uploads/templates/' . Str::slug($template->name);
        Storage::disk('public')->deleteDirectory($uploadDirectory);

        // Lösche das Template aus der Datenbank
        $template->delete();

        // Erfolgsmeldung
        session()->flash('message', 'Template erfolgreich gelöscht!');

        // Templates neu laden
        $this->mount();
    }
}
