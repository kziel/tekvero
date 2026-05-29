@php
    $locale = app()->getLocale();
    $switchLocale = $locale === 'pl' ? 'en' : 'pl';

    $canonicalUrl = route('landing', ['locale' => $locale]);
    $plUrl = route('landing', ['locale' => 'pl']);
    $enUrl = route('landing', ['locale' => 'en']);

    $manifestCards = trans('landing.manifest.cards');
    $serviceCards = trans('landing.services.cards');
    $heroPoints = trans('landing.hero.side_points');
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', $locale) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ __('landing.meta.title') }}</title>
        <meta name="description" content="{{ __('landing.meta.description') }}" />
        <link rel="canonical" href="{{ $canonicalUrl }}" />
        <meta name="robots" content="index,follow" />

        <link rel="alternate" href="{{ $plUrl }}" hreflang="pl" />
        <link rel="alternate" href="{{ $enUrl }}" hreflang="en" />
        <link rel="alternate" href="{{ $plUrl }}" hreflang="x-default" />

        <meta property="og:type" content="website" />
        <meta property="og:site_name" content="TekVero" />
        <meta property="og:title" content="{{ __('landing.meta.title') }}" />
        <meta property="og:description" content="{{ __('landing.meta.og_description') }}" />
        <meta property="og:url" content="{{ $canonicalUrl }}" />

        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" content="{{ __('landing.meta.title') }}" />
        <meta name="twitter:description" content="{{ __('landing.meta.twitter_description') }}" />

        <script type="application/ld+json">
            {!! json_encode([
                '@context' => 'https://schema.org',
                '@type' => 'Organization',
                'name' => 'TekVero',
                'url' => $canonicalUrl,
                'description' => __('landing.schema.description'),
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
        </script>

        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body id="top" class="antialiased">
        <a href="#main-content" class="tv-skip-link">{{ __('landing.a11y.skip_to_content') }}</a>

        <header class="tv-container pt-8 lg:pt-10">
            <div class="tv-panel flex items-center justify-between rounded-2xl px-5 py-4 lg:px-7">
                <x-logo />
                <div class="flex items-center gap-3">
                    <a
                        href="{{ route('landing', ['locale' => $switchLocale]) }}"
                        data-language-switch
                        class="rounded-full border border-slate-500 px-4 py-2 text-xs font-semibold text-slate-100 hover:border-emerald-500 hover:text-emerald-300"
                        aria-label="{{ __('landing.language.switch_label') }}"
                    >
                        {{ __('landing.language.switch_to') }}
                    </a>

                    <nav class="hidden items-center gap-8 text-sm text-slate-300 lg:flex" aria-label="{{ __('landing.a11y.main_nav') }}">
                        <a href="#manifest" class="transition-colors hover:text-emerald-300">{{ __('landing.nav.why') }}</a>
                        <a href="#services" class="transition-colors hover:text-emerald-300">{{ __('landing.nav.services') }}</a>
                        <a href="#stack" class="transition-colors hover:text-emerald-300">{{ __('landing.nav.stack') }}</a>
                        <a href="#contact" class="transition-colors hover:text-emerald-300">{{ __('landing.nav.contact') }}</a>
                    </nav>
                </div>
            </div>

            <nav class="mt-4 flex flex-wrap gap-2 lg:hidden" aria-label="{{ __('landing.a11y.mobile_nav') }}">
                <a href="#manifest" class="rounded-full border border-slate-600 px-4 py-2 text-xs font-medium text-slate-200">{{ __('landing.nav.why') }}</a>
                <a href="#services" class="rounded-full border border-slate-600 px-4 py-2 text-xs font-medium text-slate-200">{{ __('landing.nav.services') }}</a>
                <a href="#stack" class="rounded-full border border-slate-600 px-4 py-2 text-xs font-medium text-slate-200">{{ __('landing.nav.stack') }}</a>
                <a href="#contact" class="rounded-full border border-emerald-500 px-4 py-2 text-xs font-medium text-emerald-300">{{ __('landing.nav.contact') }}</a>
            </nav>
        </header>

        <main id="main-content" class="pb-20 lg:pb-28">
            <section class="tv-section pt-12 lg:pt-20">
                <div class="tv-container">
                    <div class="tv-panel grid gap-10 rounded-3xl px-6 py-12 md:px-10 lg:grid-cols-[1.2fr_0.8fr] lg:px-12 lg:py-14">
                        <div class="space-y-8">
                            <p class="tv-eyebrow">{{ __('landing.hero.eyebrow') }}</p>
                            <h1 class="tv-h1">{{ __('landing.hero.title') }}</h1>
                            <p class="tv-intro max-w-2xl">{{ __('landing.hero.intro') }}</p>
                            <div class="flex flex-wrap gap-4">
                                <x-cta-button href="#contact">{{ __('landing.hero.cta_primary') }}</x-cta-button>
                                <x-cta-button href="#manifest" variant="secondary">{{ __('landing.hero.cta_secondary') }}</x-cta-button>
                            </div>
                        </div>

                        <aside class="tv-card space-y-6">
                            <p class="text-sm uppercase tracking-[0.22em] text-slate-400">{{ __('landing.hero.side_title') }}</p>
                            <ul class="space-y-3 text-slate-200">
                                @foreach ($heroPoints as $point)
                                    <li class="flex items-start gap-3">
                                        <span class="mt-2 h-2 w-2 rounded-full bg-emerald-400"></span>
                                        <span>{{ $point }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </aside>
                    </div>
                </div>
            </section>

            <x-section
                id="manifest"
                :eyebrow="__('landing.manifest.eyebrow')"
                :title="__('landing.manifest.title')"
                :intro="__('landing.manifest.intro')"
            >
                <div class="grid gap-6 md:grid-cols-3">
                    @foreach ($manifestCards as $card)
                        <x-card :title="$card['title']" :body="$card['body']" />
                    @endforeach
                </div>
            </x-section>

            <x-section
                id="services"
                :eyebrow="__('landing.services.eyebrow')"
                :title="__('landing.services.title')"
                :intro="__('landing.services.intro')"
            >
                <div class="grid gap-6 md:grid-cols-3">
                    @foreach ($serviceCards as $card)
                        <x-card :title="$card['title']" :body="$card['body']" />
                    @endforeach
                </div>
            </x-section>

            <x-section
                id="stack"
                :eyebrow="__('landing.stack.eyebrow')"
                :title="__('landing.stack.title')"
                :intro="__('landing.stack.intro')"
            >
                <div class="tv-panel rounded-2xl p-6 lg:p-8">
                    <div class="flex flex-wrap gap-3 text-sm font-medium text-slate-100">
                        <span class="rounded-full border border-slate-600 px-4 py-2">Tailwind CSS 4</span>
                        <span class="rounded-full border border-slate-600 px-4 py-2">Vanilla JavaScript</span>
                        <span class="rounded-full border border-slate-600 px-4 py-2">Laravel</span>
                        <span class="rounded-full border border-slate-600 px-4 py-2">MySQL</span>
                        <span class="rounded-full border border-slate-600 px-4 py-2">Redis</span>
                    </div>
                </div>
            </x-section>

            <x-section
                id="contact"
                :eyebrow="__('landing.contact.eyebrow')"
                :title="__('landing.contact.title')"
                :intro="__('landing.contact.intro')"
            >
                <div class="tv-panel rounded-3xl p-6 lg:p-10">
                    @if (session('contact_success'))
                        <div class="mb-6 rounded-xl border border-emerald-500/40 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-200" role="status" aria-live="polite">
                            {{ session('contact_success') }}
                        </div>
                    @endif

                    @error('contact')
                        <div class="mb-6 rounded-xl border border-rose-500/40 bg-rose-500/10 px-4 py-3 text-sm text-rose-200" role="alert">
                            {{ $message }}
                        </div>
                    @enderror

                    <form class="grid gap-6 md:grid-cols-2" aria-describedby="contact-status" method="POST" action="{{ route('contact.submit', ['locale' => $locale]) }}" novalidate>
                        @csrf
                        <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off" aria-hidden="true" />

                        <div class="space-y-2">
                            <label class="text-sm text-slate-300" for="name">{{ __('landing.contact.labels.name') }}</label>
                            <input id="name" name="name" type="text" value="{{ old('name') }}" class="w-full rounded-xl border border-slate-600 bg-slate-900/60 px-4 py-3 text-slate-100 outline-none ring-0 transition focus:border-emerald-400" placeholder="{{ __('landing.contact.placeholders.name') }}" autocomplete="organization" required />
                            @error('name')
                                <p class="text-sm text-rose-300" role="alert">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm text-slate-300" for="scope">{{ __('landing.contact.labels.scope') }}</label>
                            <select id="scope" name="scope" class="w-full rounded-xl border border-slate-600 bg-slate-900/60 px-4 py-3 text-slate-100 outline-none ring-0 transition focus:border-emerald-400" required>
                                <option value="new-landing-page" @selected(old('scope') === 'new-landing-page')>{{ __('contact.scopes.new-landing-page') }}</option>
                                <option value="website-redesign" @selected(old('scope') === 'website-redesign')>{{ __('contact.scopes.website-redesign') }}</option>
                                <option value="other" @selected(old('scope') === 'other')>{{ __('contact.scopes.other') }}</option>
                            </select>
                            @error('scope')
                                <p class="text-sm text-rose-300" role="alert">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm text-slate-300" for="budget">{{ __('landing.contact.labels.budget') }}</label>
                            <input id="budget" name="budget" type="text" value="{{ old('budget') }}" class="w-full rounded-xl border border-slate-600 bg-slate-900/60 px-4 py-3 text-slate-100 outline-none ring-0 transition focus:border-emerald-400" placeholder="{{ __('landing.contact.placeholders.budget') }}" autocomplete="off" required />
                            @error('budget')
                                <p class="text-sm text-rose-300" role="alert">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 md:col-span-2">
                            <label class="text-sm text-slate-300" for="message">{{ __('landing.contact.labels.message') }}</label>
                            <textarea id="message" name="message" rows="5" class="w-full rounded-xl border border-slate-600 bg-slate-900/60 px-4 py-3 text-slate-100 outline-none ring-0 transition focus:border-emerald-400" placeholder="{{ __('landing.contact.placeholders.message') }}" autocomplete="off" required>{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-sm text-rose-300" role="alert">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2 flex flex-wrap items-center gap-4">
                            <button type="submit" class="inline-flex w-full items-center justify-center rounded-full bg-emerald-500 px-6 py-3 text-sm font-semibold text-slate-950 hover:bg-emerald-400 transition-colors sm:w-auto">{{ __('landing.contact.submit') }}</button>
                            <p id="contact-status" class="text-sm text-slate-400">{{ __('landing.contact.status') }}</p>
                        </div>
                    </form>
                </div>
            </x-section>
        </main>

        <script>
            document.querySelectorAll('[data-language-switch]').forEach((link) => {
                link.addEventListener('click', (event) => {
                    if (!window.location.hash) {
                        return;
                    }

                    event.preventDefault();
                    window.location.href = link.getAttribute('href') + window.location.hash;
                });
            });
        </script>
    </body>
</html>
