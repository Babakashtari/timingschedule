<?php require "PHP/objects/session.php"; ?>
<?php require "PHP/login_signin_check.php"; ?>

<?php echo "POST array includes: "; print_r($_POST); echo "<br>"; ?>
<!-- <?php echo "SESSION array includes: "; print_r($_SESSION); echo "<br><br><br>"; ?> -->
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
    <link rel="stylesheet" href="CSS/index.css">
    <link rel="stylesheet" href="CSS/user_validation.css">
    <link rel="stylesheet" href="CSS/header.css">
    <link rel="stylesheet" href="CSS/main.css">
    <link rel="stylesheet" href="CSS/signin.css">
    <link rel="stylesheet" href="CSS/register.css">
    <link rel="stylesheet" href="CSS/new_programs.css">
    <link rel="stylesheet" href="CSS/add_new_program.css">
    <?php if(isset($_POST['Iranian_bank_account'])){ ?>    <link rel="stylesheet" href="CSS/iranian_new_bank_account.css"> <?php } ?>

    <title>reminder</title>
</head>
<body>
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
    </main>
    <footer>
    
    </footer>
    <!-- loading scripts conditionally: -->
    <?php if(isset($_POST['Iterable_event'])){ ?><script src="javascript/iterable_event.js"></script><?php } ?>
    <?php if(isset($_POST['Iranian_bank_account'])){ ?><script src="javascript/new_bank_account.js"></script> <?php } ?>
    <?php if(isset($_POST['Iranian_bank_account'])){?><script src="javascript/bank_images.js"></script>  <?php } ?>

</body>
</html>