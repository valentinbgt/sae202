<?php
    $title = "Jardins - Seed";
    define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');
    require_once(DOCUMENT_ROOT . 'header.php');
?>
        <main>
            <div class="topHeroImage">
                <h1>Contact</h1>
            </div>
            <form action="sendMail.php" method="post">
                <input required type="text" name="contactName" id="contactName" placeholder="Prénom NOM"><br>
                <input required type="email" name="contactEmail" id="contactEmail" placeholder="Adresse Email"><br>
                <input required type="text" name="contactObject" id="contactObject" placeholder="Objet"><br>
                <textarea required name="contactMessage" id="contactMessage"></textarea><br>
                <input type="submit" value="Envoyer">
            </form>
        </main>
<?php
    require_once(DOCUMENT_ROOT . 'footer.php');