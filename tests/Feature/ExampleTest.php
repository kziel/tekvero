<?php

test('root redirects to polish landing page', function () {
    $this->withHeader('Accept-Language', 'pl-PL,pl;q=0.9,en;q=0.8')
        ->get('/')
        ->assertRedirect('/pl');
});

test('root redirect respects browser preferred language when no cookie is set', function () {
    $this->withHeader('Accept-Language', 'en-US,en;q=0.9,pl;q=0.8')
        ->get('/')
        ->assertRedirect('/en');
});

test('root redirect prefers locale cookie over browser language', function () {
    $this->withCookie('tekvero_locale', 'pl')
        ->withCookie('tekvero_cookie_consent', 'accepted')
        ->withHeader('Accept-Language', 'en-US,en;q=0.9')
        ->get('/')
        ->assertRedirect('/pl');
});

test('root redirect ignores locale cookie when consent is rejected', function () {
    $this->withCookie('tekvero_locale', 'pl')
        ->withCookie('tekvero_cookie_consent', 'rejected')
        ->withHeader('Accept-Language', 'en-US,en;q=0.9')
        ->get('/')
        ->assertRedirect('/en');
});

test('polish landing page loads with localized content', function () {
    $this->get('/pl')
        ->assertStatus(200)
        ->assertSee('data-theme="dark"', false)
        ->assertSee('data-theme-toggle', false)
        ->assertSee('data-consent-banner', false)
        ->assertSee('TekVero | Inzynierska produkcja stron WWW', false)
        ->assertSee('Dlaczego TekVero')
        ->assertSee('hreflang="pl"', false)
        ->assertSee('hreflang="en"', false);
});

test('english landing page loads with localized content', function () {
    $this->get('/en')
        ->assertStatus(200)
        ->assertSee('data-theme-toggle', false)
        ->assertSee('TekVero | Engineering-grade web production', false)
        ->assertSee('Why TekVero')
        ->assertSee('name="twitter:card"', false);
});

test('accepting cookie preferences sets consent cookie and redirects to localized landing', function () {
    $this->post('/pl/cookie-consent', [
        'consent' => 'accepted',
    ])
        ->assertRedirect('/pl')
        ->assertCookie('tekvero_cookie_consent', 'accepted');
});

test('rejecting cookie preferences sets rejected consent and clears locale cookie', function () {
    $this->post('/en/cookie-consent', [
        'consent' => 'rejected',
    ])
        ->assertRedirect('/en')
        ->assertCookie('tekvero_cookie_consent', 'rejected')
        ->assertCookieExpired('tekvero_locale');
});

test('cookie policy page is available in localized route', function () {
    $this->get('/pl/cookie-policy')
        ->assertStatus(200)
        ->assertSee('Polityka Cookies');
});

test('sitemap contains polish and english locale urls', function () {
    $this->get('/sitemap.xml')
        ->assertStatus(200)
        ->assertHeader('Content-Type', 'application/xml; charset=UTF-8')
        ->assertSee('/pl', false)
        ->assertSee('/en', false)
        ->assertSee('<lastmod>', false)
        ->assertSee('<priority>1.0</priority>', false)
        ->assertSee('<urlset', false);
});
