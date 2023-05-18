<?php
// $need_signin is handled from login_signin_check.php
if(!isset($_SESSION['username']) && $need_signin){
    ?>
    <div class="signin">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <fieldset>
                <legend><?php echo $translation['sign_in_legend']; ?></legend>
                <div>
                    <label for="username"><?php echo $translation['Username']; ?></label>
                    <input type="text" name="username" id="username" placeholder="mike" value="<?php if(isset($_POST['username'])){echo $_POST['username'];} ?>">
                </div>
                <div>
                    <label for="password"><?php echo $translation['password']; ?></label>
                    <input type="password" name="password" id="password" value="<?php if(isset($_POST['password'])){echo $_POST['password'];} ?>">
                </div>
                <div>
                    <button type="submit" name="signin" value="signed_in"><?php echo $translation['sign_in_submit']; ?></button>
                </div>
                <div>
                    <p><?php echo $translation['Not_a_member']; ?> 
                        <button type="submit" name="register" value="register"><?php echo $translation['Register_here']; ?></button>
                    </p>
                </div>
                <!-- if the user entered here after trying the add new button: -->
                <?php if(isset($_POST['add_new'])){?><input type="hidden" name="add_new" value="add_new"><?php } ?>
            </fieldset>
        </form>
    </div>
    <?php

}
?>
