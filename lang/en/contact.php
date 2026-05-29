<?php

return [
    'success' => [
        'submitted' => 'Thanks! Your inquiry has been received. We will get back to you soon.',
    ],
    'errors' => [
        'delivery_failed' => 'Your message could not be delivered right now. Please try again in a moment.',
        'spam' => 'Spam check failed. Please try again.',
    ],
    'scopes' => [
        'new-landing-page' => 'New Landing Page',
        'website-redesign' => 'Website Redesign',
        'other' => 'Other',
    ],
    'email' => [
        'subject' => 'New Tekvero inquiry: :name',
        'intro' => 'New inquiry from Tekvero website',
        'labels' => [
            'name' => 'Name / Company',
            'scope' => 'Project Scope',
            'budget' => 'Budget Range',
            'message' => 'Message',
            'locale' => 'Language',
        ],
    ],
    'validation' => [
        'name_required' => 'Please enter your name or company.',
        'scope_required' => 'Please select your project scope.',
        'scope_in' => 'Please choose one of the available scope options.',
        'budget_required' => 'Please provide your budget range.',
        'message_required' => 'Please provide project details.',
        'message_min' => 'Please provide at least :min characters in your message.',
    ],
];
