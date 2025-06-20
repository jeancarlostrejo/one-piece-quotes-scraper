<?php

namespace App\Http\Controllers;

use App\Services\QuoteService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class QuoteController extends Controller
{
    public function index(): JsonResponse
    {
        if(!QuoteService::quotesFileExists()) {
            return response()->json([
                'message' => 'Quotes not found. Please scrape quotes first.',
            ], 404);
        }

        $quotes = QuoteService::getQuotes();

        if ($quotes->isEmpty()) {
            return response()->json([
                'message' => 'No quotes available.',
                'data' => []
            ], 200);
        }

        return response()->json($quotes);
    }

    public function randomQuote(Request $request): JsonResponse | View
    {
        if (!QuoteService::quotesFileExists()) {
            return response()->json([
                'message' => 'Quotes not found. Please scrape quotes first.',
            ], 404);
        }

        $quote = QuoteService::getRandomQuote();

        if (!$quote) {
            return response()->json([
                'message' => 'No quotes available.',
            ], 200);
        }

        return view('quotes.random', compact('quote'));
    }

    public function apiRandomQuote()
    {
        if (!QuoteService::quotesFileExists()) {
            return response()->json([
                'message' => 'Quotes not found. Please scrape quotes first.',
            ], 404);
        }

        $quote = QuoteService::getRandomQuote();

        if (!$quote) {
            return response()->json([
                'message' => 'No quotes available.',
            ], 200);
        }

        return response()->json($quote);
    }
}
