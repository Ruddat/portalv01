<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\SysRequestLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Jaybizzle\CrawlerDetect\CrawlerDetect;

class LogSideRequest extends FormRequest
{
    protected $crawlerDetect;

    public function __construct(CrawlerDetect $crawlerDetect)
    {
        $this->crawlerDetect = $crawlerDetect;
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [];
    }

    public function processRequest()
    {
        if ($this->crawlerDetect->isCrawler()) {
            $this->logRequest(true);
            // Hier können Sie je nach Bedarf unterschiedliche Aktionen für Bots ausführen
        } else {
            $this->logRequest();
            // Hier können Sie die Logik für nicht-Bot-Anfragen implementieren
        }
    }

    protected function logRequest($isBot = false)
    {
        $referrer = $this->header('referer') ?? $this->header('referrer') ?? '';

        $requestData = [
            'ip_address' => $this->ip(),
            'url' => $this->fullUrl(),
            'method' => $this->method(),
            'user_agent' => $this->header('User-Agent'),
            'referrer' => $referrer, // Referrer
            'timestamp' => Carbon::now(),
            'is_bot' => $isBot,
        ];

        SysRequestLog::create($requestData);
    }
}
