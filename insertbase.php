<?php

include 'constants.php';
header('Content-Type: application/json');

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

ini_set('display_errors', 1);
error_reporting(E_ALL);

$pdo = getPDO();

if (!$pdo) {
    error_log('Erreur de connexion.');
    header('HTTP/1.1 503 Service Unavailable');
    exit;
}

// Récupération des données du formulaire
$mmsi        = $_POST['mmsi']         ?? null;
$nom         = $_POST['nom']          ?? null;
$longueur    = $_POST['longueur']     ?? null;
$largeur     = $_POST['largeur']      ?? null;
$tirant_eau  = $_POST['tirant_eau']   ?? null;
$type        = $_POST['type']         ?? null;

// Prendre la bonne valeur d'horodatage (champ caché ou champ datetime-local)
$horodatage  = $_POST['horodatage']   ?? null;
if (empty($horodatage) && isset($_POST['horodotage'])) {
    $horodatage = $_POST['horodotage'];
}
$latitude    = $_POST['latitude']     ?? null;
$longitude   = $_POST['longitude']    ?? null;
$sog         = $_POST['sog']          ?? null;
$cog         = $_POST['cog']          ?? null;
$heading     = $_POST['cap_reel']     ?? null;

// Vérification des champs obligatoires
if (empty($mmsi) || empty($horodatage)) {
    echo json_encode(['success' => false, 'message' => 'MMSI et horodatage sont obligatoires.']);
    exit;
}

try {
    // Vérifie si le bateau existe déjà (MMSI unique)
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM bateau WHERE MMSI = :mmsi");
    $stmt->execute([':mmsi' => $mmsi]);
    $existe = $stmt->fetchColumn();

    if ($existe == 0) {
        // Insère le bateau uniquement s'il n'existe pas
        $stmt = $pdo->prepare("INSERT INTO bateau
            (MMSI, Nom, Longueur, Largeur, Tirant_d_eau, Type)
            VALUES (:mmsi, :nom, :longueur, :largeur, :tirant_eau, :type)");
        $stmt->execute([
            ':mmsi'        => $mmsi,
            ':nom'         => $nom,
            ':longueur'    => $longueur,
            ':largeur'     => $largeur,
            ':tirant_eau'  => $tirant_eau,
            ':type'        => $type
        ]);
    }

    // Insère toujours une nouvelle ligne dans point_de_navigation (ID_Point auto-incrémenté)
    $stmt = $pdo->prepare("INSERT INTO point_de_navigation
        (MMSI, Horodatage, Latitude, Longitude, Vitesse_SOG, CAP_COG, Cap_Reel)
        VALUES (:mmsi, :horodatage, :latitude, :longitude, :sog, :cog, :cap_reel)");
    $stmt->execute([
        ':mmsi'        => $mmsi,
        ':horodatage'  => $horodatage,
        ':latitude'    => $latitude,
        ':longitude'   => $longitude,
        ':sog'         => $sog,
        ':cog'         => $cog,
        ':cap_reel'    => $heading,
    ]);

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

// Récupérer les données JSON envoyées via fetch()
if ($_SERVER['CONTENT_TYPE'] === 'application/json') {
    $data = json_decode(file_get_contents('php://input'), true);
    $_POST = $data; // Injecte dans $_POST pour réutiliser le code existant
}

?>