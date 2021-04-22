<?php
class Bank_photos{
    public $image_directories = [];
    public $country;

    function __construct($country){
        $this->country = $country;

        require "PHP/objects/database_connection.php";
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }else{
            $get_bank_images_query = "SELECT Logo_path FROM banks WHERE Country = '$this->country' ";
            $result = $connection->query($get_bank_images_query);

            while ($associative_array = $result->fetch_assoc()){
                array_push($this->image_directories, $associative_array['Logo_path']);
            }
        }
    }

    function get_image_directories(){
        $images_array = json_encode($this->image_directories);
        echo "<p class='directories displayNone' >" . $images_array . "</p>";
    }
}


?>