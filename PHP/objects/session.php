<?php
    
session_start();

require "user_validation.php";

class Session extends Validation {
    public $username;

    function __construct($data){
        $this->username = $data;
    }
    function adding_username_to_session(){
        $_SESSION['username'] = $this->username;
    }
    // static is used to call the function directly without any instance of the class:
    static function kill_session(){
        session_destroy();
        header("Location: index.php");
    }
}
    // after a successful validation in case of a login:
    if(isset($_POST['signin']) && $_POST['signin'] === "signed_in"){
        if(empty($user->get_errors())){
            $session = new Session($user->username);

            // assigning the username value to the session:
            $session->adding_username_to_session();
        }
    }
    // if the logout button is clicked by the user:
    if(isset($_POST['kill_session'])){
        // calling the kill_session static method:
        Session::kill_session();

    }
?>