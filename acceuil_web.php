<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>AIS 11 | Acceuil</title>
    <link rel="icon" href="icones/logo_site_2.png" type="image/png">
    <link rel="stylesheet" href="style\style.css">
    <!-- Police stylée depuis Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lobster&display=swap"
        rel="stylesheet">
</head>

<body>

    <header class="navbar">
        <!-- Logo -->
        <div class="logo">
            <img src="icones/AIS_11-08.png" alt="Logo du site">
        </div>

        <!-- Navigation -->
        <nav class="menu">
            <ul>
                <li><a href="acceuil_web.php">Accueil</a></li>
                <li><a href="ajout_bateau.php">Ajouter</a></li>
                <li><a href="visualisation.php">Cartes</a></li>
            </ul>
        </nav>


    </header>
    <section class="image-banner">

        <!--exte positionné sur l’image-->
        <div class="texte-sur-image">
            <b>
                <h1>Gestionnaire de navigation maritime
            </b></h1> <br>
            Bienvenue dans notre application web intelligente. Elle vous permet d'analyser, classer et prédire le
            comportement des navires à partir de données AIS

        </div>
        <!-- Texte centré en bas de l’image -->
        <div class="texte-bas-image">
            Debute ton aventure en mer avec nous !
        </div>

        <div class="fade-bottom"></div>
    </section>
    <section class="galerie-section">
        <h2 class="galerie-titre">Galerie des bateaux</h2>

        <div class="galerie">
            <figure>
                <img src="images/bateau_passenger.jpg" alt="Image 1">
                <figcaption>bateau passenger</figcaption>
            </figure>

            <figure>
                <img src="images/bateau_cargo.jpg" alt="Image 2">
                <figcaption>Bateau cargo</figcaption>
            </figure>

            <figure>
                <img src="images/bateau_tanker.jpg" alt="Image 3">
                <figcaption>Bateau tanker</figcaption>
            </figure>
        </div>
    </section>
    <section class="ajouter-bateau-section">
        <a href="ajout_bateau.php"><button class="btn-ajouter">Ajouter un bateau</button></a>
    </section>
    <footer class="footer">
        <hr class="footer-line">
        <div class="footer-content">
            <a href="https://github.com/Rollintayi/WEB_AIS11"><img src="icones/github.png" alt="Icône pied de page"
                    class="footer-icon"></a>
        </div>
    </footer>

</body>

</html>