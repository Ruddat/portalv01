<?php

namespace App\Livewire\Frontend\Buyer;

use App\Models\Client;
use Livewire\Component;
use app\Helpers\AvatarHelper;
use app\helpers\AvatarApiHelper;
use app\helpers\CoolAvatarHelper;
use app\helpers\FunnyAvatarHelper;
use app\helpers\CoolUsernameHelper;
use app\helpers\ShopVariablesHelper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class DashboardProfile extends Component
{

    public $addressChanged;
    public $username;
    public $name;
    public $last_name;
    public $email;
    public $shipping_street;
    public $shipping_house_no;
    public $postal_code;
    public $city;
    public $phone;
    public $client;

    public function mount()
    {
        // Hole den authentifizierten Benutzer
        $this->client = Client::find(auth()->id());


        $client = Client::find(auth()->id());

        if ($client) {
            $this->username = $client->username;
            $this->name = $client->name;
            $this->last_name = $client->last_name;
            $this->email = $client->email;
            $this->shipping_street = $client->shipping_street;
            $this->shipping_house_no = $client->shipping_house_no;
            $this->postal_code = $client->postal_code;
            $this->city = $client->city;
            $this->phone = $client->phone;
        }

    }

    public function generateAvatar($type)
    {
        $username = $this->client->name . ' ' . $this->client->last_name;


        switch ($type) {
            case 'avatar_api':
                $avatar = AvatarApiHelper::createAvatar($username);
                break;
            case 'avatar_helper':
                $avatar = AvatarHelper::createAvatar($username);
                break;
            case 'cool_avatar':
                $avatar = CoolAvatarHelper::createCoolAvatar($username);
                break;
            case 'funny_avatar':
                $avatar = FunnyAvatarHelper::createFunnyAvatar($username);
                break;
            default:
                // Handle other types or default case
                $avatar = null;
        }

        if ($avatar) {
            $this->client->avatar = $avatar;
            $this->client->save();
        }
    }

    public function generateUsername()
    {
        $username = $this->name;
        $coolUsername = CoolUsernameHelper::generate($username);
        $this->username = $coolUsername;
    }


    public function updated($propertyName)
    {
        if (in_array($propertyName, [
            'client.shipping_street',
            'client.shipping_house_no',
            'client.postal_code',
            'client.city'
        ])) {
            $this->addressChanged = true;
        }
    }


    public function saveChanges()
    {
        $validator = Validator::make([
            'username' => $this->username,
            'name' => $this->name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'shipping_street' => $this->shipping_street,
            'shipping_house_no' => $this->shipping_house_no,
            'postal_code' => $this->postal_code,
            'city' => $this->city,
            'phone' => $this->phone,
        ], [
            'username' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:clients,email,' . $this->client->id,
            'shipping_street' => 'required|string|max:255',
            'shipping_house_no' => 'required|string|max:10',
            'postal_code' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
        ]);

        try {
            $validator->validate();
        } catch (ValidationException $e) {
            $this->setErrorBag($e->validator->errors());
            return;
        }

        logger('Address Changed: ' . ($this->addressChanged ? 'true' : 'false'));


    // Überprüfe, ob sich die Adresse geändert hat
    $originalClient = Client::find($this->client->id);
    $addressChanged = $originalClient->shipping_street !== $this->shipping_street ||
                      $originalClient->shipping_house_no !== $this->shipping_house_no ||
                      $originalClient->postal_code !== $this->postal_code ||
                      $originalClient->city !== $this->city;



        if ($addressChanged === true) {
            $userInput = "{$this->shipping_street} {$this->shipping_house_no}, {$this->postal_code} {$this->city}";

            $addressProcessed = ShopVariablesHelper::processAddress(
                $userInput,
                $this->shipping_street,
                $this->shipping_house_no,
                $this->postal_code,
                $this->city,
                request()
            );

//dd($addressProcessed);

            if (!$addressProcessed) {
                session()->flash('error', 'Address could not be verified or not found.');
                return;
            }
        }


    // Die Adresse wurde geändert und erfolgreich verarbeitet.
    // Nun die neuen Daten in der Session speichern:
    session([
        'address_data' => [
            'shipping_street' => $this->shipping_street,
            'shipping_house_no' => $this->shipping_house_no,
            'postal_code' => $this->postal_code,
            'city' => $this->city,
        ],
    //    'userLatitude' => $addressProcessed['latitude'] ?? null,
    //    'userLongitude' => $addressProcessed['longitude'] ?? null,

    // Speichern der neuen Adresse unter 'selectedLocation'
    'selectedLocation' => "{$this->shipping_street} {$this->shipping_house_no}, {$this->postal_code} {$this->city}",

    ]);


        $client = Client::find(auth()->id());
        if ($client) {
            $client->username = $this->username;
            $client->name = $this->name;
            $client->last_name = $this->last_name;
            $client->email = $this->email;
            $client->phone = $this->phone;


            if ($addressChanged === true) {
                $addressData = session('address_data', []);


                if (!empty($addressData)) {
                    $client->shipping_street = $addressData['shipping_street'] ?? $this->shipping_street;
                    $client->shipping_house_no = $addressData['shipping_house_no'] ?? $this->shipping_house_no;
                    $client->postal_code = $addressData['postal_code'] ?? $this->postal_code;
                    $client->city = $addressData['city'] ?? $this->city;
                    $client->latitude = session('userLatitude');
                    $client->longitude = session('userLongitude');
                }
            } else {
                $client->shipping_street = $this->shipping_street;
                $client->shipping_house_no = $this->shipping_house_no;
                $client->postal_code = $this->postal_code;
                $client->city = $this->city;
            }

            $client->save();
        }

        session()->flash('message', 'Profile updated successfully.');
    }


    public function render()
    {
        // Stelle sicher, dass die neuesten Daten geladen werden
        $this->client = Client::find(auth()->id());

        return view('livewire.frontend.buyer.dashboard-profile')
            ->layout('layouts.buyerdashboard');

    }
}
