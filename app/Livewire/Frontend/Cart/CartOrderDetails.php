<?php

namespace App\Livewire\Frontend\Cart;

use SimpleXMLElement;
use App\Models\Client;
use App\Models\ModShop;
use Livewire\Component;
use App\Models\ModOrders;
use App\Models\ModProducts;
use Illuminate\Support\Str;
use App\Services\CartService;
use App\Models\ModProductSales;
use App\Models\ModTopRankPrice;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\GeocodeService;
use App\Models\ModVendorAddressData;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use NominatimLaravel\Content\Nominatim;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Whitecube\LaravelCookieConsent\Cookie;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Redirect as Redirector;


class CartOrderDetails extends Component
{
    public $shopData;
    public $selectedOption = 'familie'; // Eigenschaft zum Speichern des aktuellen ausgewählten Optionswerts
    public $company = ''; // Eigenschaft zum Speichern des Firmennamens
    public $department = ''; // Eigenschaft zum Speichern des Abteilungsnamens
    public $last_name = ''; // Eigenschaft zum Speichern des Nachnamens
    public $first_name = ''; // Eigenschaft zum Speichern des Vornamens
    public $email = ''; // Eigenschaft zum Speichern der E-Mail-Adresse
    public $phone = ''; // Eigenschaft zum Speichern der Telefonnummer
    public $full_address = ''; // Eigenschaft zum Speichern der vollständigen Adresse
    public $shipping_street = ''; // Eigenschaft zum Speichern der Street
    public $shipping_house_no = ''; // Eigenschaft zum Speichern der House No
    public $city = ''; // Eigenschaft zum Speichern der Stadt
    public $postal_code = ''; // Eigenschaft zum Speichern des Postleitzahl
    public $opt_news_coupons = true; // Eigenschaft zum Speichern der Option "Ja, ich möchte gelegentlich Neuigkeiten und Coupons erfahren"
    public $opt_save_data = false; // Eigenschaft zum Speichern der Option "Meine Daten für den nächsten Besuch speichern"
    public $payment_method = 'cash'; // Eigenschaft zum Speichern der ausgewählten Zahlungsart
    public $order_comment = ''; // Eigenschaft zum Speichern des Bestellkommentars
    public $description_of_way = ''; // Eigenschaft zum Speichern des Versandkommentars

    public $xml; // Definiere die Variable $xml
    public $delivery_option = 'Lieferung'; // Annahme: Die Lieferoption ist in $this->delivery_option gespeichert
    public $ipAddress;
    public $newOrderNumber;
    public $OrderNumber;
    public $orderHash;
    public $selectedTime;
    public $newData = [];
    public $paypal_express_fee_fixed;
    public $paypal_express_fee_percent;

    protected $rules = [
        'selectedOption' => 'required',
        'company' => 'required_if:selectedOption,firma',
        'department' => 'required_if:selectedOption,firma',
        'last_name' => 'required_if:selectedOption,frau,herr,familie|min:4',
        'first_name' => 'required_if:selectedOption,frau,herr,familie|min:4',
        'email' => 'required|email',
        'phone' => 'required',
        'shipping_street' => 'required|min:5',
        'shipping_house_no' => 'required|min:1',
        'city' => 'required|min:5',
        'postal_code' => 'required',
        'payment_method' => 'required',
        'opt_news_coupons' => 'boolean',
        'opt_save_data' => 'boolean',
        'order_comment' => 'nullable',
        'description_of_way' => 'nullable',
    ];


    public function mount($restaurantId)
    {
        // Abrufen der Shop-Daten anhand der ID oder eine Fehlermeldung anzeigen, falls nicht gefunden
        $this->shopData = ModShop::findOrFail($restaurantId);
        //  dd($this->shopData);
        //   $this->createXml();
        $this->ipAddress = $_SERVER['REMOTE_ADDR'];

        // Lade vorhandene Daten aus der Session, falls verfügbar
        $addressData = Session::get('address_data');
       // dd($addressData);

        // Überprüfe, ob die Daten vorhanden sind
        if ($addressData) {
            // Verwende die Sessiondaten hier weiter
            $this->userAddress = $addressData;
            $this->selectedOption = $addressData['selectedOption'] ?? '';
            $this->company = $addressData['company'] ?? '';
            $this->department = $addressData['department'] ?? '';

            $this->first_name = $addressData['first_name'] ?? '';
            $this->last_name = $addressData['last_name'] ?? '';

            $this->email = $addressData['email'] ?? '';
            $this->phone = $addressData['phone'] ?? '';
            $this->shipping_street = $addressData['shipping_street'] ?? '';
            $this->shipping_house_no = $addressData['shipping_house_no'] ?? '';
            $this->city = $addressData['city'] ?? '';
            $this->postal_code = $addressData['postal_code'] ?? '';

            $this->payment_method = $addressData['payment_method'] ?? 'cash';
            $this->opt_news_coupons = $addressData['opt_news_coupons'] ?? true;
            $this->opt_save_data = $addressData['opt_save_data'] ?? true;
            $this->order_comment = $addressData['order_comment'] ?? '';
            $this->description_of_way = $addressData['description_of_way'] ?? '';

        }

        $this->paypal_express_fee_fixed = get_settings()->paypal_express_fee_fixed;
        $this->paypal_express_fee_percent = get_settings()->paypal_express_fee_percentage;
        $this->sales_commission = get_settings()->sales_commission;
     //   dd($this->paypal_express_fee_fixed, $this->paypal_express_fee_percent, $this->sales_commission);


    }

    public function orderNowForm(CartService $cartService)
    {
        // Überprüfen, ob der Warenkorb leer ist
        $order = $cartService->content();
        // dd($order, $cart);
        Session::put('shopping-cart', $order);
        if (empty($order)) {
            return redirect()->back()->with('error', 'Der Warenkorb ist leer oder die Sitzung ist abgelaufen.');
        }

        // Validierung der Benutzereingaben
        $validatedData = $this->validate();

        //dd($validatedData);

        // Adresse für Geokodierung vorbereiten
        $street = $validatedData['shipping_street'];
        $housenumber = $validatedData['shipping_house_no'];
        $city = $validatedData['city'];
        $postal_code = $validatedData['postal_code'];
        $userInput = "$street $housenumber, $postal_code $city";

        // Überprüfen, ob die Adresse bereits in der Datenbank vorhanden ist
        $existingAddress = ModVendorAddressData::where('street', $street)
            ->where('housenumber', $housenumber)
            ->where('postal_code', $postal_code)
            ->where('city', $city)
            ->first();

        if ($existingAddress) {
            // Adresse gefunden, benutze die gespeicherten Koordinaten
            $latitude = $existingAddress->latitude;
            $longitude = $existingAddress->longitude;
        } else {



            // Geocode-Service initialisieren
            $geocodeService = new GeocodeService();
            // Adresse nicht gefunden, nutze Nominatim zur Geokodierung
            $data = $geocodeService->searchByAddress($userInput);
//dd($data);


            if (!empty($data)) {
                $result = $data[0];
                $latitude = $data[0]['lat'];
                $longitude = $data[0]['lon'];
                $this->postal_code = $data['address']['postcode'] ?? null;
//dd($postal_code);
                // Speichere die neue Adresse und ihre Koordinaten in der Datenbank
                ModVendorAddressData::create([
                    'street' => $street,
                    'housenumber' => $housenumber,
                    'postal_code' => $postal_code,
                  //  'postal_code' => $this->postal_code,
                    'city' => $city,
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
              //  dd($data);

                return redirect()->back()->with('error', 'Geocoding failed. Please check the address and try again.');
            }
        }

        // Speichern der Werte in der Session
        Session::put('latitude', $latitude);
        Session::put('longitude', $longitude);

        // Shopinformationen aus der Datenbank
        $shopId = $this->shopData->id;
        Session::put('shopId', $shopId);

        // Eindeutigen Hash-Wert generieren
        $orderHash = Str::random(16);

        $lastOrderNumber = ModOrders::where('parent', $shopId)->max('order_nr');
        $newOrderNumber = $lastOrderNumber + 1;
        Session::put('newOrderNumber', $newOrderNumber);
        Session::put('orderHash', $orderHash);

        $deliveryorpickup = Session::get('delivery_or_pickup_'. $shopId);


        // Berechne die Preise
        $prices = $this->calculatePrices($order);

        // Liefergebühr basierend auf dem Bestellwert festlegen
        $deliveryFee = Session::get("delivery_cost_$shopId", 0);
        $deliveryFreeThreshold = Session::get("delivery_free_threshold_$shopId", 0);

        if ($prices['price_products'] > $deliveryFreeThreshold) {
            $deliveryFee = 0;
        }

        // sponsored eintraege default ist = 0
        $sponsoredPrice = 0;

        // Überprüfen, ob der Nutzer über einen gesponserten Eintrag gekommen ist
        if (session('came_from_sponsored')) {

        // Aktuelles Datum und Uhrzeit
        $now = now();

        // Abrufen des gesponserten Eintrags, der noch aktiv ist
        $cameFromSponsored = ModTopRankPrice::where('shop_id', $shopId)
            ->where('start_time', '<=', $now)
            ->where('end_time', '>=', $now)
            ->first();

            // Session-Information vergessen
            session()->forget('came_from_sponsored');

            // Wenn ein aktiver gesponserter Eintrag gefunden wurde, den Preis holen
            if ($cameFromSponsored) {
                $sponsoredPrice = $cameFromSponsored->current_price;
                // Hier Preis weiterverarbeiten oder speichern
            }
        }


        // PayPal-Gebühren berechnen
        $paypalFee = ($prices['price_products'] + $prices['price_bottles']) * ($this->paypal_express_fee_percent / 100) + $this->paypal_express_fee_fixed;

      //  dd($order, $prices);
        // Neue Bestellung erstellen und in die Datenbank speichern
        $order = ModOrders::create([
            'order_nr' => $newOrderNumber,
            'parent' => $shopId,
            'shop_name' => $this->shopData->title,
            'hash' => $orderHash,
            'clients_ip' => $this->ipAddress,
            'gender' => $this->selectedOption === 'familie' ? '1' : ($this->selectedOption === 'frau' ? '2' : ($this->selectedOption === 'herr' ? '3' : '4')),
            'name' => $validatedData['last_name'],
            'surname' => $validatedData['first_name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'company' => $validatedData['company'],
            'department' => $validatedData['department'],
            'order_date' => now(),
            'shipping_street' => $validatedData['shipping_street'],
            'shipping_house_no' => $validatedData['shipping_house_no'],
            'shipping_type' => $deliveryorpickup,
            'shipping_lng' => $longitude,
            'shipping_lat' => $latitude,
            'price_products' => $prices['price_products'],
            'price_shipping' => number_format($deliveryFee, 2),
            'price_bottles' => $prices['price_bottles'],
            'price_payment' => number_format($paypalFee, 2),
            'price_tips' => '0.00',
            'price_total' => number_format($prices['price_products'] + $deliveryFee + $prices['price_bottles'] + $paypalFee, 2),
            'eshop_discount' => '0.00',
            'came_from_sponsored' => $sponsoredPrice,
            'cart_in_session' => '0',
            'coupon_code' => '',
            'rand_id' => '0',
            'shipping_city' => $validatedData['city'],
            'shipping_zip' => $validatedData['postal_code'],
            'payment_type' => $validatedData['payment_method'],
            'order_comment' => $validatedData['order_comment'],
            'shipping_comment' => $validatedData['description_of_way'],
        ]);

        $this->createXml();
        $this->productsSalesCount();
        $this->generateNewPDF($orderHash);
        $this->generateNewClient($validatedData);
        $this->generateConfirmationEmail($orderHash);
        $this->updateAddressData($validatedData);


        return redirect()->route('life-tracking', ['orderHash' => $orderHash]);
    }







    public function calculatePrices($order)
    {
     //  dd($order);

        $priceProducts = 0.00;
        $priceBottles = 0.00;

        foreach ($order as $item) {
            // Preis des Hauptprodukts berechnen
            $priceProducts += $item['price'] * $item['quantity'];

            // Optionen (Subartikel) durchlaufen
            foreach ($item['options'] as $option) {
                if ($option['productCode'] == 'deposit') {
                    // Preis der Flaschen berechnen
                    $priceBottles += $option['price'] * $option['quantity'];
                }
            }
        }

        return [
            'price_products' => number_format($priceProducts, 2),
            'price_bottles' => number_format($priceBottles, 2),
        ];
    }

    public function updateAddressData($newData)
    {
        // Validiere die eingehenden Daten (hier kannst du deine Validierung einfügen)
        $validatedData = $newData; // In der Praxis solltest du hier validieren
        //dd($validatedData, $newData, $this->opt_save_data);

        // Überprüfe, ob opt_save_data auf true gesetzt ist
        if ($this->opt_save_data) {
            // Lade vorhandene Daten aus der Session
            $existingData = Session::get('address_data', []);
            // Zusammenführen der vorhandenen Daten mit den neuen Daten
            $mergedData = array_merge($existingData, $validatedData);

            // Aktualisierte Daten in der Session speichern
            Session::put('address_data', $mergedData);

            // Lokale Kopie der Daten aktualisieren
            $this->addressData = $mergedData;

            // Optional: Feedback an den Benutzer geben
            $this->dispatch('toast', message: 'Address data updated successfully!', notify:'success' );

        } else {
            // Lösche die persönlichen Daten, aber behalte die Lieferadresse
            $existingData = Session::get('address_data', []);
            $deliveryData = [
                'shipping_street' => $existingData['shipping_street'],
                'shipping_house_no' => $existingData['shipping_house_no'],
                'city' => $existingData['city'],
                'postal_code' => $existingData['postal_code'],
                'payment_method' => $existingData['payment_method'],
                'opt_news_coupons' => $existingData['opt_news_coupons'],
                'order_comment' => $existingData['order_comment'],
                'description_of_way' => $existingData['description_of_way'],
                'opt_save_data' => $existingData['opt_save_data'],
            ];

            // Aktualisierte Lieferadresse in der Session speichern
            Session::put('address_data', $deliveryData);

            // Lokale Kopie der Daten aktualisieren
            $this->addressData = $deliveryData;

            // Optional: Feedback an den Benutzer geben
            $this->dispatch('toast', message: 'Delivery address updated successfully, personal data not saved.', notify:'success' );
        }
    }




    public function generateNewClient($data)
{
    // Geokoordinaten (Beispielwerte)
    $latitude = Session::get('latitude');
    $longitude = Session::get('longitude');
    $shopId = Session::get('shopId');
    $deliveryorpickup = Session::get('delivery_or_pickup_'. $shopId);
//dd($deliveryorpickup);


    // Überprüfen, ob ein Client mit dem angegebenen Benutzernamen bereits existiert
    $existingClient = Client::where('username', $data['first_name'])->orWhere('email', $data['email'])->first();

    // Wenn der Client bereits existiert, überspringen Sie das Einfügen
    if ($existingClient) {
        return $existingClient;
    }

    // Neue Bestellung erstellen und in die Datenbank speichern
    $order = Client::create([
        //    'order_nr' => $newOrderNumber,
        //    'parent' => $shopId,
        //    'shop_name' => $this->shopData->title,
        //    'hash' => $orderHash,
        //    'clients_ip' => $this->ipAddress,
        //    'gender' => '1', // Beispielwert
        //  'status' => '0', // New
        'name' => $data['last_name'],
        'username' => $data['first_name'],
        'email' => $data['email'],
        'phone' => $data['phone'],
        // 'order_date' => now(),
        'address' => $data['shipping_street'],
        'shipping_house_no' => $data['shipping_house_no'], // Beispielwert
        'shipping_type' => $deliveryorpickup, // Beispielwert
        'longitude' => $longitude,
        'latitude' => $latitude,
        'city' => $data['city'],
        'postal_code' => $data['postal_code'],
        // Fügen Sie weitere Felder hinzu, je nach Bedarf
    ]);

    return $order;
}

public function productsSalesCount()
{
    // Den Einkaufswagen und die Shop-ID aus der Session abrufen
    $productsSales = Session::get('shopping-cart');
    $shopId = Session::get('shopId');

    if (!$productsSales || !$shopId) {
        // Wenn der Einkaufswagen oder die Shop-ID nicht vorhanden sind, nichts tun
        return;
    }

    // Durch alle Artikel im Einkaufswagen iterieren
    foreach ($productsSales as $item) {
        // Hauptprodukt und Shop-ID abgleichen
        $productCode = $item->get('code');
        $quantity = $item->get('quantity');
        $size = $item->get('size'); // Größe abrufen
        $price = $item->get('price'); // Preis abrufen

        // Produkt in der Datenbank finden, das zur Shop-ID gehört
        $product = ModProducts::where('product_code', $productCode)
                               ->where('shop_id', $shopId)
                               ->first();

        if ($product) {
            // Prüfen, ob bereits ein Eintrag mit derselben Größe, demselben Preis, und demselben Datum existiert
            $sale = ModProductSales::where('product_id', $product->id)
                                   ->where('shop_id', $shopId)
                                   ->where('size', $size) // Größe berücksichtigen
                                   ->where('price', $price) // Preis berücksichtigen
                                   ->whereDate('sale_date', now()->toDateString())
                                   ->first();

            if ($sale) {
                // Menge erhöhen, falls Eintrag existiert
                $sale->increment('quantity', $quantity);
            } else {
                // Neuen Eintrag erstellen, falls keiner existiert
                ModProductSales::create([
                    'product_id' => $product->id,
                    'shop_id' => $shopId,
                    'quantity' => $quantity,
                    'size' => $size,
                    'price' => $price,
                    'sale_date' => now(),
                ]);
            }
        }

        // Optionen (Zusatzprodukte) aktualisieren
        $options = $item->get('options');

        foreach ($options as $option) {
            $optionCode = $option['productCode'];
            $optionQuantity = $option['quantity'];
            $optionSize = $option['size']; // Größe der Option
            $optionPrice = $option['price']; // Preis der Option

            // Zusatzprodukt in der Datenbank finden, das zur Shop-ID gehört
            $optionProduct = ModProducts::where('product_code', $optionCode)
                                        ->where('shop_id', $shopId)
                                        ->first();

            if ($optionProduct) {
                // Prüfen, ob bereits ein Eintrag mit derselben Größe, demselben Preis, und demselben Datum existiert
                $optionSale = ModProductSales::where('product_id', $optionProduct->id)
                                             ->where('shop_id', $shopId)
                                             ->where('size', $optionSize) // Größe berücksichtigen
                                             ->where('price', $optionPrice) // Preis berücksichtigen
                                             ->whereDate('sale_date', now()->toDateString())
                                             ->first();

                if ($optionSale) {
                    // Menge erhöhen, falls Eintrag existiert
                    $optionSale->increment('quantity', $optionQuantity);
                } else {
                    // Neuen Eintrag erstellen, falls keiner existiert
                    ModProductSales::create([
                        'product_id' => $optionProduct->id,
                        'shop_id' => $shopId,
                        'quantity' => $optionQuantity,
                        'size' => $optionSize,
                        'price' => $optionPrice,
                        'sale_date' => now(),
                    ]);
                }
            }
        }
    }
}



public function generateNewPdf($orderHash)
{

    $newOrderNumber = Session::get('newOrderNumber');

//dd($newOrderNumber);

    // Kaufdaten aus der Datenbank abrufen
    $orderForPdf = ModOrders::where('hash', $orderHash)->first();

//dd($orderForPdf);

    // Kundeninformationen aus dem Formular erhalten
    $customerData = [
        'phone' => $this->phone,
        'name' => $this->last_name . ' ' . $this->first_name,
        'company' => $this->company,
        'street' => $this->full_address,
        'PLZ/Ort' => $this->postal_code . ' ' . $this->city,
        'additional' => $this->description_of_way,
        'email' => $this->email,
        'orderIP' => $this->ipAddress , // Hier die IP-Adresse des Kunden einfügen
    ];

    // Shopinformationen aus der Datenbank
    $shopData = [
        'title' => $this->shopData->title,
        'street' => $this->shopData->street,
        'address' => $this->shopData->zip . ' ' . $this->shopData->city,
        'datum' => now()->format('d.m.Y H:i:s'),
    ];

    // Shopinformationen aus der Datenbank
    $orderInfos = [
        'Bestellung' => $orderForPdf->shipping_type,
        'Zeitpunkt' => 'sofort',
        'Zahlungsart' => $this->payment_method,
        'Kommentar' => $orderForPdf->order_comment,
    ];

    $orderData = json_decode($orderForPdf->order_json_data);

    // Überprüfe, ob die Daten in der erwarteten Struktur vorliegen
    if (isset($orderData->OrderList->Order->ArticleList->Article)) {
        // Überprüfe, ob es sich um ein einzelnes Objekt oder ein Array von Objekten handelt
        if (is_array($orderData->OrderList->Order->ArticleList->Article)) {
            // Wenn es sich um ein Array handelt, verwende es direkt
            $orderItems = ['items' => $orderData->OrderList->Order->ArticleList->Article];
        } else {
            // Wenn es sich um ein einzelnes Objekt handelt, wandle es in ein Array um
            $orderItems = ['items' => [$orderData->OrderList->Order->ArticleList->Article]];
        }
    } else {
        // Setze die Artikel auf ein leeres Array, wenn der Schlüssel nicht existiert oder die Daten fehlen
        $orderItems = ['items' => []];
    }

//dd($orderData, $orderItems);

//dd($orderItems['items']);

    $payment_method = $this->payment_method; // Beispielwert

    // Geokoordinaten (Beispielwerte)
    $latitude = Session::get('latitude');
    $longitude = Session::get('longitude');

    // URL für die Navigation
    $navigationUrl = "http://maps.google.com/maps?q={$latitude},{$longitude}";

    // QR-Code generieren
    $qrcode = base64_encode(QrCode::format('svg')->size(160)->errorCorrection('H')->generate($navigationUrl));
    $data = [
        'title' => $navigationUrl,
        'qrcode' => $qrcode
        ];

//dd($data);


    $data = [
        [
            'quantity' => 1,
            'description' => '1 Year Subscription',
            'price' => '129.00'
        ]
    ];

    //$pdf = Pdf::loadView('pdf.order', ['data' => $data]);

    $pdf = PDF::loadView('pdf.order', compact('customerData', 'qrcode', 'shopData', 'orderData', 'orderInfos', 'orderItems', 'payment_method', 'newOrderNumber', 'data'));

    // Holen Sie die Shop-ID aus dem $shopData-Array
    $shopId = $this->shopData['id'];

    // Generieren Sie einen Dateinamen mit der newOrderNumber
    $filename = "{$newOrderNumber}_bestellbestaetigung.pdf";

    // Verzeichnis für die Speicherung des PDFs
    $directory = "uploads/shops/{$shopId}/orders/";

    // Überprüfen, ob das Verzeichnis existiert. Wenn nicht, erstellen Sie es.
    if (!Storage::exists($directory)) {
        Storage::makeDirectory($directory, 0777, true); // Rekursiv erstellen
    }

    // Speichern Sie die PDF-Datei im Speicherverzeichnis
    Storage::put("{$directory}{$filename}", $pdf->output());

    // Rückgabewert mit dem relativen Pfad des gespeicherten PDF
    return $directory . $filename;
}



public function createXml()
{
    $orderIDValue = Session::get('orderHash');

    $articles = session()->get('shopping-cart');
//dd($articles);


    //dd($orderHash);
   // $delivery_option = 'Lieferung'; // Annahme: Die Lieferoption ist in $this->delivery_option gespeichert

    // Erstelle ein neues XML-Dokument
    $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="utf-8" standalone="yes"?><WinOrder></WinOrder>');


    // Füge <OrderList> hinzu
    $orderList = $xml->addChild('OrderList');

    // Setze das Erstellungsdatum und die Uhrzeit unter <OrderList>
    $orderList->addChild('CreateDateTime', now()->toIso8601String());

    // Füge <Order> unter <OrderList> hinzu
    $order = $orderList->addChild('Order');

    // Füge ServerData unter Order hinzu
    $serverData = $order->addChild('ServerData');
    $serverData->addChild('Agent', 'WinOrder V6.0.0.16');
    $serverData->addChild('IpAddress', '192.168.10.1');
    $serverData->addChild('CreateDateTime', now()->toIso8601String());
    $serverData->addChild('Referer', 'WinOrder');

    // Füge die Kundeninformationen hinzu
    $customer = $order->addChild('Customer');
    $customer->addChild('CustomerNo', 2);
    $customer->addChild('NoMarketing', 'false');

// Setze die OrderID
$orderID = $order->addChild('OrderID', $orderIDValue);

//dd($this->delivery_option);
    if ($this->delivery_option != 'Abholung') {
        // Füge die Lieferadresse hinzu
        $deliveryAddress = $customer->addChild('DeliveryAddress');
        $deliveryAddress->addChild('Title', ''); // Hier Titel einfügen
        $deliveryAddress->addChild('LastName', $this->last_name);
        $deliveryAddress->addChild('FirstName', $this->first_name);
        $deliveryAddress->addChild('Company', $this->company);
        $deliveryAddress->addChild('Street', $this->full_address);
        $deliveryAddress->addChild('HouseNo', '');
        $deliveryAddress->addChild('AddAddress', '');
        $deliveryAddress->addChild('DescriptionOfWay', $this->description_of_way);
        $deliveryAddress->addChild('Zip', $this->postal_code);
        $deliveryAddress->addChild('City', $this->city);
        $deliveryAddress->addChild('Country', 'DE');
        $deliveryAddress->addChild('Email', $this->email);
        $deliveryAddress->addChild('PayPalEmail', $this->email);
        $deliveryAddress->addChild('PhoneNo', $this->phone);
    } else {
        // Wenn Bestellung zur Abholung ist
        $deliveryAddress = $customer->addChild('DeliveryAddress');
        $deliveryAddress->addChild('Title', ''); // Hier Titel einfügen
        $deliveryAddress->addChild('LastName', '! ABHOLERVERKAUF !');
        $deliveryAddress->addChild('FirstName', '');
        $deliveryAddress->addChild('Company', '');
        $deliveryAddress->addChild('Street', '');
        $deliveryAddress->addChild('HouseNo', '2');
        $deliveryAddress->addChild('AddAddress', '');
        $deliveryAddress->addChild('DescriptionOfWay', '');
        $deliveryAddress->addChild('Zip', '');
        $deliveryAddress->addChild('City', '');
        $deliveryAddress->addChild('Country', 'DE');
        $deliveryAddress->addChild('Email', '');
        $deliveryAddress->addChild('PayPalEmail', '');
        $deliveryAddress->addChild('PhoneNo', '--');

    }

    // Füge StoreData hinzu
    $storeData = $order->addChild('StoreData');
    $storeData->addChild('StoreId', $this->shopData->id); // Annahme: Die StoreId ist in $this->store_id gespeichert
    $storeData->addChild('StoreName', $this->shopData->title); // Annahme: Der StoreName ist in $this->store_name gespeichert

    // Füge AddInfo hinzu
    $addInfo = $order->addChild('AddInfo');
    $addInfo->addChild('DiscountPercent', '0');
    $addInfo->addChild('CurrencyStr', '€');
    $addInfo->addChild('DeliverLumpSum', '0');
    $addInfo->addChild('Comment', 'kjdshfjkldsjfljsdlfkjsdflkjdlkfjlk'); // Leeres Kommentar-Feld
    $addInfo->addChild('PaymentType', 'Barzahlung'); // Beispiel für Barzahlung
    $addInfo->addChild('PaymentFee', '0');
    $addInfo->addChild('Tip', '13.50');
    $addInfo->addChild('TransactionID', ''); // Leeres TransactionID-Feld
 //   $addInfo->addChild('Total', '3.5'); // Beispielwert für Total
    $addInfo->addChild('MinOrderValue', '0');
    $addInfo->addChild('MinQuantitySurcharge', '0');
    $addInfo->addChild('DateTimeOrder', Session::get('selectedTime')); // Beispielwert für DateTimeOrder


//dd($articles);

// Füge die Artikelinformationen hinzu, wenn Artikel vorhanden sind
if (!empty($articles)) {
    $articleList = $order->addChild('ArticleList');

    foreach ($articles as $article) {
    //    dd($article);
        $articleNode = $articleList->addChild('Article');
        $articleNode->addChild('ArticleNo', $article['code']);
   //     $articleNode->addChild('ArticleName', $article['name']);
        $articleNode->addChild('ArticleName', htmlspecialchars($article['name'], ENT_XML1, 'UTF-8'));
      //  $articleNode->addChild('ArticleName', utf8_encode($article['name']));
        $articleNode->addChild('ArticleSize', $article['size']);
        $articleNode->addChild('Count', $article['quantity']);
        $articleNode->addChild('Price', $article['price']);

        //<Deposit>0.08</Deposit>


        if (isset($article['options'])) {
            $subArticleList = $articleNode->addChild('SubArticleList');
//dd($subArticleList);
foreach ($article['options'] as $subArticle) {
    // Überprüfe, ob der Produktcode 'deposit' ist
    if ($subArticle['productCode'] === 'deposit') {
        // Füge den Preis als Einzahlung zum Hauptartikel hinzu
        $articleNode->addChild('Deposit', $subArticle['price']);
    } else {
        // Füge den Subartikel hinzu, wenn der Produktcode nicht 'deposit' ist
        $subArticleNode = $subArticleList->addChild('SubArticle');
        $subArticleNode->addChild('ArticleNo', $subArticle['productCode']);
        $subArticleNode->addChild('ArticleName', $subArticle['productName']);
        $subArticleNode->addChild('Count', $subArticle['quantity']);
        $subArticleNode->addChild('Price', $subArticle['price']);
    }
}
        }
    }
}

//dd($articleList);

    // Konvertiere das XML-Dokument in eine Zeichenkette und speichere es in der Eigenschaft $xml
    $this->xml = $xml->asXML();


    $newOrderNumber = Session::get('newOrderNumber');
    $shopId = Session::get('shopId');

    // Definiere das Verzeichnis
$directory = "uploads/shops/{$shopId}/orders";

// Erstelle das Verzeichnis, wenn es nicht existiert
if (!Storage::exists($directory)) {
    Storage::makeDirectory($directory, 0777, true); // Hier können Sie die Berechtigungen anpassen
}

// Speichere das XML-Dokument im Verzeichnis
Storage::put("{$directory}/order_{$newOrderNumber}.xml", $this->xml);


// XML in ein Array konvertieren
$array = json_decode(json_encode($xml), true);
// Das Array in ein JSON-Format umwandeln
$jsonData = json_encode($array, JSON_PRETTY_PRINT);

//dd($jsonData);



// XML in JSON umwandeln und sicherstellen, dass Sonderzeichen korrekt behandelt werden
//$xmlString = htmlspecialchars($this->xml);
//$jsonData = json_encode($this->xml);

$newOrderNumber = Session::get('newOrderNumber');
$shopId = Session::get('shopId');

$existingOrder = ModOrders::where('order_nr', $newOrderNumber)
    ->where('parent', $shopId)
    ->first();

if ($existingOrder) {
    $existingOrder->order_json_data = $jsonData;
    $existingOrder->order_tracking_status = '999999';
    $existingOrder->save();
} else {
    $newOrder = new ModOrders();
    $newOrder->order_nr = $newOrderNumber;
    $newOrder->order_json_data = $jsonData;
    $newOrder->order_tracking_status = '999999';
    $newOrder->save();
}

    // Sende eine Erfolgsmeldung
    session()->flash('message', 'XML-Dokument wurde erfolgreich erstellt.');
}


public function generateConfirmationEmail($orderHash)
{

// Kaufdaten aus der Datenbank abrufen
$orderForEmail = ModOrders::where('hash', $orderHash)->first();

// Verkäufer-Daten zusammenstellen
$order = [
    'order_number' => $orderForEmail->order_nr,
    'created_at' => $orderForEmail->created_at,
//    'items' => json_decode($orderForEmail->order_json_data)->OrderList->Order->ArticleList->Article, // Annahme: Die Artikel sind im JSON-Format gespeichert
 //   'items' => isset(json_decode($orderForEmail->order_json_data)->OrderList->Order->ArticleList->Article) ? json_decode($orderForEmail->order_json_data)->OrderList->Order->ArticleList->Article : [], // Prüfen Sie, ob der Schlüssel existiert

    'total' => $orderForEmail->price_total,
    'currency' => 'EUR', // Annahme: Die Währung ist festgelegt
    'payment_type' => $orderForEmail->payment_type,
    'shop_name' => $orderForEmail->shop_name,
    // Füge weitere Felder hinzu, falls erforderlich
];

//dd($order);

// Buyer-Daten zusammenstellen
$customer = [
    'name' => $orderForEmail->name,
    'email' => $orderForEmail->email,
    'phone' => $orderForEmail->phone,
    'address' => $orderForEmail->shipping_street . ', ' . $orderForEmail->shipping_house_no,
    'city' => $orderForEmail->shipping_city,
    'zip' => $orderForEmail->shipping_zip,
    'country' => $orderForEmail->shipping_country_code,
    // Füge weitere Felder hinzu, falls erforderlich
];


$orderData = json_decode($orderForEmail->order_json_data);

// Überprüfe, ob die Daten in der erwarteten Struktur vorliegen
if (isset($orderData->OrderList->Order->ArticleList->Article)) {
    // Überprüfe, ob es sich um ein einzelnes Objekt oder ein Array von Objekten handelt
    if (is_array($orderData->OrderList->Order->ArticleList->Article)) {
        // Wenn es sich um ein Array handelt, verwende es direkt
        $orderItems = ['items' => $orderData->OrderList->Order->ArticleList->Article];
    } else {
        // Wenn es sich um ein einzelnes Objekt handelt, wandle es in ein Array um
        $orderItems = ['items' => [$orderData->OrderList->Order->ArticleList->Article]];
    }
} else {
    // Setze die Artikel auf ein leeres Array, wenn der Schlüssel nicht existiert oder die Daten fehlen
    $orderItems = ['items' => []];
}

//dd($orderItems);

    // Erzeuge die Verifizierungs-URL für den Verkäufer
    $trackingUrl = route('life-tracking', ['orderHash' => $orderHash]);

        // Daten für die E-Mail-Vorlage zusammenstellen
        $data = [
            'order' => $order,
            'customer' => $customer,
            'trackingUrl' => $trackingUrl,
            'orderData' => $orderData, // Korrekter Schlüssel
            'orderItems' => $orderItems,
                ];
//dd($data);



        // E-Mail-Vorlage rendern
        $order_email_body = view('email-templates.order-confirmation', $data)->render();

//dd($order_email_body);



// E-Mail-Konfiguration zusammenstellen
$mailConfig = [
    'mail_from_email' => custom_env('MAIL_FROM_ADDRESS'),
    'mail_from_name' => custom_env('MAIL_FROM_NAME'),
    'mail_recipient_email' => $customer['email'], // Verwende die E-Mail-Adresse des Kunden als Empfänger
    'mail_recipient_name' => $customer['name'], // Verwende den Namen des Kunden als Empfängername
    'mail_subject' => 'Bestellbestätigung', // Setze den Betreff der E-Mail
    'mail_body' => $order_email_body // Verwende den gerenderten Inhalt der Bestellbestätigung
];
        //dd($data, $mailConfig);

                if(sendEmail($mailConfig)){
                    session()->flash('success', 'Your email has been verified.');
                    return;
                    //    return view('backend.pages.seller.auth.email-verificaton', $data);
                //    return redirect()->route('admin.forgot-password');

            }else{
                session()->flash('fail', 'Something went wrong');
                return;
            }




}





public function generateQrCode()
{

     // Generiere den QR-Code als Bild
     $qrCode = QrCode::size(200)->geo(51.378638, -0.100897);
     dd($qrCode);



    // Generiere den QR-Code als Bild und speichere ihn auf dem Server
    $qrCodePath = public_path('qr_codes/') . 'qr_code.png';
    QrCode::size(200)->geo(51.378638, -0.100897)->format('png')->generate('QR Code', $qrCodePath);

    // Rückgabe des Dateipfads des gespeicherten QR-Codes
    return $qrCodePath;
}






    public function updatedSelectedOption($value)
    {
        // Wenn der Benutzer "Firma" auswählt, setze den Wert von $selectedOption auf "Firma"
        // Andernfalls setze ihn auf einen leeren String
     //   dd($value);
        if ($value === 'firma') {
            $this->selectedOption = 'firma';
       //     $this->refreshData();

        } else {
            $this->selectedOption = $value;
            $this->reset(['company', 'department']);
        }
    }


    public function refreshData()
    {
        // Hier kannst du die Daten neu laden, z.B.:
        $this->shopData = ModShop::findOrFail($this->shopData->id);
        // Du könntest auch andere notwendige Daten hier neu laden.

        // Livewire wird automatisch neu gerendert, wenn die Eigenschaften geändert werden.
    }



    public function render()
    {
        // Adressdaten aus der Session abrufen, falls vorhanden
        $addressData = Session::get('address_data', []);

      //  dd($addressData);

        return view('livewire.frontend.cart.cart-order-details', [
            'shopData' => $this->shopData,
            'xml' => $this->xml,
            'addressData' => $addressData, // Adressdaten an die Ansicht übergeben
        ]);
    }
}
