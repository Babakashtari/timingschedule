<?php
?>
    <header>
    <nav>
        <ul class="logo-container">
            <li class="logo">
                <a href="index.php"><img src="photos/clock_icon.png" alt="clock logo" ></a> 
            </li>
            <li class="logo-text">
                <a href="index.php">Timing Schedule</a>
            </li>
        </ul>
        <ul>
            <?php
                // if a user had already visited more than 2 pages so that the back button to be active: 
                if(isset($_SESSION['pages_sequence']) && count($_SESSION['pages_sequence']) >=2){ 
                    if(isset($_POST['back'])){
                        array_pop($_SESSION['pages_sequence']);
                    }
                    // returning the keys of the pages_sequence array:
                    $pages_sequence_keys = array_keys($_SESSION['pages_sequence']); 
                    // droping the current key at the end of the pages_sequence_keys array:
                    array_pop($pages_sequence_keys);
                    // returning the previous page key from the end of the pages_sequence keys array:
                    $previous_page_key = end($pages_sequence_keys);

                    // getting the page_sequence values:
                    $pages_sequence_values = $_SESSION['pages_sequence'];
                    // shifting the last element in the values array of page_sequences:
                    array_pop($pages_sequence_values);
                    $previous_page_value = end($pages_sequence_values);    
                    ?>
                        <li>
                            <!-- back button: -->
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                <input type="hidden" name="back">
                                <button type="submit" name="<?php echo $previous_page_key; ?>" value="<?php echo $previous_page_value; ?>">
                                    <i class="fas fa-chevron-circle-left"></i>
                                </button>
                            </form>            
                        </li>
                    <?php
                }
            ?>
            <li>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <button type="submit" name="add_new" value="add_new">
                        <i class="fas fa-plus-square"></i>
                    </button>
                </form>            
            </li>
            <li><a href="index.php"><i class="fas fa-tasks"></i></a></li>
            <li><a href="index.php"><i class="fas fa-home"></i></a></li>
            <!-- login and logout link of the header -->
            <li><form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <?php 
                    // if there is a logged in user:
                    if(isset($_SESSION['username'])){
                        ?>
                            <button type="submit" name="kill_session" value="kill_session"><i class="fas fa-user-alt-slash"></i></button>
                        <?php
                    }else{
                        ?>
                            <button type="submit" name="signin" value="signin"><i class="fas fa-sign-in-alt"></i></button>
                        <?php
                    }
                ?>
                </form>
            </li>
        </ul>
    </nav>
</header>
<?php
?>