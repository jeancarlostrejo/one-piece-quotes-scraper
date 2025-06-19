<?php

namespace App\Services;

use App\Exceptions\PageUnavailableException;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;
use GuzzleHttp\Client;
use GuzzleHttp\Promise\Utils;
use Illuminate\Support\Facades\Http;

class ScrapingService
{
    public function fetchQuotes(): array
    {
        $response = Http::get(config('app.url_scraping'));

        if (!$response->successful()) {
            throw new PageUnavailableException();
        }

        $quotes = [];

        $client = new Client();
        $crawler = (new HttpBrowser(HttpClient::create()))->request('GET', config('app.url_scraping'));

        // get all count of pages in pagination
        $pagination_html_element = $crawler->filter('.pagination li');
        $pages = (int) $pagination_html_element->getNode(count($pagination_html_element) - 2)->textContent;

        //create an array of promises for each page
        $promises = [];

        // loop through each page and create a promise for each request
        for ($i = 1; $i <= $pages; $i++) {
            $promises[$i] = $client->getAsync(config('app.url_scraping') . '?page=' . $i);
        }

        // wait for all promises to resolve independently if any of them fail
        $responses = Utils::settle($promises)->wait();

        $i = 1;

        foreach ($responses as $response) {
            if ($response['state'] === 'fulfilled') {
                $crawler = new Crawler($response['value']->getBody()->getContents());

                // Filter the quotes from the HTML
                $quotes_html_elements = $crawler->filter('.quote-container');

                foreach ($quotes_html_elements as $element) {
                    $quoteCrawler = new Crawler($element);

                    // Extract the quote text
                    $raw_quote_html = $quoteCrawler->filter('a')->html();
                    $raw_quote = strip_tags($raw_quote_html);
                    $quote = stripslashes(str_replace('\"', '', trim($raw_quote)));

                    // Extract the author name
                    $author_html_element = $quoteCrawler->filter('.quote-author');
                    $author = $author_html_element->count() > 0 ? $author_html_element->text() : 'Unknown';

                    $quotes[] = [
                        'id' => $i,
                        'quote' => $quote,
                        'author' => $author,
                    ];
                    $i++;
                }
            }
        }

        return $quotes;
    }
}
