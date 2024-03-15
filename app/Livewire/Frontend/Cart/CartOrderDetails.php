<?php

namespace App\Livewire\Frontend\Cart;

use SimpleXMLElement;
use App\Models\ModShop;
use Livewire\Component;
use App\Models\ModOrders;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use NominatimLaravel\Content\Nominatim;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;

class CartOrderDetails extends Component
{
    public $shopData;
    public $selectedOption = ''; // Eigenschaft zum Speichern des aktuellen ausgewählten Optionswerts
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

    public function mount($restaurantId)
    {
        // Abrufen der Shop-Daten anhand der ID oder eine Fehlermeldung anzeigen, falls nicht gefunden
        $this->shopData = ModShop::findOrFail($restaurantId);
     //   $this->createXml();
        $this->ipAddress = $_SERVER['REMOTE_ADDR'];

    }


    public function orderNowForm()
    {
        $validatedData = $this->validate([
           // 'selectedOption' => 'required',
           // 'company' => 'required_if:selectedOption,Firma',
           // 'department' => 'required_if:selectedOption,Firma',
            'last_name' => 'required|min:4', // Beispiel für Validierung
            'first_name' => 'required|min:4', // Beispiel für Validierung
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
        'hash' => $orderHash,
        'clients_ip' => $this->ipAddress,
        'gender' => '1', // Beispielwert
        'status' => '0', // New
        'name' => $validatedData['last_name'],
        'surname' => $validatedData['first_name'],
        'email' => $validatedData['email'],
        'phone' => $validatedData['phone'],
        'shipping_street' => $validatedData['full_address'],
        'shipping_house_no' => '2', // Beispielwert
        'shipping_type' => 'picup', // Beispielwert
        'price_products' => '0.00', // Beispielwert
        'price_shipping' => '0.00', // Beispielwert
        'price_bottles' => '0.00', // Beispielwert
        'price_payment' => '0.00', // Beispielwert
        'price_tips' => '0.00', // Beispielwert
        'price_total' => '0.00', // Beispielwert
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

        //dd($order);


    $this->createXml();

    $this->generateNewPDF();

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

    //dd($orderHash);
   // $delivery_option = 'Lieferung'; // Annahme: Die Lieferoption ist in $this->delivery_option gespeichert

    // Erstelle ein neues XML-Dokument
    $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" standalone="yes"?><WinOrder></WinOrder>');


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


// Füge die Artikelinformationen hinzu, wenn Artikel vorhanden sind
if (!empty($articles)) {
    $articleList = $order->addChild('ArticleList');

    foreach ($articles as $article) {
        $articleNode = $articleList->addChild('Article');
        $articleNode->addChild('ArticleNo', $article['article_no']);
        $articleNode->addChild('ArticleName', $article['article_name']);
        $articleNode->addChild('ArticleSize', $article['article_size']);
        $articleNode->addChild('Count', $article['count']);
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

    $xml->asXML(public_path('order_0815.xml'));

  //  dd($this->xml);


// XML in ein Array konvertieren
$array = json_decode(json_encode($xml), true);
// Das Array in ein JSON-Format umwandeln
$jsonData = json_encode($array, JSON_PRETTY_PRINT);

//dd($jsonData);



// XML in JSON umwandeln und sicherstellen, dass Sonderzeichen korrekt behandelt werden
//$xmlString = htmlspecialchars($this->xml);
//$jsonData = json_encode($this->xml);

$newOrderNumber = Session::get('newOrderNumber');

//dd($newOrderNumber);
$existingOrder = ModOrders::where('order_nr', $newOrderNumber)->first();

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
        if ($value === 'Firma') {
            $this->selectedOption = 'Firma';
            $this->refreshData();

        } else {
            $this->selectedOption = '';
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
        return view('livewire.frontend.cart.cart-order-details', [
            'shopData' => $this->shopData,
            'xml' => $this->xml,
        ]);
    }
}
