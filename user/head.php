<?php 
    if(!defined('IS_INCLUDING')){
        header("HTTP/1.0 403 Forbidden");
        die("You do not have permission to access this resource!");
    }

    ini_set("session.use_cookies", 1);
    ini_set("session.use_only_cookies", 1);
    ini_set("session.use_trans_sid", 0);
    ini_set("session.cache_limiter", "");

    $currentpath = dirname($_SERVER['SCRIPT_NAME']);
    if($currentpath == '/'){
        $currentpath = '';
    }

    echo <<<'HEAD'
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Kappelt Google Assistant to MQTT Bridge</title>
    
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    </head>
    <body>

HEAD;

?>