<?php

@session_start();
$IN_REDIRECT_URI = "http://localhost/ImageGallery/authorize.php";

$IN_CLIENT_ID = 'ffe69b8cfb784a2cb5c79407be33e389';
$IN_CLIENT_SECRET = 'da8db3942d8f4a3eb8d04d832c989a36';
$IN_ACCESS_TOKEN = '';
$IN_USER_ID = '';
if ($_SESSION['IN_ACCESS_TOKEN']) {
    $IN_ACCESS_TOKEN = $_SESSION['IN_ACCESS_TOKEN'];
}
if ($_SESSION['IN_USER_ID']) {
    $IN_USER_ID = $_SESSION['IN_USER_ID'];
}



if ($IN_ACCESS_TOKEN == '' || $IN_USER_ID == '') {


    if (isset($_REQUEST['code'])) {
        $code = $_REQUEST['code'];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'https://api.instagram.com/oauth/access_token',
            CURLOPT_HEADER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_USERAGENT => 'Codular Sample cURL Request',
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => array(
                'code' => $code,
                'client_id' => $IN_CLIENT_ID,
                'client_secret' => $IN_CLIENT_SECRET,
                'redirect_uri' => $IN_REDIRECT_URI,
                'grant_type' => 'authorization_code'
            )
        ));

        $AuthenticationResult = curl_exec($curl);
        $AuthenticationResult = json_decode($AuthenticationResult);

        curl_close($curl);

        $IN_ACCESS_TOKEN = $AuthenticationResult->access_token;
        $IN_USER_ID = $AuthenticationResult->user->id;
        $_SESSION['IN_ACCESS_TOKEN'] = $IN_ACCESS_TOKEN;
        $_SESSION['IN_USER_ID'] = $IN_USER_ID;
        header('location:index.php');
    } else {
        $url = "https://api.instagram.com/oauth/authorize/?client_id=$IN_CLIENT_ID&redirect_uri=$IN_REDIRECT_URI&response_type=code";
        header("location:$url");
    }
}
?>