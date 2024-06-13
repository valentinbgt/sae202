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
            <div class="topHeroImage">
                <h1>Gestion</h1>
            </div>
            <div class="jardinsContainer">
                <?php
                    $jardins = findUserJardins('jardins', $userId);

                    if(count($jardins) < 1){
                ?>
                    <p>Vous n'avez aucun jardin.</p>
                <?php
                    }else{
                        foreach($jardins as $jardin){
                            extract($jardin);
                            $jardin_enc_id = urlencode(base64_encode($jardin_id));
                                $sql = "SELECT COUNT(parcelle_id) AS nb_parcelles FROM parcelles WHERE jardin_id = '$jardin_id'";
                                $query = $db->prepare($sql);
                                $query->execute();
                                $res = $query->fetch();
                                $nbParcelles = $res["nb_parcelles"];
                ?>
                    <div class="carteJardin">
                        <img class="photoJardin" src="/jardins/picture.php?id=<?= $jardin_enc_id ?>" alt="Photo du jardin <?= $jardin_location; ?>" height="50px">

                        <p class="jardinTitle" title="<?= $jardin_location ?>"><?= $jardin_location ?></p>
                        <?php
                            if(empty($jardin_gps)) $jardin_gps = "/";
                        ?>
                        <p class="jardinGPS">GPS : <?= $jardin_gps ?></p>

                        <div class="separator"></div>

                        <div class="jardinDetails">
                            <p><?= $nbParcelles ?> parcelle<?php if(@intval($nbParcelles) > 1) echo "s" ?></p>

                            <div class="separator"></div>

                            <?php
                                if($jardin_available) $jardin_status = "actif";
                                else $jardin_status = "inactif";
                            ?>
                            <p class="<?= $jardin_status ?>"><?= $jardin_status ?></p>
                        </div>
                        
                        <div class="jardinActions">
                            <a href="update.php?id=<?= $jardin_enc_id; ?>">modifier</a>

                            <?php
                                if(!$nbParcelles){
                                    ?>
                                    <a href="proc/delete.php?id=<?= $jardin_enc_id; ?>">supprimer</a>
                                    <?php
                                }
                            ?>
                        </div>
                        
                        <!--<p> parcelles :</p>
                        <?php
                            $sql = "SELECT * FROM `parcelles` WHERE `jardin_id`=:jardinid";
                            $query = $db->prepare($sql);
                            $query->bindParam(':jardinid', $jardin_id);
                            $query->execute();
                            $res = $query->fetchAll(PDO::FETCH_ASSOC);

                            if(count($res) < 1){
                                ?>
                                    <p>Ce jardin n'as aucune parcelle configurée. - <a href="update.php?id=<?= $jardin_enc_id; ?>">ajouter une parcelle</a></p>
                                <?php
                            }else{
                                echo '<ul style="list-style: inside;">';
                                foreach($res as $parcelle){
                                    extract($parcelle);
                                    $parcelle_enc_id = urlencode(base64_encode($parcelle_id));
                                    if($parcelle_user_id === NULL){
                                        $parcelle_user = "Personne";
                                    }else $parcelle_user = getUserName($parcelle_user_id);
                                    ?>
                                        <li>
                                            <?= $parcelle_taille; ?>m² - 
                                            <?= $parcelle_typePlantation ?><?php if($parcelle_typePlantation) echo ' - '; ?>
                                            <?php 
                                                if($parcelle_user != "Personne" && !$parcelle_validation) echo "Demandé";
                                                else echo "Utilisé";
                                            ?> 
                                            par : <?= $parcelle_user; ?>
                                            <?php if($parcelle_user == "Personne"){ ?> <a href="proc/delete.php?parcelle=<?= $parcelle_enc_id ?>">supprimer</a> <?php } ?>
                                            <?php
                                                if($parcelle_user != "Personne" && !$parcelle_validation){?>
                                                    accepter refuser
                                                <?php }
                                            ?>
                                        </li>
                                    <?php
                                }
                                echo '</ul>';
                            }
                        ?>-->
                    </div>

                <?php
                        }
                    }
                ?>
            </div>

            

            <br><br>
            <h2>Ajouter un jardin</h2>
            <script defer src="/assets/js/addressCheck.js"></script>
            <script defer src="/assets/js/plotAdder.js"></script>
            <form id="addGardenForm" action="proc/add.php" method="post" enctype="multipart/form-data">
                <input type="text" name="jardinLocation" id="jardinLocation" placeholder="Adresse du jardin" oninput="addressCheck(this.value);"><br>
                <div id="propositionsAdresses">

                </div><br>
                <input type="file" name="jardinPicture"><br>
                <input type="checkbox" name="jardinAvailable" id="jardinAvailable">
                
                <label for="jardinAvailable">Publier le jardin dès son ajout</label><br>
                <a id="addPlotButton">Ajouter des parcelles</a><br>

                <input id="submitGardenButton" type="submit" value="Ajouter le jardin">
            </form>
        </main>
<?php
    require_once(DOCUMENT_ROOT . 'footer.php');