<?php
    $title = "Seed - Accueil";
    define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');
    require_once(DOCUMENT_ROOT . 'header.php');
?>
<main>
    <section class="section" id="home">
        <div class="background"></div>
        <div class="content">
            <div class="text">
                <h2 class="pageSeconTitle">Pour un meilleur avenir, <span class="more-sugar">Seed</span>.</h2>
                <?php
                if(isset($_SESSION["user_displayName"])) {
                    $userDisplayName = $_SESSION["user_displayName"];
                    echo "<h2>Bonjour, $userDisplayName.</h2>";
                }
                ?><br>
                <a href="#about2" class="about-index">En Savoir Plus</a> 
            </div>
            <div class="image">
                <img src="/assets/img/svg/logo.svg" alt="Seed Image" title="Logo de Seed - Écojardinage urbain">
            </div>
        </div>
    </section>

    <section class="section" id="about2">
        <div class="background"></div>
        <div class="content">
            <div class="text">
                <h1>QU'EST-CE QUE Seed ?</h1><br>
                <p>Chez Seed, nous croyons en la puissance de la nature et de la communauté. Notre mission est de créer une plateforme où les passionnés de jardinage peuvent se connecter, partager des ressources, et cultiver des espaces verts ensemble. Nous nous efforçons de promouvoir des pratiques de jardinage durables et de rendre le jardinage accessible à tous.</p>
            </div>
            <div class="image2">
                <img src="/assets/img/Index2.webp" alt="Image de jardinage urbain" title="Image de jardinage urbain">
            </div>
        </div>
    </section>

    <section class="section" id="services">
        <div class="background"></div>
        <div class="content">
            <div class="text">
                <h1>Nos fonctionnalités</h1><br>
                <p>Chez Seed, nous croyons en la puissance de la nature et de la communauté. Notre mission est de créer une plateforme où les passionnés de jardinage peuvent se connecter, partager des ressources, et cultiver des espaces verts ensemble. Nous promouvons des pratiques de jardinage durables et accessibles.</p><br>
            </div>
            <div class="image2">
                <img src="/assets/img/index3.webp" alt="Image de jardinage urbain" title="Image de jardinage urbain">
            </div>
        </div>
    </section>

    <section class="section" id="third-section">
        <div class="background"></div>
        <div class="content">
            <div class="text">
                <h1>Constante Évolution</h1><br>
                <p>Nous nous engageons à offrir une expérience utilisateur exceptionnelle en mettant constamment à jour nos fonctionnalités et en fournissant un support client réactif et compréhensif. Chez Seed, nous valorisons votre satisfaction et nous nous efforçons d'améliorer notre plateforme pour répondre aux besoins changeants de notre communauté.</p><br>
                <a href="/contact/index.php" class="about-index">Nous Contacter</a>
            </div>
            <div class="image2">
                <img src="/assets/img/index4.webp" alt="Image de jardinage urbain" title="Image de jardinage urbain">
            </div>
        </div>
    </section>
</main>

<?php
    require_once(DOCUMENT_ROOT . 'footer.php');
?>
