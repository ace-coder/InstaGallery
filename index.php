<?php
@session_start();
//if (!isset($_SESSION['USER_ID']) || $_SESSION['USER_ID'] == '') {
//    header('location:login.php');
//}

if (isset($_SESSION['IN_ACCESS_TOKEN']) && !empty($_SESSION['IN_ACCESS_TOKEN'])) {
    $IN_ACCESS_TOKEN = $_SESSION['IN_ACCESS_TOKEN'];
}

if (isset($_SESSION['IN_USER_ID']) && !empty($_SESSION['IN_USER_ID'])) {
    $IN_USER_ID = $_SESSION['IN_USER_ID'];
}
$tag_name = "bangladesh";
$data = array();
if (isset($IN_ACCESS_TOKEN) && isset($IN_USER_ID)) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
//		    CURLOPT_URL => 'https://api.instagram.com/v1/users/' . $IN_USER_ID . '/media/recent/?access_token=' . $IN_ACCESS_TOKEN,
        CURLOPT_URL => 'https://api.instagram.com/v1/tags/' . $tag_name . '/media/recent/?access_token=' . $IN_ACCESS_TOKEN,
        CURLOPT_HEADER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_USERAGENT => 'Codular Sample cURL Request'
    ));

    $Result = curl_exec($curl);
    $Result = json_decode($Result);
    curl_close($curl);
    $data = $Result->data;
}
?>
<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/font-awesome.css">

        <link href="assets/css/style.css" rel="stylesheet">
        <link href="http://fonts.googleapis.com/css?family=Cantata+One%7COpen+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="assets/js/jquery.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/js/scripts.js"></script>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container main_container">
            <div class="row header text-center">
                <p class="col-md-12 ">Add A Feed </p>
            </div>	<!--header-->

            <div class="row">
                <div class="hashtag-search text-center">
                    <form id="" name="tag" action="feed.php" method="GET" class="form-inline">
                        <div class="form-group">
                            <label for="hashtag">Add Your Hashtag</label>
                            <input type="text" name="tag_name" class="form-control"/>
                        </div>
                    </form>
                </div>

            </div>

        </div><!--/main_container-->
    </body>
</html>