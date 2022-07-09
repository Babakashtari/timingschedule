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
        if(!empty($Account_number)){
            ?>
            <div class="reports_container">
                <section class="bank_accounts_container">
                    <h1><?php echo $translation['delete_notification_text']; ?></h1>
                        <div class="account-container">
                            <table>
                                <tr>
                                    <th></th>
                                    <th><?php echo $translation['Account']; ?></th>
                                    <th><?php echo $translation['Card']; ?></th>
                                    <th><?php echo $translation['Balance']; ?></th>
                                </tr>
                                <?php
                                require "database_connection.php";
                                if ($connection->connect_error) {
                                    die("Connection failed: " . $connection->connect_error);
                                }else{
                                    $account_ID = $cleaning->test_input($regular_expressions['account_id'], $_POST['account_ID']);
                                    $get_bank_query = "SELECT accounts.ID, accounts.Account_number, accounts.Card_number, accounts.Balance, banks.Logo_path FROM accounts INNER JOIN banks ON accounts.Bank_ID = banks.Bank_ID WHERE accounts.ID='$account_ID'";
                                    $result = $connection->query($get_bank_query);
                                    if(mysqli_num_rows($result) > 0){
                                        $row = mysqli_fetch_array($result);
                                    ?>
                                        <tr>
                                            <td><img src="<?php echo $row['Logo_path']; ?>" alt="تصویر بانک" width="50px" height="50px"></td>
                                            <td><?php echo $row['Account_number']; ?></td>
                                            <td class="card_number"><?php echo $row['Card_number']; ?></td>
                                            <td><?php echo number_format($row['Balance']); ?></td>
                                        </tr>
                                    <?php
                                    }
                                }
                                ?>
                            </table>
                        </div>
                </section> 
            </div>   
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
}
?>