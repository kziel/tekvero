<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tekvero | Engineering-grade web production</title>
        <meta name="description" content="Tekvero builds engineering-grade landing pages and business websites with predictable delivery, validated code, and measurable conversion outcomes." />
        <link rel="canonical" href="{{ url('/') }}" />
        <meta name="robots" content="index,follow" />

        <meta property="og:type" content="website" />
        <meta property="og:site_name" content="Tekvero" />
        <meta property="og:title" content="Tekvero | Engineering-grade web production" />
        <meta property="og:description" content="Single-page and business website production with predictable delivery and technical reliability." />
        <meta property="og:url" content="{{ url('/') }}" />

        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" content="Tekvero | Engineering-grade web production" />
        <meta name="twitter:description" content="Landing page and website production focused on delivery speed, quality, and conversion." />

        <script type="application/ld+json">
            {!! json_encode([
                '@context' => 'https://schema.org',
                '@type' => 'Organization',
                'name' => 'Tekvero',
                'url' => url('/'),
                'description' => 'Engineering-grade web production for landing pages and business websites.',
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
        </script>

        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body id="top" class="antialiased">
        <a href="#main-content" class="tv-skip-link">Skip to main content</a>

        <header class="tv-container pt-8 lg:pt-10">
            <div class="tv-panel flex items-center justify-between rounded-2xl px-5 py-4 lg:px-7">
                <x-logo />
                <nav class="hidden items-center gap-8 text-sm text-slate-300 lg:flex" aria-label="Main navigation">
                    <a href="#manifest" class="transition-colors hover:text-emerald-300">Why Tekvero</a>
                    <a href="#services" class="transition-colors hover:text-emerald-300">Services</a>
                    <a href="#stack" class="transition-colors hover:text-emerald-300">Stack</a>
                    <a href="#contact" class="transition-colors hover:text-emerald-300">Contact</a>
                </nav>
            </div>

            <nav class="mt-4 flex flex-wrap gap-2 lg:hidden" aria-label="Mobile navigation">
                <a href="#manifest" class="rounded-full border border-slate-600 px-4 py-2 text-xs font-medium text-slate-200">Why Tekvero</a>
                <a href="#services" class="rounded-full border border-slate-600 px-4 py-2 text-xs font-medium text-slate-200">Services</a>
                <a href="#stack" class="rounded-full border border-slate-600 px-4 py-2 text-xs font-medium text-slate-200">Stack</a>
                <a href="#contact" class="rounded-full border border-emerald-500 px-4 py-2 text-xs font-medium text-emerald-300">Contact</a>
            </nav>
        </header>

        <main id="main-content" class="pb-20 lg:pb-28">
            <section class="tv-section pt-12 lg:pt-20">
                <div class="tv-container">
                    <div class="tv-panel grid gap-10 rounded-3xl px-6 py-12 md:px-10 lg:grid-cols-[1.2fr_0.8fr] lg:px-12 lg:py-14">
                        <div class="space-y-8">
                            <p class="tv-eyebrow">Tekvero Digital Production</p>
                            <h1 class="tv-h1">Engineering-grade web production. Delivered on time.</h1>
                            <p class="tv-intro max-w-2xl">
                                We design and ship landing pages that perform under real business pressure. You get transparent milestones, fast feedback loops, and code that is ready for long-term maintenance.
                            </p>
                            <div class="flex flex-wrap gap-4">
                                <x-cta-button href="#contact">Get a Free Estimate</x-cta-button>
                                <x-cta-button href="#manifest" variant="secondary">See Our Approach</x-cta-button>
                            </div>
                        </div>

                        <aside class="tv-card space-y-6">
                            <p class="text-sm uppercase tracking-[0.22em] text-slate-400">Why teams choose Tekvero</p>
                            <ul class="space-y-3 text-slate-200">
                                <li class="flex items-start gap-3">
                                    <span class="mt-2 h-2 w-2 rounded-full bg-emerald-400"></span>
                                    <span>Delivery plans are explicit, time-boxed, and visible from day one.</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <span class="mt-2 h-2 w-2 rounded-full bg-emerald-400"></span>
                                    <span>Design choices are made for conversion, not decoration.</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <span class="mt-2 h-2 w-2 rounded-full bg-emerald-400"></span>
                                    <span>Every release is validated for quality, accessibility, and speed.</span>
                                </li>
                            </ul>
                        </aside>
                    </div>
                </div>
            </section>

            <x-section
                id="manifest"
                eyebrow="Why Tekvero"
                title="Execution over noise"
                intro="Our operating model is simple: fewer promises, clearer standards, better outcomes."
            >
                <div class="grid gap-6 md:grid-cols-3">
                    <x-card title="Predictable Pace" body="Weekly delivery checkpoints, clear definitions of done, and no hidden scope drift." />
                    <x-card title="Frictionless Collaboration" body="Decisions are documented fast, feedback loops stay short, and communication remains actionable." />
                    <x-card title="Validated Code" body="Performance, accessibility, and maintainability are part of the build, not post-launch cleanup." />
                </div>
            </x-section>

            <x-section
                id="services"
                eyebrow="Services Grid"
                title="Services built for measurable outcomes"
                intro="From first draft to production publish, each service is optimized for business conversion and delivery reliability."
            >
                <div class="grid gap-6 md:grid-cols-3">
                    <x-card title="Landing Page Production" body="Conversion-first pages with strong technical SEO, structured messaging, and responsive polish." />
                    <x-card title="Boutique Business Sites" body="Credible, high-trust websites for teams that need a clean and maintainable digital presence." />
                    <x-card title="Performance Optimization" body="Targeted improvements to Core Web Vitals, render path, and usability bottlenecks on existing builds." />
                </div>
            </x-section>

            <x-section
                id="stack"
                eyebrow="Tech Stack"
                title="Trusted production toolkit"
                intro="The stack is intentionally lean: fast build cycles, stable runtime behavior, and low operational overhead."
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
                eyebrow="Contact"
                title="Start your project brief"
                intro="Share scope, budget, and timeline. We respond with a practical delivery path, not a generic sales script."
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

                    <form class="grid gap-6 md:grid-cols-2" aria-describedby="contact-status" method="POST" action="{{ route('contact.submit') }}" novalidate>
                        @csrf
                        <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off" aria-hidden="true" />

                        <div class="space-y-2">
                            <label class="text-sm text-slate-300" for="name">Name / Company</label>
                            <input id="name" name="name" type="text" value="{{ old('name') }}" class="w-full rounded-xl border border-slate-600 bg-slate-900/60 px-4 py-3 text-slate-100 outline-none ring-0 transition focus:border-emerald-400" placeholder="Acme Inc." autocomplete="organization" required />
                            @error('name')
                                <p class="text-sm text-rose-300" role="alert">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm text-slate-300" for="scope">Project Scope</label>
                            <select id="scope" name="scope" class="w-full rounded-xl border border-slate-600 bg-slate-900/60 px-4 py-3 text-slate-100 outline-none ring-0 transition focus:border-emerald-400" required>
                                <option value="new-landing-page" @selected(old('scope') === 'new-landing-page')>New Landing Page</option>
                                <option value="website-redesign" @selected(old('scope') === 'website-redesign')>Website Redesign</option>
                                <option value="other" @selected(old('scope') === 'other')>Other</option>
                            </select>
                            @error('scope')
                                <p class="text-sm text-rose-300" role="alert">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm text-slate-300" for="budget">Budget Range</label>
                            <input id="budget" name="budget" type="text" value="{{ old('budget') }}" class="w-full rounded-xl border border-slate-600 bg-slate-900/60 px-4 py-3 text-slate-100 outline-none ring-0 transition focus:border-emerald-400" placeholder="10k-25k PLN" autocomplete="off" required />
                            @error('budget')
                                <p class="text-sm text-rose-300" role="alert">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="space-y-2 md:col-span-2">
                            <label class="text-sm text-slate-300" for="message">Message</label>
                            <textarea id="message" name="message" rows="5" class="w-full rounded-xl border border-slate-600 bg-slate-900/60 px-4 py-3 text-slate-100 outline-none ring-0 transition focus:border-emerald-400" placeholder="Tell us about your timeline, goals, and current constraints." autocomplete="off" required>{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-sm text-rose-300" role="alert">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="md:col-span-2 flex flex-wrap items-center gap-4">
                            <button type="submit" class="inline-flex w-full items-center justify-center rounded-full bg-emerald-500 px-6 py-3 text-sm font-semibold text-slate-950 hover:bg-emerald-400 transition-colors sm:w-auto">Send Inquiry</button>
                            <p id="contact-status" class="text-sm text-slate-400">Response target: within one business day.</p>
                        </div>
                    </form>
                </div>
            </x-section>
        </main>
    </body>
</html>
