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
                global $regular_expressions;
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
                            array_push($this->errors, "<p class='error'>An account with the same account number is already registered.</p>");
                        }else{
                            array_push($this->column_names, "Account_number");
                            array_push($this->column_values, $account_number);    
                        }
                    }
                }else{
                    array_push($this->errors, "<p class='error'>An account number must be specified.</p>");
                }
                if(!empty($_POST['card_number'])){
                    $card_number = $data_clean_up->test_input($regular_expressions['card_number'], $_POST['card_number']);
                    if(empty($card_number)){
                        array_push($this->errors, "<p class='error'>Card number should contain 16 digits. No space or dash required.</p>");
                    }else{
                        $card_number_query_check = "SELECT Card_number FROM accounts WHERE Card_number = '$card_number' ";
                        $card_number_query_result = $connection->query($card_number_query_check);
                        if($card_number_query_result->num_rows > 0){
                            array_push($this->errors, "<p class='error'>The same card number already registered to another account.</p>");
                        }else{
                            array_push($this->column_names, "Card_number");
                            array_push($this->column_values, $card_number);    
                        }
                    }
                }
                if(!empty($_POST['Shaba_number'])){
                    $shaba = $data_clean_up->test_input($regular_expressions['shaba_number'], strtoupper($_POST['Shaba_number']));
                    if(empty($shaba)){
                        array_push($this->errors, "<p class='error'>Shaba number should begin with IR followed by 24 digits.</p>");
                    }else{
                        $shaba_number_query_check = "SELECT Shaba_number FROM accounts WHERE Shaba_number = '$shaba' ";
                        $shaba_number_query_result = $connection->query($shaba_number_query_check);
                        if($shaba_number_query_result->num_rows > 0){
                            array_push($this->errors, "<p class='error'>The same shaba number already registered to another account.</p>");
                        }else{
                            array_push($this->column_names, "Shaba_number");
                            array_push($this->column_values, $shaba);    
                        }
                    }
                }
                if(!empty($_POST['Initial_deposit'])){
                    $initial_deposit = $data_clean_up->test_input($regular_expressions['initial_deposit'], $_POST['Initial_deposit']);
                    if(empty($initial_deposit)){
                        array_push($this->errors, "<p class='error'>The deposit should only be a number.</p>");
                    }else{
                        if($initial_deposit < 0){
                            array_push($this->errors, "<p class='error'>The deposit should be a positive number.</p>");
                        }else{
                            array_push($this->column_names, "Initial_deposit");
                            array_push($this->column_values, $initial_deposit);    
                        }
                    }
                }
                if(!empty($_POST['descriptions'])){
                    $descriptions = $data_clean_up->test_input($regular_expressions['descriptions'], $_POST['descriptions']);
                    if(empty($descriptions)){
                        array_push($this->errors, "<p class='error'>allowed characters for description are '/-_=%$@' </p>");
                    }else{
                        array_push($this->column_names, "Description");
                        array_push($this->column_values, $descriptions);
                    }
                }
                if(!empty($_POST['currency'])){
                    $currency = $data_clean_up->test_input($regular_expressions['currency'], $_POST['currency']);
                    if(empty($currency)){
                        array_push($this->errors, "<p class='error'>Currency is not entered correctly.</p>");
                    }else{
                        array_push($this->column_names, "Currency_unit");
                        array_push($this->column_values, $currency);
                    }
                }else{
                    array_push($this->errors, "<p class='error'>Currency cannot be empty.</p>");
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
                    echo "<br>" . $add_query . "<br>";
                    $result = $connection->query($add_query);
                    echo "<p class='success'>Account added successfully.</p>";

                    // echo $add_query;
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