<?php

namespace App\Livewire\Backend;

use Livewire\Component;

class AdminSettings extends Component
{

    public $tab = null;
    public $default_tab = 'general_settings';
    protected $querystring = ['tab'];
    public $site_name, $site_email, $site_phone, $site_meta_keywords, $site_meta_description;

    public function selectTab($tab){
    $this->tab = $tab;
    }

    public function mount() {

        $this->tab = request()->tab ? request()->tab : $this->default_tab;

        // Populate
        $this->site_name = get_settings()->site_name;
        $this->site_email = get_settings()->site_email;
        $this->site_phone = get_settings()->site_phone;
        $this->site_meta_keywords = get_settings()->site_meta_keywords;
        $this->site_meta_description = get_settings()->site_meta_description;

    }


    public function updateGeneralSettings()
    {
        $this->validate([
            'site_name' => 'required|min:5|max:45',
            'site_email' => 'required|email',
            'site_phone' => 'required|min:5',
            'site_meta_keywords' => 'required|min:5',
            'site_meta_description' => 'required|min:5',
        ]);

        $settings = new GeneralSetting();
        $settings = $settings->first();
        $settings->site_name = $this->site_name;
        $settings->site_email = $this->site_email;
        $settings->site_phone = $this->site_phone;
        $settings->site_meta_keywords = $this->site_meta_keywords;
        $settings->site_meta_description = $this->site_meta_description;
        $settings->save();

        if ($update) {

            return $this->dispatch('toast', message: 'General settings updated successfully.', notify:'success' );

        }else {
            return $this->dispatch('toast', message: 'Something went wrong. ', notify:'error' );
        }


    }



    public function refreshComponent()
    {
    // Leere Methode, nur um die Komponente zu aktualisieren
    }

    public function render()
    {
        return view('livewire.backend.admin-settings');
    }
}
