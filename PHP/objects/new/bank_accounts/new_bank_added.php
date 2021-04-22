<?php 

class Iranian_bank_account_submit{
    public $errors = [];
    function __construct(){
        require 'PHP/objects/database_connection.php';
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }else{
            if(isset($_POST['Bank_name'])){
                $bank_id = $_POST['Bank_name'];
                $data_clean_up = new Data_clean_up();
                $bank_id = $data_clean_up->test_input('/^[0-9]$/', $bank_id);
                $check_query = "SELECT Bank_name FROM banks WHERE Bank_ID='$bank_id' ";
                $result = $connection->query($check_query);

                if($result->num_rows > 0){
                    $associative_array = $result->fetch_assoc();
                    $bank_name = $associative_array['Bank_name'];
                }else{
                    array_push($this->errors, "<p class='success'>The Bank name does not match.</p>");
                }
                if(!empty($_POST['account_holder'])){
                    $account_owner = $data_clean_up->test_input('/^([A-Z][a-z]{2,9}\s*){1,5}$/',$_POST['account_holder']);
                    if(empty($account_owner)){
                        array_push($this->errors, "<p class='error'>Account owner should begin with a capital letter and only contain space and letters .</p>");
                    }
                }elseif(!empty($_POST['account_holders'])){
                    $account_owners = $data_clean_up->test_input('/^(( *[A-Z][a-z]{2,9} *){1,5},*){2,10}$/',$_POST['account_holders']);
                    if(empty($account_owners)){
                        array_push($this->errors,"<p class='error'>Name of each owner should begin with a capital letter. Also seperate owner's names with a comma:','.</p>");
                    }
                }else{
                    array_push($this->errors, "<p class='error'>At least one account owner should be specified.</p>");
                }
                if($_POST['corporate'] === "YES"){
                    $corporate = "YES";
                }else{
                    $corporate = "NO";
                }
                if(!empty($_POST['branch'])){
                    $branch_name = $data_clean_up->test_input('/^[A-Za-z0-9]{3,}$/', $_POST['branch']);
                    if(empty($branch_name)){
                        array_push($this->errors,"<p class='error'>Branch names should only contain letters and numbers.</p>");
                    }
                }
                if(!empty($_POST['account_number'])){
                    // format for the account number:
                    $account_number = $data_clean_up->test_input('/^\d{16}$/', $_POST['account_number']);
                    if(empty($account_number)){
                        array_push($this->errors, "<p class='error'>Account number should contain 16 digits. No space or dash required.</p>");
                    }
                }else{
                    array_push($this->errors, "<p class='error'>An account number must be specified.</p>");
                }
                if(!empty($_POST['card_number'])){
                    $card_number = $data_clean_up->test_input('/^\d{16}$/', $_POST['card_number']);
                    if(empty($card_number)){
                        array_push($this->errors, "<p class='error'>card number should contain 16 digits. No space or dash required.</p>");
                    }
                }
                if(!empty($_POST['Shaba_number'])){
                    $shaba = $data_clean_up->test_input('/^IR\d{24}$/', $_POST['shaba_number']);
                    if(empty($shaba)){
                        array_push($this->errors, "<p class='error'>Shaba number should begin with IR followed by 24 digits.</p>");
                    }
                }
                if(!empty($_POST['initial_deposit'])){
                    $initial_deposit = $data_clean_up->test_input('/^\d{1,}$/', $_POST['initial_deposit']);
                    if(empty($initial_deposit)){
                        array_push($this->errors, "<p class='error'>the deposit is not a number.</p>");
                    }
                }
                if(!empty($_POST['descriptions'])){
                    $descriptions = $data_clean_up->test_input('/^[A-Za-z0-9\/, -_=%$@]{1,}$/', $_POST['descriptions']);
                    if(empty($descriptions)){
                        array_push($this->errors, "<p class='error'>allowed characters for description are '/-_=%$@' </p>");
                    }
                }
                if(!empty($_POST['currency'])){
                    $currency = $data_clean_up->test_input('/^[A-Za-z0-9\/, -_=%$@]{1,}$/', $_POST['currency']);
                    if(empty($currency)){
                        array_push($this->errors, "<p class='error'>Currency is not entered correctly.</p>");
                    }
                }else{
                    array_push($this->errors, "<p class='error'>Currency cannot be empty.</p>");
                }

            }
        }
    }
}

if(isset($_POST['add_new_Iranian_account'])){
    $add_new_Iranian_bank_account = new Iranian_bank_account_submit();
}
?>