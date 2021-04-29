<?php
if(isset($_SESSION['language']) && $_SESSION['language'] === "FR"){
    $translation = [
        "title" => "Timing Schedule!",
        "welcome" => "Bienvenu à Timing Schedule.",
        "dear" => "Cher",
        "logo_text" => "Timing Schedule",
        "first_menu_text" => "Choisissez ce que vous vouliez:",
        "business_menu" => "programmes commerciaux",
        "timely_Events" => "évenements à intervalle de temps fixe",
        "FA" => "PER",
        "EN" => "ANG",
        "FR" => "FR",
        "business_submenu" => "Choisissez le programme commercial que vous désirez commencer:",
        "New_Accounting_Program" => "Nouveau compte de comptabilité",
        "New_Bank_Account" => "nouveau compte bancaire",
        "Add_new_bank_account" => "Choisissez quel compte bancaire vous désirez ajouter:",
        "Visa_card" => "Carte Visa",
        "Master_Card" => "Carte Master",
        "Local_Banks" => "banques locales",    

        "Bank_country" => "Choisissez le pays d'origin de votre compte bancaire:",
        "Iran" => "l'Iran",
        "England" => "l'Angleterre",
        "US" => "les Etats Unis",
        "Canada" => "le Canada", 
        "France" => "la France",
        "Norway" => "la Norvège",
        "China" => "la Chine",
        "Russia" => "la Russie",

        "timely_events_menu" => "Choisissez le programme à intervalle temporelle que vous désirez ajouter:",
        "Educational_Program" => "programme didactique",
        "Single_Event_Reminder" => "évenement singulier",
        "Iterable_Program" => "programme itératif",

        "New_iterable_event_form_legend" => "Nouveau programme itératif:",
        "event_name" => "Nom de l'évenement:",
        "new_iterable_event_name_placeholder" => "Ma classe avec Monsieur Martin",
        "duration_of_the_event_label" => "Durée de l'évenement:",
        "Unknown" => "indéterminée",

        "Detail_of_the_iteration" => "Détail de l'itération:",
        "daily" => "Quotidien",
        "weekly" => "hébdomadaire",
        "monthly" => "Monsuel",

        "daily_label" => "choisissez le temps de l'évenement au quotidien:",
        "Morning" => "Le matin",
        "Mid-day" => "Le midi",
        "Afternoon" => "L'après-midi",
        "Evening" => "Le soir",
        "Midnight" => "La nuit",

        "weekly_label" => "choisissez le temps de l'évenement hébdomadaire:",
        "Monday" => "Le lundi",
        "Tuesday" => "Le mardi",
        "Wednesday" => "Le mercredi",
        "Thursday" => "Le jeudi",
        "Friday" => "Le vendredi",
        "Saturday" => "le samdi",
        "Sunday" => "le dimanche",


    ]; 
    $style = [
        "direction" => "direction: ltr;",
        "float" => "float: right;",
        "right" => "right: 0;",
        "left" => "left: 100%;",
        "text-align" => "text-align:left;",

    ];
}

?>