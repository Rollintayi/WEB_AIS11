<?php
// prediction_cluster.php

$output = [];
echo getcwd();
// exec("where python", $output);
// echo "<pre>";
// print_r($output);
// echo "</pre>";
// Exécute le script Python pour prédire les clusters
// Assurez-vous que le chemin vers Python et le script est correct

// exec("C:\\Users\\hp\\AppData\\Local\\Programs\\Python\\Python37-32\\python.exe -m pip install pymysql", $output, $return_var);
// exec("C:\\Users\\hp\\AppData\\Local\\Programs\\Python\\Python37-32\\python.exe -m pip install scikit-learn", $output, $return_var);
exec("C:\\Users\\hp\\AppData\\Local\\Programs\\Python\\Python37-32\\python.exe C:\\xampp\\htdocs\\WEB_AIS11\\WEB_AIS11\\Projet_WEB\\test.py 2>&1", $output, $return_var);
$json = end($output); // La dernière ligne est le JSON
$data = json_decode($json, true);
if (!$data) {
    echo "Erreur de décodage JSON :<br><pre>";
    print_r($output);
    echo "</pre>";
    exit;
}

// Tu peux maintenant afficher une carte avec Plotly ici
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Prédiction des clusters</title>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>

<body>
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
        }, { mapboxAccessToken: 'pk.eyJ1Ijoicm9sbGludGF5aSIsImEiOiJjbWMybDFuMTgwOXhhMmxzZHNpcXlidnY2In0.A-oJhjFocH47TsX6y63A-g' });
    </script>
</body>

</html>