<?php

namespace App\Http\Controllers;

use App\Exceptions\PageUnavailableException;
use App\Jobs\ScrapeQuotesJob;
use App\Services\ScrapingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ScrapingController extends Controller
{
    public function __construct(private ScrapingService $scrapingService) {}

    public function scrapeQuotes(): JsonResponse
    {
        try {
            ScrapeQuotesJob::dispatch($this->scrapingService);

            return response()->json([
                'message' => 'Scraping quotes in progress. You can check the quotes later.',
            ], 202);
        } catch (\Exception $e) {
            if ($e instanceof PageUnavailableException) {
                return $e->render();
            }

            return response()->json(['error' => 'An unexpected error occurred while scraping quotes.'], 500);
        }
    }
}
