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
            <li>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <button type="submit" name="add_new" value="add_new">
                        <i class="fas fa-plus-square"></i>
                        <!-- <img src="photos/fontawesome/plus-solid.svg" alt="plus"> -->
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