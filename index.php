<?php
    $title = "Seed - Accueil";
    define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');
    require_once(DOCUMENT_ROOT . 'header.php');
?>
        <main>
            <div class="topHeroImage">
                <h1>Seed</h1>
            </div>
            <h2 class="pageSeconTitle">Pour un meilleur avenir, <span class="more-sugar">Seed</span>.</h2>
            <h2>Bonjour, <?= $_SESSION["user_displayName"] ?>.</h2>
        </main>
<?php
    require_once(DOCUMENT_ROOT . 'footer.php');