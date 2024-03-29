<?php

return [
    'field' => [
        'invalid_type' => 'Ongeldig type veld: :type.',
        'options_method_not_exists' => 'De modelklasse :model moet de methode :method() definiëren met daarin opties voor het veld ":field".',
    ],
    'widget' => [
        'not_registered' => "Een widget met klassenaam ':name' is niet geregistreerd",
        'not_bound' => "Een widget met klassenaam ':name' is niet gekoppeld aan de controller",
    ],
    'page' => [
        'untitled' => "Naamloos",
        'access_denied' => [
            'label' => "Toegang geweigerd",
            'help' => "Je hebt niet de benodigde rechten om deze pagina te bekijken.",
            'cms_link' => "Ga naar CMS backend",
        ],
    ],
    'partial' => [
        'not_found' => "Het sjabloon (partial) ':name' is niet gevonden.",
    ],
    'account' => [
        'sign_out' => 'Uitloggen',
        'login' => 'Inloggen',
        'reset' => 'Reset',
        'restore' => 'Herstellen',
        'login_placeholder' => 'gebruikersnaam',
        'password_placeholder' => 'wachtwoord',
        'forgot_password' => "Wachtwoord vergeten?",
        'enter_email' => "Vul het e-mailadres in",
        'enter_login' => "Vul de gebruikersnaam in",
        'email_placeholder' => "e-mail",
        'enter_new_password' => "Vul een nieuw wachtwoord in",
        'password_reset' => "Herstel Wachtwoord",
        'restore_success' => "Een e-mail met instructies om het wachtwoord te herstellen is verzonden naar jouw e-mailadres.",
        'restore_error' => "Een gebruiker met de gebruikersnaam ':login' is niet gevonden",
        'reset_success' => "Het wachtwoord is succesvol hersteld. Je kan nu inloggen",
        'reset_error' => "Ongeldige wachtwoordherstelinformatie aangeboden. Probeer overnieuw!",
        'reset_fail' => "Het is niet mogelijk het wachtwoord te herstellen!",
        'apply' => 'Toepassen',
        'cancel' => 'Annuleren',
        'delete' => 'Verwijderen',
        'ok' => 'OK',
    ],
    'dashboard' => [
        'menu_label' => 'Overzicht',
    ],
    'user' => [
        'name' => 'Beheerder',
        'menu_label' => 'Beheerders',
        'list_title' => 'Beheer Beheerders',
        'new' => 'Nieuwe Beheerder',
        'login' => "Gebruikersnaam",
        'first_name' => "Voornaam",
        'last_name' => "Achternaam",
        'full_name' => "Volledige Naam",
        'email' => "E-mail",
        'groups' => "Groepen",
        'groups_comment' => "Voeg de gebruiker eventueel toe aan gebruikersgroepen.",
        'avatar' => "Avatar",
        'password' => "Wachtwoord",
        'password_confirmation' => "Bevestig Wachtwoord",
        'superuser' => "Speciale Gebruiker",
        'superuser_comment' => "Vink deze optie aan om de gebruiker volledige rechten tot het systeem te geven.",
        'send_invite' => 'Stuur uitnodiging per e-mail',
        'send_invite_comment' => 'Vink deze optie aan om de gebruiker een uitnodiging per e-mail te sturen',
        'delete_confirm' => 'Weet je zeker dat je deze beheerder wilt verwijderen?',
        'return' => 'Terug naar beheerdersoverzicht',
        'group' => [
            'name' => 'Groep',
            'name_field' => 'Naam',
            'menu_label' => 'Groepen',
            'list_title' => 'Beheer Groepen',
            'new' => 'Nieuwe Beheerdersgroep',
            'delete_confirm' => 'Weet je zeker dat je deze beheerdersgroep wilt verwijderen?',
            'return' => 'Terug naar groepenoverzicht',
        ],
        'preferences' => [
            'not_authenticated' => 'Er is geen geauthenticeerde gebruiker om gegevens voor te laden of op te slaan.'
        ]
    ],
    'list' => [
        'default_title' => 'Lijst',
        'search_prompt' => 'Zoeken...',
        'no_records' => 'Er zijn geen resultaten gevonden.',
        'missing_model' => 'Geen model opgegeven voor het gedrag (behavior) van de lijst gebruikt in :class.',
        'missing_column' => 'Er zijn geen kolommen voor :columns opgegeven.',
        'missing_columns' => 'Er zijn geen kolommen opgegeven voor de lijst in :class.',
        'missing_definition' => "Het gedrag (behavior) van de lijst bevat geen kolom voor ':field'.",
        'behavior_not_ready' => 'Gedrag (behavior) van de lijst is niet geladen. Controleer of makeLists() in de controller is aangeroepen.',
        'invalid_column_datetime' => "Column value ':column' is not a DateTime object, are you missing a \$dates reference in the Model?",
    ],
    'form' => [
        'create_title' => "Maak :name",
        'update_title' => "Bewerk :name",
        'preview_title' => "Bekijk :name",
        'create_success' => ':name is succesvol aangemaakt',
        'update_success' => ':name is succesvol bijgewerkt',
        'delete_success' => ':name is succesvol verwijderd',
        'missing_id' => "Record ID van het formulier is niet opgegeven.",
        'missing_model' => 'Geen model opgegeven voor het gedrag (behavior) van het formulier gebruikt in :class.',
        'missing_definition' => "Het gedrag (behavior) van het formulier bevat geen kolom voor ':field'.",
        'not_found' => 'Het formulier met record ID :id is niet gevonden.',
        'create' => 'Maken',
        'create_and_close' => 'Maken en sluiten',
        'creating' => 'Maken...',
        'save' => 'Opslaan',
        'save_and_close' => 'Opslaan en sluiten',
        'saving' => 'Opslaan...',
        'delete' => 'Verwijderen',
        'deleting' => 'Verwijderen...',
        'undefined_tab' => 'Overig',
        'field_off' => 'Uit',
        'field_on' => 'Aan',
        'apply' => 'Toepassen',
        'cancel' => 'Annuleren',
        'close' => 'Sluiten',
        'ok' => 'OK',
        'or' => 'of',
        'confirm_tab_close' => 'Weet je zeker dat je dit tabblad wilt sluiten? Niet opgeslagen wijzigingen gaan verloren.',
        'behavior_not_ready' => 'Gedrag (behavior) van het formulier is niet geladen. Controleer of initForm() in de controller is aangeroepen.',
    ],
    'relation' => [
        'missing_definition' => "Het gedrag (behavior) van de relatie bevat geen kolom voor ':field'.",
        'missing_model' => "Geen model opgegeven voor het gedrag (behavior) van relatie gebruikt in :class.",
        'invalid_action_single' => "Deze actie kan niet worden uitgevoerd op een enkele (singular) relatie.",
        'invalid_action_multi' => "Deze actie kan niet worden uitgevoerd op meerdere (multiple) relatie.",
        'add' => "Toevoegen",
        'add_name' => ":name Toevoegen",
        'create' => "Maken",
        'create_name' => "Maak :name",
        'update' => "Update",
        'update_name' => "Update :name",
        'remove' => "Verwijder",
        'remove_name' => "Verwijder :name",
        'delete' => "Wissen",
        'delete_name' => "Wis :name",
    ],
    'model' => [
        'name' => "Model",
        'not_found' => "Model ':class' met ID :id is niet gevonden",
        'missing_id' => "Record ID van het model is niet opgegeven.",
        'missing_relation' => "Model ':class' bevat geen definitie voor ':relation'.",
        'invalid_class' => "Model :model gebruikt in :class is ongeldig. Het moet de \Model klasse erven (inherit).",
        'mass_assignment_failed' => "Mass assignment failed for Model attribute ':attribute'.",
    ],
    'warnings' => [
        'tips' => 'System configuration tips',
        'tips_description' => 'There are issues you need to pay attention to in order to configure the system properly.',
        'permissions'  => 'Directory :name or its subdirectories is not writable for PHP. Please set corresponding permissions for the webserver on this directory.',
        'extension' => 'The PHP extension :name is not installed. Please install this library and activate the extension.'
    ],
    'editor' => [
        'menu_label' => 'Editor Preferences',
        'menu_description' => 'Manage code editor preferences.',
        'font_size' => 'Font size',
        'tab_size' => 'Tab size',
        'use_hard_tabs' => 'Indent using tabs',
        'code_folding' => 'Code folding',
        'word_wrap' => 'Word wrap',
        'highlight_active_line' => 'Highlight active line',
        'show_invisibles' => 'Show invisible characters',
        'show_gutter' => 'Show gutter',
        'theme' => 'Color scheme',
    ],
];