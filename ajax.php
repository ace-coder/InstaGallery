<?php

require_once "db.php";
if (isset($_POST['addToGallery']) && $_POST['addToGallery'] == true) {
    @session_start();
    $user_id = $_SESSION['USER_ID'];
    $insta_user_id = $_SESSION['IN_USER_ID'];
//    $insta_user_id = $_POST['insta_user_id'];
    $tag = $_POST['tag'];
    $instagram_id = $_POST['insta_id'];
    $insta_link = $_POST['insta_link'];
    $insta_text = $_POST['insta_text'];
    $url = $_POST['url'];
    $priority = $_POST['priority'];
    $save_directory = "./uploads/images/" . date('Y') . '/' . date('m') . '/';
    if (!file_exists($save_directory)) {
        mkdir($save_directory, 0777, true);
        $f = fopen($save_directory . 'index.html', 'w');
        fwrite($f, "Deny");
        fclose($f);
    }
    $save_name = time() . rand(1000, 9999) . '.jpg';
    $save_url = "uploads/images/" . date('Y') . '/' . date('m') . '/' . $save_name;
    if (is_writable($save_directory)) {
        file_put_contents($save_directory . $save_name, file_get_contents($url));

        $image_url = '';
        $image_order = 1;
        $fields = array(
            'user_id' => $user_id,
            'image_url' => $save_url,
            'tag' => $tag,
            'insta_user_id' => $insta_user_id,
            'insta_img_id' => $instagram_id,
            'instagram_url' => $url,
            'insta_link' => $insta_link,
            'insta_text' => $insta_text,
            'image_order' => $priority
        );
        $dbAccess = new DBAccess();
        $image_id = $dbAccess->insert('user_images', $fields);
        echo 'success';
    } else {
        exit("Failed to write to directory $save_directory");
    }
}

if (isset($_REQUEST['load_more']) && isset($_REQUEST['next_url'])) {
    $next_url = $_REQUEST['next_url'];
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $next_url,
        CURLOPT_HEADER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_USERAGENT => 'Codular Sample cURL Request'
    ));

    $Result = curl_exec($curl);
    curl_close($curl);
    print_r($Result);
}
?>