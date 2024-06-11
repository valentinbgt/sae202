<?php
    if(empty($_GET["id"])) { header("location: gestion.php"); die(); };
    $id = "";
    try {
        $id = base64_decode($_GET["id"]);
        $id = intval($id);
    } catch (\Throwable $th) {
        header("location: ../");
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


?>
        <main>
            <div class="topHeroImage">
                <h1>Modifier</h1>
            </div>
            <br><br>

            <?php
                $res = findOne("jardins", "jardin_id", $id);

                if(!is_array($res)){
                    header("location: gestion.php");
                    die();
                }

                extract($res);
            ?>
            <script defer src="/assets/js/addressCheck.js"></script>
            <form action="" method="post" enctype="multipart/form-data">
                <input value="<?= htmlentities($jardin_location) ?>" type="text" name="jardinLocation" id="jardinLocation" placeholder="Adresse du jardin" oninput="addressCheck(this.value);"><br>
                <div id="propositionsAdresses">

                </div><br>
                <input checked type="checkbox" name="jardinUpdateGPS" id="jardinUpdateGPS" oninput="document.querySelector('#jardinGPSContainer').hidden = this.checked">
                <label for="jardinUpdateGPS">Mettre à jour les coordonnées GPS en fonction de l'adresse</label><br>
                <div hidden id="jardinGPSContainer">
                    <input value="<?= $jardin_gps ?>" name="jardinGPS" id="jardinGPS" type="text" placeholder="Coordonnées GPS du jardin"><br>
                </div>
                <img id="jardinImage" src="data:image/png;base64,<?= $jardin_picture ?>" alt="Photo du jardin <?= $jardin_location ?>" height="50px">
                <input type="file" name="jardinPicture" onchange="if(this.files) document.getElementById('jardinImage').src = URL.createObjectURL(this.files)"><br>
                <input type="checkbox" name="jardinAvailable" id="jardinAvailable">
                <label for="jardinAvailable">Publier le jardin dès son ajout</label><br>
                <input type="checkbox" name="addParcelles" id="addParcelles">
                <label for="addParcelles">Ajouter des parcelles après l'ajout</label><br>
                <input type="submit" value="Ajouter">
            </form>
            
        </main>
<?php
    require_once(DOCUMENT_ROOT . 'footer.php');
