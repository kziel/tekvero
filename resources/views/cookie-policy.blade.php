@php
    $locale = app()->getLocale();
    $switchLocale = $locale === 'pl' ? 'en' : 'pl';
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', $locale) }}" data-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ __('landing.consent.policy_title') }} | TekVero</title>
        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <main class="tv-section">
            <div class="tv-container">
                <div class="tv-panel space-y-6 rounded-3xl p-6 lg:p-10">
                    <div class="flex items-center justify-between gap-3">
                        <h1 class="tv-h2">{{ __('landing.consent.policy_title') }}</h1>
                        <a href="{{ route('landing', ['locale' => $switchLocale]) }}" class="tv-link-button rounded-full px-4 py-2 text-xs font-semibold">
                            {{ __('landing.language.switch_to') }}
                        </a>
                    </div>

                    <p class="tv-intro">{{ __('landing.consent.policy_intro') }}</p>

                    <section class="space-y-2">
                        <h2 class="tv-card-title text-xl font-semibold">{{ __('landing.consent.necessary_title') }}</h2>
                        <p class="tv-card-copy">{{ __('landing.consent.necessary_text') }}</p>
                    </section>

                    <section class="space-y-2">
                        <h2 class="tv-card-title text-xl font-semibold">{{ __('landing.consent.preferences_title') }}</h2>
                        <p class="tv-card-copy">{{ __('landing.consent.preferences_text') }}</p>
                    </section>

                    <a href="{{ route('landing', ['locale' => $locale]) }}" class="tv-link-button inline-flex rounded-full px-5 py-2 text-sm font-semibold">
                        {{ __('landing.consent.back_to_site') }}
                    </a>
                </div>
            </div>
        </main>
    </body>
</html>
