<?php
if(!isset($_SESSION['language']) || empty($_SESSION['language']) || $_SESSION['language'] === "EN"){
    $translation = [
        "title" => "Timing Schedule",
        "welcome" => "welcome to Timing Schedule.",
        "dear" => "Dear",
        "logo_text" => "Timing Schedule",
        "first_menu_text" => "Please choose what you would like to set up:",
        "business_menu" => "Business Related",
        "timely_Events" => "Timely Events",
        "FA" => "FA",
        "EN" => "EN",
        "FR" => "FR",
        "business_submenu" => "Please choose what business details you would like to add:",
        "New_Accounting_Program" => "New Accounting Program",
        "New_Bank_Account" => "New Bank Account",
        "Add_new_bank_account" => "Please choose what sort of bank account you would like to add:",
        "Visa_card" => "Visa Card",
        "Master_Card" => "Master Card",
        "Local_Banks" => "Local Banks",   

        "Bank_country" => "Please choose the country of the bank account you would like to add:",
        "Iran" => "Iran",
        "England" => "England",
        "US" => "the US",
        "Canada" => "Canada", 
        "France" => "France",
        "Norway" => "Norway",
        "China" => "China",
        "Russia" => "Russia",

        "timely_events_menu" => "Please choose from the following the program you would like to add:",
        "Educational_Program" => "Educational Program",
        "Single_Event_Reminder" => "Single Event Reminder",
        "Iterable_Program" => "Iterable Program",

        "New_iterable_event_form_legend" => "New iterable event:",
        "event_name" => "Name of the event:",
        "new_iterable_event_name_placeholder" => "My class with MR. Park",
        "duration_of_the_event_label" => "Duration of the event in days:",
        "Unknown" => "Unknown",
        "Detail_of_the_iteration" => "Detail of the iteration:",

        "daily" => "Daily",
        "weekly" => "Weekly",
        "monthly" => "Monthly",

        "daily_label" => "Please choose the time of the day when the event occurs:",
        "Morning" => "Morning",
        "Mid-day" => "Mid-day",
        "Afternoon" => "Afternoon",
        "Evening" => "Evening",
        "Midnight" => "Midnight",

        "weekly_label" => "Please choose the time of the week when the event occurs:",
        "Monday" => "Monday",
        "Tuesday" => "Tuesday",
        "Wednesday" => "Wednesday",
        "Thursday" => "Thursday",
        "Friday" => "Friday",
        "Saturday" => "Saturday",
        "Sunday" => "Sunday",

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