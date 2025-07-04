<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>AIS 11 | Ajouter un point</title>
    <link rel="icon" href="icones/logo_site_2.png" type="image/png">
    <link rel="stylesheet" href="style\style2.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lobster&display=swap"
        rel="stylesheet">
    <script src="ajout.js" defer></script>

</head>

<div id="toast"></div>

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
    <section class="form-container">
        <h2 class="form-title">Ajouter un point de donnée</h2>

        <form class="form-bateau">
            <div class="form-grid">
                <!-- <div class="form-group">
                    <label for="ID_point_naviguation">ID du point de naviguation</label>
                    <input type="text" id="nom" name="nom" placeholder="Valeur">
                </div> -->
                <div class="form-group">
                    <label for="nom">Nom du bateau</label>
                    <input type="text" id="nom" name="nom" placeholder="Valeur">
                </div>

                <div class="form-group">
                    <label for="mmsi">MMSI du bateau</label>
                    <input type="text" id="mmsi" name="mmsi" placeholder="Ex : 123456789">
                </div>

                <div class="form-group">
                    <label for="horodatage">Horodatage</label>
                    <input type="datetime-local" id="horodotage" name="horodatage" required>
                </div>

                <div class="form-group">
                    <label for="latitude">Latitude</label>
                    <input type="number" id="latitude" name="latitude" placeholder="En mètre" step="0.0001">
                </div>

                <div class="form-group">
                    <label for="longitude">Longitude</label>
                    <input type="number" id="longitude" name="longitude" placeholder="En mètre" step="0.0001">
                </div>
                <div class="form-group">
                    <label for="longueur">Longueur</label>
                    <input type="number" id="longueur" name="longueur" placeholder="En mètre" step="0.01">
                </div>

                <div class="form-group">
                    <label for="tirant d'eau">tirant d'eau</label>
                    <input type="number" id="tirant_eau" name="tirant_eau" placeholder="En mètre" step="0.01">
                </div>
                <div class="form-group">
                    <label for="longueur">Largeur</label>
                    <input type="number" id="largeur" name="largeur" placeholder="En mètre" step="0.01">
                </div>

                <div class="form-group">
                    <label for="sog">Vitesse SOG</label>
                    <input type="number" id="sog" name="sog" placeholder="Valeur" step="0.01">
                </div>
                <div class="form-group">
                    <label for="cog">Cap (COG)</label>
                    <input type="number" id="cog" name="cog" placeholder="En degré" step="0.01">
                </div>
                <div class="form-group">
                    <label for="cap_reel">Cap réel</label>
                    <input type="number" id="cap_reel" name="cap_reel" placeholder="En degré" step="0.01">
                </div>
                <div class="form-group">
                    <label for="type">Type</label>
                    <input type="text" id="type" name="type" placeholder="Entrez le type de bateau">
                </div>
            </div>

            <button type="submit" class="btn-ajouter">Enregistrer</button>
        </form>
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