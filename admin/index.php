<?php
    $title = "Panel admin - Seed";
    define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');
    require_once(DOCUMENT_ROOT . 'header.php');

    if(empty($_SESSION["user_id"])){
        header("location: /profil/signin.php?from=" . $from);
        die;
    }
    $userId = $_SESSION["user_id"];

    if($_SESSION["user_type"] !== "admin"){
        header("location: /");
        die();
    }

    require('../profil/inc/db.inc.php');
    $db = dbConn();
?>
        <main>
            <h1>Pannel admin</h1>
            <br><br>

            <?php
                $users = findAll('users');
                // var_dump($jardins);

                if(count($users) < 1){
            ?>
                <p>Aucun utilisateur inscrit.</p>
            <?php
                }else{
                    foreach($users as $user){
                        extract($user);
            ?>

                        <img src="/profil/picture.php?user=<?= $user_name ?>" alt="Photo de <?= $user_displayName; ?>" height="100px">
                        <p>
                            <?= $user_displayName ?> (<?= $user_name; ?>)<br>
                            <?= $user_type ?> - 
                            <a href="#">modifier</a> - <a href="#">supprimer</a>
                        </p>

            <?php
                    }
                }
            ?>
        </main>
<?php
    require_once(DOCUMENT_ROOT . 'footer.php');