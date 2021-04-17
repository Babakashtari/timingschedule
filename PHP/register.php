<?php
// $need_register is handled from login_signin_check.php
if(!isset($_SESSION['username']) && $need_register){
    ?>
    <div class="register">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <fieldset>
                <legend>Register Here:</legend>
                <div>
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" placeholder="mike">
                </div>
                <div>
                    <label for="email">Email:</label>
                    <input type="text" name="email" id="email" placeholder="mike66@gmail.com">
                </div>
                <div>
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password">
                </div>
                <div>
                    <button type="submit" name="register" value="registered">Register</button>
                </div>
                <div>
                    <p>Already a member? 
                        <button type="submit" name="signin" value="signin">Login here</button>
                    </p>
                </div>
            </fieldset>
        </form>
    </div>
    <?php
}
?>

