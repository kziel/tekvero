<?php

return [
    'success' => [
        'submitted' => 'Dziekujemy! Twoje zapytanie zostalo przyjete. Wkrotce wrocimy z odpowiedzia.',
    ],
    'errors' => [
        'delivery_failed' => 'Nie udalo sie dostarczyc wiadomosci. Sprobuj ponownie za chwile.',
        'spam' => 'Wykryto blad weryfikacji antyspamowej. Sprobuj ponownie.',
    ],
    'scopes' => [
        'new-landing-page' => 'Nowy landing page',
        'website-redesign' => 'Przebudowa strony',
        'other' => 'Inne',
    ],
    'email' => [
        'subject' => 'Nowe zapytanie Tekvero: :name',
        'intro' => 'Nowe zapytanie ze strony Tekvero',
        'labels' => [
            'name' => 'Nazwa / Firma',
            'scope' => 'Zakres projektu',
            'budget' => 'Zakres budzetu',
            'message' => 'Wiadomosc',
            'locale' => 'Jezyk',
        ],
    ],
    'validation' => [
        'name_required' => 'Podaj nazwe lub firme.',
        'scope_required' => 'Wybierz zakres projektu.',
        'scope_in' => 'Wybierz jedna z dostepnych opcji zakresu.',
        'budget_required' => 'Podaj zakres budzetu.',
        'message_required' => 'Uzupelnij szczegoly projektu.',
        'message_min' => 'Wiadomosc powinna miec co najmniej :min znakow.',
    ],
];
