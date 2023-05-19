<?php

// if actually someone pressed the email link: 
if(isset($_GET['email']) && isset($_GET['code']) && isset($_GET['language'])){

    $email = $_GET['email'];            
    $token = $_GET['code'];
    $language = $_GET['language'];

    $clean_data = new Data_clean_up();
    $cleaned_email = $clean_data->test_email($email);
    $cleaned_language = $clean_data->test_input("/^(EN|FA|FR)$/", $language);
    $cleaned_token = $clean_data->test_input("/^[a-z0-9]{10}$/", $token);

    // if email, token and the input language were in a valid format and not empty:
    if(!empty($cleaned_email) && !empty($cleaned_token) && !empty($cleaned_language)){
      $_SESSION['language'] = $cleaned_language;
      // global $translation; I have to do something here so that in email verification interface, language would be the language of the choice of the user at the moment of registration.
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
                  echo "<p class='success'>{$translation['registration_appreciation']} {$translation['activation_confirmation']}</p>";
                }else{
                  echo "<p class='error'>{$translation['incorrect_token_error']}</p>";
                }
              }else{
                echo "<p class='error'>{$translation['token_activated_before']}</p>";
              }
            }else{
                echo "<p class='error'>{$translation['no_user_found']}</p>";
            }
        }
    }else{
        // the format of token or email is not valid:
        echo "<p class='error'>{$translation['email_token_language_format_error']}</p>";
    }
}
    
?>