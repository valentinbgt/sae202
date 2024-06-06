<?php
    require('proc/db.inc.php');

    $defaultImage = $_SERVER['DOCUMENT_ROOT'] . '/assets/img/default_jardin.webp';

    $image = "";

    if(!empty($_GET["id"])) {
        $id = base64_decode(urldecode($_GET["id"]));
        $jardin = findOne('jardins', 'jardin_id', $id);

        if($jardin) $image = base64_decode($jardin["jardin_picture"]);
    }

    if(empty($image)) $image = file_get_contents($defaultImage);

    header("Content-Type: image/webp; charset=utf-8");

    echo $image;