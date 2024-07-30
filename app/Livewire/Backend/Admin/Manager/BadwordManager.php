<?php

namespace App\Livewire\Backend\Admin\Manager;

use Livewire\Component;
use App\Models\ModAdminBadword;

class BadwordManager extends Component
{
    public $badwords;
    public $word;
    public $editId = null;
    public $editWord;

    protected $rules;

    public function __construct()
    {
        $this->rules = [
            'word' => 'required|string|max:255|unique:mod_admin_badwords,word',
            'editWord' => 'required|string|max:255|unique:mod_admin_badwords,word,' . $this->editId
        ];
    }

    public function mount()
    {
        $this->badwords = ModAdminBadword::all();
    }

    public function addBadword()
    {
        $this->validate([
            'word' => 'required|string|max:255|unique:mod_admin_badwords,word'
        ]);

        ModAdminBadword::create(['word' => $this->word, 'count' => 0]);
        $this->badwords = ModAdminBadword::all();
        $this->word = '';
    }

    public function editBadword($id)
    {
        $this->editId = $id;
        $this->editWord = ModAdminBadword::find($id)->word;
    }

    public function updateBadword()
    {
        $this->validate([
            'editWord' => 'required|string|max:255|unique:mod_admin_badwords,word,' . $this->editId
        ]);

        $badword = ModAdminBadword::find($this->editId);
        $badword->update(['word' => $this->editWord]);
        $this->badwords = ModAdminBadword::all();
        $this->editId = null;
        $this->editWord = '';
    }

    public function deleteBadword($id)
    {
        ModAdminBadword::find($id)->delete();
        $this->badwords = ModAdminBadword::all();
    }

    public function render()
    {
        return view('livewire.backend.admin.manager.badword-manager');

    }
}

