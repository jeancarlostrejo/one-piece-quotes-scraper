<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Random Quote - One Piece</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="bg-gradient-to-r from-blue-100 via-blue-200 to-blue-300 text-gray-800 flex items-center justify-center min-h-screen">
    <div class="max-w-lg mx-5 bg-white rounded-lg shadow-xl border-2 border-blue-300 p-8 mt-5 mb-5 md:mt-5 md:mb-5 sm:mx-10">
        <header class="text-center mb-6">
            <img src="{{ asset('images/one-piece-logo.jpg') }}" alt="One Piece Logo" class="mx-auto w-96 mb-4">
            <h1 class="text-4xl font-extrabold text-blue-600">One Piece Random Quote</h1>
            <p class="text-gray-600 mt-2">"Find inspiration from the world of pirates!"</p>
        </header>
        <main>
            <div class="text-center">
                <blockquote class="text-2xl font-bold text-blue-800 italic border-l-4 border-blue-500 pl-4">
                    "{!! nl2br(e($quote['quote'])) !!}"
                </blockquote>
                <p class="text-gray-700 mt-4 text-lg font-medium">- {{ $quote['author'] }}</p>
            </div>
            <div class="text-center mt-8">

                <a href="{{ route('quote.random') }}"
                    class="block bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-full shadow-lg transform transition duration-300 hover:scale-105 hover:cursor-pointer">
                    Next Quote
                </a>
                <a href="{{ route('home') }}"
                    class="block mt-4 bg-gray-500 text-white hover:bg-gray-600 font-bold py-2 px-4 rounded-full shadow-lg transform transition duration-300 hover:scale-105">
                    Go to Home
                </a>
            </div>
        </main>
        <footer class="text-center mt-4 mb-4 pb-2"> 
            <p class="text-gray-500 text-sm">Made with ❤️ by Jean Carlos</p>
            <img src="{{ asset('images/luffy-draw-flag.png') }}" alt="One Piece Flag" class="mx-auto w-24 mt-4">
        </footer>
    </div>
</body>

</html>
