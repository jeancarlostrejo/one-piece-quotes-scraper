<?php

namespace App\Http\Controllers;

use App\Exceptions\PageUnavailableException;
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
            $quotes = $this->scrapingService->fetchQuotes();

            $jsonData = json_encode($quotes, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

            Cache::flush();

            Storage::disk('quotes')->put('quotes.json', $jsonData);

            return response()->json(['message' => 'Quotes scraped successfully.',], 200);
        } catch (\Exception $e) {
            if ($e instanceof PageUnavailableException) {
                return $e->render();
            }

            return response()->json(['error' => 'An unexpected error occurred while scraping quotes.'], 500);
        }
    }
}
