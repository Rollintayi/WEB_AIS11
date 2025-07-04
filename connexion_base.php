<?php
include 'database.php';

// Récupération des données du formulaire
$mmsi = $_POST['mmsi'] ?? '';
$nom = $_POST['nom'] ?? '';
$longueur = $_POST['longueur'] ?? '';
$largeur = $_POST['largeur'] ?? '';
$tirant_eau = $_POST['tirant_eau'] ?? '';
$date = $_POST['date'] ?? '';
$heure = $_POST['heure'] ?? '';
$horodatage = $date . ' ' . $heure;
$latitude = $_POST['latitude'] ?? '';
$longitude = $_POST['longitude'] ?? '';
$vitesse_sog = $_POST['sog'] ?? '';
$cap_cog = $_POST['cap'] ?? '';
$cap_reel = null; // Si tu veux le calculer, adapte ici

// 1. Insérer dans bateau si MMSI non existant
$stmt = $pdo->prepare("SELECT COUNT(*) FROM bateau WHERE MMSI = ?");
$stmt->execute([$mmsi]);
if ($stmt->fetchColumn() == 0) {
    $stmt = $pdo->prepare("INSERT INTO bateau (MMSI, Nom, Longueur, Largeur, Tirant_d_eau) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$mmsi, $nom, $longueur, $largeur, $tirant_eau]);
}

// 2. Insérer dans point_de_navigation
$stmt = $pdo->prepare("INSERT INTO point_de_navigation (MMSI, Horodatage, Latitude, Longitude, Vitesse_SOG, CAP_COG, Cap_Reel) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->execute([$mmsi, $horodatage, $latitude, $longitude, $vitesse_sog, $cap_cog, $cap_reel]);

echo "✅ Données enregistrées avec succès.";
?>

