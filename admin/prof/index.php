<?php
    session_start();

    function errorMsg($msg){
        $_SESSION["errorMsg"] = $msg;
        header("location: ../../");
        die();
    };
    
    define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');
    require_once(DOCUMENT_ROOT . 'profil/inc/db.inc.php');
    
    $db = dbConn();

    $user = findUser("prof");

    if(!$user) {
        $user = findUser("prof@mmi-troyes.fr");
        if(!$user) errorMsg("Utilisateur introuvable.");
    }
    
    extract($user);
    
    $_SESSION["user_id"] = $user_id;
    $_SESSION["user_displayName"] = $user_displayName;
    $_SESSION["user_name"] = $user_name;
    $_SESSION["user_type"] = $user_type;
    
    if(!empty($_SESSION["from"])) $from = urldecode(base64_decode($_SESSION["from"]));
    else $from = "/";

    unset($_SESSION["from"]);

    header("location: $from");