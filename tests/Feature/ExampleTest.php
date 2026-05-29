<?php

test('the application returns a successful response', function () {
    $response = $this->get('/');

    $response
        ->assertStatus(200)
        ->assertSee('Tekvero | Engineering-grade web production', false)
        ->assertSee('name="description"', false)
        ->assertSee('property="og:title"', false)
        ->assertSee('name="twitter:card"', false);
});
