<?php
    $title = "Connexion - Seed";
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
            <h1>Connexion</h1>
            <form action="/profil/inc/signin.proc.php" method="post" enctype="multipart/form-data">
                <input type="text" name="userIdentifier" placeholder="Nom d'utilisateur ou email"><br>
                <input type="password" name="userPassword" placeholder="Mot de passe"><br>
                <input type="submit" value="Se connecter">
            </form>
            <p>Ou plutôt : <a href="/profil/signup.php?from=<?= $from; ?>">inscription</a></p>
        </main>
<?php
    require_once(DOCUMENT_ROOT . 'footer.php');