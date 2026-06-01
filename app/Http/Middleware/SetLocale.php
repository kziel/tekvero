<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * @param  Closure(Request): Response  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = (string) $request->route('locale', config('app.locale'));
        $supportedLocales = ['pl', 'en'];

        if (! in_array($locale, $supportedLocales, true)) {
            $locale = (string) config('app.fallback_locale', 'en');
        }

        app()->setLocale($locale);

        $cookieConsent = (string) $request->cookie('tekvero_cookie_consent', '');
        if ($cookieConsent === 'accepted') {
            Cookie::queue(Cookie::forever('tekvero_locale', $locale));
        }

        return $next($request);
    }
}
