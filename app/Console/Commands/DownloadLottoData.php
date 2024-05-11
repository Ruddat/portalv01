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
        $contents = file_get_contents($url);

        if ($contents === false) {
            $this->error('Failed to download the lotto data.');
            return;
        }

        $path = Storage::disk('local')->path('lotto_history.csv');
        $result = file_put_contents($path, $contents);

        if ($result === false) {
            $this->error('Failed to save the lotto data.');
            return;
        }

        $this->info('The lotto data has been downloaded and saved successfully.');
    }
}
