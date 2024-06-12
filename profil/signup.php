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
            <form action="/profil/inc/signup.proc.php" method="post" enctype="multipart/form-data">
                <input type="text" name="userName" placeholder="Nom d'utilisateur"><br>
                <input type="text" name="userDisplayName" placeholder="Nom d'affichage"><br>
                <input type="email" name="userEmail" placeholder="Adresse mail"><br>
                <input type="email" name="userEmailConfirm" placeholder=" Confirmation adresse mail"><br>
                <input type="password" name="userPassword" placeholder="Mot de passe"><br>
                <input type="password" name="userPasswordConfirm" placeholder="Confirmer mot de passe"><br>
                <input type="file" name="userProfilePicture"><br>
                <input type="submit" value="S'inscrire">
            </form>
            <div class="signup-link">
            <p>Vous avez déjà un compte ? <a href="/profil/signin.php?from=<?= $from; ?>">Se Connecter</a></p>
            </div>
        </main>
<?php
    require_once(DOCUMENT_ROOT . 'footer.php');