<?php
    $title = "Modifier Profil | Seed";
    define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');
    require_once(DOCUMENT_ROOT . 'header.php');

    if (empty($_SESSION["user_id"])) {
        header("location: /profil/signin.php");
        die;
    }

    require('inc/db.inc.php');
    $user = findOne('users', 'user_id', $_SESSION['user_id']);
    extract($user);
?>

<main>
    <div class="topHeroImage">
        <h1>Modifier Profil</h1>
    </div>

    <?php if (isset($_GET['error']) && $_GET['error'] === 'confirm'): ?>
        <div class="error">Les adresses mail ou les mots de passe ne correspondent pas. Veuillez réessayer.</div>
    <?php endif; ?>

    <form id="editForm" action="/profil/inc/modifprofil.proc.php" method="post" enctype="multipart/form-data">
        <div class="formDouble">
            <div class="formBox">
                <label for="userDisplayName">Nom d'affichage</label>
                <input type="text" name="userDisplayName" id="userDisplayName" value="<?= htmlspecialchars($user_displayName) ?>">
            </div>

            <div class="formBox">
                <label for="userName">Nom d'utilisateur</label>
                <input type="text" name="userName" id="userName" value="<?= htmlspecialchars($user_name) ?>">
            </div>
        </div>
        
        <div class="formDouble">
            <div class="formBox">
                <label for="userEmail">Adresse Mail</label>
                <input type="email" name="userEmail" id="userEmail" value="<?= htmlspecialchars($user_email) ?>">
            </div>

            <div class="formBox">
                <label for="userEmailConfirm">Confirmer l'adresse mail</label>
                <input type="email" name="userEmailConfirm" id="userEmailConfirm" value="<?= htmlspecialchars($user_email) ?>">
            </div>
        </div>

        <div class="formDouble">
            <div class="formBox">
                <label for="userPassword">Mot de passe</label>
                <input type="password" name="userPassword" id="userPassword" placeholder="************">
            </div>

            <div class="formBox">
                <label for="userPasswordConfirm">Confirmer le mot de passe</label>
                <input type="password" name="userPasswordConfirm" id="userPasswordConfirm" placeholder="************">
            </div>
        </div>

        <div class="formDouble">
            <div class="formBox">
                <label for="userProfilePicture">Photo de profil</label>
                <input hidden type="file" name="userProfilePicture" id="userProfilePicture">
                <div id="picturePreviewContainer">
                    <img id="picturePreview" alt="Prévisualisation de la photo de profil" src="/profil/picture.php?user=<?= htmlspecialchars($user_name) ?>">
                    <p class="addPicture" id="addPicture">Modifier la photo</p>
                </div>
            </div>
            <div class="formBox">
                <input type="submit" value="Mettre à jour">
            </div>
        </div>

        <!-- Ajouter un bouton pour valider les modifications -->
        <div class="formBox">
            <input type="submit" value="Valider les modifications">
        </div>
    </form>
</main>
<?php
    require_once(DOCUMENT_ROOT . 'footer.php');
?>
