    <div class="welcome">
        <p> 
            <?php 
                if(isset($_SESSION['username'])){
                    // show dear in greeting section before the name of the user if the language is other than Persian:
                    if(isset($_SESSION['language']) && $_SESSION['language'] != "FA" ){
                        echo $translation['dear']. " ";
                    }
                    ?>
                    <span><?php echo $_SESSION['username']; ?></span>
                    <?php
                    // show comma after the username in case the language is other than Persian:
                    if(isset($_SESSION['language']) && $_SESSION['language'] != "FA" ){
                        echo ", ";
                    }
                    ?>
                    <?php
                    // showing both عزیز and comma after the username in case the language is Persian:  
                    if(isset($_SESSION['language']) && $_SESSION['language'] === "FA"){
                        echo " " . $translation['dear'] . "، ";
                    }
                } 
            ?>
         <?php echo $translation['welcome']; ?></p>
    </div>
