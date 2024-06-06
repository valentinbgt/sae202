<?php
    $title = "Inscription - Seed";
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
            <h1>Inscription</h1>
            <form action="/profil/inc/signup.proc.php" method="post" enctype="multipart/form-data">
                <input type="text" name="userName" placeholder="Nom d'utilisateur"><br>
                <input type="text" name="userDisplayName" placeholder="Nom d'affichage"><br>
                <input type="email" name="userEmail" placeholder="Adresse mail"><br>
                <input type="email" name="userEmailConfirm" placeholder="Adresse mail"><br>
                <input type="password" name="userPassword" placeholder="Mot de passe"><br>
                <input type="password" name="userPasswordConfirm" placeholder="Confirmer mot de passe"><br>
                <input type="file" name="userProfilePicture"><br>
                <input type="submit" value="S'inscrire">
            </form>
            <p>Ou plutôt : <a href="/profil/signin.php?from=<?= $from; ?>">connexion</a></p>
        </main>
<?php
    require_once(DOCUMENT_ROOT . 'footer.php');