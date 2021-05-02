<?php 
$regular_expressions = [
    "bank_id" => '/^\d{1,8}$/',
    "account_owner" => '/^([A-Z][a-z]{2,9}\s*){1,5}$/',
    "account_owners" => '/^(( *[A-Z][a-z]{2,9} *){1,5},*){2,10}$/',
    "branch_name" => '/^[A-Za-z0-9 ]{3,}$/',
    "account_number" => '/^\d{8,}$/',
    "card_number" => '/^\d{16}$/',
    "shaba_number" => '/^IR[0-9]{24}$/',
    "initial_deposit" => '/^\d{1,}$/',
    "descriptions" => '/[\d\w\s=@*#\/%-]{1,}/',
    "currency" => '/^[A-Za-z0-9\/, -_=%$@]{1,}$/',
    
];

?>