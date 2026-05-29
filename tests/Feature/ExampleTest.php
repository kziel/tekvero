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
        ->withHeader('Accept-Language', 'en-US,en;q=0.9')
        ->get('/')
        ->assertRedirect('/pl');
});

test('polish landing page loads with localized content', function () {
    $this->get('/pl')
        ->assertStatus(200)
        ->assertSee('Tekvero | Inzynierska produkcja stron WWW', false)
        ->assertSee('Dlaczego Tekvero')
        ->assertSee('hreflang="pl"', false)
        ->assertSee('hreflang="en"', false);
});

test('english landing page loads with localized content', function () {
    $this->get('/en')
        ->assertStatus(200)
        ->assertSee('Tekvero | Engineering-grade web production', false)
        ->assertSee('Why Tekvero')
        ->assertSee('name="twitter:card"', false);
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
