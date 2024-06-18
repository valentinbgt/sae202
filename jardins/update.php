<?php
    if(empty($_GET["id"])) { header("location: gestion.php"); die(); };
    $id = "";
    try {
        $id = base64_decode($_GET["id"]);
        $id = intval($id);
    } catch (\Throwable $th) {
        header("location: ./gestion.php");
    }
    if(!is_int($id)) { header("location: gestion.php"); die(); };


    $title = "Modifier un jardin - Seed";
    define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');
    require_once(DOCUMENT_ROOT . 'header.php');

    if(empty($_SESSION["user_id"])){
        header("location: /profil/signin.php?from=" . $from);
        die;
    }
    $userId = $_SESSION["user_id"];

    require('proc/db.inc.php');
    $db = dbConn();

    if(isset($_GET["Accepter"])){
        $parcelle = findOne('parcelles', 'parcelle_id', $id);

        $jardin_id = $parcelle['jardin_id'];

        if(is_array($parcelle)){
            $jardin = findOne('jardins', 'jardin_id', $jardin_id);

            if(is_array($jardin)){
                
                if($userId == $jardin['jardin_user_id']){
                    try {
                        $sql = "UPDATE `parcelles` SET `parcelle_validation`=1 WHERE `parcelle_id`=:parcelleId";

                        $query = $db->prepare($sql);

                        $query->bindParam(':parcelleId', $id);

                        $query->execute();

                        header('location: ./update.php?id=' . urlencode(base64_encode($jardin_id)));

                        die();
                    } catch (\Throwable $th) {
                        die("Une erreur est survenue.");
                    }
                }
            }
        }
    }

    if(isset($_GET["Supprimer"])){
        $parcelle = findOne('parcelles', 'parcelle_id', $id);

        $jardin_id = $parcelle['jardin_id'];

        if(is_array($parcelle)){
            $jardin = findOne('jardins', 'jardin_id', $jardin_id);

            if(is_array($jardin)){
                
                if($userId == $jardin['jardin_user_id']){
                    try {
                        $sql = "DELETE FROM `parcelles` WHERE `parcelle_id`=:parcelleId";

                        $query = $db->prepare($sql);

                        $query->bindParam(':parcelleId', $id);

                        $query->execute();

                        header('location: ./update.php?id=' . urlencode(base64_encode($jardin_id)));

                        die();
                    } catch (\Throwable $th) {
                        die("Une erreur est survenue.");
                    }
                }
            }
        }
    }

    if(isset($_GET["Éjecter"])){
        $parcelle = findOne('parcelles', 'parcelle_id', $id);

        $jardin_id = $parcelle['jardin_id'];

        if(is_array($parcelle)){
            $jardin = findOne('jardins', 'jardin_id', $jardin_id);

            if(is_array($jardin)){
                
                if($userId == $jardin['jardin_user_id']){
                    try {
                        $sql = "UPDATE `parcelles` SET `parcelle_available`=1,`parcelle_validation`=0,`parcelle_user_id`=NULL WHERE `parcelle_id`=:parcelleId";

                        $query = $db->prepare($sql);

                        $query->bindParam(':parcelleId', $id);

                        $query->execute();

                        header('location: ./update.php?id=' . urlencode(base64_encode($jardin_id)));

                        die();
                    } catch (\Throwable $th) {
                        die("Une erreur est survenue. $th");
                    }
                }
            }
        }
    }

    if(isset($_GET["toggleAvailable"])){
        $jardin = findOne('jardins', 'jardin_id', $id);

        extract($jardin);

        if(is_array($jardin)){
                
            if($userId == $jardin['jardin_user_id']){
                try {
                    $sql = "UPDATE `jardins` SET `jardin_available`=:jardinAvailable WHERE `jardin_id`=:jardinId";

                    $query = $db->prepare($sql);

                    $jardin_available = !$jardin_available;

                    $query->bindParam(':jardinId', $id);
                    $query->bindParam(':jardinAvailable', $jardin_available);

                    $query->execute();

                    header('location: ./update.php?id=' . urlencode(base64_encode($jardin_id)));

                    die();
                } catch (\Throwable $th) {
                    die("Une erreur est survenue. $th");
                }
            }
            
        }
    }

?>
        <main>
            <div class="topHeroImage">
                <h1>Modifier</h1>
            </div>
            <br><br>

            <?php
                $res = findOne("jardins", "jardin_id", $id);

                if(!is_array($res)){
                    header("location: ./gestion.php");
                    die();
                }

                extract($res);

                $jardin_enc_id = urlencode(base64_encode($jardin_id));

                $jardin_location = htmlentities($jardin_location);
                $jardin_gps = htmlentities($jardin_gps);

                $owner = getUserName($jardin_user_id);

                    $sql = "SELECT COUNT(parcelle_id) AS nb_parcelles FROM parcelles WHERE jardin_id = '$jardin_id'";
                    $query = $db->prepare($sql);
                    $query->execute();
                    $res = $query->fetch();
                    $nbParcelles = $res["nb_parcelles"];
            ?>
            
            <div class="jardinEmprunt">
                <img src="picture.php?id=<?= $jardin_enc_id ?>" alt="Image du jardin <?= $jardin_location ?>">
                <p class="location"><?= $jardin_location ?></p>
                <p class="gps">GPS : <?= $jardin_gps ?></p>
                <div class="separator"></div>
                <div class="jardinEmpruntD">
                    <p class="surface"><?= $nbParcelles ?> parcelle<?= ($nbParcelles > 1) ? "s" : "" ?></p>
                    <div class="separator"></div>
                    <p class="owner"></p>
                </div>
                <div class="parcelles">
                <?php
                    $sql = "SELECT * FROM `parcelles` WHERE `jardin_id`=:jardinId";

                    $query = $db->prepare($sql);

                    $query->bindParam(':jardinId', $jardin_id);

                    $query->execute();

                    $res = $query->fetchAll(PDO::FETCH_ASSOC);

                    $parcelles = $res;

                    foreach ($parcelles as $key => $parcelle) {
                        extract($parcelle);

                        $parcelle_enc_id = urlencode(base64_encode($parcelle_id));

                        $state = "Libre";
                        if($parcelle_user_id != null && $parcelle_validation == 0) $state = "Demandé par";
                        if($parcelle_user_id != null && $parcelle_validation == 1) $state = "Pris par";

                        $user = " ";
                        if($parcelle_user_id != null) $user .= getUserName($parcelle_user_id);

                        if($parcelle_user_id == null) $action = "Supprimer";
                        if($parcelle_user_id != null && $parcelle_validation == 0) $action = "Accepter";
                        if($parcelle_user_id != null && $parcelle_validation == 1) $action = "Éjecter";
                ?>
                    <p>
                        <?= $parcelle_taille ?>m² - 
                        <?= $state . $user ?> - 
                        <a href="?id=<?= $parcelle_enc_id ?>&<?= $action ?>"><?= $action ?></a>
                    </p>                    
                    <?php
                        }
                    ?>
                </div>
                <div class="empruntEnvoi">
                    <?php
                        if($jardin_available){
                            $toggleAvailable = "Désactiver";
                        }else{
                            $toggleAvailable = "Publier";
                        }
                    ?>
                    <a class="button" href="?id=<?= $jardin_enc_id ?>&toggleAvailable"><?= $toggleAvailable ?></a>
                </div>
            </div>            
        </main>
<?php
    require_once(DOCUMENT_ROOT . 'footer.php');
