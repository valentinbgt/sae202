<?php
    $title = "Profil - Seed";
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
            <h2><?= $_SESSION["user_displayName"] ?></h2>
            <p><?= $user_name ?></p>
            <img src="/profil/picture.php?user=<?= $user_name; ?>" alt="Photo de profil de <?= $user_displayName ?>" width="300">
            <p><?= $user_email ?></p>
            <p><a href="/jardins/gestion.php">Gérer mes jardins</a></p>
            <p><a href="/jardins/gestion.php?emprunt">Gérer les parcelles empruntés</a></p>
            <!-- <p><a href="">Gérer les articles disponibles</a></p> -->
            <p><a href="/profil/inc/logout.proc.php">deconnexion</a></p>
        </main>
<?php
    require_once(DOCUMENT_ROOT . 'footer.php');