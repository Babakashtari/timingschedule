<?php
// show reports when a user logs into his/her homepage:
if((isset($_POST['signin']) && $_POST['signin'] === "signed_in" && isset($_SESSION) && !empty($_SESSION['user_ID'])) || (!isset($_POST) || empty($_POST) && isset($_SESSION) && !empty($_SESSION['user_ID']))){
    $reports_page = true;
    ?>
        <div class="reports_container">
            <section class="bank_accounts_container">
                <h1><?php echo $translation['Your_Accounts']; ?></h1>
                <div class="account-container">
                    <table>
                        <tr>
                            <th></th>
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
                                $user_ID = $_SESSION['user_ID'];
                                $get_banks_query = "SELECT accounts.Account_number, accounts.Card_number, accounts.Balance, banks.logo_path FROM accounts INNER JOIN banks ON accounts.Bank_ID = banks.Bank_ID WHERE accounts.User_ID='$user_ID'";
                                $result = $connection->query($get_banks_query);

                                while($row = mysqli_fetch_array($result)){
                                    ?>
                                    <tr>
                                        <td>
                                            <!-- edit and delete buttons: -->
                                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                                <button  type="submit" name="bank_account" value="edit">
                                                    <i class="fas fa-edit"></i> 
                                                </button>
                                                <button type="submit" name="bank_account" value="delete">
                                                    <i class="fas fa-trash-alt"></i> 
                                                </button>
                                            </form>
                                        </td>
                                        <td><img src="<?php echo $row['logo_path']; ?>" alt="تصویر بانک"></td>
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

    <?php


}
?>