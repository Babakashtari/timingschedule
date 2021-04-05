<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require "users.php";

    // validating input fields and finding/displaying of errors:
    class Validation extends User{
        public $IP_address;
        public $location;
        public $hashed_pass;
        public $token;
        public $success_messages = [];
        public $errors=[];
    
        function email_validation(){
            // checking if the cleaned up email input is not empty:
            if(!$this->email){
                array_push($this->errors, "<p class='error'>Your email does not have a valid format.</p>");
            }
        }
        function username_validation(){
            if(!$this->username){
                array_push($this->errors, "<p class='error'>Username should begin with a capital letter and have at least 3 characters.</p>");
            }
        }
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
                    $this->token = "0123456789abcdefghijklmnopqrstuvwxyz";
                    $this->token = str_shuffle($this->token);
                    $this->token = substr($this->token, 0, 10);
                    

                    $insert_query = "INSERT INTO users (username, pass, email, registry_token) VALUES ('$this->username', '$this->hashed_pass', '$this->email', '$this->token' )";
                    $result = $connection->query($insert_query);
                    if(!$result){
                        array_push($this->errors, "<p class='error'>something happened and signin failed.</p>");
                    }else{
                        // success message:
                        array_push($this->success_messages, "<p class='success'>$this->username , thank you for your registering. A message is sent to $this->email. Please check your email and click the link inside it to activate your account. Without activation, you cannot sign in.</p>");

                        // sending verification email:
                        require 'PHPMailer/src/Exception.php';
                        require 'PHPMailer/src/PHPMailer.php';
                        require 'PHPMailer/src/SMTP.php';

                        $to = $this->email;
                        $subject = "Welcome to Timing Schedule";
                        $heading = "<p style='direction:ltr;text-align:left'>Dear $this->username, </p>";
                        $body1 = "<p style='direction:ltr;text-align:left'>Welcome to Timing Schedule. Your account detail is as follows:</p>";
                        $username_text = "<p style='direction:ltr;text-align:left'>username: $this->username</p>";
                        $password_text = "<p style='direction:rtl;text-align:left'>password: $this->password</p>";
                        $body2 = "<p style='direction:ltr;text-align:left'>If you have not registered into our site, there is no need to further action. However, if this was you, please visit the link below to activate your account:</p>";
                        $activation_page_link = "<p><a href ='https://timingschedule.com/emailActivation.php?email=" .$this->email . '&code=' . $this->token. "'>https://timingschedule.com/emailActivation.php?email=" . $this->email . '&code=' . $this->token ."</a></p>";
                        $footer1 = "<p style='direction:ltr;text-align:left'>Yours Sincerely,</p>";
                        $footer2 = "<p style='direction:ltr;text-align:left'>Timing Schedule support team</p>";
                        $message = $heading . $body1 . $username_text . $password_text . $body2 . $activation_page_link . $footer1 . $footer2;
                
                        $mail_config = new PHPMailer(true);
                        try{
                            $mail_config->CharSet = 'UTF-8';
                            $mail_config->isSMTP();
                            $mail_config->Host = "mail.diorhome.ir";
                            $mail_config->SMTPAuth = true;
                            $mail_config->Username = 'info@diorhome.ir';
                            $mail_config->Password = 'joli1366';
                            $mail_config->addAddress($to);
                            $mail_config->Subject = $subject;
                            $mail_config->Body = $message;
                            $mail_config->setFrom('support@timingschedule.ocm', ' Timing Schedule support team');
                            $mail_config->isHTML(true);
                            $mail_config->send();
                        }catch (Exception $e) {
                            echo '<p class="error">There was a problem in sending message.</p>';    
                            echo "Mailer Error: {$mail_config->ErrorInfo}";
                        }   

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

        // echo $user->username . "<br>" . $user->password . "<br>" . $user->email . "<br>" . $user->IP; 

    }
    // in case of a sigin attempt:
    if(isset($_POST['signin']) && $_POST['signin'] === "signed_in"){
        $user = new validation($_POST['username'], null, $_POST['password']);
        $user->signin_validation();
        
        require "location.php";
        $user->IP_address = $location->IP_address;
        $user->location = $location->country;
        // echo $user->username . "<br>" . $user->password . "<br>" . $user->IP_address; 
    }
?>