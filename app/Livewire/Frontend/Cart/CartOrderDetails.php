<?php

namespace App\Livewire\Frontend\Cart;

use SimpleXMLElement;
use App\Models\Client;
use App\Models\ModShop;
use Livewire\Component;
use App\Models\ModOrders;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
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
    public $city = ''; // Eigenschaft zum Speichern der Stadt
    public $postal_code = ''; // Eigenschaft zum Speichern des Postleitzahl
    public $opt_news_coupons = true; // Eigenschaft zum Speichern der Option "Ja, ich möchte gelegentlich Neuigkeiten und Coupons erfahren"
    public $opt_save_data = true; // Eigenschaft zum Speichern der Option "Meine Daten für den nächsten Besuch speichern"
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


    public function mount($restaurantId)
    {
        // Abrufen der Shop-Daten anhand der ID oder eine Fehlermeldung anzeigen, falls nicht gefunden
        $this->shopData = ModShop::findOrFail($restaurantId);
     //   $this->createXml();
        $this->ipAddress = $_SERVER['REMOTE_ADDR'];

        $addressData = Session::get('address_data');

      //  dd($addressData);
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
            $this->full_address = $addressData['full_address'] ?? '';
            $this->city = $addressData['city'] ?? '';
            $this->postal_code = $addressData['postal_code'] ?? '';
            $this->payment_method = $addressData['payment_method'] ?? '';
            $this->opt_news_coupons = $addressData['opt_news_coupons'] ?? false;
            $this->opt_save_data = $addressData['opt_save_data'] ?? false;
            $this->order_comment = $addressData['order_comment'] ?? '';
            $this->description_of_way = $addressData['description_of_way'] ?? '';

        }

    }

    public function orderNowForm()
    {

            // Überprüfen, ob der Warenkorb leer ist
            $order = session()->get('shopping-cart');

         //  dd($order);
   // if (empty($order) || !Session::has('newOrderNumber')) {
    if (empty($order)) {
    return redirect()->back()->with('error', 'Der Warenkorb ist leer oder die Sitzung ist abgelaufen.');
} else {

}
        $validatedData = $this->validate([
            'selectedOption' => 'required',
            'company' => 'required_if:selectedOption,Firma',
            'department' => 'required_if:selectedOption,Firma',
            'last_name' => 'required_if:selectedOption,Frau,Herr,Divers|min:4',
            'first_name' => 'required_if:selectedOption,Frau,Herr,Divers|min:4',
            'email' => 'required|email', // Validierung der E-Mail-Adresse
            'phone' => 'required', // Validierung der Telefonnummer
            'full_address' => 'required:min:5', // Validierung der vollständigen Adresse
            'city' => 'required|min:5', // Validierung der Stadt
            'postal_code' => 'required', // Validierung der Postleitzahl
            'payment_method' => 'required', // Validierung der ausgewählten Zahlungsart
            'opt_news_coupons' => 'boolean', // Validierung der Option "Ja, ich möchte gelegentlich Neuigkeiten und Coupons erfahren"
            'opt_save_data' => 'boolean', // Validierung der Option "Meine Daten für den nächsten Besuch speichern"
            'order_comment' => 'nullable', // Validierung des Bestellkommentars
            'description_of_way' => 'nullable', // Validierung des Versandkommentars
        ],[
            'selectedOption.required' => 'Bitte wählen Sie eine Option aus.',
            'company.required_if' => 'Bitte geben Sie den Firmennamen ein.',
            'department.required_if' => 'Bitte geben Sie den Abteilungsnamen ein.',
            'last_name.required' => 'Bitte geben Sie den Nachnamen ein.',
            'last_name.min' => 'Der Nachname muss mindestens 4 Zeichen lang sein.',
            'first_name.required' => 'Bitte geben Sie den Vornamen ein.',
            'first_name.min' => 'Der Vorname muss mindestens 4 Zeichen lang sein.',
            'email.required' => 'Bitte geben Sie die E-Mail-Adresse ein.',
            'phone.required' => 'Bitte geben Sie die Telefonnummer ein.',
            'full_address.required' => 'Bitte geben Sie die vollständige Adresse ein.',
            'full_address.min' => 'Die vollständige Adresse muss mindestens 5 Zeichen lang sein.',
            'city.required' => 'Bitte geben Sie die Stadt ein.',
            'city.min' => 'Die Stadt muss mindestens 5 Zeichen lang sein.',
            'postal_code.required' => 'Bitte geben Sie die Postleitzahl ein.',
            'payment_method.required' => 'Bitte wählen Sie eine Zahlungsart aus.',
        ]);

      //   dd($validatedData);

// Konvertiere die Formulardaten in JSON
$jsonData = json_encode($validatedData);

// Speichere die Formulardaten als Cookie im Browser des Benutzers
 // Speichere die Formulardaten als Cookie im Browser des Benutzers
 $response = Response::make('')->withCookie(cookie('form_data', $jsonData, 60 * 24 * 30)); // Gültig für 30 Tage

 Session::put('address_data', $validatedData);




        // Kombiniere die Teile der Adresse aus dem Livewire-Daten-Array
        $street = $this->full_address;
        $zip = $this->postal_code;
        $city = $this->city;

        // Baue die vollständige Adresse
        $userInput = "$street $zip $city";
        // $userInput = 'Heidkrugsweg 31, Edemissen'; // Die Adresse, die der Benutzer eingibt
        // dd($userInput);

        $url = "https://nominatim.openstreetmap.org/";
        $nominatim = new Nominatim($url);

        $search = $nominatim->newSearch();
        $search->query($userInput);

        $results = $nominatim->find($search);

    if (!empty($results)) {
        foreach ($results as $result) {
        $latitude = $result['lat'];
        $longitude = $result['lon'];
        // echo "Latitude: $latitude, Longitude: $longitude<br>";
        }
    }
         // koordinaten vom besteller zur berechnung der liefergebueren

         // Speichern der Werte in der Session
        Session::put('latitude', $latitude);
        Session::put('longitude', $longitude);

        //dd($latitude, $longitude);

        // Shopinformationen aus der Datenbank
        $shopId = $this->shopData->id;
        Session::put('shopId', $shopId);

        // Eindeutigen Hash-Wert generieren
        $orderHash = Str::random(16);

        $lastOrderNumber = ModOrders::where('parent', $shopId)->max('order_nr');

        // Inkrementieren der letzten Bestellnummer um eins, um die neue Bestellnummer zu generieren
          $newOrderNumber = $lastOrderNumber + 1;
        // Bestellnummer als Eigenschaft des Livewire-Komponentenobjekts speichern
          $this->newOrderNumber = $newOrderNumber;

        Session::put('newOrderNumber', $newOrderNumber);
        Session::put('orderHash', $orderHash);

       // Neue Bestellung erstellen und in die Datenbank speichern
    $order = ModOrders::create([
        'order_nr' => $newOrderNumber,
        'parent' => $shopId,
        'shop_name' => $this->shopData->title,
        'hash' => $orderHash,
        'clients_ip' => $this->ipAddress,
        'gender' => $this->selectedOption === 'familie' ? '1' : ($this->selectedOption === 'frau' ? '2' : ($this->selectedOption === 'herr' ? '3' : '4')),
        //  'status' => '0', // New
        'name' => $validatedData['last_name'],
        'surname' => $validatedData['first_name'],
        'email' => $validatedData['email'],
        'phone' => $validatedData['phone'],
        'company' => $validatedData['company'],
        'department' => $validatedData['department'],
        'order_date' => now(),
        'shipping_street' => $validatedData['full_address'],
        'shipping_house_no' => '2', // Beispielwert
        'shipping_type' => 'picup', // Beispielwert
        'shipping_lng' => $longitude,
        'shipping_lat' => $latitude,
        'price_products' => '0.00', // Beispielwert
        'price_shipping' => '0.00', // Beispielwert
        'price_bottles' => '0.00', // Beispielwert
        'price_payment' => '0.00', // Beispielwert
        'price_tips' => '0.00', // Beispielwert
        'price_total' => '12.90', // Beispielwert
        'eshop_discount' => '0.00', // Beispielwert
        'cart_in_session' => '0', // Beispielwert
        'coupon_code' => '', // Beispielwert
        'rand_id' => '0', // Beispielwert

        'shipping_city' => $validatedData['city'],
        'shipping_zip' => $validatedData['postal_code'],
        'payment_type' => $validatedData['payment_method'],
        'order_comment' => $validatedData['order_comment'],
        'shipping_comment' => $validatedData['description_of_way'],
        // Fügen Sie weitere Felder hinzu, je nach Bedarf
    ]);

        $order = session()->get('shopping-cart');

     //   dd($order);


    $this->createXml();

    $this->generateNewPDF();

    $this->generateNewClient($validatedData);

    // Hier wird zur Livewire-Komponente `LifeTracking` weitergeleitet
    // und der $orderHash als Parameter übergeben
    return Redirect::route('life-tracking', ['orderHash' => $orderHash]);

        // Hier wird zur Methode `redirectToLifeTracking` im Livewire-Controller `LifeTracking` weitergeleitet
        return Redirect::route('life-tracking');

//        return Redirector::toRoute('life-tracking');

}

public function generateNewClient($data)
{
    // Geokoordinaten (Beispielwerte)
    $latitude = Session::get('latitude');
    $longitude = Session::get('longitude');

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
        'address' => $data['full_address'],
        'shipping_house_no' => '2', // Beispielwert
        'shipping_type' => 'picup', // Beispielwert
        'longitude' => $longitude,
        'latitude' => $latitude,
        'city' => $data['city'],
        'postal_code' => $data['postal_code'],
        // Fügen Sie weitere Felder hinzu, je nach Bedarf
    ]);

    return $order;
}




public function generateNewPdf()
{

    $newOrderNumber = $this->newOrderNumber;


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
    $orderData = [
        'Bestellung' => 'Lieferung',
        'Zeitpunkt' => 'sofort',
        'Zahlungsart' => $this->payment_method,
      ];

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

    $pdf = PDF::loadView('pdf.order', compact('customerData', 'qrcode', 'shopData', 'orderData', 'payment_method', 'newOrderNumber', 'data'));

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

//dd($articles);

// Füge die Artikelinformationen hinzu, wenn Artikel vorhanden sind
if (!empty($articles)) {
    $articleList = $order->addChild('ArticleList');

    foreach ($articles as $article) {
        $articleNode = $articleList->addChild('Article');
   //     $articleNode->addChild('ArticleNo', $article['product_code']);
   //     $articleNode->addChild('ArticleName', $article['name']);
        $articleNode->addChild('ArticleName', htmlspecialchars($article['name'], ENT_XML1, 'UTF-8'));
      //  $articleNode->addChild('ArticleName', utf8_encode($article['name']));
        $articleNode->addChild('ArticleSize', $article['size']);
        $articleNode->addChild('Count', $article['quantity']);
        $articleNode->addChild('Price', $article['price']);

        if (isset($article['sub_articles'])) {
            $subArticleList = $articleNode->addChild('SubArticleList');
            foreach ($article['sub_articles'] as $subArticle) {
                $subArticleNode = $subArticleList->addChild('SubArticle');
                $subArticleNode->addChild('ArticleNo', $subArticle['article_no']);
                $subArticleNode->addChild('ArticleName', $subArticle['article_name']);
                $subArticleNode->addChild('Count', $subArticle['count']);
                $subArticleNode->addChild('Price', $subArticle['price']);
                $subArticleNode->addChild('Partition', $subArticle['partition']);
            }
        }
    }
}



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
        return view('livewire.frontend.cart.cart-order-details', [
            'shopData' => $this->shopData,
            'xml' => $this->xml,
            'addressData' => $addressData, // Adressdaten an die Ansicht übergeben
        ]);
    }
}
