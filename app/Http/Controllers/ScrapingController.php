<?php

namespace App\Http\Controllers;

use App\Services\QuoteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ScrapingController extends Controller
{

    public function __construct(private QuoteService $quoteService) {}

    public function scrapeQuotes(): JsonResponse
    {
        $quotes = $this->quoteService->fetchQuotes();

        $jsonData = json_encode($quotes, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

        Storage::disk('local')->put('quotes.json', $jsonData);

        return response()->json($quotes);
    }
}
