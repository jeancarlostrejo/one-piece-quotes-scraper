<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class QuoteService
{
    // Verificar si el archivo de citas existe, metodo estatico
    public static function quotesFileExists(): bool
    {
        return Storage::disk('quotes')->exists('quotes.json');
    }

    // Obtener las citas del archivo, metodo estatico
    public static function getQuotes(): Collection
    {
        $quotes = self::cachedQuotes();

        return collect(json_decode($quotes, true));
    }

    // Obtener una cita aleatoria
    public static function getRandomQuote(): ?array
    {
        $quotes = self::getQuotes();

        if ($quotes->isEmpty()) {
            return null;
        }

        return $quotes->random();
    }

    // Obtener de la cache
    public static function cachedQuotes(): Collection
    {
        return Cache::remember('quotes_data', now()->addDay(), function () {
            $jsonData = Storage::disk('quotes')->get('quotes.json');

            return collect(json_decode($jsonData, true));
        });
    }

    // Formatear una cita para la consola
    public static function formatQuoteForConsole($quote): string
    {
        return sprintf(
            "\n  <options=bold>“ %s ”</>\n  <fg=gray>— %s</>\n",
            trim($quote['quote']),
            trim($quote['author'])
        );
    }
}
