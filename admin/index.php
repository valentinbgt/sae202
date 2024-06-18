<?php
    $title = "Panel admin - Seed";
    define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');
    require_once(DOCUMENT_ROOT . 'header.php');

    if(empty($_SESSION["user_id"])){
        header("location: /profil/signin.php?from=" . $from);
        die;
    }
    $userId = $_SESSION["user_id"];

    if($_SESSION["user_type"] !== "admin"){
        header("location: /");
        die();
    }

    require('../profil/inc/db.inc.php');
    $db = dbConn();
?>
        <main>
            <div class="topHeroImage">
                <h1>Pannel Admin</h1>
            </div>

            <h2 class="pageSeconTitle">Table utilisateurs</h2>

            <?php
                $users = findAll('users');
                // var_dump($jardins);

                if(count($users) < 1){
            ?>
                <p>Aucun utilisateur inscrit.</p>
            <?php
                }else{
                    foreach($users as $user){
                        extract($user);
            ?>

                        <img src="/profil/picture.php?user=<?= $user_name ?>" alt="Photo de <?= $user_displayName; ?>" height="100px">
                        <p>
                            <?= $user_displayName ?> (<?= $user_name; ?>)<br>
                            <?= $user_type ?> - 
                            <a href="#">modifier</a> - <a href="#">supprimer</a>
                        </p>

            <?php
                    }
                }
            ?>


            <h2 class="pageSeconTitle">Table Jardins</h2>
            <?php
                $jardins = findAll('jardins');

                foreach ($jardins as $jardin) {
                    extract($jardin);

                    $jardin_enc_id = urlencode(base64_encode($jardin_id));

                    ?>

                        <div class="jardinAdmin">
                            <img src="/jardins/picture.php?id=<?= $jardin_enc_id ?>" alt="Photo di jardin <?= $jardin_location ?>" height="100px">
                            <p><?= $jardin_location ?></p>
                            <p><?= $jardin_gps ?></p>
                            
                            <p><?= getUserName($jardin_user_id) ?></p>
                        </div>

                    <?php
                }
            ?>

            <h2 class="pageSeconTitle">Table Parcelles</h2>
            <?php
                $parcelles = findAll('parcelles');

                foreach ($parcelles as $parcelle) {
                    extract($parcelle);

                    $jardin = findOne('jardins', 'jardin_id', $jardin_id);

                    $jardin_enc_id = urlencode(base64_encode($jardin_id));

                    ?>

                        <div class="jardinAdmin">
                            <img src="/jardins/picture.php?id=<?= $jardin_enc_id ?>" alt="Photo di jardin <?= $jardin_location ?>" height="100px">
                            <p><?= $jardin_location ?></p>
                            <p><?= $jardin_gps ?></p>
                            
                            <p><?= getUserName($jardin_user_id) ?></p>

                            <p><?= $parcelle_taille ?>m²</p>
                            <p>Disponibilité : <?= $parcelle_available ?></p>
                            <p>Validation : <?= $parcelle_validation ?></p>
                            <p>Locataire : <?= ($parcelle_user_id == null) ? "Aucun" : getUserName($parcelle_user_id) ?></p>
                        </div>

                    <?php
                }
            ?>
        </main>
<?php
    require_once(DOCUMENT_ROOT . 'footer.php');