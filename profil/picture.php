<?php
    require('inc/db.inc.php');

    $defaultImage = $_SERVER['DOCUMENT_ROOT'] . '/assets/img/default_user.webp';

    $image = "";

    if(!empty($_GET["user"])) {
        $user = findOne('users', 'user_name', $_GET["user"]);

        if($user) $image = base64_decode($user["user_profilePicture"]);
    }

    if(empty($image)) $image = file_get_contents($defaultImage);

    header("Content-Type: image/webp; charset=utf-8");

    echo $image;