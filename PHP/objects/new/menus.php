<?php

class First_menu{
    function __construct(){
    ?>
        <div class="new">
            <p class="detail">Please choose what you would like to set up:</p>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <button type="submit" name="Business" value="Business">Business Related</button>
                <button type="submit" name="Events" value="Events">Timely Events</button>
            </form>
        </div>
    <?php

    }
}

class Business {
    function __construct(){
    ?>
        <div class="new">
            <p class="detail">Please choose what business details you would like to add:</p>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <button type="submit" name="New_accounting_program" value="New_accounting_program">New Accounting Program </button>
                <button type="submit" name="New_bank_account" value="New_bank_account">New Bank Account</button>
            </form>
        </div>
    <?php

    }
}

class Bank_account{
    function __construct(){
        ?>
            <div class="new">
                <p class="detail">Please choose what sort of bank account you would like to add:</p>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <button type="submit" name="Visa" value="Visa_card">Visa Card</button>
                    <button type="submit" name="Master" value="Master">Master Card</button>
                    <button type="submit" name="Local" value="Local">Local Banks</button>
                </form>
            </div>
        <?php
    }
}

class local_banks{
    function __construct(){
        ?>
            <div class="new">
                <p class="detail">Please choose what sort of bank account you would like to add:</p>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <button type="submit" name="Iranian_bank_account" value="add_new_Iranian_bank_account">Iran</button>
                    <button type="submit" name="England" value="England">England</button>
                    <button type="submit" name="US" value="US">US</button>
                    <button type="submit" name="Canada" value="Canada">Canada</button>
                    <button type="submit" name="France" value="France">France</button>
                    <button type="submit" name="Norway" value="Norway">Norway</button>
                    <button type="submit" name="China" value="China">China</button>
                    <button type="submit" name="Russian" value="Russian">Russian</button>

                </form>
            </div>
        <?php
    }
}

class Events{
    function __construct(){
    ?>
        <div class="new">
            <p class="detail">Please choose from the following the program you would like to add:</p>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <button type="submit" name="Educational" value="Educational">Educational Program</button>
                <button type="submit" name="Single_event" value="Single_event">Single Event Reminder</button>
                <button type="submit" name="Iterable_event" value="Iterable_event">Iterable Program</button>
            </form>
        </div>
    <?php

    }
}

// first menu:
if(isset($_POST['add_new'])){
    // if user is not logged in and tries to add a new program:
    if(!isset($_SESSION['username'])){
        echo "<p class='error'>You must login first to add a new program.</p>";
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