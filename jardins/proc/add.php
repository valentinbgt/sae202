<?php
    session_start();

    if(empty($_SESSION["user_id"])){
        header("location: ./");
        die;
    }

    function errorMsg($msg){
        $_SESSION["errorMsg"] = $msg;
        header("location: ../gestion.php");
        die();
    };

    if(empty($_POST['jardinLocation'])) errorMsg("Spécifiez une adresse pour votre jardin");

    extract($_POST);

    $jardinParcelles = [];
    if(@is_array($plotNumber)){
        foreach($plotNumber as $key => $number) {
            $number = intval($number);
            $surface = intval($plotSurface[$key]);

            if(!is_nan($number) && !is_nan($surface)){
                if(!isset($jardinParcelles[$surface])) $jardinParcelles[$surface] = 0;
                $jardinParcelles[$surface] += $number;
            }
        }
    }

    $userId = $_SESSION["user_id"];

    $jardinLocation = preg_replace("~(?:[\p{M}]{1})([\p{M}])+?~uis", "", $jardinLocation); //anti zalgo

    $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.geoapify.com/v1/geocode/search?text=".urlencode($jardinLocation)."&filter=countrycode:fr&format=json&apiKey=2400638efdf346ff80e7e73a9c362be2",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));

    $gps = curl_exec($curl);
    
    curl_close($curl);

    $gps = json_decode($gps);
    $gps = $gps->results;
    if(empty($gps[0])) errorMsg("L'addresse fournie n'est pas valide. Réessayez avec une adresse proposée.");
    $gps = $gps[0];
    $gps = $gps->lat.", ".$gps->lon;

    $jardinPicture = "";
    if(!empty($_FILES["jardinPicture"]["tmp_name"])){
        $file = $_FILES["jardinPicture"];

        if(@is_array(getimagesize($file["tmp_name"]))){
            imagewebp(imagecreatefromstring(file_get_contents($file["tmp_name"])), $file["tmp_name"], 0); //convert image to webp

            $jardinPicture = base64_encode(file_get_contents($file["tmp_name"])); //convert file to base64 string

        } else errorMsg("Le type de fichier sélectionné n'est pas une image.");
    }

    $jardinAvailable = isset($jardinAvailable) == true; //vérifier si la check box est on

    require('db.inc.php');
    $db = dbConn();

    $sql = "INSERT INTO jardins(jardin_location, jardin_available, jardin_picture, jardin_user_id, jardin_gps) VALUES (:jardinlocation, :jardinavailable, :jardinpicture, :userid, :jardingps)";

    $query = $db->prepare($sql);

    $query->bindParam(':jardinlocation', $jardinLocation);
    $query->bindParam(':jardinavailable', $jardinAvailable);
    $query->bindParam(':jardinpicture', $jardinPicture);
    $query->bindParam(':userid', $userId);
    $query->bindParam(':jardingps', $gps);

    $res = $query->execute();

    $userJardins = findUserJardins("jardins", $userId);
    $jardinId = $userJardins[count($userJardins) -1]["jardin_id"];

    //ajout des parcelles si nécessaire

    if(count($jardinParcelles) > 0){
        foreach ($jardinParcelles as $surface => $number) {

            for ($i=0; $i < $number; $i++) { 
                $sql = "INSERT INTO parcelles(parcelle_taille, parcelle_available, jardin_id) VALUES (:parcelletaille, :parcelleavailable, :jardinid)";

                $query = $db->prepare($sql);

                $query->bindParam(':parcelletaille', $surface);
                $query->bindParam(':parcelleavailable', $jardinAvailable);
                $query->bindParam(':jardinid', $jardinId);

                $res = $query->execute();
            }
        }
    }

    if($res === true){

        // if(!empty($_POST["addParcelles"])) header()

        header("location: ../gestion.php");

    }else errorMsg("Une erreur est survenue lors de la création du jardin.");