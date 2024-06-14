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
                <?php
                // Définissez $_SESSION["user_displayName"] ici si l'utilisateur est connecté

                if(isset($_SESSION["user_displayName"])) {
                    $userDisplayName = $_SESSION["user_displayName"];
                    echo "<h2>Bonjour, $userDisplayName.</h2>";
                }
                ?>

            </main>
<?php
    require_once(DOCUMENT_ROOT . 'footer.php');