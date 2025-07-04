<?php
include 'constants.php';
function getPDO()
{
    try {
        $dsn = 'mysql:host=' . DB_SERVER . ';port=' . DB_SERVER_PORT . ';dbname=' . DB_NAME . ';charset=utf8';
        $pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
}
try {
    $pdo = getPDO();
    $sql = "SELECT 
                b.MMSI, b.Nom, b.Longueur, b.Largeur, b.Tirant_d_eau, b.Type,
                p.Horodatage, p.Latitude, p.Longitude, p.Vitesse_SOG, p.CAP_COG, p.Cap_Reel, p.Date_prediction
            FROM bateau b
            JOIN point_de_navigation p ON b.MMSI = p.MMSI
            ORDER BY b.MMSI, p.Horodatage DESC";

    $stmt = $pdo->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>