<?php

class Bank_adding extends Data_clean_up{
    public $bank_name;
    public $country;
    public $bank_logo;
    public $logo_directory;

    function __construct($country, $bank_name, $bank_logo, $logo_directory){
        $regular_expressions = get_regular_expression($_SESSION['language']);
        global $translation;
        $this->country = $country;
        $this->bank_name = $bank_name;
        $this->bank_logo = $bank_logo;
        $this->logo_directory = $logo_directory;
        
        // when a user adds a brand-new bank:
        if(!empty($this->bank_name)){
            echo $regular_expressions['bank_name'];
            echo "<br>raw bank name is: " . $this->bank_name;


            $cleaned_bank_name = $this->test_input($regular_expressions['bank_name'], $this->bank_name);
            echo "<br> cleaned bank name is : " . $cleaned_bank_name;
            if(!empty($cleaned_bank_name)){

                $uploader_username = $_SESSION['username'];
                $file = $this->bank_logo;
                $file_name = $file['name'];
                $file_size = $file['size'];
                $file_TMP_name = $file['tmp_name'];
                if(!is_uploaded_file($file_TMP_name)){
                    ?>
                        <p class="error"><?php echo $translation['image_required_error']; ?></p>
                    <?php
                }else{
                    $name_array = explode('.', $file_name);
                    // check the format of the image:
                    $file_extension = strtolower(end($name_array));
                    $allowed_extensions = ['jpg', 'jpeg', 'png'];
                    // check if the format of the image is allowed:
                    if(!in_array($file_extension, $allowed_extensions)){
                        ?>
                            <p class="error"><?php echo $translation['allowed_image_format_error']; ?></p>
                        <?php
                    }
                    // check if the file size is bellow 500kb:
                    if($file_size> 512000){
                        ?>
                            <p class="error"><?php echo $translation['image_file_size_error']; ?></p>
                        <?php
                    }
                    if(in_array($file_extension, $allowed_extensions) && $file_size<= 512000){
                        require 'PHP/objects/database_connection.php';
                        if ($connection->connect_error) {
                            die("Connection failed: " . $connection->connect_error);
                        }else{
                            // check if the file already exists:
                            $check_bank_database = "SELECT * FROM banks WHERE Bank_name = '$cleaned_bank_name' AND Country='$this->country' LIMIT 1 ";
                            $result = $connection->query($check_bank_database);
                            if($result->num_rows > 0){
                                ?>
                                    <p class="error"><?php echo $translation['doublicate_bank_name_error']; ?></p>
                                <?php
                                $connection->close();
                            // a new bank name is entered:
                            }else{
                                // uploading image to the products folder on server:
                                $file_new_name = $cleaned_bank_name. "." . $file_extension;
                                $file_destination = "photos/Bank_photos/$this->logo_directory/". $file_new_name;
                                move_uploaded_file($file_TMP_name, $file_destination);
                            
                                // check if the uploader is admin:
                                $admin_check = "SELECT administrator FROM users WHERE username = '$uploader_username' ";    
                                $admin_result = $connection->query($admin_check);
                                $associative_array = $admin_result->fetch_assoc();

                                if($associative_array['administrator'] === 'YES'){
                                    $verified = "YES";
                                }else{
                                    $verified = "NO";
                                    ?>
                                        <p class="success"><?php echo $translation['new_bank_added_successfully']; ?></p>
                                    <?php
                                }
                                $insert_query = "INSERT INTO banks (Country, Bank_name, Logo_path, Verified) VALUES ('$this->country', '$cleaned_bank_name', '$file_destination', '$verified')";
                                $connection->query($insert_query);
                                $connection->close();
                                ?>
                                    <p class="success"><?php echo $translation['new_bank_success_message']; ?></p>
                                <?php
                            }
                        }
                    }
                }
            }else{
                ?>
                    <p class="error"><?php echo $translation['bank_name_format_error']; ?></p>
                <?php
            }
        }else{
            ?>
                <p class="error"><?php echo $translation['Bank_name_empty_error']; ?></p>
            <?php    
        }
    }
}

if(isset($_POST['Iranian_bank_account']) && $_POST['Iranian_bank_account'] === "new_bank_submit"){
    $new_Iranian_bank = new Bank_adding("Iran", $_POST['new_bank_name'], $_FILES['uploaded_bank_image'], "Iranian_banks");

}



?>