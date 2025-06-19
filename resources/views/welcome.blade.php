<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>One Piece Quotes Scraper</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-yellow-50 text-gray-800 flex items-center justify-center min-h-screen">
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg border-1 mt-5 mb-5 md:mt-10 md:mb-20">
        <header class="text-center mb-6 pt-6">
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
                    <p class="text-gray-700 mt-2">Retrieve scraped quotes via:</p>
                    <a href="{{ route('quotes.index') }}" class="hover:underline" target="_blank">
                        <code class="block bg-gray-200 p-2 rounded mt-2">GET api/quotes</code>
                    </a>
                </div>
            </div>
        </main>
        <footer class="text-center mt-4 pb-2">
            <p class="text-gray-500 text-sm">Made with ❤️ by Jean Carlos</p>
            <img src="{{ asset('images/luffy-draw-flag.png') }}" alt="One Piece Flag" class="mx-auto w-24 mt-4">
        </footer>
    </div>
</body>

</html>
