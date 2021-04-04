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
            <li><a href="index.php">Add New</a></li>
            <li><a href="index.php">My Programs</a></li>
            <li><a href="index.php">Reports</a></li>
            <!-- login and logout link of the header -->
            <li><form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <?php 
                    // if there is a logged in user:
                    if(isset($_SESSION['username'])){
                        ?>
                            <button type="submit" name="kill_session" value="kill_session">Logout</button>
                        <?php
                    }else{
                        ?>
                            <button type="submit" name="signin" value="signin">Login</button>
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