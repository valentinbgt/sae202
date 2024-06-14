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
    $subject = $contactObject;
    $message = $contactMessage;
    $headers = "From: " . $agentEmail . "\r\n" . "Reply-To: " . $contactEmail . "\r\n";

    $mail_status = mail($to,$subject,$message, $headers);

    var_dump($mail_status);

    echo "L'email a été envoyé.";