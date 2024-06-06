<?php
    session_start();

    function errorMsg($msg){
        $_SESSION["errorMsg"] = $msg;
        header("location: ../signup.php");
        die();
    };

    if(empty($_POST["userName"])) errorMsg("Entrez un nom d'utilisateur.");
    if(empty($_POST["userDisplayName"])) errorMsg("Entrez un nom d'affichage.");
    if(empty($_POST["userEmail"])) errorMsg("Renseignez un email.");
    if(empty($_POST["userEmailConfirm"])) errorMsg("Renseignez un Email de confirmation.");
    if(empty($_POST["userPassword"])) errorMsg("Entrez un mot de passe.");
    if(empty($_POST["userPasswordConfirm"])) errorMsg("Entrez un mot de passe valide.");

    extract($_POST);

    if(!preg_match("/^[a-zA-Z0-9\.\-_]*$/", $userName)) errorMsg("Utilisez un nom d'utilisateur valide (lettres, chiffres, ., - et _)");
    $userName = strtolower($userName);

    $userDisplayName = preg_replace("~(?:[\p{M}]{1})([\p{M}])+?~uis", "", $userDisplayName);

    if($userEmail !== $userEmailConfirm) errorMsg("Les emails renseignés ne correspondent pas.");
    if(!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) errorMsg("L'adresse email renseignée n'est pas valide.");

    if($userPassword !== $userPasswordConfirm) errorMsg("Les mots de passe renseignés ne correspondent pas.");
    $userPassword = password_hash($userPassword, PASSWORD_DEFAULT);

    $userProfilePicture = "";
    if(!empty($_FILES["userProfilePicture"]["tmp_name"])){
        $file = $_FILES["userProfilePicture"];

        if(@is_array(getimagesize($file["tmp_name"]))){

            $image = imagewebp(imagecreatefromstring(file_get_contents($file["tmp_name"])), $file["tmp_name"], 0); //convert image to webp

            $userProfilePicture = base64_encode(file_get_contents($file["tmp_name"])); //convert file to base64 string

        } else errorMsg("Le type de fichier sélectionné n'est pas une image.");
    }

    require('db.inc.php');
    $db = dbConn();

    if(findOne('users', 'user_name', $userName) !== false) errorMsg("Ce nom d'utilisateur est déjà pris.") ;
    if(findOne('users', 'user_email', $userEmail) !== false) errorMsg("Cet adresse email est déjà utilisée.") ;

    $sql = "INSERT INTO users(user_name, user_email, user_password, user_displayName, user_profilePicture) VALUES (:username, :useremail, :userpassword, :userdisplayname, :userprofilepicture)";
    $query = $db->prepare($sql);

    $query->bindParam(':username', $userName);
    $query->bindParam(':useremail', $userEmail);
    $query->bindParam(':userpassword', $userPassword);
    $query->bindParam(':userdisplayname', $userDisplayName);
    $query->bindParam(':userprofilepicture', $userProfilePicture);

    $res = $query->execute();
    
    if($res === true){
        $user_info = findOne('users', 'user_email', $userEmail);
        $userId = $user_info["user_id"];
        $userDisplayName = $user_info["user_displayName"];
        $userName = $user_info["user_name"];

        $_SESSION["user_id"] = $userId;
        $_SESSION["user_displayName"] = $userDisplayName;
        $_SESSION["user_name"] = $userName;
        
        if(!empty($_SESSION["from"])) $from = urldecode(base64_decode($_SESSION["from"]));
        else $from = "/";

        unset($_SESSION["from"]);

        header("location: $from");

    }else errorMsg("Une erreur est survenue lors de la création de l'utilisateur.");