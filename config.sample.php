<?php
    //a key that you use in the webinterface to login into this service
    //Use a longer key, you usually only need to enter it once
    $accesskey = "myAccessKey";

    //the Client ID you've entered in the Google Actions Console
    $google_clientid = 'GoogleClientID';

    //Google Project ID is shown in the "Settings" in the Google Actions Console.
    //It usually consists of your project name and some Hex-Number, for example "kappelt-smarthome-eb8cd"
    $google_projectid = 'kappelt-smarthome-eb8cd';

    //MQTT broker settings
    $mqtt_server = "mqtt1.int.kappelt.net"
    $mqtt_port = 1883;
    //leave username and password empty if it is not required
    $mqtt_username = "";
    $mqtt_password = "";
?>