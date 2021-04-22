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
    // 4
    function adding_user_ID_to_session(){
        $_SESSION['user_ID'] = $this->user_ID;
    }
    // 5
    function adding_user_pages_sequence(){
        $post_last_value = end($_POST);
        $post_keys = array_keys($_POST); 
        $post_last_key = end($post_keys);

        if(!isset($_SESSION['pages_sequence'])){
            $_SESSION['pages_sequence']['signin'] = "signed_in";
        }else{
            if(count($_SESSION['pages_sequence']) < 6){
                $_SESSION['pages_sequence'][$post_last_key] = $post_last_value;
            }else{
                $_SESSION['pages_sequence'][$post_last_key] = $post_last_value;
                array_shift($_SESSION['pages_sequence']);
            }    
        }


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
    // adding the current page visit of the user to the pages_sequence:
    if(isset($_SESSION) && !empty($_SESSION) && isset($_POST) && !empty($_POST)){
        $add_page_view = new Session($_SESSION['username'], $_SESSION['location'], $_SESSION['IP'], $_SESSION['user_ID']);
        $add_page_view->adding_user_pages_sequence();
    }


    // if the logout button is clicked by the user:
    if(isset($_POST['kill_session'])){
        // calling the kill_session static method:
        Session::kill_session();
    }
?>