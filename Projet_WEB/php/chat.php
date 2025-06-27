<?php
include 'constants.php';
include 'database.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);
$pdo = dbConnect($DB_SERVER, $DB_NAME, $DB_USER, $DB_PASSWORD, $DB_SERVER_PORT);

if ($pdo == false) {
    header('HTTP/1.1 503 Service Unavailable');
    error_log('Erreur de connexion.');
    exit;
}
var_dump($pdo);


$channels = dbGetChannels($pdo);

if ((isset($_GET['request'])) && ($_GET['request'] === 'channels')) {
    //Gestion du cache
    foreach ($channels as $values)
        echo json_encode($values);
} else {
    header('HTTP/1.1 400 Bad Request');
    exit;
}


switch ($_GET['type']) {
    case 'html':
        header('Content-Type: text/html; charset=utf-8');
        echo "<table border='1'><tr><th>ID</th><th>Nom</th></tr>";
        foreach ($channels as $channel) {
            echo "<tr><td>{$channel['id']}</td><td>{$channel['name']}</td></tr>";
        }
        echo "</table>";
        break;
    case 'csv':
        header('Content-Type: text/plain; charset=utf-8');
        foreach ($channels as $channel) {
            echo "{$channel['id']},{$channel['name']}";
            echo PHP_EOL;
        }
        break;
    default:
        header('Content-Type: application/json; charset=utf-8');
        header('Cache-control: no-store, no-cache, must-revalidate');
        header('Pragma: no-cache');
        header('HTTP/1.1 200 OK');
        foreach ($channels as $values)
            echo json_encode($values);
        break;
}
?>