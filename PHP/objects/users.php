<?php 

require "data_clean_up.php";

class User extends Data_clean_up{
    public $username;
    public $email;
    public $password;
  
    function __construct($user, $mail, $pass) {
      $this->username = $this->test_input("/^[A-Z][a-z0-9]{2,}$/", $user);
      $this->email = $this->test_email($mail);
      $this->password = $this->test_input("/^[a-zA-Z0-9]{5,15}$/", $pass);
    }
    function get_username() {
      return $this->username;
    }
    function get_email() {
      return $this->email;
    }
    function get_password() {
      return $this->password;
    }
}

?>