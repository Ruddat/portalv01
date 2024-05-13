<?php

namespace App\Http\Controllers\Backend\Seller\LottoSim;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class LottoSimController extends Controller
{
    private $localFilePath = 'lotto_history.csv';

    public function simulate(Request $request)
    {
        try {
            // Überprüfen, ob historische Daten vorhanden sind
            if (!Storage::disk('local')->exists($this->localFilePath)) {
                abort(500, 'Historical data file not found.');
            }

            $historicalData = $this->loadHistoricalData();

            // Überprüfen, ob historische Daten vorhanden sind
            if (empty($historicalData)) {
                abort(500, 'No historical data found.');
            }

            // Überprüfen, ob Wahrscheinlichkeiten bereits zwischengespeichert sind
            $probabilities = Cache::remember('eurojackpot_probabilities', now()->addHours(24), function () use ($historicalData) {
                return $this->calculateEurojackpotProbabilities($historicalData);
            });


            // Den Wert von $probabilities ausgeben (nachdem er entweder aus dem Cache geholt wurde oder berechnet wurde)
            $lottoNumbersList = [];
            for ($i = 0; $i < 12; $i++) {
                $lottoNumbers = $this->simulateEurojackpotDrawBasedOnLastDraw($probabilities);
                $lottoNumbersList[] = $lottoNumbers;
            }
//dd($lottoNumbersList);

            // Die Blade-Vorlage mit den Lottozahlen aufrufen und die Zahlenliste übergeben
            return view('backend.pages.seller.lottosimulator.lottosim', ['lottoNumbersList' => $lottoNumbersList]);


            // Den Wert von $probabilities ausgeben (nachdem er entweder aus dem Cache geholt wurde oder berechnet wurde)
            $output = '';
            for ($i = 0; $i < 12; $i++) {
                $lottoNumbers = $this->simulateEurojackpotDrawBasedOnLastDraw($probabilities);
                $output .= json_encode(['numbers' => $lottoNumbers]) . "\n";
            }

            return response($output)->header('Content-Type', 'application/json');


        } catch (\Exception $e) {
            Log::error('Error occurred while simulating Eurojackpot draw: ' . $e->getMessage());
            abort(500, 'An error occurred while simulating Eurojackpot draw.');
        }
    }


    private function loadHistoricalData(): array
    {
        $path = Storage::disk('local')->path($this->localFilePath);

        if (!file_exists($path) || !is_readable($path)) {
            abort(500, 'Failed to read historical data file.');
        }

        $file = file($path);

        if ($file === false) {
            abort(500, 'Failed to read historical data file.');
        }

        $data = [];

        foreach ($file as $line) {
            // Entfernen Sie das letzte Semikolon am Ende der Zeile
            $line = rtrim($line, ";\n");

            // Teilen Sie die Zeile an jedem semikolongetrennten Leerzeichen
            $numbers = preg_split('/;+/', $line);

            // Entfernen Sie leere Elemente aus dem Array
            $numbers = array_filter($numbers, function($value) {
                return !empty($value);
            });

            // Extrahieren Sie die letzten 6 Zahlen
            $drawNumbers = array_slice($numbers, -6);

            // Konvertieren Sie die Zahlen in ganze Zahlen
            $drawNumbers = array_map('intval', $drawNumbers);

            // Überprüfen Sie, ob alle Zahlen extrahiert wurden
            if (count($drawNumbers) === 6) {
                $data[] = $drawNumbers;
            }
        }
        return $data;
    }

    private function calculateEurojackpotProbabilities(array $historicalData): array
    {
        $flatList = array_map('intval', array_merge(...$historicalData));
        $totalNumbers = count($flatList);

        // Überprüfen, ob historische Daten vorhanden sind
        if ($totalNumbers === 0) {
            abort(500, 'No historical data available for Eurojackpot probability calculation.');
        }

        // Wahrscheinlichkeiten berechnen
        $counter = array_count_values($flatList);
        $probabilities = array_map(function ($count) use ($totalNumbers) {
            return $count / $totalNumbers;
        }, $counter);

        return $probabilities;
    }

    private function simulateEurojackpotDrawBasedOnLastDraw(array $probabilities): array
    {
        $lottoNumbers = [];

        // Ziehe die Hauptzahlen (5 aus 50)
        $mainNumbers = $this->drawUniqueMainNumbersFromProbabilities($probabilities, 5);
        $lottoNumbers['main_numbers'] = $mainNumbers;

        // Ziehe die Eurozahlen (2 aus 10)
        $euroNumbers = $this->drawUniqueEuroNumbersFromProbabilities($probabilities, 2);
        $lottoNumbers['euro_numbers'] = $euroNumbers;

        return $lottoNumbers;
    }

    private function drawUniqueMainNumbersFromProbabilities(array $probabilities, int $count): array
    {
        $numbers = [];
        $probabilitySum = array_sum($probabilities);

        // Sortiere die Zahlen nach ihrer Wahrscheinlichkeit
        arsort($probabilities);

        while (count($numbers) < $count) {
            $randomNumber = $this->getRandomNumberBasedOnProbabilities($probabilities, $probabilitySum);
            // Überprüfen, ob die Zufallszahl nicht bereits in den gezogenen Zahlen ist und im Bereich von 1 bis 50 liegt
            if (!in_array($randomNumber, $numbers) && $randomNumber >= 1 && $randomNumber <= 50) {
                $numbers[] = $randomNumber;
            }
        }

        // Sortiere die Zahlen und gebe sie zurück
        sort($numbers);
        return $numbers;
    }

    private function drawUniqueEuroNumbersFromProbabilities(array $probabilities, int $count): array
    {
        $numbers = [];
        $probabilitySum = array_sum($probabilities);

        // Sortiere die Zahlen nach ihrer Wahrscheinlichkeit
        arsort($probabilities);

        while (count($numbers) < $count) {
            $randomNumber = $this->getRandomNumberBasedOnProbabilities($probabilities, $probabilitySum);
            // Überprüfen, ob die Zufallszahl nicht bereits in den gezogenen Zahlen ist und im Bereich von 1 bis 12 liegt
            if (!in_array($randomNumber, $numbers) && $randomNumber >= 1 && $randomNumber <= 12) {
                $numbers[] = $randomNumber;
            }
        }

        // Sortiere die Zahlen und gebe sie zurück
        sort($numbers);
        return $numbers;
    }


    private function drawUniqueNumbersFromProbabilities(array $probabilities, int $count): array
    {
        $numbers = [];
        $probabilitySum = array_sum($probabilities);

        // Sortiere die Zahlen nach ihrer Wahrscheinlichkeit
        arsort($probabilities);

        while (count($numbers) < $count) {
            $randomNumber = $this->getRandomNumberBasedOnProbabilities($probabilities, $probabilitySum);
            // Überprüfen, ob die Zufallszahl nicht bereits in den gezogenen Zahlen ist und im Bereich von 1 bis 12 liegt
            if (!in_array($randomNumber, $numbers) && $randomNumber >= 1 && $randomNumber <= 12) {
                $numbers[] = $randomNumber;
            }
        }

        // Sortiere die Zahlen und gebe sie zurück
        sort($numbers);
        return $numbers;
    }

    private function getRandomNumberBasedOnProbabilities(array $probabilities, float $probabilitySum): int
    {
        // Debugging: Überprüfen, ob die Wahrscheinlichkeiten leer sind
        if (empty($probabilities)) {
            throw new \Exception('Probabilities are empty.');
        }

        // Debugging: Überprüfen, ob die Wahrscheinlichkeitssumme größer als Null ist
        if ($probabilitySum <= 0) {
            throw new \Exception('Probability sum is not greater than zero.');
        }

        $randomFloat = mt_rand() / mt_getrandmax(); // Generiere eine Zufallszahl zwischen 0 und 1
        $randomProbability = $randomFloat * $probabilitySum;
        $currentProbability = 0;

        foreach ($probabilities as $number => $probability) {
            $currentProbability += $probability;
            if ($currentProbability >= $randomProbability) {
                return $number;
            }
        }

        // Wenn wir an diesen Punkt gelangen, ist etwas schief gelaufen
        throw new \Exception('Failed to select a random number based on probabilities.');
    }
}
