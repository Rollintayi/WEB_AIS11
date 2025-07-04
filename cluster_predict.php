<?php
// exec("C:\\Users\\hp\\AppData\\Local\\Programs\\Python\\Python37-32\\python.exe -m pip install pymysql", $output, $return_var);
// exec("C:\\Users\\hp\\AppData\\Local\\Programs\\Python\\Python37-32\\python.exe -m pip install scikit-learn", $output, $return_var);
$output = [];
$return_var = 0;
exec("C:\\Python313\\python.exe C:\\XAMPP\\htdocs\\WEB_AIS11(2)\\scripts\\script_clust.py 2>&1", $output, $return_var);

$json = end($output); // La dernière ligne est le JSON
$data = json_decode($json, true);
if (!$data) {
    echo "Erreur de décodage JSON :<br><pre>";
    print_r($output);
    echo "</pre>";
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style\cluster_style.css">
    <link rel="icon" href="icones/logo_site_2.png" type="image/png">
    <title>Prédiction des clusters</title>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lobster&display=swap"
        rel="stylesheet">
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
            <div class="connexion">
                <a href="authentification.php">Se connecter</a>
            </div>
        </div>
    </header>
    <h1>Clusters prédits</h1>
    <div id="map"
        style="width: 100%; height: 600px; border: 1px solid #ccc; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.05); margin-bottom: 3rem;">
    </div>

    <script>
        const data = <?php echo json_encode($data); ?>;
        const clusterColors = ["#1f77b4", "#ff7f0e", "#2ca02c"];
        const traces = [0, 1, 2].map(cluster => {
            const points = data.filter(d => d.cluster == cluster);
            return {
                type: 'scattermapbox',
                mode: 'markers',
                name: 'Cluster ' + cluster,
                lat: points.map(p => parseFloat(p.Latitude)),
                lon: points.map(p => parseFloat(p.Longitude)),
                marker: { size: 12, color: clusterColors[cluster] },
                text: points.map(p => `MMSI: ${p.MMSI}`)
            };
        });
        Plotly.newPlot('map', traces, {
            mapbox: {
                style: 'open-street-map',
                center: { lat: 15, lon: -18 },
                zoom: 4
            },
            margin: { t: 0, b: 0 }
        }, { mapboxAccessToken: 'pk.eyJ1Ijoid2Fnc3oiLCJhIjoiY21jZXh1ZGoxMDJjODJpcXRneDUxdG1ucyJ9.DUuuKV9tP1NJS1-cXL93zg' });
    </script>
    <footer class="footer">
        <hr class="footer-line">
        <div class="footer-content">
            <img src="icones/github.png" alt="Icône pied de page" class="footer-icon">
        </div>
    </footer>
</body>

</html>