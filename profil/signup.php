<?php
    $title = "Inscription | Seed";
    define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');
    require_once(DOCUMENT_ROOT . 'header.php');

    $_SESSION["from"] = @$_GET["from"];

    if(!empty($_SESSION["user_id"])){
        if(!empty($_GET["from"])) $from = urldecode(base64_decode($_GET["from"]));
        else $from = "/";
        header("location: $from");
        die;
    }
?>
        <main>
            <div class="topHeroImage">
                <h1>Inscription</h1>
            </div>
            <script src="/assets/js/signForm.js" defer></script>
            <form id="signForm" action="/profil/inc/signup.proc.php" method="post" enctype="multipart/form-data">
                <div class="formDouble">
                    <div class="formBox">
                        <label for="userDisplayName">Nom d'affichage</label>
                        <input type="text" name="userDisplayName" id="userDisplayName" placeholder="Emma MARTIN">
                    </div>

                    <div class="formBox">
                        <label for="userName">Nom d'utilisateur <span class="thin">(identifiant)</span></label>
                        <input type="text" name="userName" id="userName" placeholder="emma.martin">
                    </div>
                </div>
                
                <div class="formDouble">
                    <div class="formBox">
                        <label for="userEmail">Adresse Mail</label>
                        <input type="email" name="userEmail" id="userEmail" placeholder="emma.martin@gmail.com">
                    </div>

                    <div class="formBox">
                        <label for="userEmailConfirm">Confirmer l'adresse mail</label>
                        <input type="email" name="userEmailConfirm" id="userEmailConfirm" placeholder="emma.martin@gmail.com">
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
                            <img hidden id="picturePreview" alt="Prévisualisation de la photo de profil" src="/assets/img/default_user.webp">
                            <p class="addPicture" id="addPicture">Ajouter une photo</p>
                        </div>
                    </div>
                    <div class="formBox">
                        <input type="submit" value="S'inscrire">
                    </div>
                </div>
                
                <div class="signup-link">
                    <p>Vous avez déjà un compte ? <a href="/profil/signin.php?from=<?= $from; ?>">Se Connecter</a></p>
                </div>
            </form>
        </main>
<?php
    require_once(DOCUMENT_ROOT . 'footer.php');