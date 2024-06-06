<?php
    session_start();


    var_dump($_POST);

    function errorMsg($msg){
        $_SESSION["errorMsg"] = $msg;
        header("location: ../signin.php");
        die();
    };

    if(empty($_POST["userIdentifier"])) errorMsg("Entrez un nom d'utilisateur ou une adresse email.");
    if(empty($_POST["userPassword"])) errorMsg("Entrez un mot de passe.");

    extract($_POST);

    $userIdentifier = strtolower($userIdentifier);

    require('db.inc.php');
    $db = dbConn();

    $user = findUser($userIdentifier);

    if(!$user) errorMsg("Utilisateur introuvable.");
    
    $hashedPassword = $user["user_password"];
    
    if(password_verify($userPassword, $hashedPassword)){//vérifier password, si non error msg, si oui, connecter

        extract($user);

        $_SESSION["user_id"] = $user_id;
        $_SESSION["user_displayName"] = $user_displayName;
        $_SESSION["user_name"] = $user_name;
        $_SESSION["user_type"] = $user_type;
        
        if(!empty($_SESSION["from"])) $from = urldecode(base64_decode($_SESSION["from"]));
        else $from = "/";

        unset($_SESSION["from"]);

        header("location: $from");

    }else errorMsg("Mot de passe incorrect.");