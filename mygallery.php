<?php
require_once 'db.php';
$base_url = 'http://localhost/imagegallery/';
@session_start();
$insta_user_id = $_SESSION['IN_USER_ID'];
$user_id = $_SESSION['USER_ID'];

$dbAccess = new DBAccess();
$user_images = $dbAccess->get_where('user_images', '*', array('insta_user_id' => $insta_user_id), false, 'image_order');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>My Image Gallery</title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/font-awesome.css">

        <link href="assets/css/style.css" rel="stylesheet">
        <link href="http://fonts.googleapis.com/css?family=Cantata+One%7COpen+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="assets/js/jquery.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
        <link href="assets/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
        <script src="assets/fancybox/jquery.fancybox.js" type="text/javascript"></script>
        <script type="text/javascript" src="assets/js/scripts.js"></script>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript">
            $(document).ready(function () {
                $(".fancybox").fancybox({
                    openEffect: 'elastic',
                    closeEffect: 'elastic',
                    helpers: {
                        title: {type: 'inside'}
                    }
                });
            });
        </script>
    </head>
    <body>
        <div class="container">
            <p class="text-center"><a href="feed.php">Instagram feed</a></p>

            <ul id="my_gallery">
                <?php foreach ($user_images as $image): ?>
                    <li>
                        <a class="fancybox" rel="gallery1" href="<?php echo $base_url . $image['image_url']; ?>" title="<?php echo $image['insta_text']; ?>">
                            <img src="<?php echo $base_url . $image['image_url']; ?>" alt="">
                        </a>
                        <p>
                            <a href="<?php echo $image['insta_link']; ?>" target="_blank" style="margin-top: 5px;">#<?php echo $image['tag']; ?></a>
                        </p>
                    </li>
                <?php endforeach; ?>

            </ul>
        </div>
    </body>
</html>
