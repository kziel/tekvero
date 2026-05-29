@php
	$locale = $inquiry['locale'] ?? 'en';
@endphp

{{ __('contact.email.intro', locale: $locale) }}

{{ __('contact.email.labels.name', locale: $locale) }}: {{ $inquiry['name'] }}
{{ __('contact.email.labels.scope', locale: $locale) }}: {{ __('contact.scopes.'.$inquiry['scope'], locale: $locale) }}
{{ __('contact.email.labels.budget', locale: $locale) }}: {{ $inquiry['budget'] }}
{{ __('contact.email.labels.locale', locale: $locale) }}: {{ strtoupper($locale) }}

{{ __('contact.email.labels.message', locale: $locale) }}:
{{ $inquiry['message'] }}
