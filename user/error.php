<?php
    function error_msg($error, $button = false, $button_text = "", $button_link = ""){
        ?>
<div class="container">
    <div class="row">
        <form class="col s12">
            <div class="card red">
                <div class="card-content white-text">
                    <span class="card-title">Error</span>
                    <p><?php echo($error); ?></p>
                </div>

                <?php if($button){ ?>
                <div class="card-action">
                    <div class="row">
                        <a class="btn waves-effect waves-light right" href="<?php echo $button_link ?>"><?php echo $button_text ?></a>
                    </div>
                </div>
                <?php } ?>

            </div>
        </form>
    </div>
</div>
        <?php

        if(!defined('IS_INCLUDING')){
            define('IS_INCLUDING', true);
        }
        require_once('foot.php');
        exit();
    }
?>