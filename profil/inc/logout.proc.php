<?php
    if(!empty($_GET["from"])) $from = urldecode(base64_decode($_GET["from"]));
    else $from = "/";

    session_start();
    session_destroy();

    header("location: $from");