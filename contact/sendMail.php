<?php
ini_set( 'display_errors', 1 );
error_reporting( E_ALL );

$from = "EXPEDITEUR";
$to = "DESTINATAIRE";
$subject = "VPSMAIL-02";
$message = "Envoi du Message via PHP";
$headers = "From:" . $from;

//mail($to,$subject,$message, $headers);

echo "L'email a été envoyé.";