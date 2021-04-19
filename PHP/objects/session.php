<?php
session_start();
require "user_validation.php";

class Session extends Validation {
    public $username;
    public $location;
    public $IP;
    public $user_ID;

    function __construct($user, $country, $IP, $user_ID){
        $this->user_ID = $user_ID;
        $this->username = $user;
        $this->location = $country;
        $this->IP = $IP;
    }
    // 1
    function adding_username_to_session(){
        $_SESSION['username'] = $this->username;
    }
    // 2
    function adding_country_to_session(){
        $_SESSION['location'] = $this->location;
    }
    // 3
    function adding_ip_to_session(){
        $_SESSION['IP'] = $this->IP;
    }
    function adding_user_ID_to_session(){
        $_SESSION['user_ID'] = $this->user_ID;
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
            $session = new Session($user->username, $user->location, $user->IP_address, $user->user_ID);

            // assigning the username value to the session:
            $session->adding_username_to_session();
            // assigning location value to the session:
            $session->adding_country_to_session();
            // assigning IP value to the session:
            $session->adding_ip_to_session();
            // assigning user_ID value to the session:
            $session->adding_user_ID_to_session();
        }
    }
    // if the logout button is clicked by the user:
    if(isset($_POST['kill_session'])){
        // calling the kill_session static method:
        Session::kill_session();
    }
?>