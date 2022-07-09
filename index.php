<?php require "PHP/objects/regex.php"; ?>

<?php require "PHP/objects/data_clean_up.php"; ?>
<?php require "PHP/objects/session.php"; ?>
<?php require "PHP/login_signin_check.php"; ?>
<?php require "PHP/objects/new/bank_accounts/load_bank_accounts_select_options.php"; ?>

<?php require "PHP/languages/French.php"; ?>
<?php require "PHP/languages/English.php"; ?>
<?php require "PHP/languages/Persian.php"; ?>
<?php require "PHP/languages/change_language.php"; ?>

<?php echo "POST array includes: "; print_r($_POST); echo "<br>"; ?>
<?php echo "SESSION array includes: "; print_r($_SESSION); echo "<br><br><br>"; ?>
<?php if(isset($_SESSION['location'])){echo $_SESSION['location']; } ?>

<!-- <?php echo "POST array keys are:"; print_r(array_keys($_POST)); echo "<br>" ?> -->

<!-- <?php 
    $post_keys = array_keys($_POST); 
    $last_name = end($post_keys);
    echo $last_name; 
?> -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="photos/clock_icon.png" type="image/x-icon">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <?php if(isset($_SESSION['language']) && $_SESSION['language'] === "FA"){?><link rel="stylesheet" href="CSS/index_farsi.css"><?php }else{ ?><link rel="stylesheet" href="CSS/index.css"> <?php } ?>
    <?php if(isset($_SESSION['language']) && $_SESSION['language'] === "FA"){?><link rel="stylesheet" href="CSS/user_validation_farsi.css"><?php }else{ ?><link rel="stylesheet" href="CSS/user_validation.css"> <?php } ?>
    <?php if(isset($_SESSION['language']) && $_SESSION['language'] === "FA"){?><link rel="stylesheet" href="CSS/header_farsi.css"><?php }else{ ?><link rel="stylesheet" href="CSS/header.css"> <?php } ?>
    <?php if(isset($_SESSION['language']) && $_SESSION['language'] === "FA"){?><link rel="stylesheet" href="CSS/main_farsi.css"><?php }else{ ?><link rel="stylesheet" href="CSS/main.css"> <?php } ?>
    <?php if(isset($_SESSION['language']) && $_SESSION['language'] === "FA"){?><link rel="stylesheet" href="CSS/signin_farsi.css"><?php }else{?><link rel="stylesheet" href="CSS/signin.css"> <?php } ?>
    <?php if(isset($_SESSION['language']) && $_SESSION['language'] === "FA"){?><link rel="stylesheet" href="CSS/register_farsi.css"><?php }else{?><link rel="stylesheet" href="CSS/register.css"> <?php } ?>
    <?php if(isset($_SESSION['language']) && $_SESSION['language'] === "FA"){?><link rel="stylesheet" href="CSS/new_programs_farsi.css"><?php }else{?><link rel="stylesheet" href="CSS/new_programs.css"> <?php } ?>
    <?php if(isset($_SESSION['language']) && $_SESSION['language'] === "FA"){?><link rel="stylesheet" href="CSS/add_new_program_farsi.css"><?php }else{?><link rel="stylesheet" href="CSS/add_new_program.css"> <?php } ?>
    <?php if(isset($_POST['Iranian_bank_account']) || isset($_POST['edit_bank_account'])){ ?>    <link rel="stylesheet" href="CSS/iranian_new_bank_account.css"> <?php } ?>
    <?php if((isset($_POST['signin']) && $_POST['signin'] === "signed_in") || (!isset($_POST) || empty($_POST) && isset($_SESSION) && !empty($_SESSION['user_ID']))){ if(isset($_SESSION['language']) && $_SESSION['language'] === "FA"){ ?><link rel="stylesheet" href="CSS/homepage_reports.css"> <?php }else{ ?> <link rel="stylesheet" href="CSS/homepage_reports.css">  <?php }  } ?>
    <?php if(isset($_POST['delete_bank_account_confirm'])){ if(isset($_SESSION['language']) && $_SESSION['language'] === "FA"){ ?> <link rel="stylesheet" href="CSS/homepage_reports.css"> <link rel="stylesheet" href="CSS/delete_bank_account_farsi.css"> <?php }else{ ?> <link rel="stylesheet" href="CSS/homepage_reports.css"> <link rel="stylesheet" href="CSS/delete_bank_account.css"> <?php } } ?>
    <title><?php echo $translation['title']; ?></title>
</head>
<body >
    <!-- top time and date -->
    <?php require "PHP/header.php" ?>
    <main>
        <!-- top welcome text: -->
        <?php require "PHP/welcome.php"; ?>
        <!-- top of the forms validation errors: -->
        <?php require "PHP/user_validation_messages.php"; ?>
        <!-- new programs: -->
        <?php require "PHP/objects/new/menus.php"; ?>
        <!-- top of the login form email validation check -->
        <?php require "PHP/objects/email_activation_validation.php"; ?>
        <!-- sign in form: -->
        <?php require "PHP/signin.php"; ?>
        <!-- registration form: -->
        <?php require "PHP/register.php"; ?>
        <?php require "PHP/objects/homepage_reports.php"; ?>
        <?php require "PHP/objects/delete_bank_account.php"; ?>
        <?php require "PHP/objects/edit_bank_account.php"; ?>
        <?php require "PHP/objects/bank_account_edit_result.php"; ?>
    </main>
    <footer>
    
    </footer>
    <!-- loading scripts conditionally: -->
    <script src="javascript/langauge_choose.js"></script>
    <?php if(isset($_POST['Iterable_event'])){ ?><script src="javascript/iterable_event.js"></script><?php } ?>
    <?php if(isset($_POST['Iranian_bank_account'])){ ?><script src="javascript/new_bank_account.js"></script> <?php } ?>
    <?php if(isset($_POST['edit_bank_account'])){ ?><script src="javascript/edit_bank_account.js"></script> <?php } ?>
    <?php if(isset($_POST['Iranian_bank_account']) || isset($_POST['edit_bank_account'])){?><script src="javascript/bank_images.js"></script>  <?php } ?>
    <?php if(isset($_POST['edit_bank_account']) && isset($_POST['Country']) && $_POST['Country'] === "Iran"){ ?> <script src="javascript/Persian_card_number_seperator_non_input.js"></script> <?php } ?>
    <?php if(isset($_POST['Iranian_bank_account']) || (isset($_POST['edit_bank_account']) && isset($_POST['Country']) && $_POST['Country'] === "Iran")){ ?><script src="javascript/Persian_card_number_seperator.js"></script><?php } ?>

    <?php if(isset($_POST['Iranian_bank_account']) || isset($_POST['edit_bank_account'])){ ?><script src="javascript/number_formater.js"></script><?php } ?>
    <?php if(isset($reports_page) && isset($_SESSION['language']) && $_SESSION['language'] === "FA"){ ?><script src="javascript/Persian_number_formater_non_input.js"></script> <?php } ?>
</body>
</html>