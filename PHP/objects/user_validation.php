<?php 

    require "users.php";

    // validating input fields and finding/displaying of errors:
    class Validation extends User{
        public $IP_address;
        public $errors=[];
    
        function email_validation(){
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
            // if(isset($_POST['register']) && $_POST['register'] === "registered"){
                $this->username_validation();
                $this->password_validation();
                $this->email_validation();    
            // }
        }
        // if there was at least an error while validating the form:
        function get_errors(){
            if($this->errors){
                return $this->errors;
            }
        }
    }   

    // in case of a register attempt:
    if(isset($_POST['register']) && $_POST['register'] === "registered"){
        $user = new Validation($_POST['username'], $_POST['email'], $_POST['password']);
        $user->registration_validation();

        // echo $user->username . "<br>" . $user->password . "<br>" . $user->email . "<br>" . $user->IP; 

        require "database_connection";
        // check_connection
        if($connection->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }else{
            echo "successfully connected";
        }
    }
    // in case of a sigin attempt:
    if(isset($_POST['signin']) && $_POST['signin'] === "signed_in"){
        $user = new validation($_POST['username'], null, $_POST['password']);
        $user->signin_validation();
        
        require "location.php";
        $user->IP_address = $location->IP_address;
        // echo $user->username . "<br>" . $user->password . "<br>" . $user->IP_address; 
    }
?>