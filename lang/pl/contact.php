<?php

return [
    'success' => [
        'submitted' => 'Dziękujemy! Twoje zapytanie zostało przyjęte. Wkrótce wrócimy z odpowiedzią.',
    ],
    'errors' => [
        'delivery_failed' => 'Nie udało się dostarczyć wiadomości. Spróbuj ponownie za chwilę.',
        'spam' => 'Wykryto błąd weryfikacji antyspamowej. Spróbuj ponownie.',
    ],
    'scopes' => [
        'new-landing-page' => 'Nowy landing page',
        'website-redesign' => 'Przebudowa strony',
        'other' => 'Inne',
    ],
    'email' => [
        'subject' => 'Nowe zapytanie TekVero: :name',
        'intro' => 'Nowe zapytanie ze strony TekVero',
        'labels' => [
            'name' => 'Nazwa / Firma',
            'scope' => 'Zakres projektu',
            'budget' => 'Zakres budżetu',
            'message' => 'Wiadomość',
            'locale' => 'Język',
        ],
    ],
    'validation' => [
        'name_required' => 'Podaj nazwę lub firmę.',
        'scope_required' => 'Wybierz zakres projektu.',
        'scope_in' => 'Wybierz jedną z dostępnych opcji zakresu.',
        'budget_required' => 'Podaj zakres budżetu.',
        'message_required' => 'Uzupełnij szczegóły projektu.',
        'message_min' => 'Wiadomość powinna mieć co najmniej :min znaków.',
    ],
];
