<?php
if($need_signin){
    ?>
    <div class="signin">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <fieldset>
                <legend>Sign in Here:</legend>
                <div>
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" placeholder="mike">
                </div>
                <div>
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password">
                </div>
                <div>
                    <button type="submit" name="signin" value="signed_in">sign in</button>
                </div>
                <div>
                    <p>Not a member? 
                        <button type="submit" name="register" value="register">Register here</button>
                    </p>
                </div>
            </fieldset>
        </form>
    </div>
    <?php

}
?>
