<?php

use App\Http\Controllers\ScrapingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/scraping', [ScrapingController::class, 'scrapeQuotes'])->name('scraping.scrapeQuotes');
