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
        $locale = (string) $request->route('locale', app()->getLocale());

        /** @var array{name: string, scope: string, budget: string, message: string, locale: string} $payload */
        $payload = $request->safe()->except('website');
        $payload['locale'] = $locale;

        try {
            Mail::to((string) config('mail.from.address'))->send(new ContactInquiryMail($payload));
        } catch (Throwable $exception) {
            Log::warning('Contact inquiry delivery failed.', [
                'error_class' => $exception::class,
                'ip' => $request->ip(),
            ]);

            return redirect()->route('landing', ['locale' => $locale])
                ->withInput($request->except('website'))
                ->withErrors([
                    'contact' => __('contact.errors.delivery_failed', locale: $locale),
                ]);
        }

        return redirect()->route('landing', ['locale' => $locale])
            ->with('contact_success', __('contact.success.submitted', locale: $locale));
    }
}
