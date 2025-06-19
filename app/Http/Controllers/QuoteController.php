<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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

        $jsonData = Storage::disk('quotes')->get('quotes.json');
        $quotes = json_decode($jsonData, true);

        return response()->json($quotes);
    }

    public function randomQuote(Request $request): JsonResponse | View
    {
        if (!Storage::disk('quotes')->exists('quotes.json')) {
            return response()->json([
                'message' => 'Quotes not found. Please scrape quotes first.',
            ], 404);
        }

        $jsonData = Storage::disk('quotes')->get('quotes.json');
        $quotes = collect(json_decode($jsonData, true));

        $quote = $quotes->random();

        if($request->wantsJson()) {
            return response()->json($quote);
        }

        return view('quotes.random', compact('quote'));
    }
}
