<?php 

require "users.php";
require "PHP/languages/French.php";
require "PHP/languages/English.php";
require "PHP/languages/Persian.php";

    // validating input fields and finding/displaying of errors:
    class Validation extends User{
        
        public $IP_address;
        public $location;
        public $hashed_pass;
        public $token;
        public $user_ID;
        public $success_messages = [];
        public $errors=[];
    
        // 1
        function email_validation(){
            // checking if the cleaned up email input is not empty:
            if(!$this->email){
                global $translation;
                $email_format_error = $translation['email_format_error'];
                array_push($this->errors, "<p class='error'>$email_format_error</p>");
            }
        }
        // 2
        function username_validation(){
            if(!$this->username){
                global $translation;
                $username_format_error = $translation['username_format_error'];
                array_push($this->errors, "<p class='error'>$username_format_error</p>");
            }
        }
        // 3
        function password_validation(){
            if(!$this->password){
                global $translation;
                $password_format_error = $translation['password_format_error'];
                array_push($this->errors,"<p class='error'>$password_format_error</p>");
            }
        }
        // checking if the data is entered correctly for loging in:
        function signin_validation(){
            if(isset($_POST['signin']) && $_POST['signin'] === "signed_in"){
                $this->username_validation();
                $this->password_validation();
                require "database_connection.php";
                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }else{
                    global $translation;
                    // check database:
                    $check_query = "SELECT * FROM users WHERE username='$this->username' ";
                    $result = $connection->query($check_query);
                    $connection->close();
                    // if there was any user registered with the credentials inserted:
                    if($result->num_rows > 0){
                        $associative_array = $result->fetch_assoc();
                        // check if the user has activated his account:
                        if(!empty($associative_array['registry_token'])){
                            // adding dear user dynamically according to the chosen language:
                            if($_SESSION['language'] === "EN"){
                                $dear_user = "Dear <i>$this->username</i> , ";
                            }elseif($_SESSION['language'] === "FR"){
                                $dear_user = "Cher <i>$this->username</i> , ";
                            }else{
                                $dear_user = "<i>$this->username</i> عزیز، ";
                            }

                            $email_activation_error = $translation['email_activation_error'];
                            array_push($this->errors,"<p class='error'>$dear_user $email_activation_error</p>");
                        }else{
                            if(!password_verify($this->password, $associative_array['pass'])){
                                $password_no_match_error = $translation['password_no_match_error'];
                                array_push($this->errors,"<p class='error'>$password_no_match_error</p>");
                            }else{
                                // successfully logged in:
                                // $login_success_message = $translation['login_success_message'];
                                // array_push($this->success_messages, "<p class='success'>$login_success_message</p>");
                                $this->user_ID = $associative_array['ID'];
                                // devoting login credentials to session values are handled directly from Session class in session.php file
                            }    
                        }
                    }else{
                        $no_user_found_error = $translation['no_user_found_error'];
                        array_push($this->errors,"<p class='error'>$no_user_found_error</p>");
                    }
                }    
            }
        }
        // checking if the data is entered correctly for registering:
        function registration_validation(){
            $this->username_validation();
            $this->password_validation();
            $this->email_validation();    

            require "database_connection.php";
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }else{
                global $translation;
                // check the database for dublicate content:
                $check_query = " SELECT * FROM users WHERE username='$this->username' OR email='$this->email' ";
                $result = $connection->query($check_query);
                if($result->num_rows > 0){
                    $associative_array = $result->fetch_assoc();
                    if($associative_array['username'] === $this->username){
                        $user_already_exists_error = $translation['user_already_exists_error'];
                        array_push($this->errors, "<p class='error'>$user_already_exists_error</p>");
                    }
                    if($associative_array['email'] === $this->email){
                        $email_already_exists_error = $translation['email_already_exists_error'];

                        array_push($this->errors, "<p class='error'>$email_already_exists_error</p>");
                    }
                }
                // inserting user data into the database if there was no errors:
                if(empty($this->errors)){
                    // hashing password:
                    $this->hashed_pass = password_hash($this->password, PASSWORD_BCRYPT);

                    // creating a token:
                    require "token.php";
                    $generated_token = new Create_token("0123456789abcdefghijklmnopqrstuvwxyz");
                    $this->token = $generated_token->get_token();

                    $insert_query = "INSERT INTO users (username, pass, email, registry_token) VALUES ('$this->username', '$this->hashed_pass', '$this->email', '$this->token' )";
                    $result = $connection->query($insert_query);
                    $connection->close();

                    if(!$result){
                        $something_went_wrong = $translation['something_went_wrong'];
                        array_push($this->errors, "<p class='error'>$something_went_wrong</p>");
                    }else{
                        if($_SESSION['language'] === "EN"){
                            $dear_user = "Dear <i>$this->username</i>, ";
                            $message_sent_announcement = "A message is sent to <i> $this->email </i>.";
                        }elseif($_SESSION['language'] === "FR"){
                            $dear_user = "Cher <i>$this->username</i>, ";
                            $message_sent_announcement = "Un message est envoyé à <i> $this->email </i>.";
                        }else{
                            $dear_user = "<i>$this->username</i> عزیز، ";
                            $message_sent_announcement = "پیامی به <i> $this->email </i> ارسال شده است.";
                        }
                        $registration_appreciation = $translation['registration_appreciation'];
                        $check_email_request = $translation['check_email_request'];
                        
                        // success message:
                        array_push($this->success_messages, "<p class='success'>$dear_user $registration_appreciation. $message_sent_announcement $check_email_request</p>");

                        // sending verification email:
                        require "email.php";
                        $verification_email = new Send_email();
                        $verification_email->email_activation_message_generator($this->email, $this->username, $this->password, $this->token);
                        $verification_email->send();
                
                    }
                }
            } 
        }
        // if there was at least an error while validating the form:
        // this is called in user_validation_messages.php
        function get_errors(){
            if($this->errors){
                return $this->errors;
            }
        }
        // if the form was successfully validated:
        // this is called in user_validation_messages.php
        function get_success_messages(){
            if($this->success_messages){
                return $this->success_messages;
            }
        }
    }   

    // in case of a register attempt:
    if(isset($_POST['register']) && $_POST['register'] === "registered"){
        $user = new Validation($_POST['username'], $_POST['email'], $_POST['password']);
        $user->registration_validation();
    }
    // in case of a sigin attempt:
    if(isset($_POST['signin']) && $_POST['signin'] === "signed_in"){
        $user = new validation($_POST['username'], null, $_POST['password']);
        $user->signin_validation();
        
        require "location.php";
        $user->IP_address = $location->IP_address;
        $user->location = $location->country;
    }
?>