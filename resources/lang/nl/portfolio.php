<?php

return [
    'navbar_brand' => 'Portfolio',
    'no-javascript' => 'Javascript lijkt uitgeschakeld. Deze site werkt misschien niet zoals verwacht.',

    
    'home' => 'Home',
    'profile' => 'Profiel',
    'dashboard' => 'Dashboard',
    'motivation' => 'Motivatie',
    'vision' => 'Beroepsbeeld',

    'author' => [
        'name' => 'Daniel de Cloet',
        'email' => 'djdecloet@gmail.com',
    ],

    'page_previous' => 'Vorige pagina',

    'contact_details' => 'Contactgegevens',
    'contact_form' => [
        'success_message' => 'Invullen formulier geslaagd. We zullen binnenkort contact opnemen.',
        'title' => 'Contactformulier',
        'email' => [
            'label' => 'Voer het e-mailadres in waar wij u kunnen bereiken.',
            'icon' => 'fas fa-envelope',
            'placeholder' => 'user@example.com',
            'popover_title' => 'Voer een geldige email in',
            'popover_content' => 'Een e-mailadres moet een enkel @ teken hebben en eindigen op een domein (example.com).<br>Example: user@example.com',
        ],
        'name' => [
            'label' => 'Voer uw naam in',
            'icon' => 'fas fa-user',
            'placeholder' => 'Voer uw naam in',
            'popover_title' => 'Voer uw naam in',
            'popover_content' => 'De naam waar u graag mee angesproken wilt worden.',
        ],
        'message' => [
            'label' => 'Feedback',
            'icon' => 'fas fa-comment',
            'placeholder' => 'Voer hier uw bericht in',
        ],
        'submit' => [
            'value' => 'Verzenden',
            'icon' => 'fas fa-bullhorn',
        ],
    ],
    'need_help' => 'Hulp nodig',
    'contact_us' => 'Neem contact op',

    'errors' => [
        'default' => [
            'error' => 'Helaas konden wij deze pagina niet vinden.<br>Misschien is deze pagina recentelijk verplaatst of tijdelijk niet toegankelijk.',
            'tips' => 'Probeer de pagina later nog eens te bezoeken of ga naar:',
        ],
        '403' => [
            'error' => 'U heeft onvoldoende rechten om deze pagina te bezoeken.',
            'tips' => 'Bent u ingelogd op het juiste account?<br>Is dit niet wat u verwacht? Vraag dan aan uw systeembeheerder om uw toegang te controleren.<br>Ga snel naar:',
        ],
        '404' => [
            'error' => 'Helaas konden wij deze pagina niet vinden.<br>Misschien is deze pagina recentelijk verplaatst of tijdelijk niet toegankelijk.',
            'tips' => 'Probeer de pagina later nog eens te bezoeken of ga naar:',
        ],
        '419' => [
            'error' => 'Uw sessie is verlopen.',
            'tips' => 'Ga terug naar de vorige pagina om het forulier opnieuw te verzenden.<br>Herhaalt dit probleem zich? <a href="/contact">Neem dan contact op.</a><br>Ga snel naar:',
        ],
        '500' => [
            'error' => 'Er is een fout opgetreden in ons systeem.',
            'tips' => 'We zullen deze foutmelding verwerken en oplossen.<br>Probeer de pagina later nog eens te bezoeken.',
        ],
    ],
];
