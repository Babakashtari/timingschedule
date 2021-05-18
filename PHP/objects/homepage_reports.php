<?php
// show reports when a user logs into his/her homepage:
if(!isset($_POST) || empty($_POST)){
    ?>
        <div class="reports_container">
            <section class="bank_accounts_container">
                <h1>Your Accounts:</h1>
                <div class="account-container">
                    <?php
                        require "database_connection.php";
                        if ($connection->connect_error) {
                            die("Connection failed: " . $connection->connect_error);
                        }else{
                            $user_ID = $_SESSION['user_ID'];
                            $get_banks_query = "SELECT accounts.Account_number, accounts.Card_number, accounts.Balance, accounts.Description, banks.logo_path FROM accounts INNER JOIN banks ON accounts.Bank_ID = banks.Bank_ID WHERE accounts.User_ID = '$user_ID'";

                        }
                    ?>
                    <table>
                        <tr>
                            <th rowspan="2">
                                <!-- edit and delete buttons: -->
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                    <button type="submit" name="bank_account" value="edit">
                                         <i class="fas fa-edit"></i> 
                                    </button>

                                    <button type="submit" name="bank_account" value="delete">
                                         <i class="fas fa-trash-alt"></i> 
                                    </button>
                                </form>
                            </th>
                            <th rowspan="2"><img src="photos/Bank_photos/Iranian_banks/Saderat.png" alt="تصویر بانک"></th>
                            <th>Account Number:</th>
                            <th>Card Number:</th>
                            <th>Balance:</th>
                            <th>Descriptions:</th>
                        </tr>
                        <tr>
                            <td>0207486370008</td>
                            <td>6037 6915 7925 4897</td>
                            <td>7,464,390</td>
                            <td>حساب اصلی من در بانک صادرات</td>
                        </tr>
                    </table>




                </div>
            </section>
        </div>

    <?php


}
?>