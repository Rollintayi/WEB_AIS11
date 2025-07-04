<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style\prediction_t_style.css">
    <link rel="icon" href="icones/logo_site_2.png" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lobster&display=swap"
        rel="stylesheet">
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <title> Prédiction|Type et trajectoire</title>
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
        <h1> Résultats de prédiction</h1>
        <?php
        $mmsi = $_GET['mmsi'] ?? "";
        echo "<h2>Prédiction en cours pour le MMSI : $mmsi</h2>";
        ?>
        <div class="recap">
            <div class="type">
                <select id="method">
                    <option value="none">Méthode</option>
                    <option value="0">Random Forest</option>
                    <option value="1">Logistic Regression</option>
                    <option value="2">Support Vector Machine</option>
                    <option value="3">Decision Tree</option>
                </select>
                <script>
                    'use strict';

                    document.getElementById("method").addEventListener("change", function () {
                        const selected = this.value;
                        const print = document.getElementById("print");

                        if (selected !== "none" && predictions[selected] !== undefined) {
                            print.textContent = "Type : " + predictions[selected];
                        } else {
                            print.textContent = "Type : ---";
                        }
                    });
                </script>

                <div class="result_type">

                    <?php

                    $mmsi = $_GET['mmsi'] ?? null;
                    if (!$mmsi) {
                        die("MMSI non fourni.");
                    }

                    $bateaux = json_decode(file_get_contents("bateaux.json"), true);
                    $bateau = null;

                    foreach ($bateaux as $b) {
                        if ($b['mmsi'] == $mmsi) {
                            $bateau = $b;
                            break;
                        }
                    }

                    if (!$bateau) {
                        die("Bateau avec MMSI $mmsi non trouvé.");
                    }

                    // Préparer les variables
                    $length = escapeshellarg($bateau['length']);
                    $width = escapeshellarg($bateau['width']);
                    $draft = escapeshellarg($bateau['draft']);

                    $results = [4];
                    // Exécution du script Python
                    $cmd = "python scripts\script_type.py $length $width $draft";
                    $output = shell_exec($cmd);
                    $data = json_decode($output, true) ?? "Erreur";
                    $results[0] = $data["random forest"] ?? "Erreur";
                    $results[1] = $data["logistic regression"] ?? "Erreur";
                    $results[2] = $data["svm"] ?? "Erreur";
                    $results[3] = $data["decision tree"] ?? "Erreur";
                    ?>
                    <script>
                        const predictions = <?= json_encode($results) ?>;
                    </script>

                    <p class="print" id="print">Type : ---</p>
                </div>
            </div>
            <div class="trajectory">
                <h2>Trajectoire prédite</h2>
                <?php
                $mmsi = $_GET['mmsi'] ?? null;
                if (!$mmsi) {
                    die("MMSI non fourni.");
                }

                $bateaux = json_decode(file_get_contents("bateaux.json"), true);
                $bateau = null;

                foreach ($bateaux as $b) {
                    if ($b['mmsi'] == $mmsi) {
                        $bateau = $b;
                        break;
                    }
                }

                if (!$bateau) {
                    die("Bateau avec MMSI $mmsi non trouvé.");
                }
                // Préparer les variables
                $lat = escapeshellarg($bateau['latitude']);
                $lon = escapeshellarg($bateau['longitude']);
                $SOG = escapeshellarg($bateau['vitesse']);
                $COG = escapeshellarg($bateau['direction']);
                $heading = escapeshellarg($bateau['heading']);
                $length = escapeshellarg($bateau['length']);
                $draft = escapeshellarg($bateau['draft']);

                // Exécution du script Python
                $cmd = "python scripts\script_trajectory.py $lat $lon $SOG $COG $heading $length $draft";
                $output = shell_exec($cmd);
                echo "<pre>$output</pre>";
                $data = json_decode($output, true);
                ?>

                <ul>
                    <li>+5 min → Latitude : <?= $data['pred_5']['lat'] ?>, Longitude : <?= $data['pred_5']['lon'] ?>
                    </li>
                    <li>+10 min → Latitude : <?= $data['pred_10']['lat'] ?>, Longitude : <?= $data['pred_10']['lon'] ?>
                    </li>
                    <li>+15 min → Latitude : <?= $data['pred_15']['lat'] ?>, Longitude : <?= $data['pred_15']['lon'] ?>
                    </li>
                </ul>

                <div id="graph">
                    <?php
                    echo '<iframe src="trajectoire.html" width="100%" height="600" style="border:none;"></iframe>';
                    ?>
                </div>
            </div>
        </div>
        <div class="back" onclick="history.go(-1);">Retour</div>
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