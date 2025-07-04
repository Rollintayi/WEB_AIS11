<?php
include 'constants.php';
header('Content-Type: application/json');
try {
    $pdo = new PDO(
        'mysql:host=' . DB_SERVER . ';port=' . DB_SERVER_PORT . ';dbname=' . DB_NAME . ';charset=utf8',
        DB_USER,
        DB_PASSWORD
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $input = json_decode(file_get_contents('php://input'), true);

    // Permet la suppression multiple (tableau d'objets) ou simple (un objet)
    $rows = [];
    if (isset($input[0]) && is_array($input[0])) {
        $rows = $input;
    } elseif (isset($input['mmsi']) && isset($input['horodatage'])) {
        $rows[] = $input;
    }

    if (count($rows) === 0) {
        echo json_encode(['success' => false, 'error' => 'Paramètres manquants']);
        exit;
    }

    $success = true;
    foreach ($rows as $row) {
        $mmsi = $row['mmsi'] ?? null;
        $horodatage = $row['horodatage'] ?? null;
        if ($mmsi && $horodatage) {
            // Supprimer d'abord de point_de_navigation
            $stmt1 = $pdo->prepare("DELETE FROM point_de_navigation WHERE MMSI = :mmsi AND Horodatage = :horodatage");
            $stmt1->execute([':mmsi' => $mmsi, ':horodatage' => $horodatage]);

            // Vérifier s'il reste des points pour ce MMSI
            $stmt2 = $pdo->prepare("SELECT COUNT(*) FROM point_de_navigation WHERE MMSI = :mmsi");
            $stmt2->execute([':mmsi' => $mmsi]);
            $count = $stmt2->fetchColumn();

            // Si plus aucun point, supprimer le bateau associé
            if ($count == 0) {
                $stmt3 = $pdo->prepare("DELETE FROM bateau WHERE MMSI = :mmsi");
                $stmt3->execute([':mmsi' => $mmsi]);
            }
        } else {
            $success = false;
        }
    }
    echo json_encode(['success' => $success]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>