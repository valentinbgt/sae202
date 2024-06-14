<?php
    session_start();
    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );

    function errorMsg($msg){
        $_SESSION["errorMsg"] = $msg;
        header("location: ./");
        die();
    };

    extract($_POST);

    if(empty($contactName)) errorMsg("Entrez un nom.");
    if(empty($contactEmail)) errorMsg("Entrez une adresse email.");
    if(empty($contactObject)) errorMsg("Entrez un object.");
    if(empty($contactMessage)) errorMsg("Entrez un message.");

    $contactName = preg_replace("~(?:[\p{M}]{1})([\p{M}])+?~uis", "", $contactName);
    $contactObject = preg_replace("~(?:[\p{M}]{1})([\p{M}])+?~uis", "", $contactObject);
    $contactMessage = preg_replace("~(?:[\p{M}]{1})([\p{M}])+?~uis", "", $contactMessage);

    if(!filter_var($contactEmail, FILTER_VALIDATE_EMAIL)) errorMsg("L'adresse email renseignée n'est pas valide.");

    $agentEmail = "valentin.beauget@etudiant.univ-reims.fr";

    //FIRST MAIL
    $from = $agentEmail;
    $to = $agentEmail;
    $subject = $contactObject . " - Contact Seed";

    $message = "<h1>Contact - Seed</h1>";
    $message .= "<h2>$contactName ($contactEmail) : $contactObject</h2>";
    $message .= "<p>$contactMessage</p>";

    $headers = "From: " . $agentEmail;
    $headers .= "\r\nReply-To: " . $contactEmail;
    $headers .= "\r\nContent-Type: text/html; charset=UTF-8";


    $mail_status1 = mail($to,$subject,$message, $headers);

    //CONFIRM EMAIL
    $from = $agentEmail;
    $to = $contactEmail;
    $subject = "Message reçu - Seed";

    $message = "<h1>Message reçu - Seed</h1>";
    $message .= "<h2>Nous avons bien reçu votre demande.</h2>";
    $message .= "<h3>$contactName ($contactEmail) : $contactObject</h3>";
    $message .= "<p>$contactMessage</p>";

    $headers = "From: " . $agentEmail;
    $headers .= "\r\nReply-To: " . $agentEmail;
    $headers .= "\r\nContent-Type: text/html; charset=UTF-8";


    $mail_status2 = mail($to,$subject,$message, $headers);

    if($mail_status1 && $mail_status2){
        $_SESSION["errorMsg"] = "Le message a bien été envoyé.";
        header("location: /");
    }else{
        errorMsg("Une erreur est survenue, le message n'a pas été envoyé.");
    }