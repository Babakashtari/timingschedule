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

        "monthly_label" => "Please choose the day of the month when the event occurs:",
        "ordinal_number_first" => "st",
        "ordinal_number_second" => "nd",
        "ordinal_number_third" => "rd",
        "more_than_three_ordinal_numbers" => "th",

        "30_31_days_selection_error" => "Careful, month with less than 30 days may ignore your event iteration",
        "confirmation_label" => "Do we need your confirmation after an iteration?",

        "YES" => "Yes",
        "NO" => "No",

        "money_inquiry_label" => "Do you receive money after an iteration?",
        "amount_of_money_received_label" => "How much do you receive per iteration?",
        "currency_choice_label" => "choose your currency:",
        "US_Dollars" => "US Dollars",
        "CA_Dollars" => "CA Dollars",
        "Euros" => "Euros",
        "Ir_Rials" => "Ir Rials",
        "Ir_Tomans" => "Ir Tomans",
        "Add" => "Add",

        "sign_in_legend" => "Sign in Here:",
        "Username" => "Username:",
        "password" => "Password:",
        "sign_in_submit" => "Sign in",
        "Not_a_member" => "Not a member?",
        "Register_here" => "Register here",

        "Register_Here_legend" => "Register Here:",
        "Email" => "Email:",
        "Register_submit" => "Register",
        "Already_a_member" => "Already a member? ",
        "Login_here" => "Login here",

        "email_format_error" => "Your email does not have a valid format.",
        "username_format_error" => "Username should begin with a capital letter and have at least 3 characters.",
        "password_format_error" => "Password should only contain lowercase, upercase and numbers and have at least 5 to 15 characters.",
        // dear user is added to this value in user_validation.php:
        "email_activation_error" => 'You have not activated your account yet. Please visit your email.',
        "password_no_match_error" => "Your password does not match. Please retry.",
        "login_success_message" => "Congradulations, you have successfully logged in.",
        "no_user_found_error" => "No registered user found with the username you entered.",
        "user_already_exists_error" => "Username already exists. Please choose another one.",
        "email_already_exists_error" => "Email already exists. Please choose another one.",
        "something_went_wrong" => "something happened and signin failed.",
        "registration_appreciation" => "thank you for your registration",
        "check_email_request" => "Please check your email and activate your account. without activation, you cannot signin.",

        "New_bank_account_form_legend" => "New Iranian Bank Account:",
        "Bank_name" => "Bank name:",
        "Bank_name_placeholder" => "ex: Eghtesade Novin",
        "not_in_the_list_above" => "Not in the list above?",
        "Bank_Logo" => "Bank Logo:",
        "Add_Bank_submit" => "Add Bank",
        "Holder_name_label" => "Holder name:",
        "Holder_name_placeholder" => "Type in your name",
        "Corporate_label" => "Corporate",
        "Multiple_owners" => "Multiple owners",
        "multiple_owners_label" => "Multiple holders' names:",
        "multiple_owners_placeholder" => "Seperate names by comma",
        "Branch_name_label" => "Branch Name:",
        "Branch_name_placeholder" => "Ex: Imam Khomeini st",
        "Account_Number_label" => "Account Number:",
        "Account_number_placeholder" => "enter your account number",
        "Card_number_label" => "Card Number:",
        "Card_number_placeholder" => "Enter 16 digit card number",
        "Shaba_number_label" => "Account Shaba Number:",
        "Shaba_number_placeholder" => "enter IR + 24 numbers",
        "Initial_Deposit_label" => "Initial Deposit:",
        "Initial_deposit_placeholder" => "Enter a positive number with a maximum of 15 digits. ",
        "Descriptions_label" => "Descriptions",
        "Descriptions_placeholder" => "type something about this account...",
        "currency_label" => "Currency Unit Of The Account:",
        "New_account_submit" => "Add New Account",

        "Bank_ID_error" => "The Bank name does not match.",
        "account_owner_error" => "Account owner should begin with a capital letter and only contain space and letters. Maximum word-count and character-count of each word are 5 and 10 respectively.",
        "multiple_owners_error" => "Name of each owner should begin with a capital letter. Maximum of 10 owners allowed. Also owner's names should be seperated with a comma: ,",
        "minimum_one_owner_error" => "At least an account owner should be specified.",
        "branch_name_error" => "Branch names should only contain letters, numbers, dash and underscore.",
        "account_number_error" => "Account number should contain at least 8 digits without any space or dash.",
        "same_account_number_error" => "An account with the same account number is already registered.",
        "minimum_one_account_number_error" => "An account number must be specified.",
        "card_number_format_error" => "Card number should contain 16 digits. No space or dash required.",
        "same_card_number_error" => "The same card number already registered to another account.",
        "shaba_format_error" => "Shaba number should begin with IR followed by 24 digits.",
        "same_shaba_number_error" => "The same shaba number already registered to another account.",
        "deposit_format_error" => "The deposit should only be a positive number.",
        "descriptions_error" => "Only letters, numbers and _ are allowed for description.",
        "currency_error" => "Currency is not entered correctly.",
        "currency_empty_error" => "Currency cannot be empty.",
        "Account_added_successfully" => "Account added successfully.",

        "image_required_error" => "Please upload an image as the bank icon.",
        "allowed_image_format_error" => "Allowed file formats are JPG and PNG.",
        "image_file_size_error" => "File size should not exceed 500KBs.",
        "doublicate_bank_name_error" => "Bank name already exists. No need to reenter.",
        "new_bank_added_successfully" => "Thank you for your contribution. Please wait while we verify your Bank.",
        "new_bank_success_message" => "New Bank added successfully.",
        "bank_name_format_error" => "Bank Name Should begin with a capital and cannot contain more than 8 words or 15 characters in each word.",
        "Bank_name_empty_error" => "Bank Name and Image fields cannot be empty.",
    ]; 


}

?>