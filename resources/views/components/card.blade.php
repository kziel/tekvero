@props([
    'title' => '',
    'body' => '',
    'class' => '',
])

<article {{ $attributes->merge(['class' => "tv-card {$class}"]) }}>
    <h3 class="tv-card-title text-xl font-semibold tracking-tight">{{ $title }}</h3>
    <p class="tv-card-copy mt-4 leading-relaxed">{{ $body }}</p>
    {{ $slot }}
</article>
