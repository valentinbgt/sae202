<?php
    $title = "Parcelles empruntées - Seed";
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
                <h1>Emprunts</h1>
            </div>
            <h2 class="pageSeconTitle">Gestion des parcelles empruntées</h2>
            <div class="jardinsContainer">
                <?php
                    $sql = "SELECT * FROM `parcelles` WHERE `parcelle_user_id`=:userid";

                    $query = $db->prepare($sql);
                    $query->bindParam(':userid', $userId);
                    $query->execute();

                    $res = $query->fetchAll(PDO::FETCH_ASSOC);

                    $parcelles = $res;

                    if(count($parcelles) < 1){
                ?>
                    <p>Vous n'avez aucune parcelle empruntée.</p>
                <?php
                    }else{
                        foreach($parcelles as $parcelle){
                            extract($parcelle);

                            $jardin = findOne('jardins', 'jardin_id', $jardin_id);

                            extract($jardin);

                            $jardin_enc_id = urlencode(base64_encode($jardin_id));
                            $parcelle_enc_id = urlencode(base64_encode($parcelle_id));

                            $owner = getUserName($jardin_user_id);
                ?>
                    <div class="carteJardin">
                        <?php
                            if($parcelle_validation == 0){
                                ?>
                                    <p class="waitForValid">En attente de validation</p>
                                <?php
                            }
                        ?>

                        <img class="photoJardin" src="/jardins/picture.php?id=<?= $jardin_enc_id ?>" alt="Photo du jardin <?= $jardin_location; ?>" height="50px">

                        <p class="jardinTitle" title="<?= $jardin_location ?>"><?= $jardin_location ?></p>
                        <?php
                            if(empty($jardin_gps)) $jardin_gps = "/";
                        ?>
                        <p class="jardinGPS" title="<?= $jardin_gps ?>">GPS : <?= $jardin_gps ?></p>

                        <div class="separator"></div>

                        <div class="jardinDetails">
                            <p>Taille <?= $parcelle_taille ?>m²</p>

                            <div class="separator"></div>

                            <p><span class="actif"><?= $owner ?></span></p>
                        </div>
                        
                        <div class="jardinActions">
                            <!--<a href="#">Modifier</a>-->
                            
                            <a href="borrow.php?id=<?= $parcelle_enc_id ?>&giveBack">Rendre</a>
                        </div>
                    </div>

                <?php
                        }
                    }
                ?>
            </div>

            <h2 class="pageSeconTitle">Ajouter un jardin</h2>
            <script defer src="/assets/js/addressCheck.js"></script>
            <script defer src="/assets/js/plotAdder.js"></script>
            <script defer src="/assets/js/customCheckboxes.js"></script>
            <script defer src="/assets/js/addGardenForm.js"></script>
            <form id="addGardenForm" action="proc/add.php" method="post" enctype="multipart/form-data">
                <div class="formDouble">
                    <div class="formBox">
                        <label for="jardinLocation">Adresse du jardin</label>
                        <input type="text" name="jardinLocation" id="jardinLocation" placeholder="9 rue Québec, 10430 Rosières-près-Troyes, France" oninput="addressCheck(this.value);">
                        <div id="propositionsAdresses"></div>  
                    </div>              
                        
                    <div class="formBox">
                        <label for="jardinPicture">Photo du jardin </label>
                        <input hidden type="file" name="jardinPicture" id="jardinPicture">
                            <div id="picturePreviewContainer">
                                <img hidden="" id="picturePreview" alt="Prévisualisation de la photo de profil" src="/assets/img/default_jardin.webp">
                                <p class="addPicture" id="addPicture">Ajouter une photo</p>
                            </div>
                    </div>
                </div>

                <div class="formDouble">
                    <div class="formBox">
                        <a id="addPlotButton">Ajouter une parcelle</a>
                        <div class="plotsList"></div>
                    </div>

                    <div class="formBox">
                        <div class="publish">
                            <input hidden type="checkbox" name="jardinAvailable" id="jardinAvailable">
                            <div class="customCheckBox" data-target="jardinAvailable"></div>
                            <label for="jardinAvailable">Publier le jardin</label>
                        </div>
                        <input id="submitGardenButton" type="submit" value="Ajouter le jardin">
                    </div>
                </div>
            </form>
        </main>
<?php
    require_once(DOCUMENT_ROOT . 'footer.php');