<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class QuoteController extends Controller
{
    public function index(): JsonResponse
    {
        if (!Storage::disk('quotes')->exists('quotes.json')) {
            return response()->json([
                'message' => 'Quotes not found. Please scrape quotes first.',
            ], 404);
        }

        $quotes = Cache::remember('quotes_data', now()->addDay(), function() {
            $jsonData = Storage::disk('quotes')->get('quotes.json');

            return json_decode($jsonData, true);
        });

        return response()->json($quotes);
    }

    public function randomQuote(Request $request): JsonResponse | View
    {
        if (!Storage::disk('quotes')->exists('quotes.json')) {
            return response()->json([
                'message' => 'Quotes not found. Please scrape quotes first.',
            ], 404);
        }

        $quotes = Cache::remember('quotes_data', now()->addDay(), function() {
            $jsonData = Storage::disk('quotes')->get('quotes.json');

            return collect(json_decode($jsonData, true));
        });

        $quote = $quotes->random();

        return view('quotes.random', compact('quote'));
    }

    public function apiRandomQuote()
    {
        if (!Storage::disk('quotes')->exists('quotes.json')) {
            return response()->json([
                'message' => 'Quotes not found. Please scrape quotes first.',
            ], 404);
        }

        $quotes = Cache::remember('quotes_data', now()->addDay(), function() {
            $jsonData = Storage::disk('quotes')->get('quotes.json');

            return json_decode($jsonData, true);
        });

        $quote = $quotes->random();

        return response()->json($quote);
    }
}
