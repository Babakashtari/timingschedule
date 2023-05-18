<?php

class Get_IP {
  public static $IP;
  static function get_IP_address() {
    if(isset($_SERVER['HTTP_CLIENT_IP'])){
      self::$IP = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
      self::$IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }elseif(isset($_SERVER['HTTP_X_FORWARDED'])){
      self::$IP = $_SERVER['HTTP_X_FORWARDED'];
    }elseif(isset($_SERVER['HTTP_FORWARDED_FOR'])){
      self::$IP = $_SERVER['HTTP_FORWARDED_FOR'];
    }elseif(isset($_SERVER['HTTP_FORWARDED'])){
      self::$IP = $_SERVER['HTTP_FORWARDED'];
    }elseif(isset($_SERVER['REMOTE_ADDR'])){
      self::$IP = $_SERVER['REMOTE_ADDR'];
    }else{
      self::$IP = "UNKNOWN";
    }
    return self::$IP;
  }  
}

// getting the IP address:
// $IP = Get_IP::get_IP_address();
// while working offline via localhost:
$IP = "2.191.190.141";




class User_location {
    public $IP_address;
    public $city;
    public $country;

    function __construct($IP){
        $this->user_IP = $IP;
    }
    function get_API_link(){
        // the link provided by ipinfodb.com:
        $address_string = "http://api.ipinfodb.com/v3/ip-city/?key=570a33f937e4c0e8d4c4d2cd60fa551dbac771cced1762a1460ac1a1e77d3e6c&ip=";
        $address_string .= $this->user_IP;
        $address_string .= "&format=json";
        return $address_string;
    }
    function get_API_JSON($link){
        return file_get_contents($link);
    }
    function decode_JSON_object($JSON){
        return json_decode($JSON);
    }
    function parse_php_object($php_obj){
        if($php_obj->statusCode === "OK"){
           $this->IP_address = $php_obj->ipAddress;
           $this->city = $php_obj->cityName;
           $this->country = $php_obj->countryName;
        }else{
            echo "ip not recognized by the API.";
        }
    }
    function get_location(){
      // getting the API link:
      $API_link =  $this->get_API_link();
      // getting the result of the API in JSON Format:
      $JSON_object =  $this->get_API_JSON($API_link);
      // turning the resulting Json file into a php object:
      $PHP_object = $this->decode_JSON_object($JSON_object);
      // extracting city, country and ip of the user:
      $this->parse_php_object($PHP_object);
    }
}

$location = new User_location($IP);
// this gets city, country and ip address of the visitor:
$location->get_location();

?>