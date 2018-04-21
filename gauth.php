<?php
    //redirect to login form
    //keep all get parameters

    $client_id = isset($_GET['client_id']) ? $_GET['client_id']:'';
    $response_type = isset($_GET['response_type']) ? $_GET['response_type']:'';
    $redirect_uri = isset($_GET['redirect_uri']) ? $_GET['redirect_uri']:'';
    $state = isset($_GET['state']) ? $_GET['state']:'';

    $currentpath = dirname($_SERVER['SCRIPT_NAME']);
    if($currentpath == '/'){
        $currentpath = '';
    }

    $newuri = $currentpath . "/user/login.php?" . 
                        "client_id=$client_id&" .
                        "response_type=$response_type&" . 
                        "redirect_uri=$redirect_uri&" .
                        "state=$state";

    header("Location: $newuri");
?>