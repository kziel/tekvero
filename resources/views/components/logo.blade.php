@props(['class' => ''])

<a href="#top" {{ $attributes->merge(['class' => "inline-flex items-center gap-3 text-slate-50 {$class}"]) }}>
    <svg viewBox="0 0 44 44" class="h-11 w-11" aria-hidden="true">
        <rect x="0" y="0" width="44" height="44" rx="11" fill="#10B981" />
        <path d="M8 12H36V18H24V34H20V18H8V12Z" fill="#0F172A" />
        <path d="M10 22L22 34L34 22" stroke="#0F172A" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" fill="none" />
    </svg>
    <span class="font-semibold tracking-tight text-xl">Tekvero</span>
</a>
