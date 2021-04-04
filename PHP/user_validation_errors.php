<?php
    ?>
    <div class="errors">
    <?php

    // if there was an attempt to signin or signup by the user, check for errors: 
    if(
        (isset($_POST['register']) && $_POST['register'] === "registered")
        ||
        (isset($_POST['signin']) && $_POST['signin'] === "signed_in")
    ){
        if(!empty($user->get_errors())){
            foreach ($user->get_errors() as $error ) {
                echo $error;
            }    
        }            
    }
    ?>
    </div>
    <?php
?>