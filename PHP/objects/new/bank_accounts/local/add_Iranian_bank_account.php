<?php require 'PHP/objects/add_new_bank_by_users.php'; ?>

    <div class="new_program">
        <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
            <fieldset>
                    <legend>New Iranian Bank Account:</legend>
                    <div id="Bank_name_container">
                        <p class="compulsary">Bank name:</p>
                        <div id="bank_image_container"></div>
                        <select name="Bank_name" id="Bank_name">
                            <option value="">Please select a bank</option>
                            <?php 
                                require 'PHP/objects/database_connection.php';
                                if ($connection->connect_error) {
                                    die("Connection failed: " . $connection->connect_error);
                                }else{
                                    $options_query= " SELECT * FROM banks WHERE Country='Iran' AND Verified='YES' ";
                                    $result = $connection->query($options_query);
                                    if($result->num_rows > 0){
                                        while ($associative_array = $result->fetch_assoc()) {
                                        ?>
                                            <option value="<?php echo $associative_array['Bank_name'] ?>"><?php echo $associative_array['Bank_name'] ?></option>
                                        <?php
                                        }
                                    }
                                    $connection->close();
                                }
                            ?>
                        </select>
                    </div>
                    <div>
                        <span>
                            <label for="add_new_bank">
                                <input type="checkbox" name="add_new_bank" id="add_new_bank"> Not in the list above?
                            </label>
                        </span>
                    </div>
                    <div class="displayNone" id="add_bank">
                        <label class="compulsary" for="new_bank_name">Bank Name:
                            <input  type="text" name="new_bank_name" id="new_bank_name" placeholder="ex: Eghtesade Novin">
                        </label>
                        <label class="compulsary" for="upload_bank_image">Bank Logo:
                            <input type="file" name="uploaded_bank_image" id="uploaded_bank_image">
                        </label>
                        <button type="submit" name="Iranian_bank_account" value="new_bank_submit">Add Bank</button>
                    </div>
                    <div>
                        <label class="compulsary" for="account_holder" id="single_holder">Holder name (real/corporate):
                            <input type="text" name="account_holder" id="account_holder">
                        </label>
                        <span>
                            <label for="corporate">
                                <input type="checkbox" name="corporate" id="corporate" value="YES"> Corporate
                            </label>
                        </span>
                        <span>
                            <label for="multiple">
                                <input type="checkbox" name="multiple" id="multiple" value="multiple_owners"> Multiple owners
                            </label>
                        </span>
                    </div>
                    <div id="multiple_owners_div" class="displayNone">
                        <p class="compulsary">Multiple holders' names:</p>
                            <textarea rows="10" name="account_holders" id="account_holders" placeholder="Seperate names by comma"></textarea>
                    </div>
                    <div>
                        <label for="branch">Branch Name:
                            <input type="text" name="branch" id="branch">
                        </label>
                    </div>
                    <div>
                        <label class="compulsary" for="account_number">Account Number:
                            <input type="text" name="account_number" id="account_number">
                        </label>
                    </div>
                    <div>
                        <label for="card_number">Card Number:
                            <input type="text" name="card_number" id="card_number">
                        </label>
                    </div>
                    <div>
                        <label for="Shaba_number">Account Shaba Number:
                            <input type="text" name="Shaba_number" id="Shaba_number">
                        </label>
                    </div>
                    <div>
                        <label for="Initial_deposit">Initial Deposit:
                            <input type="text" name="Initial_deposit" id="Initial_deposit">
                        </label>
                    </div>

                    <div>
                        <p>Descriptions:</p>                            
                        <textarea name="descriptions" id="descriptions" rows="10" placeholder="type something about this account..."></textarea>
                    </div>

                    <div id="money_amount_container">
                        <p class="compulsary">Choose The Currency Of The Account:</p>
                        <select name="currency" id="currency">
                            <option value="US_Dollar">US Dollars</option>
                            <option value="CA_Dollar">CA Dollars</option>

                            <option value="Euros">Euros</option>
                            <option value="Ir_Rial" selected>Ir Rials</option>
                            <option value="Ir_Toman">Ir Tomans</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" name="add_new_account" value="add_new_account">Add New Account</button>
                    </div>
            </fieldset>
        </form>
    </div>
