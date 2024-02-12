<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use App\Models\SocialNetwork;
use App\Models\GeneralSettings;

class AdminSettings extends Component
{
    public $pageTitle;
    public $tab = null;
    public $default_tab = 'general_settings';
    protected $querystring = ['tab'];
    public $site_name, $site_email, $site_phone, $site_meta_keywords, $site_meta_description, $site_logo,
    $site_favicon, $site_address;

    public $facebook_url, $twitter_url, $instagram_url, $linkedin_url, $printerest_url, $youtube_url, $tiktok_url,
    $whatsapp_number, $github_url, $telegram_url, $snapchat_url, $twitch_url;


    public function selectTab($tab){
    $this->tab = $tab;
    }

    public function mount() {

        $this->pageTitle = 'Einstellungen';

        $this->tab = request()->tab ? request()->tab : $this->default_tab;

        // Populate
        $this->site_name = get_settings()->site_name;
        $this->site_email = get_settings()->site_email;
        $this->site_phone = get_settings()->site_phone;
        $this->site_meta_keywords = get_settings()->site_meta_keywords;
        $this->site_meta_description = get_settings()->site_meta_description;
        $this->site_logo = get_settings()->site_logo;
        $this->site_favicon = get_settings()->site_favicon;
        $this->site_address = get_settings()->site_address;

        // populate social network settings
        $this->facebook_url = get_social_network()->facebook_url;
        $this->twitter_url = get_social_network()->twitter_url;
        $this->instagram_url = get_social_network()->instagram_url;
        $this->linkedin_url = get_social_network()->linkedin_url;
        $this->pinterest_url = get_social_network()->pinterest_url;
        $this->youtube_url = get_social_network()->youtube_url;
        $this->tiktok_url = get_social_network()->tiktok_url;
        $this->whatsapp_number = get_social_network()->whatsapp_number;
        $this->github_url = get_social_network()->github_url;
        $this->telegram_url = get_social_network()->telegram_url;
        $this->snapchat_url = get_social_network()->snapchat_url;
        $this->twitch_url = get_social_network()->twitch_url;


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

        $settings = new GeneralSettings();
        $settings = $settings->first();
        $settings->site_name = $this->site_name;
        $settings->site_email = $this->site_email;
        $settings->site_phone = $this->site_phone;
        $settings->site_meta_keywords = $this->site_meta_keywords;
        $settings->site_meta_description = $this->site_meta_description;
        $settings->site_address = $this->site_address;
        $update = $settings->save();

        if ($update) {

            return $this->dispatch('toast', message: 'General settings updated successfully.', notify:'success' );

        }else {
            return $this->dispatch('toast', message: 'Something went wrong. ', notify:'error' );
        }


    }

    public function updateSocialNetworks()
    {
        $this->validate([
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'printerest_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'tiktok_url' => 'nullable|url',
            'whatsapp_number' => 'nullable|numeric',
            'github_url' => 'nullable|url',
            'telegram_url' => 'nullable|url',
            'snapchat_url' => 'nullable|url',
            'twitch_url' => 'nullable|url',
        ]);

        $social_network = new SocialNetwork();
        $social_network = $social_network->first();
        $social_network->facebook_url = $this->facebook_url;
        $social_network->twitter_url = $this->twitter_url;
        $social_network->instagram_url = $this->instagram_url;
        $social_network->linkedin_url = $this->linkedin_url;
        $social_network->printerest_url = $this->printerest_url;
        $social_network->youtube_url = $this->youtube_url;
        $social_network->tiktok_url = $this->tiktok_url;
        $social_network->whatsapp_number = $this->whatsapp_number;
        $social_network->github_url = $this->github_url;
        $social_network->telegram_url = $this->telegram_url;
        $social_network->snapchat_url = $this->snapchat_url;
        $social_network->twitch_url = $this->twitch_url;
        $update = $social_network->save();

        if ( $update )  {

            return $this->dispatch('toast', message: 'Social networks updated successfully.', notify:'success' );

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
