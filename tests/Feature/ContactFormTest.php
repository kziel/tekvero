<?php

use App\Mail\ContactInquiryMail;
use Illuminate\Support\Facades\Mail;

it('submits contact form successfully', function () {
    Mail::fake();

    $response = $this->post('/contact', [
        'name' => 'Acme Sp. z o.o.',
        'scope' => 'new-landing-page',
        'budget' => '10k-25k PLN',
        'message' => 'We need a conversion-focused landing page for a new campaign launch this quarter.',
        'website' => '',
    ]);

    $response
        ->assertRedirect('/')
        ->assertSessionHas('contact_success')
        ->assertSessionHasNoErrors();

    Mail::assertSent(ContactInquiryMail::class, function (ContactInquiryMail $mail): bool {
        return $mail->inquiry['name'] === 'Acme Sp. z o.o.';
    });
});

it('rejects honeypot submissions', function () {
    Mail::fake();

    $response = $this->from('/')->post('/contact', [
        'name' => 'Spam Bot',
        'scope' => 'other',
        'budget' => '0',
        'message' => 'This should never pass validation because honeypot is filled.',
        'website' => 'https://spam.example',
    ]);

    $response
        ->assertRedirect('/')
        ->assertSessionHasErrors(['website']);

    Mail::assertNothingSent();
});

it('validates required fields', function () {
    Mail::fake();

    $response = $this->from('/')->post('/contact', [
        'name' => '',
        'scope' => '',
        'budget' => '',
        'message' => '',
        'website' => '',
    ]);

    $response
        ->assertRedirect('/')
        ->assertSessionHasErrors(['name', 'scope', 'budget', 'message']);

    Mail::assertNothingSent();
});

it('throttles repeated contact submissions', function () {
    Mail::fake();

    $payload = [
        'name' => 'Rate Limit Test',
        'scope' => 'other',
        'budget' => '5k-10k PLN',
        'message' => 'Testing route limiter behavior for repeated submissions over the same short time window.',
        'website' => '',
    ];

    for ($attempt = 1; $attempt <= 5; $attempt++) {
        $this->post('/contact', $payload)->assertRedirect('/');
    }

    $this->post('/contact', $payload)->assertStatus(429);

    Mail::assertSent(ContactInquiryMail::class, 5);
});
