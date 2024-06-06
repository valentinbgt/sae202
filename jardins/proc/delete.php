<?php
    session_start();
    
    function errorMsg($msg){
        $_SESSION["errorMsg"] = $msg;
        header("location: ../gestion.php");
        die();
    };

    if(empty($_SESSION["user_id"])){
        header("location: ../gestion.php");
        die;
    }
    $userId = $_SESSION["user_id"];

    if(empty($_GET["id"])) errorMsg("Spécifiez un jardin à supprimer");
    $jardinId = base64_decode($_GET["id"]);

    require('db.inc.php');
    $db = dbConn();

    $sql = "DELETE FROM `jardins` WHERE `jardin_id`=:jardinid AND `jardin_user_id`=:userid";

    $query = $db->prepare($sql);

    $query->bindParam(':jardinid', $jardinId);
    $query->bindParam(':userid', $userId);

    $res = $query->execute();

    if($res === true){

        header("location: ../gestion.php");

    }else errorMsg("Une erreur est survenue lors de la suppression du jardin.");