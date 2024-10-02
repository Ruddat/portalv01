<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DownloadLottoData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lotto:download';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download the latest lotto data from lotto-datenbank.de';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $url = 'https://lotto-datenbank.de/euro_jackpot.csv';

        // Initialize cURL session
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
            'Accept-Language: en-US,en;q=0.9',
            'Connection: keep-alive',
            'Upgrade-Insecure-Requests: 1',
        ]);

        // Execute cURL session and get the response
        $contents = curl_exec($ch);

        // Check for errors
        if (curl_errno($ch)) {
            $this->error('Failed to download the lotto data: ' . curl_error($ch));
            curl_close($ch);
            return;
        }

        // Close cURL session
        curl_close($ch);

        // Save the contents to a file
        $path = Storage::disk('local')->path('lotto_history.csv');
        $result = file_put_contents($path, $contents);

        if ($result === false) {
            $this->error('Failed to save the lotto data.');
            return;
        }

        $this->info('The lotto data has been downloaded and saved successfully.');
    }
}
