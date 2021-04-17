<?php

// if actually someone pressed the email link: 
if(isset($_GET['email']) && isset($_GET['code'])){

    $email = $_GET['email'];            
    $token = $_GET['code'];

    $clean_data = new Data_clean_up();
    $cleaned_email = $clean_data->test_email($email);
    $cleaned_token = $clean_data->test_input("/^[a-z0-9]{10}$/", $token);

    // if both email and token are in a valid format and not empty:
    if(!empty($cleaned_email) && !empty($cleaned_token)){
        // echo "<p class='success'>Both email and token are valid</p>";
        require "database_connection.php";
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }else{
            // checking if the email and token both exist in the database:
            $check_query= "SELECT * FROM users WHERE email='$cleaned_email' ";
            $result = $connection->query($check_query);
            // if at least a result was found:
            if($result->num_rows > 0){
              $associative_array = $result->fetch_assoc();
              if(!empty($associative_array['registry_token'])){
                if($associative_array['registry_token'] === $cleaned_token){
                  // deleting token:
                  $delete_query = "UPDATE users SET registry_token=NULL WHERE email='$cleaned_email'";
                  $result = $connection->query($delete_query);
                  echo "<p class='success'>Thank you for registration. Your account is now activated and you can login here:</p>";
                }else{
                  echo "<p class='error'> Incorrect token inserted.</p>";
                }
              }else{
                echo "<p class='error'> You have already activated your account.</p>";
              }
            }else{
                echo "<p class='error'>No user found with your credentials.</p>";
            }
        }
    }else{
        // the format of token or email is not valid:
        echo "<p class='error'>Email or Token are not in a valid format.</p>";
    }
}
    
?>