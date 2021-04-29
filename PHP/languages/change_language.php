<?php
if(isset($_POST['language'])){
    $language_selected_by_user = $_POST['language'];
    $checking = new Data_clean_up();
    $language_selected_by_user = $checking->test_input('/^FA|EN|FR$/', $language_selected_by_user);
    echo "the selected language by the user is :" . $language_selected_by_user;
    if(!empty($language_selected_by_user)){
        // setting the language chosen by the user for the website:
        $_SESSION['language'] = $language_selected_by_user;
        // reloading so that the session language change takes effect:
        $homepage = htmlspecialchars($_SERVER['PHP_SELF']);
        header("Location: $homepage");
    }else{
        echo "language input chosen by the user is not valid!!!";
    }
}
?>