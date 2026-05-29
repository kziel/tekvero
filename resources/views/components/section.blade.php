@props([
    'id' => null,
    'eyebrow' => null,
    'title' => null,
    'intro' => null,
    'class' => '',
])

<section @if($id) id="{{ $id }}" @endif {{ $attributes->merge(['class' => "tv-section {$class}"]) }}>
    <div class="tv-container">
        @if($eyebrow || $title || $intro)
            <header class="space-y-4">
                @if($eyebrow)
                    <p class="tv-eyebrow">{{ $eyebrow }}</p>
                @endif
                @if($title)
                    <h2 class="tv-h2">{{ $title }}</h2>
                @endif
                @if($intro)
                    <p class="tv-intro max-w-2xl">{{ $intro }}</p>
                @endif
            </header>
        @endif

        <div class="mt-10">
            {{ $slot }}
        </div>
    </div>
</section>
