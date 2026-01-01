<?php

namespace App\Console\Commands;

use App\Mail\RandomQuoteOnePiece;
use App\Services\QuoteService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendQuoteRandomEmail extends Command
{
    protected $signature = 'quote:send-email';

    protected $description = 'Send a random quote via email';

    public function handle()
    {
        if (!QuoteService::quotesFileExists()) {
            $this->fail('Quotes file not found.');
        }

        $quote = QuoteService::getRandomQuote();

        if (!$quote) {
            $this->fail('No quotes available.');
        }

        Mail::to('jeancarlostrejo19@gmail.com')->queue(new RandomQuoteOnePiece($quote));
    }
}
