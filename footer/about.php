<?php
    $title = "À propos | Seed";
    define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');
    require_once(DOCUMENT_ROOT . 'header.php');
?>

<main>
    <div class="topHeroImage">
        <h1>À propos de Seed</h1>
    </div>
    
    <section class="about-section">
        <h2>Notre Mission</h2>
        <p>
            Chez Seed, nous croyons en la puissance de la nature et de la communauté. Notre mission est de créer une plateforme où les passionnés de jardinage peuvent se connecter, partager des ressources, et cultiver des espaces verts ensemble. Nous nous efforçons de promouvoir des pratiques de jardinage durables et de rendre le jardinage accessible à tous.
        </p>
    </section>

    <section class="about-section">
        <h2>Nos Valeurs</h2>
        <ul>
            <li><strong>Communauté :</strong> Nous valorisons la collaboration et le partage des connaissances entre jardiniers de tous niveaux.</li>
            <li><strong>Soutien :</strong> Nous offrons un espace où les utilisateurs peuvent se soutenir mutuellement et trouver des ressources pour réussir leurs projets de jardinage.</li>
            <li><strong>Durabilité :</strong> Nous encourageons des pratiques de jardinage respectueuses de l'environnement pour contribuer à un avenir plus vert.</li>
        </ul>
    </section>

    <section class="about-section">
        <h2>Ce Que Nous Offrons</h2>
        <p>
            Sur Seed, vous trouverez une variété de fonctionnalités pour vous aider dans vos projets de jardinage :
        </p>
        <ul>
            <li><strong>Gestion des Jardins :</strong> Créez et gérez vos propres jardins, suivez l'évolution de vos plantations et partagez vos succès avec la communauté.</li>
            <li><strong>Parcelles Empruntées :</strong> Trouvez et gérez des parcelles de jardinage disponibles à emprunter près de chez vous.</li>
            <li><strong>Ressources et Conseils :</strong> Accédez à une vaste bibliothèque de ressources et de conseils de jardinage, fournis par des experts et des membres de la communauté.</li>
            <li><strong>Événements Communautaires :</strong> Participez à des événements locaux et virtuels pour rencontrer d'autres jardiniers et apprendre ensemble.</li>
        </ul>
    </section>

    <section class="about-section">
        <h2>Rejoignez-Nous</h2>
        <p>
            Que vous soyez un jardinier débutant ou expérimenté, Seed est l'endroit idéal pour vous épanouir. Rejoignez notre communauté dès aujourd'hui et commencez à cultiver votre passion pour le jardinage !
        </p><br>
        <?php
            if(empty($_SESSION["user_id"])){
        ?>
        <p><a href="/profil/signup.php">Créer un compte</a> | <a href="/profil/signin.php">Se connecter</a></p>
        <?php
            }
        ?>
    </section>
</main>

<?php
    require_once(DOCUMENT_ROOT . 'footer.php');
?>
