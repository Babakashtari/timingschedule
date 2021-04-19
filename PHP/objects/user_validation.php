<?php 

require "users.php";

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
                array_push($this->errors, "<p class='error'>Your email does not have a valid format.</p>");
            }
        }
        // 2
        function username_validation(){
            if(!$this->username){
                array_push($this->errors, "<p class='error'>Username should begin with a capital letter and have at least 3 characters.</p>");
            }
        }
        // 3
        function password_validation(){
            if(!$this->password){
                array_push($this->errors,"<p class='error'>Password should only contain lowercase, upercase and numbers and have at least 5 to 15 characters.</p>");
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
                    // check database:
                    $check_query = "SELECT * FROM users WHERE username='$this->username' ";
                    $result = $connection->query($check_query);
                    $connection->close();
                    // if there was any user registered with the credentials inserted:
                    if($result->num_rows > 0){
                        $associative_array = $result->fetch_assoc();
                        // check if the user has activated his account:
                        if(!empty($associative_array['registry_token'])){
                            array_push($this->errors,"<p class='error'>Dear <i>$this->username</i> , You have not activated your account yet. Please visit your email.</p>");
                        }else{
                            if(!password_verify($this->password, $associative_array['pass'])){
                                array_push($this->errors,"<p class='error'>Your password does not match. Please retry.</p>");
                            }else{
                                // successfully logged in:
                                array_push($this->success_messages, "<p class='success'>Congradulations, you have successfully logged in.</p>");
                                $this->user_ID = $associative_array['ID'];
                                // devoting login credentials to session values are handled directly from Session class in session.php file
                            }    
                        }
                    }else{
                        array_push($this->errors,"<p class='error'>No registered user found with the username you entered.</p>");
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
                // check the database for dublicate content:
                $check_query = " SELECT * FROM users WHERE username='$this->username' OR email='$this->email' ";
                $result = $connection->query($check_query);
                if($result->num_rows > 0){
                    $associative_array = $result->fetch_assoc();
                    if($associative_array['username'] === $this->username){
                        array_push($this->errors, "<p class='error'>Username already exists. Please choose another one.</p>");
                    }
                    if($associative_array['email'] === $this->email){
                        array_push($this->errors, "<p class='error'>Email already exists. Please choose another one.</p>");
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
                        array_push($this->errors, "<p class='error'>something happened and signin failed.</p>");
                    }else{
                        // success message:
                        array_push($this->success_messages, "<p class='success'>Dear <i> $this->username </i>, thank you for your registration. A message is sent to <i> $this->email </i>. Please check your email and click the link inside it to activate your account. Without activation, you cannot sign in.</p>");

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