<?php
    if(empty($_GET["id"])) header("location: gestion.php");
    $id = "";
    try {
        $id = base64_decode($_GET["id"]);
        $id = intval($id);
    } catch (\Throwable $th) {
        header("location: ../");
    }
    if(!is_int($id)) header("location: gestion.php");


    $title = "Modifier un jardin - Seed";
    define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');
    require_once(DOCUMENT_ROOT . 'header.php');

    if(empty($_SESSION["user_id"])){
        header("location: /profil/signin.php?from=" . $from);
        die;
    }
    $userId = $_SESSION["user_id"];

    require('proc/db.inc.php');
    $db = dbConn();

    
?>
        <main>
            <div class="topHeroImage">
                <h1>Modifier</h1>
            </div>
            <br><br>

            
        </main>
<?php
    require_once(DOCUMENT_ROOT . 'footer.php');
