<?php
    if(empty($title)) $title = "Seed";
    session_start();
    $from = base64_encode(urlencode($_SERVER['REQUEST_URI']));
    $page = explode("?", basename($_SERVER['REQUEST_URI']))[0];
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title ?></title>

        <link rel="stylesheet" href="/assets/css/style.css">

        <script src="/assets/js/main.js"></script>

        <script>
            <?php
                if(!empty($_SESSION["errorMsg"])){
                    $message = $_SESSION["errorMsg"];
                    echo "errorMsg(`$message`);";
                    unset($_SESSION["errorMsg"]);
                }
            ?>
        </script>
    </head>
    <body>
        <header>
            <nav>
                <a href="/">Seed</a>
                <a href="/jardins">Les jardins</a>
                <!--<a href="/annonces">Annonces</a>-->
                <a href="/contact">Nous contacter</a>
                
                <?php
                    if(empty($_SESSION["user_id"])){
                ?>
                    <a <?php if($page == "signin.php") echo "hidden"; ?> href="/profil/signin.php?from=<?= $from; ?>">connexion</a>
                    <a <?php if($page != "signin.php") echo "hidden"; ?> href="/profil/signup.php?from=<?= $from; ?>">inscription</a>
                <?php
                    }else{
                ?>
                    <a <?php if($page == "profil") echo "hidden"; ?> href="/profil"><img src="/profil/picture.php?user=<?= $_SESSION["user_name"] ?>" alt="Photo de profil de <?= $_SESSION["user_displayName"] ?>" width="60px"></a>
                <?php
                    }
                ?>
            </nav>
        </header>
        <div id="content">