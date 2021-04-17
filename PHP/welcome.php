    <div class="welcome">
        <p> 
            <?php 
                if(isset($_SESSION['username'])){
                    ?>
                    Dear <span><?php echo $_SESSION['username']; ?>,</span>
                    <?php
                } 
            ?>
         welcome to Timing Schedule.</p>
    </div>
