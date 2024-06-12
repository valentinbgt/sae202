<?php
    $title = "Connexion | Seed";
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
                <h1>Connexion</h1>
            </div>
            <form action="/profil/inc/signin.proc.php" method="post" enctype="multipart/form-data">
            <label for="userIdentifier">Nom d'utilisateur ou Email :</label>
            <input type="text" name="userIdentifier" id="userIdentifier" placeholder="Nom d'utilisateur ou Email"><br>
            <label for="userPassword">Mot de passe :</label>
            <input type="password" name="userPassword" id="userPassword" placeholder="Mot de passe"><br>
            <input type="submit" value="Se connecter">
            </form>
            <div class="signup-link">
        <p>Vous n'avez pas de compte ? <a href="/profil/signup.php?from=<?= $from; ?>">Inscription</a></p>
    </div>        
        </main>
<?php
    require_once(DOCUMENT_ROOT . 'footer.php');