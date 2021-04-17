<?php
class Create_token{
    public $token;
    function __construct($x){
        $this->token = $x;
    }
    function get_token(){
        $this->token = str_shuffle($this->token);
        $this->token = substr($this->token, 0, 10);

        return $this->token;
    }
}

?>