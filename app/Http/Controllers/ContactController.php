<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactInquiryMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ContactController extends Controller
{
    public function store(ContactRequest $request): RedirectResponse
    {
        /** @var array{name: string, scope: string, budget: string, message: string} $payload */
        $payload = $request->safe()->except('website');

        try {
            Mail::to((string) config('mail.from.address'))->send(new ContactInquiryMail($payload));
        } catch (Throwable $exception) {
            Log::warning('Contact inquiry delivery failed.', [
                'error_class' => $exception::class,
                'ip' => $request->ip(),
            ]);

            return redirect('/')
                ->withInput($request->except('website'))
                ->withErrors([
                    'contact' => 'Your message could not be delivered right now. Please try again in a moment.',
                ]);
        }

        return redirect('/')->with('contact_success', 'Thanks! Your inquiry has been received. We will get back to you soon.');
    }
}
