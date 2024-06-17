<?php
    $title = "Emprunter un jardin - Seed";
    define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');
    require_once(DOCUMENT_ROOT . 'header.php');

    if(empty($_GET["id"])) { header("location: ./"); die("1"); };
    $id = "";
    try {
        $id = base64_decode($_GET["id"]);
        $id = intval($id);
    } catch (\Throwable $th) {
        header("location: ./");
    }
    if(!is_int($id)) { header("location: ./"); die("2"); };

    require('proc/db.inc.php');
    $db = dbConn();

    if(isset($_GET['giveBack'])){
        if(empty($_SESSION["user_id"])){
            header("location: /profil/signin.php?from=" . $from);
            die;
        }
        $userId = $_SESSION["user_id"];

        $sql = "UPDATE `parcelles` SET `parcelle_available`=1, `parcelle_validation`=0, `parcelle_user_id` = NULL WHERE `parcelle_id`=:parcelleId AND `parcelle_user_id`=:userId";

        $query = $db->prepare($sql);
        $query->bindParam(':userId', $userId);
        $query->bindParam(':parcelleId', $id);

        $query->execute();

        header("location: ./parcelles.php");

        die("3");
    }

    if(empty($_GET["s"])) { header("location: ./"); die("4"); };
    $surface = "";
    try {
        $surface = base64_decode($_GET["s"]);
        $surface = intval($surface);
    } catch (\Throwable $th) {
        header("location: ./");
    }
    if(!is_int($surface)) { header("location: ./"); die("5"); };

    $sql = "SELECT * FROM `parcelles` WHERE `parcelle_taille`=:surface AND `jardin_id`=:id AND `parcelle_available`=1 AND `parcelle_user_id` IS NULL";

    $query = $db->prepare($sql);

    $query->bindParam(':id', $id);
    $query->bindParam(':surface', $surface);

    $query->execute();

    $parcelle = $query->fetch();

    if(!$parcelle){
        header("location: ./");
        die("6");
    }

    if(isset($_GET["go"])){//script d'ajout du jardin + redirection vers parcelles
        if(empty($_SESSION["user_id"])){
            header("location: /profil/signin.php?from=" . $from);
            die;
        }
        $userId = $_SESSION["user_id"];
        
        if($parcelle['parcelle_available'] == 1 && $parcelle['parcelle_user_id'] == null){
            $parcelle_id = $parcelle["parcelle_id"];

            $sql = "UPDATE `parcelles` SET `parcelle_available`=0, `parcelle_validation`=0, `parcelle_user_id`=:userId WHERE `parcelle_id`=:parcelleId";

            $query = $db->prepare($sql);
            $query->bindParam(':userId', $userId);
            $query->bindParam(':parcelleId', $parcelle_id);

            $query->execute();
        }else{
            header('location: ./');
            die("7");
        }
        
        header('location: parcelles.php');
        die("8");
    }
?>
     <main>
        <div class="topHeroImage">
            <h1>Emprunter</h1>
        </div>
        <br><br>

        <?php
            $res = findOne("jardins", "jardin_id", $id);

            if(!is_array($res)){
                header("location: ./.php");
                die();
            }

            extract($res);

            $jardin_enc_id = urlencode(base64_encode($jardin_id));

            $jardin_location = htmlentities($jardin_location);
            $jardin_gps = htmlentities($jardin_gps);

            $owner = getUserName($jardin_user_id);
        ?>
        <div class="jardinEmprunt">
            <img src="picture.php?id=<?= $jardin_enc_id ?>" alt="Image du jardin <?= $jardin_location ?>">
            <p class="location"><?= $jardin_location ?></p>
            <p class="gps">GPS : <?= $jardin_gps ?></p>
            <div class="separator"></div>
            <div class="jardinEmpruntD">
            <p class="surface">Surface :<br><?= $parcelle['parcelle_taille'] ?>m²</p>
            <div class="separator"></div>
            <p class="owner">Propriétaire : <br><span class="actif"><?= $owner ?></span></p>
            </div>
            <div class="empruntEnvoi">
            <a class="button" href="?id=<?= urlencode($_GET["id"]) ?>&s=<?= urlencode($_GET["s"]) ?>&go">Emprunter</a>
            </div>
            <p class="message">Le propriétaire, <?= $owner ?>, sera averti et devra valider votre demande manuellement.</p>
        </div>
        
    </main>
<?php
    require_once(DOCUMENT_ROOT . 'footer.php');