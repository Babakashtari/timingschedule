<?php
class Bank_photos{
    public $image_directories = [];
    public $country;
    public $substring_positions = [];
    public $last_position = 0;
    
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
        $Arabic_unicodes = 
        ["\u0622", "\u0621", "\u0627", "\u0628", "\u067e", "\u062a", "\u062b", "\u062c", "\u0686", "\u062d", "\u062e", "\u062f", "\u0630", "\u0631", "\u0632", "\u0698", "\u0633", "\u0634", "\u0635", "\u0636", "\u0637", "\u0638", "\u0639", "\u063A", "\u0641", "\u0642", "\u06a9", "\u06af", "\u0644", "\u0645", "\u0648", "\u0647", "\u0649", "\u0626", "\u0646", "\u06cc"];
        $Persian_characters = ["آ", "ء", "ا", "ب", "پ", "ت", "ث", "ج", "چ", "ح", "خ", "د", "ذ", "ر", "ز", "ژ", "س", "ش", "ص", "ض", "ط", "ذ", "ع", "غ", "ف", "ق", "ک", "گ", "ل", "م", "و", "ه", "ی", "ئ", "ن", "ی"];
        // decoding unicoded Persian alphabet:
        if(!empty($images_array)){
                for($i = 0 ; $i<count($Arabic_unicodes); $i++){
                    // check if the unicoded letter is found in the string:
                    if(strpos($images_array, $Arabic_unicodes[$i]) !== false){
                       $images_array = str_replace($Arabic_unicodes[$i], $Persian_characters[$i], $images_array);
                    }                    
                }
            }
        echo "<p class='directories displayNone' >" . $images_array . "</p>";
    }
}


?>