<?php 
        // when someone enters the website for the first time or 
        if(!isset($_SESSION['username'])){
            $need_register = false;
            $need_signin = true;  
        }
        // when someone requests to register form from the signin form:
        if  (isset($_POST['register']) && $_POST['register'] == "register"){
            $need_register = true;
            $need_signin = false;  
        }
        // if someone just registered and now needs to signin:
        elseif(isset($_POST['register']) && $_POST['register'] == "registered"){
            // if there was no validation errors:
            if(empty($user->get_errors())){
                $need_register = false;
                $need_signin = true;     
            // if there was at least one validation error: 
            }else{
                $need_register = true;
                $need_signin = false;     
            }
        }
        // if a signin attempt has occured: 
        elseif(isset($_POST['signin'])){
            // when the user clicks the signin button from a register form:
            if($_POST['signin'] == "signin"){
                $need_register = false;
                $need_signin = true;    
            // when a user successfully signs in:       
            }elseif($_POST['signin'] == "signed_in"){
                // if there was no validation errors:
                if(empty($user->get_errors())){
                    $need_register = false;
                    $need_signin = false;
                // if there was at least one validation error:    
                }else{
                    $need_register = false;
                    $need_signin = true;
                }
            }
        }
    
?>
