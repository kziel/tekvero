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
            'website.max' => 'Spam check failed. Please try again.',
        ];
    }
}
