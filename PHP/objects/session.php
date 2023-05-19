<?php
session_start();
require "user_validation.php";

class Session extends Validation {
    public $username;
    public $location;
    public $IP;
    public $user_ID;
    public $langauge;

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
    function adding_language_to_session(){
        if(substr_count($this->location, "France") > 0){
            $this->langauge = "FR";
        }elseif(substr_count($this->location, "Iran") > 0){
            $this->langauge = "FA";
        }else{
            $this->langauge = "EN";
        }
        $_SESSION['language'] = $this->langauge;
    }
    // 6
    function adding_user_pages_sequence(){
        $post_last_value = end($_POST);
        $post_keys = array_keys($_POST); 
        $post_last_key = end($post_keys);

        if(!isset($_POST['signin']) && !isset($_POST['register'])){
            if(!isset($_SESSION['pages_sequence_keys'])){
                $_SESSION['pages_sequence_keys'] = [];
                $_SESSION['pages_sequence_values'] = [];
                array_push($_SESSION['pages_sequence_keys'], $post_last_key);
                array_push($_SESSION['pages_sequence_values'], $post_last_value);
            }else{
                if(count($_SESSION['pages_sequence_keys']) < 6){
                    // if the user visits the page from a way other than clicking the back button:
                    if(!isset($_POST['back'])){
                        array_push($_SESSION['pages_sequence_keys'], $post_last_key);
                        array_push($_SESSION['pages_sequence_values'], $post_last_value);    
                    }
                // if more than 6 pages were visited by the user: 
                }else{
                    // if the user visits the page from a way other than clicking the back button:
                    if(!isset($_POST['back'])){
                        array_push($_SESSION['pages_sequence_keys'], $post_last_key);
                        array_push($_SESSION['pages_sequence_values'], $post_last_value);
                        // removing from the first element so that the user's website serfing activity won't exceed 6 pages in a row:
                        array_shift($_SESSION['pages_sequence_keys']);
                        array_shift($_SESSION['pages_sequence_values']);    
                    }
                }    
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
            // assinging language to the session:
            $session->adding_language_to_session();
        }
    }
    // adding the current page visit of the user to the pages_sequence:
    if(isset($_SESSION) && !empty($_SESSION) && isset($_POST) && !empty($_POST)){
        // when a user is signed in :
        if(isset($_SESSION['username']) && isset($_SESSION['location']) && isset($_SESSION['IP']) && isset($_SESSION['user_ID'])){
            $add_page_view = new Session($_SESSION['username'], $_SESSION['location'], $_SESSION['IP'], $_SESSION['user_ID']);
            $add_page_view->adding_user_pages_sequence();    
        }
    }
    // if the logout button is clicked by the user:
    if(isset($_POST['kill_session'])){
        // calling the kill_session static method:
        Session::kill_session();
    }
?>