<?php
    require_once('devices.php');

    //response is always JSON
    header('Content-Type: application/json');

    $request = json_decode(file_get_contents('php://input'), true);

    ob_start();
    var_dump($request);
    error_log(ob_get_clean());

    //check, whether requestId is present
    if(!isset($request['requestId'])){
        errorResponse("", ErrorCode::protocolError, true);
    }

    //check the auth header
    checkAuth($request['requestId']);

    //See https://developers.google.com/actions/smarthome/create-app for information about the JSON request format
    if(!isset($request['inputs'])){
        errorResponse($request['requestId'], ErrorCode::protocolError, true);
        error_log("TEMP: Input not available");
    }

    //handle each input
    foreach($request['inputs'] as $input){
        //intent is not defined -> protocol error
        if(!isset($input['intent'])){
            errorResponse($request['requestId'], ErrorCode::protocolError, true);
        }

        if($input['intent'] == 'action.devices.SYNC'){
            //sync-intent
            handleSync($request['requestId']);
        }else if($input['intent'] == 'action.devices.QUERY'){
            //query-intent
            errorResponse($request['requestId'], ErrorCode::unknownError, true);
        }else if($input['intent'] == 'action.devices.EXECUTE'){
            //execute-intent
            errorResponse($request['requestId'], ErrorCode::unknownError, true);
        }else{
            //unknown intent
            errorResponse($request['requestId'], ErrorCode::protocolError, true);
        }
    }

    /**
     * ----------------------------------------------------------------------------------
     * handling/ helper functions
     * ----------------------------------------------------------------------------------
     */

    /**
     * Check, if the sent Authorization-Header is valid
     */
    function checkAuth($requestid){
        if(isset(getallheaders()['Authorization'])){
            $authkey = getallheaders()['Authorization'];            //Auth header is in format "Bearer <Auth-Key>"
            $authkey = str_replace('Bearer ', '', $authkey);

            session_id($authkey);
            session_start();
            if(!isset($_SESSION['logintime'])){
                errorResponse($requestid, ErrorCode::authExpired, true);
            }
        }else{
            errorResponse($requestid, ErrorCode::authFailure, true);   
        }
    }

    /**
     * Handle the Sync-Intent
     */
    function handleSync($requestid){
        global $devices;

        $response = [
            'requestId' => $requestid,
            'payload' => [
                'devices' => []
            ]
        ];

        foreach($devices as $device){
            $response['payload']['devices'][] = [
                'id' => $device['id'],
                'type' => $device['type'],
                'traits' => $device['traits'],
                'name' => [
                    'defaultNames' => ['Kappelt Virtual Device'],
                    'name' => $device['name'],
                    'nicknames' => $device['nicknames']
                ],
                'willReportState' => false,
                'deviceInfo' => [
                    'manufacturer' => 'Kappelt'
                ]
            ];
        }

        echo json_encode($response);
    }

    //error codes that can be returned
    abstract class ErrorCode{
        const authExpired = "authExpired";
        const authFailure = "authFailure";
        const deviceOffline = "deviceOffline";
        const timeout = "timeout";
        const deviceTurnedOff = "deviceTurnedOff";
        const deviceNotFound = "deviceNotFound";
        const valueOutOfRange = "valueOutOfRange";
        const notSupported = "notSupported";
        const protocolError = "protocolError";
        const unknownError = "unknownError";
    }

    /**
     * Send an error message back
     */
    function errorResponse($requestid, $errorcode, $exit_afterwards = false){
        $error = [
            'requestId' => $requestid,
            'payload' => [
                'errorCode' => $errorcode   
            ]
        ];

        echo json_encode($error);

        if($exit_afterwards){
            exit();
        }
    }
?>