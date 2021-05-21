<?php
if(isset($_POST['delete_bank_account_confirmed'])){
    if(isset($_POST['account_number']) && !empty($_POST['account_number'])){

        $regular_expressions = get_regular_expression($_SESSION['language']);
        global $translation;
        $cleaning = new Data_clean_up();
        $Account_number = $cleaning->test_input($regular_expressions['account_number'], $_POST['account_number']);

        if(!empty($Account_number)){
            require 'PHP/objects/database_connection.php';
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }else{
                $delete_query = "DELETE FROM accounts WHERE Account_number = '$Account_number' ";
                $result = $connection->query($delete_query);
                if($result){
                    ?>
                        <p class="success"><?php echo $translation['delete_bank_account_success']; ?></p>
                        <p class="centered"><a href="index.php"><?php echo $translation['return']; ?></a></p>
                    <?php    
                // if the delete sql is not entered correctly:
                }else{
                    ?>
                    <p class="error"><?php echo $translation['delete_error']; ?></p>
                    <?php
                }
            }
        }else{
            // if the Account number is not valid:
            ?>
            <p class="error"><?php echo $translation['invalid_account_number_error']; ?></p>
            <?php
        }
    }
}

if(isset($_POST['delete_bank_account_confirm'])){
    if(isset($_POST['account_number']) && !empty($_POST['account_number'])){
        $regular_expressions = get_regular_expression($_SESSION['language']);
        global $translation;
        $cleaning = new Data_clean_up();
        $Account_number = $cleaning->test_input($regular_expressions['account_number'], $_POST['account_number']);
        ?>
        <form class="inline" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <input type="hidden" name="account_number" value="<?php echo $Account_number; ?>">
            <p class="centered"><?php echo $translation['delete_confirm_message']; ?></p>
            <p class="centered">
                <a href="index.php"><?php echo $translation['return']; ?></a>
                <button  type="submit" name="delete_bank_account_confirmed" value="delete"> <?php echo $translation['YES'] ?> </button>
            </p>
        </form>
        <?php
    }
}
?>