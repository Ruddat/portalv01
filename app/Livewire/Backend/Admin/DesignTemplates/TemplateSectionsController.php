<?php

namespace App\Livewire\Backend\Admin\DesignTemplates;

use Livewire\Component;
use App\Models\ModSharedTemplateSections;

class TemplateSectionsController extends Component
{
    public $templateId;
    public $sections = [];
    public $newSection = ['name' => '', 'content' => '', 'type' => 'section', 'editable' => true];

    public function mount($templateId)
    {
        $this->templateId = $templateId;
        $this->sections = ModSharedTemplateSections::where('template_id', $templateId)->get()->toArray();
    }

    public function addSection()
    {
        $this->sections[] = $this->newSection;
    }

    public function removeSection($index)
    {
        unset($this->sections[$index]);
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

    public function render()
    {
        return view('livewire.backend.admin.design-templates.template-sections-controller');
    }
}
