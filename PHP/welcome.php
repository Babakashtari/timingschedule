<?php

?>
    <div class="welcome">
        <p>Dear 
            <?php 
                if(isset($_SESSION['username'])){
                    ?>
                    <span><?php echo $_SESSION['username']; ?>,</span>
                    <?php
                } 
            ?>
         welcome to Timing Schedule.</p>
    </div>

<?php

?>