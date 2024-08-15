<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ModSharedToolsPrinters;

class DiscoverPrinters extends Command
{
    protected $signature = 'printers:discover';
    protected $description = 'Discover and store installed printers';

    public function handle()
    {
        // Erkennung der Drucker
        $printers = $this->getPrinters();

        // Speichern in der Datenbank
        foreach ($printers as $printer) {
            ModSharedToolsPrinters::updateOrCreate(
                ['name' => $printer['name']],
                ['port' => $printer['port'], 'driver' => $printer['driver']]
            );
        }

        $this->info('Drucker erfolgreich erkannt und gespeichert.');
    }

    private function getPrinters()
    {
        $printers = [];

        // Windows
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $output = [];
            exec('powershell -Command "Get-Printer | Select-Object Name, PortName, DriverName | ConvertTo-Json"', $output);
            $printers = json_decode(implode("\n", $output), true);
            $printers = array_map(function ($printer) {
                return [
                    'name' => $printer['Name'],
                    'port' => $printer['PortName'],
                    'driver' => $printer['DriverName']
                ];
            }, $printers);
        }

        // Linux
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'LIN') {
            $output = [];
            exec('lpstat -p', $output);
            foreach ($output as $line) {
                if (preg_match('/^printer (.+?) is/', $line, $matches)) {
                    $printers[] = [
                        'name' => $matches[1],
                        'port' => null, // Nicht verfügbar auf Linux
                        'driver' => null // Nicht verfügbar auf Linux
                    ];
                }
            }
        }

        return $printers;
    }
}
