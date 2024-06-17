<?php
    session_start();

    function errorMsg($msg){
        $_SESSION["errorMsg"] = $msg;
        header("location: ./");
        die();
    };

    if(empty($_SESSION["user_id"])){
        header("location: /profil/signin.php?from=" . $from);
        die;
    }
    $userId = $_SESSION['user_id'];

    require('inc/db.inc.php');
    $db = dbConn();

    $user = findOne('users', 'user_id', $userId);
    extract($user);

    extract($_POST);

    if(!empty($profilNewPassword)){
        
        if(password_verify($profilCurrentPassword, $user_password)){
            
            if($profilNewPassword === $profilConfirmPassword){
                
                $newHash = password_hash($profilNewPassword, PASSWORD_DEFAULT);

                echo "Il faut change rle mote de passe en $newHash";/* DEV */

            }else errorMsg("Les deux mots de passe ne correspondent pas.");

        }else errorMsg("Le mot de passe fournit est incorrect.");
    }

    var_dump($_FILES);

    if(!empty($_FILES["profilPictureInput"]["tmp_name"])){
        $file = $_FILES["profilPictureInput"];

        if(@is_array(getimagesize($file["tmp_name"]))){

            $image = imagewebp(imagecreatefromstring(file_get_contents($file["tmp_name"])), $file["tmp_name"], 0); //convert image to webp

            $userProfilePicture = base64_encode(file_get_contents($file["tmp_name"])); //convert file to base64 string

            //envoyer l'image
            
            try {
                $sql = "UPDATE `users` SET `user_profilePicture`=:picture WHERE `user_id`=:userId";

                $query = $db->prepare($sql);

                $query->bindParam(':picture', $userProfilePicture);
                $query->bindParam(':userId', $userId);

                $query->execute();
            
            } catch (PDOException $e) {
                errorMsg("Error: " . $e->getMessage());
            }

            header('location: ./');

        } else errorMsg("Le type de fichier sélectionné n'est pas une image.");
    }

    if(empty($profilName)) $profilName = $user_displayName;
    if(empty($profilUsername)) $profilUsername = $user_name;
    if(empty($profilEmail)) $profilEmail = $user_email;

    if(!preg_match("/^[a-zA-Z0-9\.\-_]*$/", $profilUsername)) errorMsg("Utilisez un nom d'utilisateur valide (lettres, chiffres, ., - et _)");
    $profilUsername = strtolower($profilUsername);

    $profilName = preg_replace("~(?:[\p{M}]{1})([\p{M}])+?~uis", "", $profilName);

    if(!filter_var($profilEmail, FILTER_VALIDATE_EMAIL)) errorMsg("L'adresse email renseignée n'est pas valide.");

    try {
        $sql = "UPDATE `users` SET `user_name`=:userName, `user_displayName`=:userDisplayName, `user_email`=:userEmail WHERE `user_id`=:userId";

        $query = $db->prepare($sql);

        $query->bindParam(':userName', $profilUsername);
        $query->bindParam(':userDisplayName', $profilName);
        $query->bindParam(':userEmail', $profilEmail);
        $query->bindParam(':userId', $userId);

        $query->execute();
    
    } catch (PDOException $e) {
        errorMsg("Error: " . $e->getMessage());
        die();
    }

    $_SESSION["user_displayName"] = $profilName;
    $_SESSION["user_name"] = $profilUsername;

    header('location: ./');