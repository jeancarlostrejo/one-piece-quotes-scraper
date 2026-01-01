<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="bg-gradient-to-r from-blue-100 via-blue-200 to-blue-300 text-gray-800 flex items-center justify-center min-h-screen">

    {{ $slot }}

    <footer class="text-center mt-4 mb-4 pb-2">
        <p class="text-gray-500 text-sm">Made with ❤️ by <a href="https://github.com/jeancarlostrejo" class="font-bold"
                target="_blank" rel="noopener noreferrer">
                Jean Carlos
            </a></p>
        <img src="{{ asset('images/luffy-draw-flag.png') }}" alt="One Piece Flag" class="mx-auto w-24 mt-4">
        <p class="text-base">&copy; {{ now()->format('Y') }}</p>
    </footer>
    </div>
</body>

</html>
