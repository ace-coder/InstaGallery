<?php

require_once 'db.php';

if (isset($_REQUEST['add'])) {
    $user_id = $_SESSION['user_id'];
    $image_url = '';
    $image_order = 1;
    $fields = array(
        'user_id' => $user_id,
        'image_url' => $image_order,
        'image_order' => $image_order
    );
    $image_id = insert('user_images', $fields);
}
?>