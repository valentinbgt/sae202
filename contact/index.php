<?php
    $title = "Jardins - Seed";
    define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');
    require_once(DOCUMENT_ROOT . 'header.php');
?>
        <main>
            <div class="topHeroImage">
                <h1>Contact</h1>
            </div>
            <h2 class="pageSeconTitle">Contactez nous si besoin</h2>
            <form id="signForm" action="sendMail.php" method="post">
                <div class="formDouble">
                    <div class="formBox">
                        <label for="contactName">Prénom NOM</label>
                        <input required type="text" name="contactName" id="contactName" placeholder="Emma MARTIN">
                    </div>
                    <div class="formBox">
                        <label for="contactEmail">Adresse Email</label>
                        <input required type="email" name="contactEmail" id="contactEmail" placeholder="emma.martin@gmail.com">
                    </div>
                </div>
                
                <div class="formBox">
                    <label for="contactObject">Object de la demande</label>
                    <input required type="email" name="contactObject" id="contactObject" placeholder="Demande de partenariat">
                </div>
                
                <div class="formBox textarea">
                    <label for="contactEmail">Adresse Email</label>
                    <textarea required name="contactMessage" id="contactMessage" placeholder="Bonjour,..."></textarea>
                </div>

                <div class="formDouble">
                    <div class="formBox">
                        <input type="submit" value="Envoyer">
                    </div>
                </div>
            </form>
        </main>
<?php
    require_once(DOCUMENT_ROOT . 'footer.php');