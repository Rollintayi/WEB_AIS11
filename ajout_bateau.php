<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Entête personnalisée</title>
    <link rel="stylesheet" href="style_2.css">
    
</head>
<body>

    <header class="navbar">
        <!-- Logo -->
        <div class="logo">
            <img src="logo_site.png" alt="Logo du site">
        </div>

        <!-- Navigation -->
        <nav class="menu">
            <ul>
                <a href="acceuil_web.html">accueil</a>
                <li><a href="#">Ajouter</a></li>
                <li><a href="#">Prédictions</a></li>
                <li><a href="#">Cartes</a></li>
            </ul>
        </nav>

        <!-- Connexion -->
        <div class="connexion">
            <a href="#">Se connecter</a>
        </div>
    </header>
    <section class="form-container">
    <h2 class="form-title">Ajouter un point de donnée</h2>

        <form class="form-bateau" action="connexion_base.php" method="post">
               <div class="form-grid">
                <!-- <div class="form-group">
                    <label for="ID_point_naviguation">ID du point de naviguation</label>
                    <input type="text" id="nom" name="nom" placeholder="Valeur">
                </div> -->
                <div class="form-group">
                    <label for="nom">Nom du bateau</label>
                    <input type="text" id="nom" name="nom" placeholder="Valeur">
                </div>

                <div class="form-group">
                    <label for="mmsi">MMSI du bateau</label>
                    <<input type="text" id="mmsi" name="MMSI" placeholder="Ex : 123456789">
                </div>

                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" id="date" name="date" placeholder="YYYY-MM-DD">
                </div>

                <div class="form-group">
                    <label for="heure">Heure</label>
                    <input type="time" id="heure" name="heure" placeholder="HH:MM:SS">
                </div>

                <div class="form-group">
                    <label for="latitude">Latitude</label>
                    <input type="number" id="latitude" name="Latitude" placeholder="En mètre" step="0.0001">
                </div>

                <div class="form-group">
                    <label for="longitude">Longitude</label>
                    <input type="number" id="longitude" name="Longitude" placeholder="En mètre" step="0.0001">
                </div>

                <div class="form-group">
                    <label for="longueur">Longueur</label>
                    <input type="number" id="longueur" name="Longueur" placeholder="En mètre" step="0.01">
                </div>

                <div class="form-group">
                    <label for="tirant d'eau">tirant d'eau</label>
                    <input type="number" id="tirant d'eau" name="Tirant_eau" placeholder="En mètre" step="0.01">
                </div>
                <div class="form-group">
                    <label for="longueur">Largeur</label>
                    <input type="number" id="largeur" name="Largeur" placeholder="En mètre" step="0.01">
                </div>

                <div class="form-group">
                    <label for="cap_COG">Cap</label>
                    <input type="number" id="Cap" name="CAP_COG" placeholder="En mètre" step="0.01">
                </div>

                <div class="form-group">
                    <label for="sog">Vitesse SOG</label>
                    <input type="number" id="sog" name="Vitesse_SOG" placeholder="Valeur" step="0.01">
                </div>

                <div class="form-group">
                    <label for="etat">État du bateau</label>
                    <select id="etat" name="ID_etat">
                        <option value="">-- Sélectionnez un état --</option>
                        <option value="0">En mer</option>
                        <option value="1">Au port</option>
                        <option value="2">A quai</option>
                        <option value="3">A l'arrêt</option>
                        <option value="5">En manoeuvre</option>
                        <option value="8">En panne</option>
                        <option value="15">Hors service</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn-ajouter">Enregistrer</button>
        </form>
    </section>
    <footer class="footer">
    <hr class="footer-line">
    <div class="footer-content">
        <img src="github.png" alt="Icône pied de page" class="footer-icon">
    </div>
</footer>

</body>
</html>
