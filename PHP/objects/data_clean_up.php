<?php


class Data_clean_up {
  // cleaning user inputs:
  function test_input($regex, $data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if (preg_match($regex,$data)) {
      return $data;
    }else{
      return $data = null;
    }
  }

  // cleaning user email:
  function test_email($data){
    if(filter_var($data, FILTER_VALIDATE_EMAIL)){
      return $data;
    }else{
      return $data = null;
    }
  }
}
  
?>