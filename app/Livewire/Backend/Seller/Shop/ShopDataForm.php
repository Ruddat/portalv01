<?php

namespace App\Livewire\Backend\Seller\Shop;

use App\Models\ModShop;
use Livewire\Component;
use App\Services\GeocodeService;
use Illuminate\Support\Facades\Auth;
use NominatimLaravel\Content\Nominatim;

class ShopDataForm extends Component
{
    public $shopData;
    public $shop;
    public $shop_name, $shop_email, $shop_phone, $shop_street, $shop_zip, $shop_city, $shop_owner, $shop_extra_contacts;


    public function mount(ModShop $shopData)
    {
        // Überprüfen, ob die Shop-ID in der Session vorhanden ist
        if (Auth::guard('seller')->check()) {
            $seller = Auth::guard('seller')->user();
        }
        if (!session()->has('currentShopId')) {
            return redirect()->route('seller.login'); // Benutzer zur Homepage umleiten
        }

        // Shopdaten aus der Datenbank abrufen
        $shopId = session('currentShopId');
        $this->shop = ModShop::findOrFail($shopId);

        // Zuweisen der Daten zu den entsprechenden Variablen
        $this->shop_name = $this->shop->title;
        $this->shop_email = $this->shop->email;
        $this->shop_phone = $this->shop->phone;
        $this->shop_street = $this->shop->street;
        $this->shop_zip = $this->shop->zip;
        $this->shop_city = $this->shop->city;
        $this->shop_owner = $this->shop->owner;
        $this->shop_extra_contacts = $this->shop->extra_contacts;

        // Weitere Daten zuweisen, falls erforderlich
    }


    public function updateShopDataDetails()
    {
        // Validate data if necessary
        $validatedData = $this->validate([
        'shop_name' => 'required|string|max:255',
        'shop_email' => 'required|email',
        'shop_phone' => 'required',
        'shop_street' => 'required',
        'shop_zip' => 'required',
        'shop_city' => 'required',
        'shop_owner' => 'required',
        'shop_extra_contacts' => 'required|regex:/^DE\d{9}$/',
        // Add other fields as needed
        ],[
            'shop_name.required' => 'The shop name field is required.',
            'shop_name.string' => 'The shop name must be a string.',
            'shop_name.max' => 'The shop name must not exceed 255 characters.',
            'shop_email.required' => 'The shop email field is required.',
            'shop_email.email' => 'The shop email must be a valid email address.',
            'shop_phone.required' => 'The shop phone field is required.',
            'shop_street.required' => 'The shop street field is required.',
            'shop_zip.required' => 'The shop zip field is required.',
            'shop_city.required' => 'The shop city field is required.',
            'shop_owner.required' => 'The shop owner field is required.',
            'shop_extra_contacts.required' => 'The shop Tax ID must soon DE123456789 and is required.',
            // Add other fields as needed
        ]);




    // Kombiniere die Teile der Adresse aus dem Livewire-Daten-Array
    $street = $this->shop_street;
    $zip = $this->shop_zip;
    $city = $this->shop_city;

    //$street = $this->newShop['street'];
    //$zip = $this->newShop['zip'];
    //$city = $this->newShop['city'];



    // Baue die vollständige Adresse
    $userInput = "$street $zip $city";
    // $userInput = 'Heidkrugsweg 31, Edemissen'; // Die Adresse, die der Benutzer eingibt
    //dd($userInput);


        // Geocode-Service initialisieren
        $geocodeService = new GeocodeService();
        $results = $geocodeService->searchByAddress($userInput);


      //  dd($results);

    if (!empty($results)) {
        foreach ($results as $result) {
        $latitude = $result['lat'];
        $longitude = $result['lon'];
        //     echo "Latitude: $latitude, Longitude: $longitude<br>";
        //dd($latitude, $longitude);
    }
    //  dd($latitude, $longitude);

        // Update shop data in the database
        $this->shop->update([
            'title' => $this->shop_name,
            'email' => $this->shop_email,
            'phone' => $this->shop_phone,
            'street' => $this->shop_street,
            'zip' => $this->shop_zip,
            'city' => $this->shop_city,
            'owner' => $this->shop_owner,
            'extra_contacts' => $this->shop_extra_contacts,
            'lat' => $latitude,
            'lng' => $longitude,
            // Add other fields as needed
            ]);

    } else {
        // Keine Ergebnisse gefunden
        echo "Keine Ergebnisse gefunden für die angegebene Adresse";
    }


        // Emit event or perform any additional actions after updating
        // For example:
        $this->dispatch('shopDataUpdated');

        // Aktionen nach erfolgreicher Validierung
        session()->flash('success_message', 'Your Shopinfo has been updated successfully.');
        $this->dispatch('scroll-to-message');

        // Triggern Sie das Livewire-Event, wenn die Daten erfolgreich aktualisiert wurden
        $this->dispatch('scroll-to-success');

        // Optionally, you can also redirect the user or display a success message
        return $this->dispatch('toast', message: 'Shop data updated successfully', notify:'success' );

    }


    public function render()
    {
        $this->shopData = ModShop::findOrFail(session('currentShopId'));
     //   dd($this->shopData);
        return view('livewire.backend.seller.shop.shop-data-form');
    }
}
