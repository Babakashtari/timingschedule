<?php 
    // English regular expressions:
    $English_regular_expressions = [
        "bank_id" => '/^\d{1,8}$/',
        "account_id" => '/^\d+$/',
        "bank_name" => '/^([A-Z][a-z ]{1,15}){1,8}$/',
        "account_owner" => '/^([A-Z][a-z ]{2,9}){1,5}$/',
        "account_owners" => '/^([A-Z][a-z]{2,15}(,| *)+){1,10}$/',
        "branch_name" => '/^[A-Za-z0-9-_ ]{3,}$/',
        "account_number" => '/^\d{8,}$/',
        "card_number" => '/^\d{16}$/',
        "shaba_number" => '/^IR[0-9]{24}$/',
        // negative numbers for the initial deposit are not accepted according to this regular expression:
        "initial_deposit" => '/^\d+$/',
        "descriptions" => '/[\d\w]{1,}/',
        "currency" => '/^[A-Za-z0-9\/, -_=%$@]{1,}$/',
    ];

    // French regular expressions:
    $French_regular_expressions = [
        "bank_id" => '/^\d{1,8}$/',
        "account_id" => '/^\d+$/',
        "bank_name" => '/^([A-Z][a-zéàùèûâêîôçëäïü ]{1,15}){1,8}$/',
        "account_owner" => '/^([A-Z][a-zéàùèûâêîôçëäïü ]{2,9}){1,5}$/',
        "account_owners" => '/^([A-Z][a-zéàùèûâêîôçëäïü]{2,15}(,| *)+){1,10}$/',
        "branch_name" => '/^[A-Za-zéàùèûâêîôçëäïü0-9-_ ]{3,}$/',
        "account_number" => '/^\d{8,}$/',
        "card_number" => '/^\d{16}$/',
        "shaba_number" => '/^IR[0-9]{24}$/',
        // negative numbers for the initial deposit are not accepted according to this regular expression:
        "initial_deposit" => '/^\d+$/',
        "descriptions" => '/[\d\w]{1,}/',
        "currency" => '/^[A-Za-z0-9\/, -_=%$@]{1,}$/',
    ];

    // Persian regular expressions:
    $Persian_regular_expressions = [
        "bank_id" => '/^\d{1,8}$/',
        "account_id" => '/^\d+$/',
        "bank_name" => '/^([ ءآابپتثجچحخدذرزژسشصضطظعغفقکگلمنوهیئ]{1,15}){1,8}$/',
        "account_owner" => '/^([ آابپتثجچحخدذرزژسشصضطظعغفقکگلمنوهیئ]{2,9}){1,5}$/',
        "account_owners" => '/^([آابپتثجچحخدذرزژسشصضطظعغفقکگلمنوهیئ]{2,15}(،| *)+){1,10}$/',
        "branch_name" => '/^([0-9 ]+|[آابپتثجچحخدذرزژسشصضطظعغفقکگلمنوهیئ]){3,}$/',
        "account_number" => '/^\d{8,}$/',
        "card_number" => '/^\d{16}$/',
        "shaba_number" => '/^IR[0-9]{24}$/',
        // negative numbers for the initial deposit are not accepted according to this regular expression:
        "initial_deposit" => '/^\d+$/',
        "descriptions" => '/[\d\w]{1,}/',
        "currency" => '/^[A-Za-z0-9\/, -_=%$@]{1,}$/',
    ];

    function get_regular_expression($session_language){
        $regular_expressions;
        if(!isset($session_language) || empty($session_language) || $session_language === "EN"){
            global $English_regular_expressions;
            $regular_expressions =  $English_regular_expressions;
        }elseif(isset($session_language) && $session_language === "FR"){
            global $French_regular_expressions;
            $regular_expressions = $French_regular_expressions;
        }elseif(isset($session_language) && $session_language === "FA"){
            global $Persian_regular_expressions;
            $regular_expressions = $Persian_regular_expressions;
        }
        return $regular_expressions;
    }

?>