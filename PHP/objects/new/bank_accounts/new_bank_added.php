<?php 

// require "PHP/objects/regex.php";

class Iranian_bank_account_submit{
    public $errors = [];
    public $column_values = [];
    public $column_names = [];

    function __construct(){
        require 'PHP/objects/database_connection.php';
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }else{
            if(isset($_POST['Bank_name'])){
                $regular_expressions = get_regular_expression($_SESSION['language']);
                global $translation;
                $bank_id = $_POST['Bank_name'];
                $data_clean_up = new Data_clean_up();
                $bank_id = $data_clean_up->test_input($regular_expressions['bank_id'], $bank_id);
                $check_query = "SELECT Bank_name FROM banks WHERE Bank_ID='$bank_id' ";
                $result = $connection->query($check_query);

                if($result->num_rows > 0){
                    $associative_array = $result->fetch_assoc();
                    $bank_name = $associative_array['Bank_name'];
                    array_push($this->column_names, "Bank_ID");
                    array_push($this->column_values, $bank_id);
                }else{
                    $bank_id_error =  $translation['Bank_ID_error'];
                    array_push($this->errors, "<p class='error'>$bank_id_error</p>");
                }
                if(!empty($_POST['account_holder'])){
                    $account_owner = $data_clean_up->test_input($regular_expressions['account_owner'], $_POST['account_holder']);
                    if(empty($account_owner)){
                        $account_owner_error = $translation['account_owner_error'];
                        array_push($this->errors, "<p class='error'>$account_owner_error</p>");
                    }else{
                        array_push($this->column_names, "Account_owner");
                        array_push($this->column_values, $account_owner);
                    }
                }elseif(!empty($_POST['account_holders'])){
                    $account_owners = $data_clean_up->test_input($regular_expressions['account_owners'], $_POST['account_holders']);
                    if(empty($account_owners)){
                        $multiple_owners_error = $translation['multiple_owners_error'];
                        array_push($this->errors,"<p class='error'>$multiple_owners_error</p>");
                    }else{
                        array_push($this->column_names, "Account_owner");
                        array_push($this->column_values, $account_owners);
                    }
                }else{
                    $minimum_one_owner_error = $translation['minimum_one_owner_error'];
                    array_push($this->errors, "<p class='error'>$minimum_one_owner_error</p>");
                }
                if(isset($_POST['corporate']) && $_POST['corporate'] === "YES"){
                    $corporate = "YES";
                }else{
                    $corporate = "NO";
                }
                array_push($this->column_names, "Corporate");
                array_push($this->column_values, $corporate);

                if(!empty($_POST['branch'])){
                    $branch_name = $data_clean_up->test_input($regular_expressions['branch_name'], $_POST['branch']);
                    if(empty($branch_name)){
                        $branch_name_error = $translation['branch_name_error'];
                        array_push($this->errors,"<p class='error'>$branch_name_error</p>");
                    }else{
                        array_push($this->column_names, "Branch_name");
                        array_push($this->column_values, $branch_name);
                    }
                }
                if(!empty($_POST['account_number'])){
                    // format for the account number:
                    $account_number = $data_clean_up->test_input($regular_expressions['account_number'], $_POST['account_number']);
                    if(empty($account_number)){
                        $account_number_error = $translation['account_number_error'];
                        array_push($this->errors, "<p class='error'>$account_number_error</p>");
                    }else{
                        $account_number_query_check = "SELECT Account_number FROM accounts WHERE Account_number = '$account_number' ";
                        $account_number_query_result = $connection->query($account_number_query_check);
                        if($account_number_query_result->num_rows > 0){
                            $same_account_number_error = $translation['same_account_number_error'];
                            array_push($this->errors, "<p class='error'>$same_account_number_error</p>");
                        }else{
                            array_push($this->column_names, "Account_number");
                            array_push($this->column_values, $account_number);    
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
                        $card_number_format_error = $translation['card_number_format_error'];
                        array_push($this->errors, "<p class='error'>$card_number_format_error</p>");
                    }else{
                        $card_number_query_check = "SELECT Card_number FROM accounts WHERE Card_number = '$card_number' ";
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
                        $shaba_number_query_check = "SELECT Shaba_number FROM accounts WHERE Shaba_number = '$shaba' ";
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
                if(!empty($_POST['Initial_deposit'])){
                    $Balance = str_replace("," , "", $_POST['Initial_deposit']);
                    echo $Balance;
                    $Balance = $data_clean_up->test_input($regular_expressions['initial_deposit'], $Balance);
                    if(empty($Balance)){
                        $deposit_format_error = $translation['deposit_format_error'];
                        array_push($this->errors, "<p class='error'>$deposit_format_error</p>");
                    }else{
                        array_push($this->column_names, "Balance");
                        array_push($this->column_values, $Balance);    
                    }
                }
                if(!empty($_POST['descriptions'])){
                    $descriptions = $data_clean_up->test_input($regular_expressions['descriptions'], $_POST['descriptions']);

                    if(empty($descriptions)){
                        $descriptions_error = $translation['descriptions_error'];
                        array_push($this->errors, "<p class='error'>$descriptions_error</p>");
                    }else{
                        array_push($this->column_names, "Description");
                        array_push($this->column_values, $descriptions);
                    }
                }
                if(!empty($_POST['currency'])){
                    $currency = $data_clean_up->test_input($regular_expressions['currency'], $_POST['currency']);
                    if(empty($currency)){
                        $currency_error = $translation['currency_error'];
                        array_push($this->errors, "<p class='error'>$currency_error</p>");
                    }else{
                        array_push($this->column_names, "Currency_unit");
                        array_push($this->column_values, $currency);
                    }
                }else{
                    $empty_currency = $translation['currency_empty_error'];
                    array_push($this->errors, "<p class='error'>$empty_currency</p>");
                }
                // check to see if there was any errors:
                if(empty($this->errors)){
                    // saving new bank account data to the database:
                    $columns = "";
                    $values = "";

                    for($i = 0 ; $i < count($this->column_names); $i++){
                        $columns .= $this->column_names[$i] . ", ";
                        $values .= "'" . $this->column_values[$i] . "', ";
                    }
                    $columns.= "User_ID";
                    $values .= $_SESSION['user_ID'];

                    $add_query = "INSERT INTO accounts ($columns) VALUES ($values)";
                    $result = $connection->query($add_query);
                    $successfully_added_message = $translation['Account_added_successfully'];
                    echo "<p class='success'>$successfully_added_message</p>";
                }else{
                   foreach ($this->errors as $value) {
                       echo $value;
                   }
                }
            }
            $connection->close();
        }
    }
}

if(isset($_POST['Iranian_bank_account']) && $_POST['Iranian_bank_account'] === "Iranian_bank_account_submit"){
    $add_new_Iranian_bank_account = new Iranian_bank_account_submit();
}
?>