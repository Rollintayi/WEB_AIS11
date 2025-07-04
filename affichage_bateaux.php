<?php
$fichier = 'bateaux.json';
$bateaux = [];

if (file_exists($fichier)) {
    $bateaux = json_decode(file_get_contents($fichier), true);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Liste des bateaux</title>
        <link rel="stylesheet" href="style\prediction_t_style.css">
</head>
<body> 
    <header class="navbar">
        <!-- Logo -->
        <div class="logo">
            <img src="icones/logo_site_2.png" alt="Logo du site">
        </div>

        <!-- Navigation -->
        <nav class="menu">
            <ul>
                <li><a href="acceuil_web.php">Accueil</a></li>
                <li><a href="ajout_bateau.php">Ajouter</a></li>
                <li><a href="prediction_t.php">Prédictions</a></li>
                <li><a href="visualisation.php">Cartes</a></li>
            </ul>
        </nav>

        <!-- Connexion -->
        <div class="connexion">
            <a href="authentification.php">Se connecter</a>
        </div>
    </header>
  <h2>Liste des bateaux enregistrés</h2>

  <form action="prediction_t.php" method="get">
    <table border="1" cellpadding="6">
      <tr>
        <th></th>
        <th>Nom</th><th>MMSI</th><th>Longueur</th><th>Profondeur</th><th>État</th><th>Date</th><th>Heure</th>
        <th>Latitude</th><th>Longitude</th><th>Vitesse</th><th>Direction</th><th>Cap</th><th>Tirant</th>
      </tr>
      <?php foreach ($bateaux as $b) : ?>
        <tr>
          <td><input type="radio" name="mmsi" value="<?= htmlspecialchars($b['mmsi']) ?>" required></td>
          <td><?= htmlspecialchars($b['name']) ?></td>
          <td><?= htmlspecialchars($b['mmsi']) ?></td>
          <td><?= htmlspecialchars($b['length']) ?></td>
          <td><?= htmlspecialchars($b['width']) ?></td>
          <td><?= htmlspecialchars($b['etat']) ?></td>
          <td><?= htmlspecialchars($b['date']) ?></td>
          <td><?= htmlspecialchars($b['heure']) ?></td>
          <td><?= htmlspecialchars($b['latitude']) ?></td>
          <td><?= htmlspecialchars($b['longitude']) ?></td>
          <td><?= htmlspecialchars($b['vitesse']) ?></td>
          <td><?= htmlspecialchars($b['direction']) ?></td>
          <td><?= htmlspecialchars($b['heading']) ?></td>
          <td><?= htmlspecialchars($b['draft']) ?></td>
        </tr>
      <?php endforeach; ?>
    </table>

    <br>
    <button type="submit">Prédire la trajectoire</button>
  </form>
  <footer class="footer">
            <hr class="footer-line">
            <div class="footer-content">
                <img src="icones/github.png" alt="Icône pied de page" class="footer-icon">
            </div>
        </footer>
</body>
</html>
