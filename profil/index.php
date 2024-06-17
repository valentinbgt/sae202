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
            <form action="edit.php" class="profil" method="post" enctype="multipart/form-data">
                <input type="text" name="profilName" id="profilName" value="<?= $user_displayName ?>" placeholder="<?= $user_displayName ?>">
                <input type="text" name="profilUsername" id="profilUsername" value="<?= $user_name ?>" placeholder="<?= $user_name ?>">

                <img id="profilImage" src="data:image/webp;base64,<?= $user_profilePicture; ?>" alt="Photo de profil de <?= $user_displayName ?>">
                <input type="file" name="profilPictureInput" id="profilPictureInput" accept="image/*" hidden>
                <a id="addPictureButton" class="button little">Changer de photo</a>

                <input type="text" name="profilEmail" id="profilEmail" value="<?= $user_email ?>" placeholder="<?= $user_email ?>">

                <label for="profilCurrentPassword">Mot de passe actuel</label>
                <input type="password" name="profilCurrentPassword" id="profilCurrentPassword" placeholder="************">
                <label for="profilNewPassword">Nouveau mot de passe</label>
                <input type="password" name="profilNewPassword" id="profilNewPassword" placeholder="************">
                <label for="profilConfirmPassword">Confirmer le mot de passe</label>
                <input type="password" name="profilConfirmPassword" id="profilConfirmPassword" placeholder="************">
                
                <a href="">Annuler les modifications</a>
                <input type="submit" class="button little" value="Enregister les modifications">

                <br><br><br>
                <p><a href="/jardins/gestion.php">Gérer mes jardins</a></p>
                <p><a href="/jardins/parcelles.php">Gérer les parcelles empruntés</a></p>
                <!-- <p><a href="">Gérer les articles disponibles</a></p> -->
                <p><a href="/profil/inc/logout.proc.php">Déconnexion</a></p>
            </form>
            
        </main>
<?php
    require_once(DOCUMENT_ROOT . 'footer.php');