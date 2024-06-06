<?php
    $title = "Gestion des jardins - Seed";
    define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');
    require_once(DOCUMENT_ROOT . 'header.php');

    if(empty($_SESSION["user_id"])){
        header("location: /profil/signin.php?from=" . $from);
        die;
    }
    $userId = $_SESSION["user_id"];

    require('proc/db.inc.php');
    $db = dbConn();
?>
        <main>
            <h1>Gestion des jardins</h1>
            <br><br>

            <?php
                $jardins = findUserJardins('jardins', $userId);
                // var_dump($jardins);

                if(count($jardins) < 1){
            ?>
                <p>Vous n'avez aucun jardin.</p>
            <?php
                }else{
                    foreach($jardins as $jardin){
                        extract($jardin);
                        $jardin_enc_id = urlencode(base64_encode($jardin_id));
            ?>

                        <img src="/jardins/picture.php?id=<?= $jardin_enc_id ?>" alt="Photo du jardin <?= $jardin_location; ?>" height="50px">
                        <p>
                            <?= $jardin_location ?><br>
                            Coordonnées GPS : <?php if(!empty($jardin_gps)) echo $jardin_gps; ?><br>
                            <?php if(!$jardin_available) echo "inactif - "; ?>
                            <a href="proc/update.php?id=<?= $jardin_enc_id; ?>">modifier</a> - <a href="proc/delete.php?id=<?= $jardin_enc_id; ?>">supprimer</a>
                            <p>parcelles :</p>
                            <?php
                                $sql = "SELECT * FROM `parcelles` WHERE `jardin_id`=:jardinid";
                                $query = $db->prepare($sql);
                                $query->bindParam(':jardinid', $jardin_id);
                                $query->execute();
                                $res = $query->fetchAll(PDO::FETCH_ASSOC);

                                if(count($res) < 1){
                                    ?>
                                        <p>Ce jardin n'as aucune parcelle configurée. - <a href="proc/update.php?id=<?= $jardin_enc_id; ?>">ajouter une parcelle</a></p>
                                    <?php
                                }else{
                                    foreach($res as $parcelle){
                                        extract($parcelle);
                                        if($parcelle_user_id === NULL){
                                            $parcelle_user = "Personne";
                                        }else $parcelle_user = getUserName($parcelle_user_id);
                                        ?>
                                            <p> - <?= $parcelle_taille; ?>m² - <?= $parcelle_typePlantation ?> - Utilisé par : <?= $parcelle_user; ?></p>
                                        <?php
                                    }
                                }
                            ?>
                        </p>

            <?php
                    }
                }
            ?>

            <br><br>
            <h2>Ajouter un jardin</h2>
            <script defer src="/assets/js/addressCheck.js"></script>
            <form action="proc/add.php" method="post" enctype="multipart/form-data">
                <input type="text" name="jardinLocation" id="jardinLocation" placeholder="Adresse du jardin" oninput="addressCheck(this.value);"><br>
                <div id="propositionsAdresses">

                </div><br>
                <input type="file" name="jardinPicture"><br>
                <input type="checkbox" name="jardinAvailable" id="jardinAvailable">
                <label for="jardinAvailable">Publier le jardin dès son ajout</label><br>
                <input type="checkbox" name="addParcelles" id="addParcelles">
                <label for="addParcelles">Ajouter des parcelles après l'ajout</label><br>
                <input type="submit" value="Ajouter">
            </form>
        </main>
<?php
    require_once(DOCUMENT_ROOT . 'footer.php');