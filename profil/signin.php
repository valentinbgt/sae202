<?php
    $title = "Connexion | Seed";
    define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');
    require_once(DOCUMENT_ROOT . 'header.php');

    $_SESSION["from"] = "";
    if(isset($_GET["from"])) $_SESSION["from"] = $_GET["from"];

    if(!empty($_SESSION["user_id"])){
        if(!empty($_GET["from"])) $from = urldecode(base64_decode($_GET["from"]));
        else $from = "/";
        header("location: $from");
        die;
    }
?>
        <main>
            <div class="topHeroImage">
                <h1>Connexion</h1>
            </div>
            <form id="signForm" action="/profil/inc/signin.proc.php" method="post" enctype="multipart/form-data">
                
                <div class="formDouble">
                    <div class="formBox">
                        <label for="userIdentifier">Nom d'utilisateur ou Email :</label>
                        <input type="text" name="userIdentifier" id="userIdentifier" placeholder="emma.martin">
                    </div>
                </div>
                
                <div class="formDouble">
                    <div class="formBox">
                        <label for="userPassword">Mot de passe :</label>
                        <input type="password" name="userPassword" id="userPassword" placeholder="************">
                    </div>
                </div>
                <div class="formDouble">
                    <div class="formBox">
                        <input type="submit" value="Se connecter">
                    </div>
                </div>

                <div class="signup-link">
                    <p>Vous n'avez pas de compte ? <a href="/profil/signup.php?from=<?= $from; ?>">S'inscrire</a></p>
                </div>

                <div class="signup-link">
                    <p><a href="/gestion/prof?from=<?= $_SESSION["from"]; ?>">Connexion prof</a></p>
                </div>
            </form>
    </div>        
        </main>
<?php
    require_once(DOCUMENT_ROOT . 'footer.php');