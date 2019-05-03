<?php

return [
    'navbar_brand' => 'Portfolio',
    
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
        'title' => 'Contactformulier',
        'email' => [
            'label' => 'Voer het e-mailadres in waar wij u kunnen bereiken.',
            'icon' => '<i class="fas fa-envelope"></i>',
            'placeholder' => 'Voer een geldige e-mail in',
        ],
        'name' => [
            'label' => 'Voer uw naam in',
            'icon' => '<i class="fas fa-user"></i>',
            'placeholder' => 'Voer uw naam in',
        ],
        'message' => [
            'label' => 'Feedback',
            'icon' => '<i class="fas fa-comment"></i>',
            'placeholder' => 'Voer hier uw bericht in',
        ],
        'submit' => [
            'value' => 'Verzenden',
            'icon' => '<i class="fas fa-bullhorn"></i>',
        ],
    ],
    'need_help' => 'Hulp nodig',
    'contact_us' => 'Neem contact op',

    'errors' => [
        'default' => [
            'error' => 'Helaas konden wij deze pagina niet vinden.',
            'tips' => 'Probeer de pagina later nog eens te bezoeken of ga naar:',
        ],
        '403' => [
            'error' => 'U heeft onvoldoende rechten om deze pagina te bezoeken.',
            'tips' => 'Bent u ingelogd op het juiste account?<br>Is dit niet wat u verwacht? Vraag dan aan uw systeembeheerder om uw toegang te controleren.',
        ],
        '404' => [
            'error' => 'Helaas konden wij deze pagina niet vinden.',
            'tips' => 'Probeer de pagina later nog eens te bezoeken of ga naar: ',
        ],
        '419' => [
            'error' => 'Uw sessie is verlopen.',
            'tips' => 'Ga terug naar de vorige pagina om het forulier opnieuw te verzenden.<br>Herhaalt dit probleem zich? <a href="/contact">Neem dan contact op.</a>',
        ],
        '500' => [
            'error' => 'Er is een fout opgetreden in ons systeem.',
            'tips' => 'We zullen deze foutmelding verwerken en oplossen.<br>Probeer de pagina later nog eens te bezoeken.',
        ],
    ],
];
