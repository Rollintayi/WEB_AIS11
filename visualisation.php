<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AIS 11</title>
    <link rel="icon" href="icones/logo_site_2.png" type="image/png">
    <link rel="stylesheet" href="style\style_clust.css">
    <!-- Police stylée depuis Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lobster&display=swap"
        rel="stylesheet">
    <!-- Plotly Style -->
    <script src="https://cdn.plot.ly/plotly-2.24.1.min.js"></script>
    <!-- JS Scripts -->
    <script src="visualisation.js" defer></script>

</head>

<body>

    <header class="navbar">
        <div class="container">
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

            <!-- Connexion -->

        </div>
    </header>
    <main>
        <section aria-labelledby="title-section">
            <h1 id="title-section">Visualisation des Données AIS</h1>
            <p>Cette page permet de visualiser les données AIS collectées, d'analyser les trajectoires des bateaux et de
                prédire leur type.</p>
            <p>Utilisez les boutons ci-dessous pour interagir avec les données.</p>
            <div class="button-container">
                <button id="load-data">Charger les données</button>
                <button id="clear-data">Effacer les données</button>
            </div>
        </section>
        <section aria-labelledby="table-title">
            <h2 id="table-title">Détails des Relevés</h2>

            <div class="table-container">
                <table id="boats-table">
                    <caption>Liste des points enregistrés pour chaque bateau :</caption>
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">MMSI</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Longueur</th>
                            <th scope="col">Largeur</th>
                            <th scope="col">Tirant d'eau</th>
                            <th scope="col">Type</th>
                            <th scope="col">Latitude</th>
                            <th scope="col">Longitude</th>
                            <th scope="col">SOG</th>
                            <th scope="col">COG</th>
                            <th scope="col">Cap réel</th>
                            <th scope="col">Horodatage</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <!-- Les lignes seront insérées ici par JavaScript -->
                    </tbody>
                </table>
                <div class="button-container">
                    <div id="prediction-actions">
                        <button id="type" type="submit">Prédire le type</button>
                        <button id="path" type="submit">Prédire les trajectoires</button>
                        <button id="predict-clusters" type="submit">Prédire les clusters</button>
                    </div>
                </div>
            </div>
        </section>
        <section aria-labelledby="map-title">
            <h2 id="map-title">Carte des Trajectoires</h2>
            <div id="map-container"></div>
        </section>
    </main>


    <footer class="footer">
        <hr class="footer-line">
        <div class="footer-content">
            <a href="https://github.com/Rollintayi/WEB_AIS11"><img src="icones/github.png" alt="Icône pied de page"
                    class="footer-icon"></a>
        </div>
    </footer>

</body>

</html>