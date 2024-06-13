<?php
    $title = "Profil | Seed";
    define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');
    require_once(DOCUMENT_ROOT . 'header.php');

    if(empty($_SESSION["user_id"])){
        header("location: /profil/signin.php?from=" . $from);
        die;
    }

    require('inc/db.inc.php');
    $user = findOne('users', 'user_id', $_SESSION['user_id']);
    extract($user);
?>

<main>
    <div class="topHeroImage">
        <h1>Profil</h1>
    </div>
    <div class="profile-info">
        <div class="profile-picture">
            <div class="circle"></div>
            <img src="/profil/picture.php?user=<?= $user_name; ?>" alt="Photo de profil de <?= $user_displayName ?>" width="100">
        </div>
        <h2>@<?= $_SESSION["user_displayName"] ?></h2>
    </div>
    <div class="stars">
    <svg id="Calque_2" data-name="Calque 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 708.66 708.66" >
        <g id="Calque_1-2" data-name="Calque 1">
            <g>
                <path class="cls-1" d="M331.23,0h46.39c66.6,20.96,114.39,57.24,116.57,127.73,99.53-24.33,154.45-11.64,189.66,47.95,14.04,23.77,26.67,55.93,20.66,80.25-9.05,36.63-35.01,69.73-55.24,107.01,60.76,53.97,74.63,99.63,42.87,158.47-34.07,63.12-88.32,80.92-194.26,63.74-26.55,86.53-69.45,123.47-143.42,123.52-73.93.05-117.23-37.22-143.45-123.47-104.71,16.5-156.15,2.36-189.5-58.02-12.26-22.2-23.94-51.99-17.66-73.89,10.52-36.64,35.67-69.73,56.08-106.9C1.05,296.06-16.24,248.78,16.08,191.43c13.52-23.99,36.27-46.13,60.38-61.96,42.24-27.74,89.98-15.57,138.16-1.09,3.66-72.66,51.32-107.64,116.61-128.38ZM354.18,234.86c-70.08.16-130.54,55.55-131.05,120.08-.52,64.38,59.17,120.3,129.59,121.42,71.08,1.13,133.81-56.35,132.98-121.87-.81-64.63-61.45-119.79-131.52-119.63Z"/>
                <path class="cls-1" d="M352.9,299.13c35.03-.68,61.8,22.35,62.98,54.19,1.24,33.66-25.4,58.96-61.88,58.76-35.09-.19-60.76-23.73-61.03-55.97-.27-32.27,25.01-56.3,59.93-56.98Z"/>
            </g>
        </g>
    </svg>
    <svg id="Calque_2" data-name="Calque 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 708.66 708.66" >
        <g id="Calque_1-2" data-name="Calque 1">
            <g>
                <path class="cls-1" d="M331.23,0h46.39c66.6,20.96,114.39,57.24,116.57,127.73,99.53-24.33,154.45-11.64,189.66,47.95,14.04,23.77,26.67,55.93,20.66,80.25-9.05,36.63-35.01,69.73-55.24,107.01,60.76,53.97,74.63,99.63,42.87,158.47-34.07,63.12-88.32,80.92-194.26,63.74-26.55,86.53-69.45,123.47-143.42,123.52-73.93.05-117.23-37.22-143.45-123.47-104.71,16.5-156.15,2.36-189.5-58.02-12.26-22.2-23.94-51.99-17.66-73.89,10.52-36.64,35.67-69.73,56.08-106.9C1.05,296.06-16.24,248.78,16.08,191.43c13.52-23.99,36.27-46.13,60.38-61.96,42.24-27.74,89.98-15.57,138.16-1.09,3.66-72.66,51.32-107.64,116.61-128.38ZM354.18,234.86c-70.08.16-130.54,55.55-131.05,120.08-.52,64.38,59.17,120.3,129.59,121.42,71.08,1.13,133.81-56.35,132.98-121.87-.81-64.63-61.45-119.79-131.52-119.63Z"/>
                <path class="cls-1" d="M352.9,299.13c35.03-.68,61.8,22.35,62.98,54.19,1.24,33.66-25.4,58.96-61.88,58.76-35.09-.19-60.76-23.73-61.03-55.97-.27-32.27,25.01-56.3,59.93-56.98Z"/>
            </g>
        </g>
    </svg>
    <svg id="Calque_2" data-name="Calque 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 708.66 708.66" >
        <g id="Calque_1-2" data-name="Calque 1">
            <g>
                <path class="cls-1" d="M331.23,0h46.39c66.6,20.96,114.39,57.24,116.57,127.73,99.53-24.33,154.45-11.64,189.66,47.95,14.04,23.77,26.67,55.93,20.66,80.25-9.05,36.63-35.01,69.73-55.24,107.01,60.76,53.97,74.63,99.63,42.87,158.47-34.07,63.12-88.32,80.92-194.26,63.74-26.55,86.53-69.45,123.47-143.42,123.52-73.93.05-117.23-37.22-143.45-123.47-104.71,16.5-156.15,2.36-189.5-58.02-12.26-22.2-23.94-51.99-17.66-73.89,10.52-36.64,35.67-69.73,56.08-106.9C1.05,296.06-16.24,248.78,16.08,191.43c13.52-23.99,36.27-46.13,60.38-61.96,42.24-27.74,89.98-15.57,138.16-1.09,3.66-72.66,51.32-107.64,116.61-128.38ZM354.18,234.86c-70.08.16-130.54,55.55-131.05,120.08-.52,64.38,59.17,120.3,129.59,121.42,71.08,1.13,133.81-56.35,132.98-121.87-.81-64.63-61.45-119.79-131.52-119.63Z"/>
                <path class="cls-1" d="M352.9,299.13c35.03-.68,61.8,22.35,62.98,54.19,1.24,33.66-25.4,58.96-61.88,58.76-35.09-.19-60.76-23.73-61.03-55.97-.27-32.27,25.01-56.3,59.93-56.98Z"/>
            </g>
        </g>
    </svg>
    <svg id="Calque_2" data-name="Calque 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 708.66 708.66" >
        <g id="Calque_1-2" data-name="Calque 1">
            <g>
                <path class="cls-1" d="M331.23,0h46.39c66.6,20.96,114.39,57.24,116.57,127.73,99.53-24.33,154.45-11.64,189.66,47.95,14.04,23.77,26.67,55.93,20.66,80.25-9.05,36.63-35.01,69.73-55.24,107.01,60.76,53.97,74.63,99.63,42.87,158.47-34.07,63.12-88.32,80.92-194.26,63.74-26.55,86.53-69.45,123.47-143.42,123.52-73.93.05-117.23-37.22-143.45-123.47-104.71,16.5-156.15,2.36-189.5-58.02-12.26-22.2-23.94-51.99-17.66-73.89,10.52-36.64,35.67-69.73,56.08-106.9C1.05,296.06-16.24,248.78,16.08,191.43c13.52-23.99,36.27-46.13,60.38-61.96,42.24-27.74,89.98-15.57,138.16-1.09,3.66-72.66,51.32-107.64,116.61-128.38ZM354.18,234.86c-70.08.16-130.54,55.55-131.05,120.08-.52,64.38,59.17,120.3,129.59,121.42,71.08,1.13,133.81-56.35,132.98-121.87-.81-64.63-61.45-119.79-131.52-119.63Z"/>
                <path class="cls-1" d="M352.9,299.13c35.03-.68,61.8,22.35,62.98,54.19,1.24,33.66-25.4,58.96-61.88,58.76-35.09-.19-60.76-23.73-61.03-55.97-.27-32.27,25.01-56.3,59.93-56.98Z"/>
            </g>
        </g>
    </svg>
    <svg id="Calque_2" data-name="Calque 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 708.66 708.66">
    <g id="Calque_1-2" data-name="Calque 1">
        <clipPath id="half-flower">
            <rect x="0" y="0" width="354.33" height="708.66" />
        </clipPath>
        <g clip-path="url(#half-flower)">
            <g>
                <path class="cls-1" d="M331.23,0h46.39c66.6,20.96,114.39,57.24,116.57,127.73,99.53-24.33,154.45-11.64,189.66,47.95,14.04,23.77,26.67,55.93,20.66,80.25-9.05,36.63-35.01,69.73-55.24,107.01,60.76,53.97,74.63,99.63,42.87,158.47-34.07,63.12-88.32,80.92-194.26,63.74-26.55,86.53-69.45,123.47-143.42,123.52-73.93.05-117.23-37.22-143.45-123.47-104.71,16.5-156.15,2.36-189.5-58.02-12.26-22.2-23.94-51.99-17.66-73.89,10.52-36.64,35.67-69.73,56.08-106.9C1.05,296.06-16.24,248.78,16.08,191.43c13.52-23.99,36.27-46.13,60.38-61.96,42.24-27.74,89.98-15.57,138.16-1.09,3.66-72.66,51.32-107.64,116.61-128.38ZM354.18,234.86c-70.08.16-130.54,55.55-131.05,120.08-.52,64.38,59.17,120.3,129.59,121.42,71.08,1.13,133.81-56.35,132.98-121.87-.81-64.63-61.45-119.79-131.52-119.63Z"/>
                <path class="cls-1" d="M352.9,299.13c35.03-.68,61.8,22.35,62.98,54.19,1.24,33.66-25.4,58.96-61.88,58.76-35.09-.19-60.76-23.73-61.03-55.97-.27-32.27,25.01-56.3,59.93-56.98Z"/>
            </g>
        </g>
    </g>
</svg>
</div>
    <div class="dropdown">
        <button class="dropbtn">Paramètres</button>
        <div class="dropdown-content" id="myDropdown">
            <a href="/jardins/gestion.php">Gérer mes jardins</a>
            <a href="/jardins/gestion.php?emprunt">Gérer les parcelles empruntées</a>
            <a href="/profil/inc/logout.proc.php">Déconnexion</a>
        </div>
    </div>
</main>

<?php
    require_once(DOCUMENT_ROOT . 'footer.php');
?>
