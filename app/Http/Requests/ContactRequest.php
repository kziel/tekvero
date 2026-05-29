<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'scope' => ['required', Rule::in(['new-landing-page', 'website-redesign', 'other'])],
            'budget' => ['required', 'string', 'max:120'],
            'message' => ['required', 'string', 'min:20', 'max:4000'],
            // Honeypot: real users never fill this hidden field.
            'website' => ['nullable', 'max:0'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => __('contact.validation.name_required'),
            'scope.required' => __('contact.validation.scope_required'),
            'scope.in' => __('contact.validation.scope_in'),
            'budget.required' => __('contact.validation.budget_required'),
            'message.required' => __('contact.validation.message_required'),
            'message.min' => __('contact.validation.message_min'),
            'website.max' => __('contact.errors.spam'),
        ];
    }
}
