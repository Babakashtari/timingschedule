<?php require "PHP/objects/session.php"; ?>
<?php require "PHP/login_signin_check.php"; ?>

<!-- <?php if(isset($_SESSION)){print_r($_SESSION);} ?> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="photos/clock_icon.png" type="image/x-icon">
    <link rel="stylesheet" href="CSS/index.css">
    <link rel="stylesheet" href="CSS/top_time_and_date.css">
    <link rel="stylesheet" href="CSS/user_validation.css">
    <link rel="stylesheet" href="CSS/header.css">
    <link rel="stylesheet" href="CSS/main.css">
    <link rel="stylesheet" href="CSS/signin.css">
    <link rel="stylesheet" href="CSS/register.css">

    <title>reminder</title>
</head>
<body>
    <!-- top time and date -->
    <?php require "PHP/top_date_and_time.php"; ?>
    <?php require "PHP/header.php" ?>

    <main>
        <!-- top welcome text: -->
        <?php require "PHP/welcome.php"; ?>
        <!-- top of the forms validation errors: -->
        <?php require "PHP/user_validation_messages.php"; ?>
        <!-- sign in form: -->
        <?php require "PHP/signin.php" ?>
        <!-- registration form: -->
        <?php require "PHP/register.php" ?>
    </main>
    <footer>
    
    </footer>
    <script src="javascript/time_and_date.js"></script>
    <!-- <script src="javascript/retrieve_IP.js"></script> -->
</body>
</html>