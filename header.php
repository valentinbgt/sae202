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
        <meta name="description" content="Seed, partagez votre jardin et faites des échanges dans une démarche éco responsable.">
        <link rel="icon" href="/assets/img/Favicon.svg" type="image/x-icon">
        <title><?= $title ?></title>

        <link rel="stylesheet" href="/assets/css/style.css">
        <link rel="stylesheet" href="/assets/css/fonts/getAll.css">

        <script src="/assets/js/main.js"></script>
        <script src="/assets/js/animation.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous">

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
                <div class="navLink <?= ($page == 'index.php' || $page == '') ? 'active' : '' ?>"><object title="Accueil" data="/assets/img/svg/home.svg" type="image/svg+xml" class="navIcon" aria-label="Accueil"></object><a href="/"><span class="navLinkText"><img class="home-logo" src="/assets/img/svg/logo.svg" alt="Seed Logo" title="Seed - Écojardinage urbain"></span></a></div>
                <div class="navLink <?= ($page == 'jardins') ? 'active' : '' ?>"><object title="Jardin" data="/assets/img/svg/fleur.svg" type="image/svg+xml" class="navIcon" aria-label="Jardin"></object><a href="/jardins"><span class="navLinkText">Jardins</span></a></div>
                <div class="navLink <?= ($page == 'gestion.php') ? 'active' : '' ?>"><object title="Gestion" data="/assets/img/svg/bulles.svg" type="image/svg+xml" class="navIcon" aria-label="Gestion"></object><a href="/jardins/gestion.php"><span class="navLinkText">Gestion</span></a></div>
                
                <?php
                    if(empty($_SESSION["user_id"])){
                ?>
                    <div <?php if($page == "signin.php") echo "hidden"; ?> <?= ($page == 'signin.php') ? 'class="navLink active"' : 'class="navLink"' ?>><object data="/assets/img/svg/user.svg" type="image/svg+xml" class="navIcon"></object><a href="/profil/signin.php?from=<?= $from; ?>"><span class="navLinkText">Connexion</span></a></div>
                    <div <?php if($page != "signin.php") echo "hidden"; ?> <?= ($page == 'signup.php') ? 'class="navLink active"' : 'class="navLink"' ?>><object data="/assets/img/svg/user.svg" type="image/svg+xml" class="navIcon"></object><a href="/profil/signup.php?from=<?= $from; ?>"><span class="navLinkText">Inscription</span></a></div>
                <?php
                    }else{
                ?>
                    <a href="/profil" title="Page profil utilisateur"><div style="background-image: url('/profil/picture.php?user=<?= $_SESSION["user_name"] ?>');" class="navIcon image"></div></a>
                <?php
                    }
                ?>
            </nav>
        </header>
        <div id="content">