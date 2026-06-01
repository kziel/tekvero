<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CookieConsentController extends Controller
{
    public function update(Request $request, string $locale): RedirectResponse
    {
        $consent = (string) $request->validate([
            'consent' => ['required', 'in:accepted,rejected'],
        ])['consent'];

        Cookie::queue(Cookie::forever('tekvero_cookie_consent', $consent));

        if ($consent === 'rejected') {
            Cookie::queue(Cookie::forget('tekvero_locale'));
        }

        return redirect()->route('landing', ['locale' => $locale]);
    }
}
