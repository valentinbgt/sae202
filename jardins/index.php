<?php
    $title = "Jardins - Seed";
    define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');
    require_once(DOCUMENT_ROOT . 'header.php');
?>
        <main>
            <div class="topHeroImage">
                <h1>Jardins</h1>
            </div>
            <h2 class="pageSeconTitle">Découvrez nos jardins</h2>
            <p>Aucune parcelle de jardin n'est disponible à l'emprunt actuellement.</p>
            <p><a href="gestion.php">Ajoutez votre jardin</a></p>
        </main>
<?php
    require_once(DOCUMENT_ROOT . 'footer.php');