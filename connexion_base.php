<?php
<?php
$pdo = new PDO("mysql:host=localhost;dbname=donnees ais;charset=utf8", "root", "");

// Récupération des données du formulaire
$MMSI = $_POST['MMSI'];
$Latitude = $_POST['Latitude'];
$Longitude = $_POST['Longitude'];
$Vitesse_SOG = $_POST['Vitesse_SOG'];
$CAP_COG = $_POST['CAP_COG'];
$ID_etat = $_POST['ID_etat'];

// Combiner date et heure pour Horodatage
$date = $_POST['date'];
$heure = $_POST['heure'];
$Horodatage = $date . ' ' . $heure;
// Validation des données
// Champs non présents dans le formulaire : à adapter selon tes besoins
$ID_point = null;
$Cap_Reel = null;
$Date_prediction = null;
$ID_cluster = null;

// Préparation de la requête SQL sécurisée
$sql = "INSERT INTO point_de_navigation 
        (ID_point, MMSI, Horodatage, Latitude, Longitude, Vitesse_SOG, CAP_COG, Cap_Reel, Date_prediction, ID_cluster, ID_etat)
        VALUES 
        (:ID_point, :MMSI, :Horodatage, :Latitude, :Longitude, :Vitesse_SOG, :CAP_COG, :Cap_Reel, :Date_prediction, :ID_cluster, :ID_etat)";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':ID_point' => $ID_point,
    ':MMSI' => $MMSI,
    ':Horodatage' => $Horodatage,
    ':Latitude' => $Latitude,
    ':Longitude' => $Longitude,
    ':Vitesse_SOG' => $Vitesse_SOG,
    ':CAP_COG' => $CAP_COG,
    ':Cap_Reel' => $Cap_Reel,
    ':Date_prediction' => $Date_prediction,
    ':ID_cluster' => $ID_cluster,
    ':ID_etat' => $ID_etat
]);

echo "✅ Données insérées dans la base donnees_ais.";
?>

