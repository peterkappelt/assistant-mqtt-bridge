<?php

//include this file before doing session_start or other actions.
//A custom path and longer expiry is necessary

require_once('config.php');

if(!file_exists($session_path)){
    mkdir($session_path, 0700, true);
}
session_save_path($session_path);
ini_set('session.gc_maxlifetime', 31536000); //keep them for one year

?>