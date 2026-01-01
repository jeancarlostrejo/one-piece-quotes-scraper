<x-layout title="One Piece Quotes Scraper">
    <div
        class="max-w-4xl mx-5 bg-white rounded-lg shadow-lg border-2 border-blue-300 mt-5 mb-5 md:mt-10 md:mb-20 sm:mx-10">
        <header class="text-center mb-6 mt-4 p-2">
            <img src="{{ asset('images/one-piece-logo.jpg') }}" alt="One Piece Logo" class="mx-auto w-96 mb-4">
            <h1 class="text-4xl font-bold text-blue-800">One Piece Quotes Scraper</h1>
            <p class="text-gray-700 mt-2 p-4">Scrape One Piece quotes from Freakuotes and expose them via an API.</p>
        </header>
        <main>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 px-4">
                <div class="p-4 bg-yellow-100 rounded-lg shadow-md border border-yellow-400">
                    <h2 class="text-xl font-semibold text-yellow-700 flex items-center">
                        Scraping Endpoint
                    </h2>
                    <p class="text-gray-700 mt-2">Start scraping quotes by visiting:</p>
                    <a href="{{ route('scraping.scrapeQuotes') }}" target="_blank" class="hover:underline">
                        <code class="block bg-gray-200 p-2 rounded mt-2">GET /scraping</code>
                    </a>
                </div>
                <div class="p-4 bg-blue-100 rounded-lg shadow-md border border-blue-400">
                    <h2 class="text-xl font-semibold text-blue-700">
                        Quotes Endpoint
                    </h2>
                    <p class="text-gray-700 mt-2">Retrieve scraped quotes via API:</p>
                    <a href="{{ route('quotes.index') }}" class="hover:underline" target="_blank">
                        <code class="block bg-gray-200 p-2 rounded mt-2">GET api/quotes</code>
                    </a>
                </div>
                <div class="p-4 bg-green-100 rounded-lg shadow-md border border-green-400">
                    <h2 class="text-xl font-semibold text-green-700">
                        Random Quote Endpoint
                    </h2>
                    <p class="text-gray-700 mt-2">Get a random quote via API:</p>
                    <a href="{{ route('quotes.random') }}" class="hover:underline" target="_blank">
                        <code class="block bg-gray-200 p-2 rounded mt-2">GET api/quote/random</code>
                    </a>
                </div>
                <div class="p-4 bg-orange-100 rounded-lg shadow-md border border-orange-400">
                    <h2 class="text-xl font-semibold text-orange-700">
                        Random Quote Page
                    </h2>
                    <p class="text-gray-700 mt-2">Get a random quote by visiting:</p>
                    <a href="{{ route('quote.random') }}" class="hover:underline" target="_blank">
                        <code class="block bg-gray-200 p-2 rounded mt-2">GET /quote-random</code>
                    </a>
                </div>
            </div>
        </main>
</x-layout>
