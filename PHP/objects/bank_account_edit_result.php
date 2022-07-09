<?php
if(isset($_POST['bank_account_edited']) && $_POST['bank_account_edited'] === "bank_account_edited"){
    require "PHP/objects/new/bank_accounts/new_bank_added.php";
    class Bank_account_edited extends Iranian_bank_account_submit{
        function __construct(){

        }
        function check_if_data_is_already_present_in_database(){
            require 'PHP/objects/database_connection.php';
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }else{
                $regular_expressions = get_regular_expression($_SESSION['language']);
                global $translation;
                $data_clean_up = new Data_clean_up();
                if(!empty($_POST['account_number'])){
                    // format for the account number:
                    $account_number = $data_clean_up->test_input($regular_expressions['account_number'], $_POST['account_number']);
                    if(empty($account_number)){
                        $account_number_error = $translation['account_number_error'];
                        array_push($this->errors, "<p class='error'>$account_number_error</p>");
                    }else{
                        $account_ID = $data_clean_up->test_input($regular_expressions['bank_ID'], $_POST['account_ID']);
                        if(!empty($account_ID)){
                            // checking if the modified account number already exists in the database:
                            $account_number_query_check = "SELECT Account_number FROM accounts WHERE Account_number = '$account_number' AND ID <> '$account_ID'";
                            $account_number_query_result = $connection->query($account_number_query_check);
    
                            if($account_number_query_result->num_rows > 0){
                                $same_account_number_error = $translation['same_account_number_error'];
                                array_push($this->errors, "<p class='error'>$same_account_number_error</p>");
                            }else{
                                array_push($this->column_names, "Account_number");
                                array_push($this->column_values, $account_number);    
                            }    
                        }
                    }
                }else{
                    $minimum_one_account_number_error = $translation['minimum_one_account_number_error'];
                    array_push($this->errors, "<p class='error'>$minimum_one_account_number_error</p>");
                }
                if(!empty($_POST['card_number'])){
                    // replace all spaces in the card number
                    $card_number = str_replace(" ","",$_POST['card_number']);
                    $card_number = $data_clean_up->test_input($regular_expressions['card_number'], $card_number);
                    if(empty($card_number)){
                        $card_number_format_error = $translation['card_number_format_error'];
                        array_push($this->errors, "<p class='error'>$card_number_format_error</p>");
                    }else{
                        $card_number_query_check = "SELECT Card_number FROM accounts WHERE Card_number = '$card_number' AND ID <> '$account_ID' ";
                        $card_number_query_result = $connection->query($card_number_query_check);
                        if($card_number_query_result->num_rows > 0){
                            $same_card_number_error = $translation['same_card_number_error'];
                            array_push($this->errors, "<p class='error'>$same_card_number_error</p>");
                        }else{
                            array_push($this->column_names, "Card_number");
                            array_push($this->column_values, $card_number);    
                        }
                    }
                }
                if(!empty($_POST['Shaba_number'])){
                    $shaba = $data_clean_up->test_input($regular_expressions['shaba_number'], strtoupper($_POST['Shaba_number']));
                    if(empty($shaba)){
                        $shaba_format_error = $translation['shaba_format_error'];
                        array_push($this->errors, "<p class='error'>$shaba_format_error</p>");
                    }else{
                        $shaba_number_query_check = "SELECT Shaba_number FROM accounts WHERE Shaba_number = '$shaba' AND ID <> '$account_ID' ";
                        $shaba_number_query_result = $connection->query($shaba_number_query_check);
                        if($shaba_number_query_result->num_rows > 0){
                            $same_shaba_number_error = $translation['same_shaba_number_error'];
                            array_push($this->errors, "<p class='error'>$same_shaba_number_error</p>");
                        }else{
                            array_push($this->column_names, "Shaba_number");
                            array_push($this->column_values, $shaba);    
                        }
                    }
                }    
            }
        }
        // writing data to the database:
    }
    $bank_account_edited = new Bank_account_edited();
    $bank_account_edited->check_if_data_is_already_present_in_database();
}

?>