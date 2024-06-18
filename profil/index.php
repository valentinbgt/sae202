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

                <img id="profilImage" src="picture.php?user=<?= $user_name; ?>" alt="Photo de profil de <?= $user_displayName ?>">
                <input type="file" name="profilPictureInput" id="profilPictureInput" accept="image/*" hidden>
                <a id="addPictureButton" class="button little">Changer de photo</a>

                <input type="text" name="profilEmail" id="profilEmail" value="<?= $user_email ?>" placeholder="<?= $user_email ?>">

                <label for="profilCurrentPassword">Mot de passe actuel</label>
                <input type="password" name="profilCurrentPassword" id="profilCurrentPassword" placeholder="************">
                <label for="profilNewPassword">Nouveau mot de passe</label>
                <input type="password" name="profilNewPassword" id="profilNewPassword" placeholder="************">
                <label for="profilConfirmPassword">Confirmer le mot de passe</label>
                <input type="password" name="profilConfirmPassword" id="profilConfirmPassword" placeholder="************">
                
                <div class="enregistrerProfil">
                    <a class="button little" href="">Annuler</a>
                    <input type="submit" class="button little" value="Enregister">
                </div>

                <br>
                <a class="button" href="/jardins/gestion.php">Gérer mes jardins</a>
                <a class="button" href="/jardins/parcelles.php">Gérer les parcelles empruntés</a>
                <a class="button" href="/profil/inc/logout.proc.php">Déconnexion</a>
            </form>
            
        </main>
<?php
    require_once(DOCUMENT_ROOT . 'footer.php');