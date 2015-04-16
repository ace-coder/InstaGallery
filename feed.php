<?php
require_once 'db.php';
@session_start();
//echo $_SESSION['IN_ACCESS_TOKEN'];
//if (!isset($_SESSION['logged_user']) || $_SESSION['logged_user'] == '') {
//    header('location:login.php');
//}
if (!isset($_SESSION['IN_ACCESS_TOKEN']) || empty($_SESSION['IN_ACCESS_TOKEN'])) {
    header('location:authorize.php');
}

if (isset($_SESSION['IN_ACCESS_TOKEN']) && !empty($_SESSION['IN_ACCESS_TOKEN'])) {
    $IN_ACCESS_TOKEN = $_SESSION['IN_ACCESS_TOKEN'];
}

if (isset($_SESSION['IN_USER_ID']) && !empty($_SESSION['IN_USER_ID'])) {
    $IN_USER_ID = $_SESSION['IN_USER_ID'];
}

$tag_name = $_REQUEST['tag_name'];
//$tag_name = "bangladesh";
$data = array();
if (isset($IN_ACCESS_TOKEN) && isset($IN_USER_ID)) {
    $insta_feedurl = 'https://api.instagram.com/v1/tags/' . $tag_name . '/media/recent/?access_token=' . $IN_ACCESS_TOKEN;
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
//		    CURLOPT_URL => 'https://api.instagram.com/v1/users/' . $IN_USER_ID . '/media/recent/?access_token=' . $IN_ACCESS_TOKEN,
        CURLOPT_URL => $insta_feedurl,
        CURLOPT_HEADER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_USERAGENT => 'Codular Sample cURL Request'
    ));

    $Result = curl_exec($curl);
    $Result = json_decode($Result);
    curl_close($curl);
    if (isset($Result->data))
        $data = $Result->data;
    $insta_user_id = $_SESSION['IN_USER_ID'];
//    $user_id = $_SESSION['USER_ID'];

    $dbAccess = new DBAccess();
    $user_images = $dbAccess->get_where('user_images', '*', array('insta_user_id' => $insta_user_id));
    $user_insta_images = array();
    $max_order = 1;
    foreach ($user_images as $image) {
        if ($image['image_order'] > $max_order) {
            $max_order = $image['image_order'];
        }
        if (!in_array($image['insta_img_id'], $user_insta_images)) {
            array_push($user_insta_images, $image['insta_img_id']);
        }
    }

//    print_r($data[5]);
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
        <script src="assets/js/underscore.js" type="text/javascript"></script>
        <script type="text/javascript">
            var insta_images = [];
            var assigned_images = [];
            var unassigned_images = [];
            var discarded_images = [];
            var user_insta_images = ["<?php echo implode('","', $user_insta_images); ?>"];
            var insta_feedurl = '<?php echo $insta_feedurl; ?>';
            $(document).ready(function () {
                LoadInstagramFeed(insta_feedurl, 'remove_all');
            });
        </script>
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
                <p class="col-md-12 "> Feed Items</p>
                <a href="mygallery.php">My Gallery</a>
            </div>	<!--header-->
            <div class="row main_menu">
                <div class="col-md-4">
                    <form id="" name="tag" action="feed.php" method="GET" >
                        <input id="tag_name" name="tag_name" class="index_page_search" type="text"  placeholder="&#xF002;" value="<?php echo $tag_name; ?>"/>
                    </form>
                </div>
                <div class="col-md-4 text-center">
                    <p class="refresh_feed" ><a href="">Refresh Feed</a></p>
                </div>
                <div class="col-md-4">
                    <ul id="menu_assign" class="menu_list">
                        <li ><a class="active" href="#unassigned">Unassigned </a></li>
                        <li><a href="#assigned">Assigned </a></li>
                        <li><a href="#discarded">Discarded </a></li>
                    </ul>
                </div>
            </div><!--/main_menu-->
            <div class="row">
                <div class="col-md-7">
                    <ul class="menu_list">
                        <li ><a class="active" href="#">Date </a></li>
                        <li><a href="#">Likes </a></li>
                        <li><a href="#">Comments </a></li>
                    </ul>
                </div>
                <div class="col-md-5 add_url">
                    <ul>
                        <li><i class="fa fa-camera-retro fa-2x">	 </i></li>
                        <li><a href="#">Add by url </a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div id="quick_discard" class="col-md-12 text-center">
                    <h4>Use the quick discard cross to discard images</h4>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12 text-center">

                    <ul class="feed_item">

                        <?php
                        foreach ($data as $image) {

                            $open_modal = 'class=" open_modal"';
                            if (in_array($image->id, $user_insta_images)) {
                                continue;
                            }
                            ?>
                            <li id="<?php echo $image->id; ?>"<?php echo $img_added; ?>>
                                <a class="close_icon text-right remove_inst_img">
                                    <i class="fa fa-times fa-2x "></i>
                                </a>
                                <a href="javascript:void(0);"<?php echo $open_modal; ?>>
                                    <img class="img_inst" src="<?php echo $image->images->thumbnail->url; ?>" alt="" />
                                </a>
                                <div class="like_comment"><i class="fa fa-heart"> <?php echo $image->likes->count; ?> </i> <i class="fa fa-comment"> <?php echo $image->comments->count; ?> </i></div>
                                <input  type="hidden" class="low_resolution"  value="<?php echo $image->images->low_resolution->url; ?>"/>
                                <input  type="hidden" class="standard_resolution" value="<?php echo $image->images->standard_resolution->url; ?>"/>
                                <input  type="hidden" class="insta_link" value="<?php echo $image->link; ?>"/>
                                <input  type="hidden" class="insta_text" value="<?php echo $image->caption->text; ?>"/>
                            </li>

                        <?php } ?>
                    </ul>
                    <div class="load_more">
                        <div id="loading">
                            <img src="assets/images/loading.gif" alt=""/>
                        </div>
                        <a id="load_more_insta" href="javascript:void(0);"> Load More</a>
                        <input type="hidden" id="hfLoadMore" value="<?php echo $Result->pagination->next_url; ?>">
                    </div>
                </div>

            </div>

        </div><!--/main_container-->
        <!-- Modal -->
        <div class="mm_modal modal fade" id="galleryModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <img class="img_inst img-responsive" src="<?php echo $image->images->thumbnail->url; ?>" alt="" />
                            <div class="like_comment"><i class="fa fa-heart"> <?php echo $image->likes->count; ?></i> <i class="fa fa-comment"> <?php echo $image->comments->count; ?></i></div>
                        </div>
                        <div class="col-md-3 text-left add_to_gallery">
                            <p> Add to gallery</p><br />
                            <p>
                                <button type="button" class="addToGallery btn btn-default">Yes</button>
                            </p>
                            <br />
                            <p>
                                <button type="button" class="btn btn-default" data-dismiss="modal" aria-label="Close">No</button>
                            </p>
                            <input  type="hidden" class="insta_user_id"  value="<?php echo $insta_user_id; ?>"/>
                            <input  type="hidden" class="insta_img_id"  value="<?php echo $image->id; ?>"/>
                            <input  type="hidden" class="low_resolution"  value="<?php echo $image->images->low_resolution->url; ?>"/>
                            <input  type="hidden" class="standard_resolution" value="<?php echo $image->images->standard_resolution->url; ?>"/>
                            <input  type="hidden" class="insta_link" value="<?php echo $image->link; ?>"/>
                            <input  type="hidden" class="insta_text" value="<?php echo $image->caption->text; ?>"/>
                        </div>
                        <div class="col-md-5">
                            <p>Priority <small>100 = 1st in gallery, 0 = last</small></p>
                            <input type="number" name="priority" class="form-control priority" value="<?php echo $max_order; ?>"/>
                            <div class="alert alert-success msg_success" role="alert" style="margin-top: 20px;"></div>
                            <div class="alert alert-danger msg_error" role="alert" style="margin-top: 20px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>