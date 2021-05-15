<?php
?>
    <header>
    <nav>
        <ul class="logo-container" >
            <li class="logo">
                <a href="index.php"><img src="photos/clock_icon.png" alt="clock logo" ></a> 
            </li>
            <li class="logo-text">
                <a href="index.php"><?php echo $translation['logo_text']; ?></a>
            </li>
        </ul>
        <ul>
            <li>
                <form id="language_form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <button id="show_language"><i class="fas fa-language"></i></button>
                    <ul id="language_container" class="displayNone">
                        <li>
                            <button type="submit" name="language" value="EN" >EN</button>
                        </li>
                        <li>
                            <button type="submit" name="language" value="FR" >FR</button>
                        </li>
                        <li>
                            <button type="submit" name="language" value="FA" >FA</button>
                        </li>
                    </ul>
                </form>
            </li>

            <?php
                // Generating the back key in the header menu: 
                if(isset($_SESSION['pages_sequence_keys'])){ 
                    // if the user clicked the back button:
                    if(isset($_POST['back'])){
                        array_pop($_SESSION['pages_sequence_keys']);
                        array_pop($_SESSION['pages_sequence_values']);
                    }
                    $number_of_pages_visited = count($_SESSION['pages_sequence_keys']);
                    // if there was at least 2 page visits so that the back button refers the user to the previous page visited:
                    if($number_of_pages_visited > 1){
                        $previous_page_index = $number_of_pages_visited - 2;
                        $previous_page_key = $_SESSION['pages_sequence_keys'][$previous_page_index];
                        $previous_page_value = $_SESSION['pages_sequence_values'][$previous_page_index];
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