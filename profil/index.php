<?php
    $title = "Profil | Seed";
    define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');
    require_once(DOCUMENT_ROOT . 'header.php');

    if(empty($_SESSION["user_id"])){
        header("location: /profil/signin.php?from=" . $from);
        die;
    }

    require('inc/db.inc.php');
    $user = findOne('users', 'user_id', $_SESSION['user_id']);
    extract($user);
?>
        <main>
            <div class="topHeroImage">
                <h1>Profil</h1>
            </div>
            <h2 class="pageSeconTitle">Gérez votre profil utilisateur</h2>

            <script src="/assets/js/profil.js" defer></script>
            <form action="edit.php" class="profil" method="post">
                <input type="text" name="profilName" id="profilName" value="<?= $_SESSION["user_displayName"] ?>" placeholder="<?= $_SESSION["user_displayName"] ?>">
                <input type="text" name="profilUsername" id="profilUsername" value="<?= $user_name ?>" placeholder="<?= $user_name ?>">
                <img id="profilImage" src="/profil/picture.php?user=<?= $user_name; ?>" alt="Photo de profil de <?= $user_displayName ?>">
                <input type="file" name="profilPictureInput" id="profilPictureInput" accept="image/*" hidden>
                <a id="addPictureButton" class="button little">Changer de photo</a>
                <input type="text" name="profilEmail" id="profilEmail" value="<?= $user_email ?>" placeholder="<?= $user_email ?>">
                <label for="profilPassword">Mot de passe</label>
                <input type="password" name="profilPassword" id="profilPassword" placeholder="************">
                <label for="profilConfirmPassword">Confirmer le mot de passe</label>
                <input type="password" name="profilConfirmPassword" id="profilConfirmPassword" placeholder="************">

                
                <input type="submit" class="button little">Enregister les modifications</input>

                <br><br><br>
                <p><a href="/jardins/gestion.php">Gérer mes jardins</a></p>
                <p><a href="/jardins/parcelles.php">Gérer les parcelles empruntés</a></p>
                <!-- <p><a href="">Gérer les articles disponibles</a></p> -->
                <p><a href="/profil/inc/logout.proc.php">Déconnexion</a></p>
            </form>
            
        </main>
<?php
    require_once(DOCUMENT_ROOT . 'footer.php');