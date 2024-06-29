<?php

namespace App\Livewire\Backend\Admin\Manager;

use Livewire\Component;
use App\Models\Translation;
use Livewire\WithPagination;

class TranslationManager extends Component
{
    use WithPagination;

    public $search = '';
    public $locale = '';
    public $perPage = 10;
    public $saveUpdatedTranslations = [];

    protected $queryString = [
        'search' => ['except' => ''],
        'locale' => ['except' => ''],
        'perPage' => ['except' => 10],
    ];

    public function mount()
    {
        $this->initializeTranslations();
    }

    public function initializeTranslations()
    {
        $translations = Translation::when($this->search, function ($query) {
            $query->where('text', 'like', '%' . $this->search . '%');
        })
        ->when($this->locale, function ($query) {
            $query->where('locale', $this->locale);
        })
        ->paginate($this->perPage);

        foreach ($translations as $translation) {
            $this->saveUpdatedTranslations[$translation->id] = $translation->text;
        }
    }

    public function updatedSearch()
    {
        $this->resetPage();
        $this->initializeTranslations();
    }

    public function updatedLocale()
    {
        $this->resetPage();
        $this->initializeTranslations();
    }

    public function render()
    {
        $translations = Translation::when($this->search, function ($query) {
            $query->where('text', 'like', '%' . $this->search . '%');
        })
        ->when($this->locale, function ($query) {
            $query->where('locale', $this->locale);
        })
        ->paginate($this->perPage);

        foreach ($translations as $translation) {
            if (!isset($this->saveUpdatedTranslations[$translation->id])) {
                $this->saveUpdatedTranslations[$translation->id] = $translation->text;
            }
        }

        return view('livewire.backend.admin.manager.translation-manager', [
            'translations' => $translations,
            'locales' => $this->getAvailableLocales(),
        ]);
    }

    public function saveTranslations()
    {
        foreach ($this->saveUpdatedTranslations as $id => $text) {
            $translation = Translation::find($id);
            if ($translation) {
                $translation->update(['text' => $text]);
            }
        }

        $this->dispatch('toast', message: 'Translations updated successfully.', notify:'success' );
        $this->initializeTranslations();
    }

    public function deleteTranslation($id)
    {
        Translation::find($id)->delete();
        $this->resetPage();
        $this->initializeTranslations();
    }

    protected function getAvailableLocales()
    {
        return Translation::select('locale')->distinct()->pluck('locale');
    }
}
