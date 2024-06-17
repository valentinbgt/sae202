<?php
    $title = "Jardins - Seed";
    define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');
    require_once(DOCUMENT_ROOT . 'header.php');

    require_once('proc/db.inc.php');
?>
        <main>
            <div class="topHeroImage">
                <h1>Jardins</h1>
            </div>
            <h2 class="pageSeconTitle">Les parcelles <span style="text-wrap: nowrap;">à emprunter</spa></h2>

            <?php
                if(!empty($_GET["search"])){
                    $search = $_GET["search"];
                }else{
                    $search = "";
                }
                $search = "%$search%";

                $db = dbConn();

                $req = "SELECT `jardin_id`, `jardin_gps`, `jardin_location`, `jardin_available` FROM `jardins` WHERE `jardin_available`=1 AND `jardin_location` LIKE :search";
                $query = $db->prepare($req);
                $query->bindParam(':search', $search);
                $query->execute();
                $res = $query->fetchAll(PDO::FETCH_ASSOC);

                $jardins_available = $res;
                $jardins = array();

                foreach ($jardins_available as $jardin) {
                    extract($jardin);
                    $jardins[$jardin_id] = $jardin;
                }
                
                $req = "SELECT * FROM `parcelles` WHERE `parcelle_available`=1 AND `parcelle_user_id`IS NULL";
                $query = $db->prepare($req);
                $query->execute();
                $res = $query->fetchAll(PDO::FETCH_ASSOC);

                $parcelles_available = $res;
                shuffle($parcelles_available);

                ?>
            <div class="jardinsContainer parcelles">            
                <?php

                foreach ($parcelles_available as $parcelle) {
                    extract($parcelle);

                    if(!isset($jardins[$jardin_id])) continue;

                    extract($jardins[$jardin_id]);

                    $jardin_enc_id = urlencode(base64_encode($jardin_id));

                    $jardin_location = htmlentities($jardin_location);
                    $jardin_gps = htmlentities($jardin_gps);


                    ?>
                        <div class="carteJardin">
                            <img class="photoJardin" src="/jardins/picture.php?id=<?= $jardin_enc_id ?>" alt="Photo du jardin 9 Rue De Quebec, 10000 Troyes, France">
                            <p class="jardinTitle" title="<?= $jardin_location ?>"><?= $jardin_location ?></p>
                            <p class="jardinGPS" title="<?= $jardin_gps ?>">GPS : <?= $jardin_gps ?></p>
                            <div class="separator"></div>
                            <div class="jardinDetails">
                                <p class="surface"><?= $parcelle_taille ?> m²<br>1 restante</p>
                                <div class="separator"></div>
                                <p class="owner">propriétaire : <br><span class="actif">Inconnu (inconnu)</span></p>
                            </div>
                            <div class="jardinActions">
                                <a href="#">Emprunter</a>
                            </div>
                        </div>
                    <?php
                }
            ?>
            </div>
            <p>Aucune parcelle de jardin n'est disponible à l'emprunt actuellement.</p>
            <p><a href="gestion.php">Ajoutez votre jardin</a></p>
        </main>
<?php
    require_once(DOCUMENT_ROOT . 'footer.php');