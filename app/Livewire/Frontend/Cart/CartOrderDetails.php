<?php

namespace App\Livewire\Frontend\Cart;

use App\Models\ModShop;
use Livewire\Component;
use App\Models\ModOrders;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use NominatimLaravel\Content\Nominatim;

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
    public $delivery_option = 'Abholung'; // Annahme: Die Lieferoption ist in $this->delivery_option gespeichert
    public $ipAddress;


    public function mount($restaurantId)
    {
        // Abrufen der Shop-Daten anhand der ID oder eine Fehlermeldung anzeigen, falls nicht gefunden
        $this->shopData = ModShop::findOrFail($restaurantId);
        $this->createXml();
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
        // dd($latitude, $longitude);
        $shopId = $this->shopData->id;

        // Eindeutigen Hash-Wert generieren
        $orderHash = Str::random(16);

        $lastOrderNumber = ModOrders::where('parent', $shopId)->max('order_nr');

        // Inkrementieren der letzten Bestellnummer um eins, um die neue Bestellnummer zu generieren
          $newOrderNumber = $lastOrderNumber + 1;


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
    ];

    $payment_method = $this->payment_method; // Beispielwert


    $data = [
        [
            'quantity' => 1,
            'description' => '1 Year Subscription',
            'price' => '129.00'
        ]
    ];

    //$pdf = Pdf::loadView('pdf.order', ['data' => $data]);

    $pdf = PDF::loadView('pdf.order', compact('customerData', 'shopData', 'payment_method', 'data'));



    $filePath = 'pdf/' . time() . '_bestellbestaetigung.pdf';
    Storage::put($filePath, $pdf->output());

  //  return $pdf->download();


}



public function generatePDF()
{
    // Erfassen der Bestellinformationen
    $orderNumber = '7587';
    $orderDate = now()->format('d.m.Y H:i:s');
    $storeName = 'Pizza Express Edemissen';
    $storePhoneNumber = '053739966';
    $storeAddress = 'Heidkrugsweg 31, 31234 Edemissen, Deutschland';
    $orderMethod = 'Internetbestellung über www.just-deliver.de';
    $customerPhone = '05373930430';
    $customerName = 'Bargholz Andre';
    $customerCompany = ''; // Falls nicht angegeben
    $customerStreet = 'Seershäuser Weg 5';
    $customerPostalCode = '38543';
    $customerCity = 'Hillerse (Volkse)';
    $customerAdditional = ''; // Falls nicht angegeben
    $customerEmail = 'Eva_und_Andre@t-online.de';
    $orderIP = '94.31.104.186';

    // Bestellpositionen
    $orderItems = [
        ['name' => '40', 'Bulls Big Daddy', 'price' => '10.90'],
        ['name' => '68', 'Presley Burger - Wedges', 'price' => '11.90']
    ];

    // HTML für das PDF generieren
    $html = '
        <div>
            <h1>Bestellung: ' . $orderNumber . ' | Datum: ' . $orderDate . '</h1>
            <p>Filiale: ' . $storeName . ' | Tel.: ' . $storePhoneNumber . '</p>
            <p>' . $storeAddress . '</p>
            <p>' . $orderMethod . '</p>

            <h2>Kundendaten</h2>
            Telefon: ' . $customerPhone . '</br>
            Name: ' . $customerName . '
            <p>Firma / Abt.: ' . $customerCompany . '</p>
            <p>Straße: ' . $customerStreet . '</p>
            <p>PLZ / Ort: ' . $customerPostalCode . ' ' . $customerCity . '</p>
            <p>Zusatz: ' . $customerAdditional . '</p>
            <p>E-Mail-Adresse: ' . $customerEmail . '</p>
            <p>Bestell-IP: ' . $orderIP . '</p>
            <p style="font-weight: bold;">Zahlung: Kunde hat bereits online bezahlt!!!</p>
            <h2>Bestellung</h2>
            <p>Bestellung: Lieferung</p>
            <p>Zeitpunkt: sofort</p>
            <p>Zahlungsart: Paypal Express</p>
            <table style="margin: auto;">
                <thead>
                    <tr>
                        <th>Art.-Nr.</th>
                        <th>Artikel + Zutaten</th>
                        <th>Einzelpreis</th>
                        <th>Summe</th>
                    </tr>
                </thead>
                <tbody>';
    // Durchlaufe die Bestellpositionen und füge sie zur Tabelle hinzu
    $index = 1;

    foreach ($orderItems as $item) {
        $html .= '
                    <tr>
                    <td>' . $index . '</td>
                    <td>' . $item['name'] . '</td>
                        <td>' . $item['price'] . ' €</td>
                        <td>' . $item['price'] . ' €</td>
                    </tr> ';

 }
    // Schließe die Tabelle und füge Zwischensumme, Zahlung und Gesamtsumme hinzu
    $html .= '
                </tbody>
            </table>
            <p>Zwischensumme: 22.80 €</p>
            <p>Zahlung: 1.01 €</p>
            <p>Summe: 23.81 €</p>
        </div>';

    // PDF mit DOMPDF generieren
    $pdf = PDF::loadHTML($html);

        // Speichern der PDF-Datei auf dem Server
        $filePath = 'pdf/' . time() . '_bestellbestaetigung.pdf';
        Storage::put($filePath, $pdf->output());

        // Rückgabe des Dateipfads für die gespeicherte PDF
        return $filePath;
}






public function createXml()
{
    $delivery_option = 'Abholung'; // Annahme: Die Lieferoption ist in $this->delivery_option gespeichert
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


    if ($this->delivery_option !== 'Abholung') {
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


    // Sende eine Erfolgsmeldung
    session()->flash('message', 'XML-Dokument wurde erfolgreich erstellt.');
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
