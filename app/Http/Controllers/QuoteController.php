<?php

namespace App\Http\Controllers;

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
}
