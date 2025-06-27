'use strict';
console.log("Let's get started");
//document.cookie = 'prenom=thibault'
function setCookie(event) {
    //Suppression du comportement par défaut
    event.preventDefault();

    //Récupération du login et du mot de passe entré par l'utilisateur
    const login = document.getElementById("login").value;
    const password = document.getElementById("password").value;
    const standby = document.getElementById("stay-connected");

    //Mise en place du cookie qui stocke ces derniers dans une clé auth
    //Redirection vers la page chat.html
    connect();

}

//Changement de page
function connect() {
    //Récupération des informations de l'utilisateur stockées dans le cookie de clé auth
    let cookie = document.cookie.split('; ').find(row => row.startsWith('auth='));

    //Redirige L'utilisateur vers la page chat.html
    if (cookie) {
        window.location.href = 'chat.html';
    }

}

document.getElementById('authentication-area').addEventListener("submit", setCookie); let encodedcookie = btoa(`${login}:${password}`);

    document.cookie = `auth= ${encodedcookie};path/`;

    //Expiration du cookie
    if (standby.checked) {
        document.cookie += `;max-age=${24 * 3600}`;
    }

    //Affichage des cookies
    let cookies = document.cookie;

   