<?php
    $title = "Jardins - Seed";
    define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');
    require_once(DOCUMENT_ROOT . 'header.php');

    require_once('proc/db.inc.php');
?>
        <main>
            <div class="topHeroImage">
                <h1>Jardins</h1>
            </div>
            <h2 class="pageSeconTitle">Les parcelles <span style="text-wrap: nowrap;">à emprunter</spa></h2>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" class="searchForm">
                    <input type="search" name="search" id="searchInput" placeholder="Rechercher un jardin par localisation" value="<?php if(!empty($_GET['search'])) echo htmlentities($_GET['search']); ?>">
                </form><br>
            <?php
                if(!empty($_GET["search"])){
                    $search = $_GET["search"];
                }else{
                    $search = "";
                }
                $search = "%$search%";

                $db = dbConn();

                $req = "SELECT `jardin_id`, `jardin_gps`, `jardin_location`, `jardin_available`, `jardin_user_id` FROM `jardins` WHERE `jardin_available`=1 AND `jardin_location` LIKE :search";
                $query = $db->prepare($req);
                $query->bindParam(':search', $search);
                $query->execute();
                $res = $query->fetchAll(PDO::FETCH_ASSOC);

                $jardins_available = $res;
                $jardins = array();

                foreach ($jardins_available as $jardin) {
                    extract($jardin);
                    $jardins[$jardin_id] = $jardin;
                }
                
                $req = "SELECT * FROM `parcelles` WHERE `parcelle_available`=1 AND `parcelle_user_id`IS NULL";
                $query = $db->prepare($req);
                $query->execute();
                $res = $query->fetchAll(PDO::FETCH_ASSOC);

                $parcelles_available = $res;

                $parcelles_available_sort = [];

                foreach ($parcelles_available as $parcelle_available_key => $parcelle_available) {
                    $parcelleSorted = false;
                    foreach ($parcelles_available_sort as $parcelle_available_sort_key => $parcelle_available_sort) {
                        if(@$parcelle_available_sort["parcelle_taille"] == $parcelle_available["parcelle_taille"] && @$parcelle_available_sort["jardin_id"] == $parcelle_available["jardin_id"]){
                            $parcelleSorted = true;
                            $parcelles_available_sort[$parcelle_available_sort_key]["nbParcelles"]++;
                        };
                    }

                    if(@!$parcelleSorted){
                        $parcelle_available["nbParcelles"] = 1;
                        $parcelles_available_sort[$parcelle_available_key] = $parcelle_available;
                    }else{
                        
                    }
                }

                $parcelles_available = $parcelles_available_sort;


                shuffle($parcelles_available);

                ?>
            <div class="jardinsContainer parcelles">            
                <?php

                foreach ($parcelles_available as $parcelle) {
                    extract($parcelle);

                    if(!isset($jardins[$jardin_id])) continue;

                    extract($jardins[$jardin_id]);

                    $jardin_enc_id = urlencode(base64_encode($jardin_id));
                    $parcelle_enc_taille = urlencode(base64_encode($parcelle_taille));

                    $jardin_location = htmlentities($jardin_location);
                    $jardin_gps = htmlentities($jardin_gps);

                    $userName = getUserName($jardin_user_id);

                    $nbParcelles = $parcelle["nbParcelles"];

                    ?>
                        <div class="carteJardin">
                            <img class="photoJardin" src="/jardins/picture.php?id=<?= $jardin_enc_id ?>" alt="Photo du jardin 9 Rue De Quebec, 10000 Troyes, France">
                            <p class="jardinTitle" title="<?= $jardin_location ?>"><?= $jardin_location ?></p>
                            <p class="jardinGPS" title="<?= $jardin_gps ?>">GPS : <?= $jardin_gps ?></p>
                            <div class="separator"></div>
                            <div class="jardinDetails">
                                <p class="surface"><?= $parcelle_taille ?> m²<br><?= $nbParcelles ?> restante<?php if($nbParcelles > 1) echo "s";?></p>
                                <div class="separator"></div>
                                <p class="owner">propriétaire : <br><span class="actif"><?= $userName ?></span></p>
                            </div>
                            <div class="jardinActions">
                                <a href="borrow.php?id=<?= $jardin_enc_id ?>&s=<?= $parcelle_enc_taille ?>">Emprunter</a>
                            </div>
                        </div>
                    <?php
                }
                ?>
            </div>
            <p class="buttonContainer"><a class="button" href="gestion.php">Ajoutez votre jardin</a></p>
        </main>

        <script>
    function filterJardins() {
        // Get the search term from the input field
        var searchTerm = document.getElementById("searchInput").value.toLowerCase();

        // Get all the garden cards (assuming they have a class like "carteJardin")
        var gardenCards = document.querySelectorAll(".carteJardin");

        // Loop through each garden card
        for (var i = 0; i < gardenCards.length; i++) {
            var gardenCard = gardenCards[i];

            // Get the garden location text (assuming it has a class like "jardinTitle")
            var gardenLocation = gardenCard.querySelector(".jardinTitle").textContent.toLowerCase();

            // Check if the garden location text includes the search term
            if (gardenLocation.indexOf(searchTerm) !== -1) {
                // If it includes the term, show the card
                gardenCard.style.display = "block";
            } else {
                // If it doesn't include the term, hide the card
                gardenCard.style.display = "none";
            }
        }
    }

    // Attach event listener to search input
    document.getElementById("searchInput").addEventListener("keyup", filterJardins);
</script>
<?php
    require_once(DOCUMENT_ROOT . 'footer.php');