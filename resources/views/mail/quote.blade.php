<x-mail::message>
# 🌟 Inspiración de One Piece 🌟
<img src="{{ asset('images/one-piece-logo.jpg') }}" alt="One Piece Logo" style="width: 200px; height: auto; display: block; margin: 0 auto;">

---

@foreach (explode("\n", $quote['quote']) as $line)
> {{ $line }}
@endforeach

**- {{ $quote['author'] }}**

---

<x-mail::button :url="route('home')">
Descubre más frases
</x-mail::button>

---

Gracias,<br>
**Jean Carlos Trejo**
</x-mail::message>