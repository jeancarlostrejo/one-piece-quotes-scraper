<?php

namespace App\Console\Commands;

use App\Services\QuoteService;
use GuzzleHttp\Psr7\Query;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class QuoteRandom extends Command
{
    protected $signature = 'quote:random';

    protected $description = 'Get a random quote of One Piece Universe';

    public function handle()
    {
        if(!QuoteService::quotesFileExists()) {
            $this->fail('Quotes file not found.');
        }

        $quote = QuoteService::getRandomQuote();

        if (!$quote) {
            $this->fail('No quotes available.');
        }

        $this->comment(QuoteService::formatQuoteForConsole($quote));
    }
}
