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
        <link rel="stylesheet" href="/assets/css/fonts/getAll.css">

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
                <div class="navLink"><object data="/assets/img/svg/home.svg" type="image/svg+xml" class="navIcon"></object><a href="/"></a></div>
                <div class="navLink"><object data="/assets/img/svg/fleur.svg" type="image/svg+xml" class="navIcon"></object><a href="/jardins"></a></div>
                <div class="navLink"><object data="/assets/img/svg/bulles.svg" type="image/svg+xml" class="navIcon"></object><a href="/contact"></a></div>
                
                <?php
                    if(empty($_SESSION["user_id"])){
                ?>
                    <div <?php if($page == "signin.php") echo "hidden"; ?> class="navLink"><object data="/assets/img/svg/user.svg" type="image/svg+xml" class="navIcon"></object><a href="/profil/signin.php?from=<?= $from; ?>"></a></div>
                    <div <?php if($page != "signin.php") echo "hidden"; ?> class="navLink"><object data="/assets/img/svg/user.svg" type="image/svg+xml" class="navIcon"></object><a href="/profil/signup.php?from=<?= $from; ?>"></a></div>
                <?php
                    }else{
                ?>
                    <!-- <a <?php if($page == "profil") echo "hidden"; ?> href="/profil"><img src="/profil/picture.php?user=<?= $_SESSION["user_name"] ?>" alt="Photo de profil de <?= $_SESSION["user_displayName"] ?>" width="60px"></a> -->
                    <a href="/profil"><div style="background-image: url('/profil/picture.php?user=<?= $_SESSION["user_name"] ?>');" class="navIcon image"></div></a>
                <?php
                    }
                ?>
            </nav>
        </header>
        <div id="content">