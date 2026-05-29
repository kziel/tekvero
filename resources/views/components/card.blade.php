@props([
    'title' => '',
    'body' => '',
    'class' => '',
])

<article {{ $attributes->merge(['class' => "tv-card {$class}"]) }}>
    <h3 class="text-xl font-semibold tracking-tight text-slate-50">{{ $title }}</h3>
    <p class="mt-4 text-slate-300 leading-relaxed">{{ $body }}</p>
    {{ $slot }}
</article>
