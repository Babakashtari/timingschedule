<?php
if(isset($_POST['edit_bank_account'])){
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
                $get_bank_info_query = "SELECT * FROM accounts INNER JOIN banks ON accounts.Bank_ID = banks.Bank_ID WHERE accounts.Account_number = '$Account_number'";
                $bank_info = $connection->query($get_bank_info_query);

                if($bank_info->num_rows > 0){
                    $bank_info_array = $bank_info->fetch_assoc();
                    $country = $bank_info_array['Country'];
                    $Bank_ID = $bank_info_array['Bank_ID'];
                    $account_owner = $bank_info_array['Account_owner'];
                    $corporate = $bank_info_array['Corporate'];
                    $branch = $bank_info_array['Branch_name'];
                    $card_number = $bank_info_array['Card_number'];
                    $shaba = $bank_info_array['Shaba_number'];
                    $balance = $bank_info_array['Balance'];
                    $Description = $bank_info_array['Description'];
                    $multiple_owners = $bank_info_array['Multiple_owners'];
                    ?>
                    <div class="new_program">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                            <fieldset>
                                <legend><?php echo $translation['Edit_bank_account_form_legend']; ?></legend>
                                <div id="Bank_name_container">
                                    <p class="compulsary"><?php echo $translation['Bank_name']; ?></p>
                                    <div id="bank_image_container">
                                        <img src="" width="100%" height="100%">
                                        <?php 
                                            require "PHP/objects/bank_images_generator.php";
                                            if(isset($_POST['Iranian_bank_account']) || isset($_POST['edit_bank_account'])){
                                                $Iranian_bank_images = new Bank_photos($country);
                                                $Iranian_bank_images->get_image_directories();
                                            }       
                                        ?>
                                    </div>
                                    <select name="Bank_name" id="Bank_name">
                                    <!-- <option value="">Please select a bank</option> -->
                                    <?php
                                    $options_query= " SELECT * FROM banks WHERE Country='$country' AND Verified='YES' ";
                                    $result = $connection->query($options_query);
                                    if($result->num_rows > 0){
                                        while ($associative_array = $result->fetch_assoc()) {
                                        ?>
                                            <option value="<?php echo $associative_array['Bank_ID'] ?>" <?php if(isset($Bank_ID) && $Bank_ID === $associative_array['Bank_ID']){ echo "selected";} ?> ><?php echo $associative_array['Bank_name'] ?></option>
                                        <?php
                                        }
                                    }
                                    $connection->close();
                                        ?>
                                    </select>
                                </div>
                                <div class="displayNone" id="add_bank">
                                    <label class="compulsary" for="new_bank_name"><?php echo $translation['Bank_name']; ?>
                                        <input  type="text" name="new_bank_name" id="new_bank_name" placeholder="<?php echo $translation['Bank_name_placeholder']; ?>" value="<?php if(isset($_POST['new_bank_name'])){echo $_POST['new_bank_name'];} ?>">
                                    </label>
                                    <label class="compulsary" for="upload_bank_image"><?php echo $translation['Bank_Logo']; ?>
                                        <input type="file" name="uploaded_bank_image" id="uploaded_bank_image">
                                    </label>
                                    <button type="submit" name="Iranian_bank_account" value="new_bank_submit"><?php echo $translation['Add_Bank_submit']; ?></button>
                                </div>
                                <div>
                                    <label class="compulsary" for="account_holder" id="single_holder"><?php echo $translation['Holder_name_label']; ?>
                                        <input type="text" name="account_holder" id="account_holder" placeholder="<?php echo $translation['Holder_name_placeholder']; ?>" value="<?php if(isset($account_owner)){echo $account_owner; } ?>">
                                    </label>
                                    <span>
                                        <label for="corporate">
                                            <input type="checkbox" name="corporate" id="corporate" value="YES" <?php if(isset($corporate) && $corporate === "YES"){ echo "checked"; } ?> > <?php echo $translation['Corporate_label']; ?> 
                                        </label>
                                    </span>
                                    <span>
                                        <label for="multiple_owners">
                                            <input type="checkbox" name="multiple_owners" id="multiple_owners" value="YES" <?php if(isset($multiple_owners)){ echo "checked"; } ?> > <?php echo $translation['Multiple_owners']; ?>
                                        </label>
                                    </span>
                                </div>
                                <div id="multiple_owners_div" class="displayNone">
                                    <p class="compulsary"><?php echo $translation['multiple_owners_label']; ?></p>
                                    <textarea rows="10" name="account_holders" id="account_holders" placeholder="<?php echo $translation['multiple_owners_placeholder']; ?>"><?php if(isset($account_owner)){echo $account_owner; } ?></textarea>
                                </div>
                                <div>
                                    <label for="branch"><?php echo $translation['Branch_name_label']; ?>
                                        <input type="text" name="branch" id="branch" value="<?php if(isset($branch)){echo $branch;} ?>" placeholder="<?php echo $translation['Branch_name_placeholder']; ?>">
                                    </label>
                                </div>
                                <div>
                                    <label class="compulsary" for="account_number"><?php echo $translation['Account_Number_label']; ?>
                                        <input type="text" name="account_number" id="account_number" value="<?php if(isset($Account_number)){echo $Account_number;} ?>" placeholder="<?php echo $translation['Account_number_placeholder']; ?>">
                                    </label>
                                </div>
                                <div>
                                    <label for="card_number"><?php echo $translation['Card_number_label']; ?>
                                        <input type="text" name="card_number" class="card_number" value="<?php if(isset($card_number)){echo $card_number;} ?>" placeholder="<?php echo $translation['Card_number_placeholder']; ?>" >
                                    </label>
                                </div>
                                <div>
                                    <label for="Shaba_number"><?php echo $translation['Shaba_number_label']; ?>
                                        <input type="text" name="Shaba_number" id="Shaba_number" value="<?php if(isset($shaba)){echo $shaba;} ?>" placeholder="<?php echo $translation['Shaba_number_placeholder']; ?>">
                                    </label>
                                </div>
                                <div>
                                    <label for="Initial_deposit"><?php echo $translation['Initial_Deposit_label']; ?>
                                        <input type="text" class="numerical_value" name="Initial_deposit" id="Initial_deposit" value="<?php if(isset($balance)){ echo number_format($balance); } ?>" placeholder="<?php echo $translation['Initial_deposit_placeholder']; ?>">
                                    </label>
                                </div>
                                <div>
                                    <p><?php echo $translation['Descriptions_label']; ?></p>                            
                                    <textarea name="descriptions" id="descriptions" rows="10" placeholder="<?php echo $translation['Descriptions_placeholder']; ?>" ><?php if(isset($Description)){echo $Description;} ?></textarea>
                                </div>
                                <div id="money_amount_container">
                                    <p class="compulsary"><?php echo $translation['currency_label']; ?></p>
                                    <select name="currency" id="currency">
                                        <option value="US_Dollar"><?php echo $translation['US_Dollars']; ?></option>
                                        <option value="CA_Dollar"><?php echo $translation["CA_Dollars"]; ?></option>
                                        <option value="Euros"><?php echo $translation['Euros']; ?></option>
                                        <!-- this value is selected as this is where an Iranian bank account is added: -->
                                        <option value="Ir_Rial" selected><?php echo $translation['Ir_Rials']; ?></option>
                                        <option value="Ir_Toman"><?php echo $translation['Ir_Tomans']; ?></option>
                                    </select>
                                </div>
                                <div>
                                    <button type="submit" name="bank_account_edited" value="bank_account_edited"><?php echo $translation['modify_account']; ?></button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <?php
                }else{
                    ?>
                        <p class="error"><?php echo $translation['invalid_account_number_error'] ?></p>
                    <?php
                }
            }
        }
    }
}

?>