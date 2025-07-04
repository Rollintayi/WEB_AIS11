<!DOCTYPE html>
<html lang="fr">
     <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style\authentification_style.css">
        <link rel="icon" href="icones/logo_site_2.png" type="image/png">
        <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
        <title> AIS 11|Connexion</title>
    </head>
    <body>
        <header class="navbar">
        <div class="container_nav">
            <!-- Logo -->
            <div class="logo">
                <img src="icones/logo_site_2.png" alt="Logo du site">
            </div>

            <!-- Navigation -->
            <nav class="menu">
                <ul>
                    <li><a href="acceuil_web.php">Accueil</a></li>
                    <li><a href="ajouter_bateau.php">Ajouter</a></li>
                    <li><a href="prediction_t.php">Prédictions</a></li>
                    <li><a href="visualisation.php">Cartes</a></li>
                </ul>
            </nav>

            <!-- Connexion -->
            <div class="connexion">
                <a href="authentification.php">Se connecter</a>
            </div>
        </div>
    </header>
        <main>
            <div class="container">
                <h2>Bienvenue</h2>
                <form action="ajout_bateau.php">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Entrez votre adresse mail" required>

                <label for="pseudo">Pseudo</label>
                <input type="text" id="pseudo" name="pseudo" placeholder="Comment souhaitez-vous apparaître ?" required>

                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" required>

                <button type="submit" class="btn">Se connecter</button>
                </form>

                <a href="#" class="forgot-password">Mot de passe oublié ?</a>
            </div>
        </main>
        <footer class="footer">
            <hr class="footer-line">
            <div class="footer-content">
                <img src="icones/github.png" alt="Icône pied de page" class="footer-icon">
            </div>
        </footer>
    </body>
</html>
