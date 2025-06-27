<?php
include 'constants.php';
try {
    $pdo = new PDO(
        'mysql:host=' . DB_SERVER . ';port=' . DB_SERVER_PORT . ';dbname=' . DB_NAME . ';charset=utf8',
        DB_USER,
        DB_PASSWORD
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // On supprime d'abord les points de navigation (clé étrangère)
    $pdo->exec("DELETE FROM point_de_navigation");
    // Puis les bateaux
    $pdo->exec("DELETE FROM bateau");

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>