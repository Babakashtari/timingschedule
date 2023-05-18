<?php
// $need_register is handled from login_signin_check.php
if(!isset($_SESSION['username']) && $need_register){
    ?>
    <div class="register">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <fieldset>
                <legend><?php echo $translation['Register_Here_legend']; ?></legend>
                <div>
                    <label for="username"><?php echo $translation['Username']; ?></label>
                    <input type="text" name="username" id="username" placeholder="mike" value="<?php if(isset($_POST['username'])){echo $_POST['username'];} ?>">
                </div>
                <div>
                    <label for="email"><?php echo $translation['Email']; ?></label>
                    <input type="text" name="email" id="email" placeholder="mike66@gmail.com" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>">
                </div>
                <div>
                    <label for="password"><?php echo $translation['password']; ?></label>
                    <input type="password" name="password" id="password" value="<?php if(isset($_POST['password'])){echo $_POST['password'];} ?>">
                </div>
                <div>
                    <button type="submit" name="register" value="registered"><?php echo $translation['Register_submit']; ?></button>
                </div>
                <div>
                    <p><?php echo $translation['Already_a_member']; ?>
                        <button type="submit" name="signin" value="signin"><?php echo $translation['Login_here']; ?></button>
                    </p>
                </div>
            </fieldset>
        </form>
    </div>
    <?php
}
?>

