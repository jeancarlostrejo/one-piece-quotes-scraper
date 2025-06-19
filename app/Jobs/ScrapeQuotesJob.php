<?php

namespace App\Jobs;

use App\Services\ScrapingService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class ScrapeQuotesJob implements ShouldQueue
{
    use Queueable;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public int $tries = 3;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public int $timeout = 120;

    /**
     * Create a new job instance.
     */
    public function __construct(private ScrapingService $scrapingService)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $quotes = $this->scrapingService->fetchQuotes();

        $jsonData = json_encode($quotes, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

        Cache::flush();

        Storage::disk('quotes')->put('quotes.json', $jsonData);
    }
}
