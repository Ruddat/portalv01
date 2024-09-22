<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Seller;
use App\Models\ModShop;

class DeleteUnverifiedSellers extends Command
{
    // Der Name und die Beschreibung des Commands
    protected $signature = 'sellers:delete-unverified';
    protected $description = 'Löscht nicht verifizierte Verkäufer und ihre Shops';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Holen aller nicht verifizierten Verkäufer
        $unverifiedSellers = Seller::where('email_verified_at', null)->get();

        if ($unverifiedSellers->isEmpty()) {
            $this->info('Es wurden keine nicht verifizierten Verkäufer gefunden.');
            return 0;
        }

        // Löschen der Shops und Verknüpfungen
        foreach ($unverifiedSellers as $seller) {
            // Lösche die Zuordnungen der Shops in der Pivot-Tabelle
            $seller->shops()->each(function ($shop) {
                // Wenn das Shop-Modell Soft Deletes verwendet, verwende forceDelete()
                if ($shop->getDeletedAtColumn() !== null) {
                    $shop->forceDelete();
                } else {
                    $shop->delete();
                }
            });

            // Lösche den Verkäufer
            $seller->forceDelete();
        }

        $this->info('Nicht verifizierte Verkäufer und ihre Shops wurden erfolgreich gelöscht.');

        return 0;
    }
}
