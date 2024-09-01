<?php

namespace App\Livewire\Backend\Admin\DesignTemplates;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\ModSharedTemplates;
use App\Models\ModSharedTemplateJs;
use App\Models\ModSharedTemplateCss;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\ModSharedTemplateSections;

class CreateTemplate extends Component
{
    use WithFileUploads;

    public $templateName;
    public $description;
    public $previewImage;
    public $htmlSkeleton;
    public $cssFiles = [];
    public $jsFiles = [];

    public function saveTemplate()
    {
        $uploadDirectory = 'uploads/templates/' . Str::slug($this->templateName);

        // Erstelle das Verzeichnis, falls es nicht existiert
        if (!Storage::disk('public')->exists($uploadDirectory)) {
            Storage::disk('public')->makeDirectory($uploadDirectory);
        }

        // Speichere das Vorschaubild im öffentlichen Verzeichnis
        $previewImagePath = $this->previewImage->store($uploadDirectory, 'public');

        $template = ModSharedTemplates::create([
            'name' => $this->templateName,
            'description' => $this->description,
            'html_skeleton' => $this->htmlSkeleton,
            'preview_image' => $previewImagePath
        ]);

        foreach ($this->cssFiles as $css) {
            ModSharedTemplateCss::create([
                'template_id' => $template->id,
                'file_path' => $css->store($uploadDirectory . '/css', 'public')
            ]);
        }

        foreach ($this->jsFiles as $js) {
            ModSharedTemplateJs::create([
                'template_id' => $template->id,
                'file_path' => $js->store($uploadDirectory . '/js', 'public')
            ]);
        }

        session()->flash('message', 'Template erfolgreich erstellt!');
    }

    public function render()
    {
        return view('livewire.backend.admin.design-templates.create-template');
    }
}
