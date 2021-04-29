<?php
    ?>
    <div class="new_program new_iterable_program">
        <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" style="<?php echo $style['text-align']; ?>">
            <fieldset>
                    <legend><?php echo $translation['New_iterable_event_form_legend']; ?></legend>
                    <div>
                        <label class="compulsary" for="new_iterable_event_name"><?php echo $translation['event_name']; ?></label>
                        <input type="text" name="new_iterable_event_name" id="new_iterable_event_name" placeholder="<?php echo $translation['new_iterable_event_name_placeholder']; ?>">
                    </div>
                    <div>
                        <label class="compulsary" for="duration"><?php echo $translation['duration_of_the_event_label']; ?>
                            <input type="number" name="duration" id="duration">
                        </label>
                        <span>
                            <label for="unknown">
                                <input type="checkbox" name="duration" id="unknown" value="unknown">
                                <?php echo $translation['Unknown']; ?>
                            </label>
                        </span>
                    </div>
                    <div>
                        <span>
                            <p class="compulsary"><?php echo $translation['Detail_of_the_iteration']; ?></p>
                            <label for="daily_selector">
                                <input type="radio" name="iteration" id="daily_selector" value="daily">
                                <?php echo $translation['daily']; ?>
                            </label>
                            <label for="weekly_selector">
                                <input type="radio" name="iteration" id="weekly_selector" value="weekly">
                                <?php echo $translation['weekly']; ?>
                            </label>
                            <label for="monthly_selector">
                                <input type="radio" name="iteration" id="monthly_selector" value="monthly">
                                <?php echo $translation['monthly']; ?>
                            </label>
                            <!-- <label for="annually">annually:</label>
                                <input type="radio" name="iteration" id="annually" value="annually">
                            </label> -->
                        </span>                    
                    </div>
                    <div class="iterator_container" id="daily">
                        <p class="compulsary"><?php echo $translation['daily_label']; ?></p>
                        <span>
                            <label for="morning">
                                <input type="checkbox" name="daily" id="morning" value="morning">
                                <?php echo $translation['Morning']; ?>
                            </label>
                            <label for="midday">
                                <input type="checkbox" name="daily" id="midday" value="midday">
                                <?php echo $translation['Mid-day']; ?>
                            </label>
                            <label for="afternoon">
                                <input type="checkbox" name="daily" id="afternoon" value="afternoon">
                                <?php echo $translation['Afternoon']; ?>
                            </label>
                            <label for="evening">
                                <input type="checkbox" name="daily" id="evening" value="evening">
                                <?php echo $translation['Evening']; ?>
                            </label>
                            <label for="midnight">
                                <input type="checkbox" name="daily" id="midnight" value="midnight">
                                <?php echo $translation['Midnight']; ?>
                            </label>
                        </span>
                    </div>
                    <div class="iterator_container" id="weekly">
                        <p class="compulsary"><?php echo $translation['weekly_label']; ?></p>
                        <?php
                        // begin the week from Saturday if the language is Persian:
                        if(isset($_SESSION['language']) && $_SESSION['language'] === "FA"){
                            ?>
                            <span>
                                <label for="Saturday">
                                    <input type="checkbox" name="weekly" id="Saturday" value="Saturday">
                                    <?php echo $translation['Saturday']; ?>
                                </label>
                                <label for="Sunday">
                                    <input type="checkbox" name="weekly" id="Sunday" value="Sunday">
                                    <?php echo $translation['Sunday']; ?>
                                </label>
                                <label for="Monday">
                                    <input type="checkbox" name="weekly" id="Monday" value="Monday">
                                    <?php echo $translation['Monday']; ?>
                                </label>
                                <label for="Tuesday">
                                    <input type="checkbox" name="weekly" id="Tuesday" value="Tuesday">
                                    <?php echo $translation['Tuesday']; ?>
                                </label>
                                <label for="Wednesday">
                                    <input type="checkbox" name="weekly" id="Wednesday" value="Wednesday">
                                    <?php echo $translation['Wednesday']; ?>
                                </label>
                                <label for="Thursday">
                                    <input type="checkbox" name="weekly" id="Thursday" value="Thursday">
                                    <?php echo $translation['Thursday']; ?>
                                </label>
                                <label for="Friday">
                                    <input type="checkbox" name="weekly" id="Friday" value="Friday">
                                    <?php echo $translation['Friday']; ?>
                                </label>
                            </span>
                            <?php
                        // begin the week from Monday if the language is other than Persian:
                        }else{
                            ?>
                            <span>
                                <label for="Monday">
                                    <input type="checkbox" name="weekly" id="Monday" value="Monday">
                                    <?php echo $translation['Monday']; ?>
                                </label>
                                <label for="Tuesday">
                                    <input type="checkbox" name="weekly" id="Tuesday" value="Tuesday">
                                    <?php echo $translation['Tuesday']; ?>
                                </label>
                                <label for="Wednesday">
                                    <input type="checkbox" name="weekly" id="Wednesday" value="Wednesday">
                                    <?php echo $translation['Wednesday']; ?>
                                </label>
                                <label for="Thursday">
                                    <input type="checkbox" name="weekly" id="Thursday" value="Thursday">
                                    <?php echo $translation['Thursday']; ?>
                                </label>
                                <label for="Friday">
                                    <input type="checkbox" name="weekly" id="Friday" value="Friday">
                                    <?php echo $translation['Friday']; ?>
                                </label>
                                <label for="Saturday">
                                    <input type="checkbox" name="weekly" id="Saturday" value="Saturday">
                                    <?php echo $translation['Saturday']; ?>
                                </label>
                                <label for="Sunday">
                                    <input type="checkbox" name="weekly" id="Sunday" value="Sunday">
                                    <?php echo $translation['Sunday']; ?>
                                </label>
                            </span>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="iterator_container" id="monthly">
                        <p class="compulsary">Please choose the day of the month when the event occurs:</p>
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
                        <label for="amount_of_money_received" class="compulsary">How much do you receive per iteration?
                            <input type="number" name="amount_of_money_received" id="amount_of_money_received">
                        </label>
                        <p class="compulsary">choose your currency:</p>
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
    <?php
?>