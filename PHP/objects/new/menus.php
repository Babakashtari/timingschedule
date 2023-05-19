<?php

class First_menu{
    function __construct(){
    ?>
        <div class="new">
            <p class="detail"><?php global $translation; echo $translation['first_menu_text']; ?></p>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <button type="submit" name="Business" value="Business"><?php global $translation; echo $translation['business_menu'];  ?></button>
                <button type="submit" name="Events" value="Events"><?php global $translation; echo $translation['timely_Events']; ?></button>
            </form>
        </div>
    <?php

    }
}

class Business {
    function __construct(){
    ?>
        <div class="new">
            <p class="detail"><?php global $translation; echo $translation['business_submenu']; ?></p>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <button type="submit" name="New_accounting_program" value="New_accounting_program"><?php global $translation; echo $translation['New_Accounting_Program']; ?> </button>
                <button type="submit" name="New_bank_account" value="New_bank_account"><?php global $translation; echo $translation['New_Bank_Account']; ?></button>
            </form>
        </div>
    <?php

    }
}

class Bank_account{
    function __construct(){
        ?>
            <div class="new">
                <p class="detail"><?php global $translation; echo $translation['Add_new_bank_account']; ?></p>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <button type="submit" name="Visa" value="Visa_card"><?php global $translation; echo $translation['Visa_card']; ?></button>
                    <button type="submit" name="Master" value="Master"><?php global $translation; echo $translation['Master_Card']; ?></button>
                    <button type="submit" name="Local" value="Local"><?php global $translation; echo $translation['Local_Banks']; ?></button>
                </form>
            </div>
        <?php
    }
}

class local_banks{
    function __construct(){
        ?>
            <div class="new">
                <p class="detail"><?php global $translation; echo $translation['Bank_country']; ?></p>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <button type="submit" name="Iranian_bank_account" value="add_new_Iranian_bank_account"><?php global $translation; echo $translation['Iran']; ?></button>
                    <button type="submit" name="England" value="England"><?php global $translation; echo $translation['England']; ?></button>
                    <button type="submit" name="US" value="US"><?php global $translation; echo $translation['US']; ?></button>
                    <button type="submit" name="Canada" value="Canada"><?php global $translation; echo $translation['Canada']; ?></button>
                    <button type="submit" name="France" value="France"><?php global $translation; echo $translation['France']; ?></button>
                    <button type="submit" name="Norway" value="Norway"><?php global $translation; echo $translation['Norway']; ?></button>
                    <button type="submit" name="China" value="China"><?php global $translation; echo $translation['China']; ?></button>
                    <button type="submit" name="Russian" value="Russian"><?php global $translation; echo $translation['Russia']; ?></button>
                </form>
            </div>
        <?php
    }
}

class Events{
    function __construct(){
    ?>
        <div class="new">
            <p class="detail"><?php global $translation; echo $translation['timely_events_menu']; ?></p>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <button type="submit" name="Educational" value="Educational"><?php global $translation; echo $translation['Educational_Program']; ?></button>
                <button type="submit" name="Iterable_event" value="Iterable_event"><?php global $translation; echo $translation['Iterable_Program']; ?></button>
                <button type="submit" name="Single_event" value="Single_event"><?php global $translation; echo $translation['Single_Event_Reminder']; ?></button>
            </form>
        </div>
    <?php

    }
}

// first menu:
if(isset($_POST['add_new'])){
    // if user is not logged in and tries to add a new program:
    if(!isset($_SESSION['username'])){
        ?>
            <p class='error'><?php echo $translation['add_new_program_error']; ?></p>
        <?php
    }else{
        $First_menu = new First_menu();
    }
// if business menu is requested:
}elseif(isset($_POST['Business'])){
    $new_business = new Business();

// if add bank account menu is selected:
}elseif(isset($_POST['New_bank_account'])){
    $new_account = new Bank_account();

// if local bank account is selected:
}elseif(isset($_POST['Local'])){
    $local_banks_list = new local_banks();

// if an Iranian bank account is selected:
}elseif(isset($_POST['Iranian_bank_account'])){
    require "PHP/objects/new/bank_accounts/new_bank_added.php";
    require "PHP/objects/new/bank_accounts/local/add_Iranian_bank_account.php";
}elseif(isset($_POST['Events'])){
    $edd_new_event = new Events();
// if an iterable event is selected:
}elseif(isset($_POST['Iterable_event'])){
    require "PHP/objects/new/timely_events/new_iterable_event.php";
}


?>