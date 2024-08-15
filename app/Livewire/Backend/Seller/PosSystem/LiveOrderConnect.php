<?php

namespace App\Livewire\Backend\Seller\PosSystem;

use Exception;
use Livewire\Component;
use App\Models\ModOrders;
use Mike42\Escpos\Printer;
use App\Models\ModSharedToolsPrinters;
use App\Models\ModSharedToolsPrinterConfiguration;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Dompdf\Dompdf;
use Dompdf\Options;


class LiveOrderConnect extends Component
{
    public $ordersIn;
    public $ordersPrepared;
    public $ordersDelivered;
    public $newOrder = null;
    public $activeTab = 'ordersIn'; // Default Tab

    protected $listeners = ['orderUpdated' => 'refreshOrders'];

    public function mount()
    {
        $this->refreshOrders();
        $this->checkForNewOrders();

    }

    public function refreshOrders()
    {
        $this->ordersIn = ModOrders::where('order_tracking_status', 1) // Assuming 0 is 'in'
            ->whereDate('created_at', today())
            ->orderBy('created_at', 'asc')
            ->get();

        $this->ordersPrepared = ModOrders::where('order_tracking_status', 2) // Assuming 1 is 'prepared'
            ->whereDate('created_at', today())
            ->orderBy('created_at', 'desc')
            ->get();

        $this->ordersDelivered = ModOrders::where('order_tracking_status', 3) // Assuming 2 is 'delivered'
            ->whereDate('created_at', today())
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function moveToPrepared($orderId)
    {
        $order = ModOrders::find($orderId);
        if ($order) {
            $order->order_tracking_status = 2; // Mark as 'prepared'
            $order->save();
            $this->refreshOrders();
            $this->activeTab = 'ordersPrepared'; // Change to Prepared tab
        }
    }

    public function moveToDelivered($orderId)
    {
        $order = ModOrders::find($orderId);
        if ($order) {
            $order->order_tracking_status = 3; // Mark as 'delivered'
            $order->save();
            $this->refreshOrders();
            $this->activeTab = 'ordersDelivered'; // Change to Delivered tab
        }
    }

    public function setActiveTab($tabName)
    {
        $this->activeTab = $tabName;
    }


    public function checkForNewOrders()
    {
        $this->newOrder = ModOrders::where('order_tracking_status', 999999) // Assuming 0 is 'in'
            ->whereDate('created_at', today())
            ->orderBy('created_at', 'desc')
            ->first(); // Holt die erste neue Bestellung
//dd($this->newOrder);

        if ($this->newOrder) {
            $this->dispatch('playAudio');
        }
    }

public function setDeliveryTime($minutes)
{
    if ($this->newOrder) {
        $this->newOrder->deliver_minutes = $minutes;
        $this->newOrder->save();
    }
}

public function confirmOrder()
{
    if ($this->newOrder) {
        $this->newOrder->order_tracking_status = 1; // Status auf 'prepared' setzen
        $this->newOrder->save();

        $this->refreshOrders();
        $this->checkForNewOrders(); // nächste Bestellung laden
    }
}

public function skipOrder()
{
    $this->newOrder = null;
    $this->checkForNewOrders();
}





public function printOrder()
{
    $computerName = gethostname();
    $shopId = 511; // Beispielhaft: Shop-ID des angemeldeten Benutzers

    // Drucker-Konfiguration laden
    $printerConfig = ModSharedToolsPrinterConfiguration::where('shop_id', $shopId)
                        ->where('computer_name', $computerName)
                        ->first();

    if (!$printerConfig) {
        session()->flash('error', 'Drucker nicht konfiguriert!');
        return;
    }

    // Druckerinformationen abrufen
    $printer = ModSharedToolsPrinters::find($printerConfig->printer_id);

    if (!$printer) {
        session()->flash('error', 'Drucker nicht gefunden!');
        return;
    }

    // Testen, ob der Drucker ein POS-Drucker ist
    $isPosPrinter = $printer->connection_type === 'network' && $printer->type === 'POS';
//dd($isPosPrinter);

    try {
        if ($isPosPrinter) {
            // POS-Drucker konfigurieren
            $connector = new NetworkPrintConnector($printer->ip_address, $printer->port);
            $escposPrinter = new Printer($connector);

            // Druckbefehl senden für POS-Drucker
            $orderData = json_decode($this->newOrder->order_json_data);
            $this->printOrderDetails($escposPrinter, $orderData);

            $escposPrinter->cut();
        } else {
            // A4-Drucker konfigurieren und Druckauftrag ausführen
            $orderData = json_decode($this->newOrder->order_json_data);
 // dd($orderData);
            $this->printOrderDetailsA4($orderData); // PDF erzeugen und direkt streamen/anzeigen
        }
    } catch (Exception $e) {
        session()->flash('error', 'Druckfehler: ' . $e->getMessage());
    } finally {
        if (isset($escposPrinter)) {
            $escposPrinter->close(); // Stelle sicher, dass der Drucker immer geschlossen wird
        }
    }

    session()->flash('message', 'Druckauftrag gesendet!');
}


public function printOrderDetails(Printer $printer, $orderData)
{
    // Druck von Bestelldetails für POS-Drucker
    $printer->text("Order #" . $orderData->OrderList->Order->OrderID . "\n");
    $printer->text("Name: " . $orderData->OrderList->Order->Customer->DeliveryAddress->FirstName . " " . $orderData->OrderList->Order->Customer->DeliveryAddress->LastName . "\n");
    $printer->text("Adresse: " . $orderData->OrderList->Order->Customer->DeliveryAddress->Street . " " . $orderData->OrderList->Order->Customer->DeliveryAddress->HouseNo . "\n");
    $printer->text("Gesamtbetrag: €" . $orderData->OrderList->Order->TotalPrice . "\n");
    // Weitere Details können hier hinzugefügt werden...
}


public function printOrderDetailsA4($orderData)
{
// Setzen Sie die Option, Fehler in Dompdf zu zeigen
$options = new \Dompdf\Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);
$dompdf = new \Dompdf\Dompdf($options);

   // dd($orderData);


$html = "<h1>Order #" . $orderData->OrderList->Order->OrderID . "</h1>";
// HTML-Inhalt für das PDF
$html = "<h1>Order #" . $orderData->OrderList->Order->OrderID . "</h1>";
$html .= "<p>Name: " . $orderData->OrderList->Order->Customer->DeliveryAddress->FirstName . " " . $orderData->OrderList->Order->Customer->DeliveryAddress->LastName . "</p>";
$html .= "<p>Adresse: " . $orderData->OrderList->Order->Customer->DeliveryAddress->Street . " " . $orderData->OrderList->Order->Customer->DeliveryAddress->HouseNo . "</p>";
//$html .= "<p>Gesamtbetrag: €" . $orderData->OrderList->Order->TotalPrice . "</p>";

// Start der Artikelliste
$html .= "<h2>Artikelliste</h2>";
$html .= "<ul>";

foreach ($orderData->OrderList->Order->ArticleList->Article as $article) {
    $html .= "<li>";
    $html .= "<strong>Artikelname:</strong> " . htmlspecialchars($article->ArticleName) . " (" . htmlspecialchars($article->ArticleSize) . ")<br>";
    $html .= "<strong>Anzahl:</strong> " . htmlspecialchars($article->Count) . "<br>";
    $html .= "<strong>Preis:</strong> €" . htmlspecialchars($article->Price) . "<br>";
    $html .= "<strong>Artikelnummer:</strong> " . htmlspecialchars($article->ArticleNo) . "<br>";

    // Wenn es SubArticles gibt, diese auch auflisten
    if (!empty($article->SubArticleList)) {
        $html .= "<ul>";


        if (isset($article->SubArticleList->SubArticle)) {
            foreach ($article->SubArticleList->SubArticle as $subArticle) {
                $articleName = !empty($subArticle->ArticleName) ? $subArticle->ArticleName : 'Kein Name';
                $price = !empty($subArticle->Price) ? $subArticle->Price : '0.00';

                $html .= "<li>";
                $html .= "<strong>Zusatz:</strong> " . htmlspecialchars($articleName) . " - €" . htmlspecialchars(number_format($price, 2));
                $html .= "</li>";
            }
        } else {
            // Überprüfen Sie, ob SubArticleList direkt ein Array ist
            foreach ($article->SubArticleList as $subArticle) {
                $articleName = !empty($subArticle->ArticleName) ? $subArticle->ArticleName : 'Kein Name';
                $price = !empty($subArticle->Price) ? $subArticle->Price : '0.00';

                $html .= "<li>";
                $html .= "<strong>Zusatz:</strong> " . htmlspecialchars($articleName) . " - €" . htmlspecialchars(number_format($price, 2));
                $html .= "</li>";
            }
        }

        $html .= "</ul>";
    }

    $html .= "</li>";
}

$html .= "</ul>";

// Überprüfen Sie den generierten HTML-Inhalt


    // Laden des HTML-Inhalts in Dompdf
    $dompdf->loadHtml($html);


    // (Optional) Papiergröße und Ausrichtung einstellen
    $dompdf->setPaper('A4', 'portrait');

    // Rendern des PDFs
    $dompdf->render();

    // Speichern des PDFs im Server-Ordner
    $output = $dompdf->output();
    $filePath = storage_path('app/public/order.pdf');
    file_put_contents($filePath, $output);

    // Befehl zum Drucken des PDFs
    $printerName = 'EPSON ET-2810 Series'; // Ändern Sie das in den Namen Ihres Druckers
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        // Für Windows
        shell_exec("start /B rundll32.exe printui.dll,PrintUIEntry /y /n \"{$printerName}\"");
        shell_exec("start /B AcroRd32.exe /t \"{$filePath}\" \"{$printerName}\"");
    } else {
        // Für Unix/Linux/MacOS
        shell_exec("lp -d {$printerName} {$filePath}");
    }

    // Optional: Löschen der PDF-Datei nach dem Druck
    // unlink($filePath);
}







public function render()
{
    return view('livewire.backend.seller.pos-system.live-order-connect', [
        'ordersIn' => $this->ordersIn,
        'ordersPrepared' => $this->ordersPrepared,
        'ordersDelivered' => $this->ordersDelivered,
        'activeTab' => $this->activeTab,
        'newOrder' => $this->newOrder, // Neue Bestellung an die Ansicht übergeben
    ]);
}

}
