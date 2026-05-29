<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/sitemap.xml', function () {
    $lastmod = now()->toAtomString();

    $entries = [
        [
            'url' => route('landing', ['locale' => 'pl']),
            'changefreq' => 'weekly',
            'priority' => '1.0',
        ],
        [
            'url' => route('landing', ['locale' => 'en']),
            'changefreq' => 'weekly',
            'priority' => '0.9',
        ],
    ];

    $entriesXml = collect($entries)
        ->map(static fn (array $entry): string => '<url>'
            .'<loc>'.e((string) $entry['url']).'</loc>'
            .'<lastmod>'.$lastmod.'</lastmod>'
            .'<changefreq>'.e((string) $entry['changefreq']).'</changefreq>'
            .'<priority>'.e((string) $entry['priority']).'</priority>'
            .'</url>')
        ->implode('');

    $xml = '<?xml version="1.0" encoding="UTF-8"?>'
        .'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'
        .$entriesXml
        .'</urlset>';

    return response($xml, 200, [
        'Content-Type' => 'application/xml; charset=UTF-8',
    ]);
})->name('sitemap');

Route::get('/', function () {
    $supportedLocales = ['pl', 'en'];

    $localeFromCookie = request()->cookie('tekvero_locale');
    if (is_string($localeFromCookie) && in_array($localeFromCookie, $supportedLocales, true)) {
        return redirect()->route('landing', ['locale' => $localeFromCookie]);
    }

    $preferredLocale = request()->getPreferredLanguage($supportedLocales);
    $locale = is_string($preferredLocale) ? $preferredLocale : 'pl';

    return redirect()->route('landing', ['locale' => $locale]);
});

Route::prefix('{locale}')
    ->where(['locale' => 'pl|en'])
    ->middleware('setLocale')
    ->group(function (): void {
        Route::get('/', function () {
            return view('welcome');
        })->name('landing');

        Route::post('/contact', [ContactController::class, 'store'])
            ->middleware('throttle:contact')
            ->name('contact.submit');
    });
