<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    //global includes: header and error routines
    define('IS_INCLUDING', true);
    require_once('head.php');
    require_once('error.php');
    require_once('../config.php');

    //See https://developers.google.com/actions/identity/oauth2-implicit-flow for auth info
    //check parameters provided by Google
    //1. check the provided google clientid:
    $client_id = isset($_GET['client_id']) ? $_GET['client_id']:'';
    if($client_id != $google_clientid){
        error_msg('Invalid Client ID has been provided!');
    }
    //2. Check response type, should always be token
    $response_type = isset($_GET['response_type']) ? $_GET['response_type']:'';
    if($response_type != "token"){
        error_msg('Unknown Response Type requested!');
    }
    //3. Check redirect_uri. It is always https://oauth-redirect.googleusercontent.com/r/YOUR_PROJECT_ID
    $redirect_uri = isset($_GET['redirect_uri']) ? $_GET['redirect_uri']:'';
    if($redirect_uri != ('https://oauth-redirect.googleusercontent.com/r/' . $google_projectid)){
        error_msg('Invalid Redirect-Request!');
    }
    //4. check if a state is defined
    $state = isset($_GET['state']) ? $_GET['state']:'';
    if($state == ''){
        error_msg('No State given!');
    }

    // echo($_SERVER["SCRIPT_NAME"] . "?client_id=$client_id&response_type=$response_type&redirect_uri=$redirect_uri&state=$state")

    var_dump(getallheaders());
    //start session handling
    session_start();

    if(isset($_SESSION['logintime'])){
        //user is already logged in. Redirect immediatly
        $sessionid = session_id();
        header("Location: $redirect_uri#access_token=$sessionid&token_type=bearer&state=$state");
    }

    if(isset($_POST['accesskey'])){
        //accesskey is defined. That means, that the user already pressed the "Login" button
        
        if($_POST['accesskey'] == $accesskey){
            $_SESSION['logintime'] = time();

            $sessionid = session_id();
            header("Location: $redirect_uri#access_token=$sessionid&token_type=bearer&state=$state");
        }else{
            error_msg('Access Key is wrong!', true, 'Back to Login', $currentpath . "?client_id=$client_id&response_type=$response_type&redirect_uri=$redirect_uri&state=$state");
        }
    }

?>

<div class="container">
    <div class="row">
        <form class="col s12" method="POST" action="#">
            <div class="card blue darken-1">
                <div class="card-content white-text">
                    <span class="card-title">Login</span>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="accesskey" name="accesskey" placeholder="Access Key" type="password" class="validate">
                            <label class="white-text" for="accesskey">Access Key</label>
                        </div>
                    </div>
                </div>
                <div class="card-action">
                    <div class="row">
                        <button class="btn waves-effect waves-light right" type="submit">Login <i class="material-icons right">vpn_key</i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
    require_once('foot.php');
?>