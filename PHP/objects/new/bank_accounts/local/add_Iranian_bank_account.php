<?php require 'PHP/objects/add_new_bank_by_users.php'; ?>

    <div class="new_program">
        <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
            <fieldset>
                    <legend>New Iranian Bank Account:</legend>
                    <div id="Bank_name_container">
                        <p>Bank name:</p>
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
                        <label for="new_bank_name">Bank Name:
                            <input type="text" name="new_bank_name" id="new_bank_name" placeholder="ex: Eghtesade Novin">
                        </label>
                        <label for="upload_bank_image">Bank Logo:
                            <input type="file" name="uploaded_bank_image" id="uploaded_bank_image">
                        </label>
                        <button type="submit" name="Iranian_bank_account" value="new_bank_submit">Add Bank</button>
                    </div>
                    <div>
                        <label for="account_holder">Holder name:
                            <input type="text" name="account_holder" id="account_holder">
                        </label>
                        <span>
                            <label for="multiple">
                                <input type="checkbox" name="multiple" id="multiple" value="multiple_owners"> Multiple owners
                            </label>
                        </span>
                    </div>
                    <div id="multiple_owners_div" class="displayNone">
                        <p>Multiple holders' name:</p>
                            <textarea name="account_holders" id="account_holders" placeholder="Seperate names by comma"></textarea>
                    </div>
                    <div>
                        <span>
                            <p>Detail of the iteration:</p>
                            <label for="daily_selector">
                                <input type="radio" name="iteration" id="daily_selector" value="daily">
                                Daily
                            </label>
                            <label for="weekly_selector">
                                <input type="radio" name="iteration" id="weekly_selector" value="weekly">
                                Weekly
                            </label>
                            <label for="monthly_selector">
                                <input type="radio" name="iteration" id="monthly_selector" value="monthly">
                                Monthly
                            </label>
                            <!-- <label for="annually">annually:</label>
                                <input type="radio" name="iteration" id="annually" value="annually">
                            </label> -->
                        </span>                    
                    </div>
                    <div class="iterator_container" id="daily">
                        <p>Please choose the time of the day when the event occurs:</p>
                        <span>
                            <label for="morning">
                                <input type="checkbox" name="daily" id="morning" value="morning">
                                Morning
                            </label>
                            <label for="midday">
                                <input type="checkbox" name="daily" id="midday" value="midday">
                                Mid-day
                            </label>
                            <label for="afternoon">
                                <input type="checkbox" name="daily" id="afternoon" value="afternoon">
                                Afternoon
                            </label>
                            <label for="evening">
                                <input type="checkbox" name="daily" id="evening" value="evening">
                                Evening
                            </label>
                            <label for="midnight">
                                <input type="checkbox" name="daily" id="midnight" value="midnight">
                                Midnight
                            </label>
                        </span>
                    </div>
                    <div class="iterator_container" id="weekly">
                        <p>Please choose the time of the week when the event occurs:</p>
                        <span>
                            <label for="Monday">
                                <input type="checkbox" name="weekly" id="Monday" value="Monday">
                                Monday
                            </label>
                            <label for="Tuesday">
                                <input type="checkbox" name="weekly" id="Tuesday" value="Tuesday">
                                Tuesday
                            </label>
                            <label for="Wednesday">
                                <input type="checkbox" name="weekly" id="Wednesday" value="Wednesday">
                                Wednesday
                            </label>
                            <label for="Thursday">
                                <input type="checkbox" name="weekly" id="Thursday" value="Thursday">
                                Thursday
                            </label>
                            <label for="Friday">
                                <input type="checkbox" name="weekly" id="Friday" value="Friday">
                                Friday
                            </label>
                            <label for="Saturday">
                                <input type="checkbox" name="weekly" id="Saturday" value="Saturday">
                                Saturday
                            </label>
                            <label for="Sunday">
                                <input type="checkbox" name="weekly" id="Sunday" value="Sunday">
                                Sunday
                            </label>
                        </span>
                    </div>
                    <div class="iterator_container" id="monthly">
                        <p>Please choose the day of the month when the event occurs:</p>
                        <span>
                            <?php
                               function add_days_of_the_month(){
                                for($i=1; $i<=31; $i++){
                                    if($i<4){
                                        if($i===1){
                                        ?>
                                            <label for="<?php echo "day_" . $i ; ?>">
                                                <input type="checkbox" name="monthly" id="<?php echo "day_" . $i ; ?>" value="<?php echo $i ; ?>">
                                                <?php echo $i . 'st:'; ?>
                                            </label>    
                                        <?php
                                        }elseif($i===2){
                                        ?>
                                            <label for="<?php echo "day_" . $i ; ?>">
                                                <input type="checkbox" name="monthly" id="<?php echo "day_" . $i ; ?>" value="<?php echo $i ; ?>">
                                                <?php echo $i . 'nd:'; ?>
                                            </label>
                                        <?php
                                        }else{
                                        ?>
                                            <label for="<?php echo "day_" . $i ; ?>">
                                                <input type="checkbox" name="monthly" id="<?php echo "day_" . $i ; ?>" value="<?php echo $i ; ?>">
                                                <?php echo $i . 'rd:'; ?>
                                            </label>
                                        <?php
                                        }
                                    }else{
                                    ?>
                                        <label for="<?php echo "day_" . $i ; ?>">
                                            <input type="checkbox" name="monthly" id="<?php echo "day_" . $i ; ?>" value="<?php echo $i ; ?>">
                                            <?php echo $i . 'th:'; ?>
                                        </label>
                                    <?php
                                    }
                                }
                               }
                               add_days_of_the_month();
                            ?>
                            <p class="displayNone" id="error_message_30_31">Careful, month with less than 30 days may ignore your event iteration</p>
                        </span>
                    </div>
                    <div>
                        <p>Do we need your confirmation after an iteration?</p>
                        <span>
                            <label for="confirmation_YES">
                                <input type="radio" name="confirmation" id="confirmation_YES" value="YES">Yes
                            </label>
                            <label for="confirmation_NO">
                                <input type="radio" name="confirmation" id="confirmation_NO" value="NO">No
                            </label>
                        </span>
                    </div>
                    <div>
                        <p>Do you receive money after an iteration?</p>
                        <span id="money_options">
                            <label for="money_YES">
                                <input type="radio" name="money_confirmation" id="money_YES" value="YES">Yes
                            </label>
                            <label for="money_NO">
                                <input type="radio" name="money_confirmation" id="money_NO" value="NO">No
                            </label>
                        </span>
                    </div>
                    <div class="displayNone" id="money_amount_container">
                        <label for="amount_of_money_received">How much do you receive per iteration?
                            <input type="number" name="amount_of_money_received" id="amount_of_money_received">
                        </label>
                        <p>choose your currency:</p>
                        <select name="currency" id="currency">
                            <option value="US_Dollar">US Dollars</option>
                            <option value="CA_Dollar">CA Dollars</option>

                            <option value="Euros">Euros</option>
                            <option value="Ir_Rial">Ir Rials</option>
                            <option value="Ir_Toman">Ir Tomans</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" name="add_new_iterable_event" value="new_iterable_event_added">Add</button>
                    </div>
            </fieldset>
        </form>
    </div>
