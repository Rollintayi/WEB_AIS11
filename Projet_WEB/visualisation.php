<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AIS 11</title>
    <link rel="stylesheet" href="style.css">
    <!-- Police stylée depuis Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
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
                <img src="IMG/AIS_11-08.png" alt="Logo du site">
            </div>

            <!-- Navigation -->
            <nav class="menu">
                <ul>
                    <li><a href="#">Accueil</a></li>
                    <li><a href="#">Ajouter</a></li>
                    <li><a href="#">Prédictions</a></li>
                    <li><a href="#">Cartes</a></li>
                </ul>
            </nav>

            <!-- Connexion -->
            <div class="connexion">
                <a href="#">Se connecter</a>
            </div>
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
                            <th scope="col">MMSI</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Longueur</th>
                            <th scope="col">Largeur</th>
                            <th scope="col">Tirant d'eau</th>
                            <th scope="col">État</th>
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
                <div id="prediction-actions">
                    <button id="type">Prédire le type</button>
                    <button id="path">Prédire la trajectoire</button>
                </div>
                <form action="cluster_predict.php" method="post" target="_blank">
                    <button id="predict-clusters" type="submit">Prédire les clusters</button>
                </form>
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
            <img src="github.png" alt="Icône pied de page" class="footer-icon">
        </div>
    </footer>

</body>

</html>