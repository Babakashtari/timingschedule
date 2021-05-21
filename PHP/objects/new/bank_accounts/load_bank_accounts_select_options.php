<?php

class load_banks{
    function __construct(){
        require "PHP/objects/database_connection.php";
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }else{
            global $translation;
            ?>
            <p class="compulsary"><?php echo $translation['choose_bank_account']; ?></p>
            <?php
            $user_ID = $_SESSION['user_ID'];
            $get_accounts_query = "SELECT accounts.ID, accounts.Account_number, banks.logo_path FROM accounts INNER JOIN banks ON accounts.Bank_ID = banks.Bank_ID WHERE accounts.User_ID='$user_ID'";
            $result = $connection->query($get_accounts_query);
            if(mysqli_num_rows($result) > 0){
                ?>
                    <table>
                <?php
                while($row = mysqli_fetch_array($result)){
                ?>
                        <tr>
                            <td>
                                <input type="radio" name="bank_account" value="<?php echo $row["ID"]; ?>">
                            </td>
                            <td><img src="<?php echo $row['logo_path']; ?>" alt="تصویر بانک"></td>
                            <td><?php echo $row['Account_number']; ?></td>
                        </tr>
                <?php
                }  
                ?>
                    </table>
                <?php  
            // if there was no bank account added by the user:
            }else{
                ?>
                    <p class="error" ><?php echo $translation['no_accounts_yet_error']; ?></p>
                    <button class="no_bank_account_yet" type="submit" name="New_bank_account" value="New_bank_account"><?php echo $translation['open_bank_account']; ?></button>
                <?php
            }
    
        }
    }
}

?>