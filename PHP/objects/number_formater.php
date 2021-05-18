<?php
require "data_clean_up.php";

if(isset($_GET['number_value'])){

    $cleaning_the_number = new Data_clean_up();
    $cleaned_number = $cleaning_the_number->test_input('/\d*/' ,$_GET['number_value']);
    echo number_format($cleaned_number);
}

?>