<?php

use App\Http\Controllers\QuoteController;
use App\Http\Controllers\ScrapingController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::get('/scraping', [ScrapingController::class, 'scrapeQuotes'])->name('scraping.scrapeQuotes');
Route::get('/quotes/random', [QuoteController::class, 'randomQuote'])->name('quotes.random');
