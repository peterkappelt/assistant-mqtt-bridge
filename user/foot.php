<?php 
    if(!defined('IS_INCLUDING')){
        header("HTTP/1.0 403 Forbidden");
        die("You do not have permission to access this resource!");
    }

    echo <<<'FOOT'

        <footer class="page-footer blue darken-2">
            <div class="footer-copyright blue darken-1">
                <div class="container">
                    &copy; 2018 Peter Kappelt | Google Assistant to MQTT Bridge
                </div>
            </div>
        </footer>
    </body>
</html>
FOOT;

?>