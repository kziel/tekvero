@props(['class' => ''])

<a href="#top" {{ $attributes->merge(['class' => "tv-logo-link inline-flex items-center gap-3 {$class}"]) }}>
    <svg viewBox="0 0 44 44" class="h-11 w-11" aria-hidden="true">
<rect x="0" y="0" width="42" height="8" rx="3" fill="#10B981"/>
    <path d="M 3,16 L 21,36 L 39,16" stroke="#10B981" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
    </svg>
    <span class="font-semibold tracking-tight text-xl">TekVero</span>
</a>
