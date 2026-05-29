@props([
    'href' => '#',
    'variant' => 'primary',
])

@php
    $base = 'inline-flex items-center justify-center rounded-full px-6 py-3 text-sm font-semibold transition-colors duration-200 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-400';
    $styles = $variant === 'secondary'
        ? 'border border-slate-500 text-slate-100 hover:border-emerald-500 hover:text-emerald-300'
        : 'bg-emerald-500 text-slate-950 hover:bg-emerald-400';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => "{$base} {$styles}"]) }}>
    {{ $slot }}
</a>
