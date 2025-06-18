<?php

namespace App\Services;

use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;

class QuoteService
{
    public function fetchQuotes(): array
    {
        $quotes = [];

        $browser = new HttpBrowser(HttpClient::create());
        $crawler = $browser->request('GET', config('app.url_scraping'));

        // get all count of pages in pagination
        $pagination_html_element = $crawler->filter('.pagination li');
        $pages = (int) $pagination_html_element->getNode(count($pagination_html_element) - 2)->textContent;

        for ($i = 1; $i <= $pages; $i++) {
            // request each page
            $crawler = $browser->request('GET', config('app.url_scraping') . '?page=' . $i);

            // filter all quotes from the page
            $quotes_html_elements = $crawler->filter('.quote-container');

            // get each quote and author for each page
            foreach ($quotes_html_elements as $element) {
                $quoteCrawler = new Crawler($element);

                $raw_quote = $quoteCrawler->filter('a')->innerText();
                $quote = (str_replace("\\", '', $raw_quote));

                $author_html_element = $quoteCrawler->filter('.quote-author');
                $author = $author_html_element->count() > 0 ? $author_html_element->text() : 'Unknown';

                $quotes[] = [
                    'quote' => $quote,
                    'author' => $author,
                ];
            }
        }

        return $quotes;
    }
}
