'use strict';

function getCookie() {
    let cookie = document.cookie.split('; ').find(row => row.startsWith('auth='));
    if (cookie) {
        let decodedcookie = atob(cookie.split('=')[1]);
        let [dec_log, dec_passw] = decodedcookie.split(':');
        alert(`Bienvenue ${dec_log}`);
    }
    else {
        window.location.href = 'authentication.html';
    }
}

async function getChannels() {
    try {
        let response = await fetch('php/chat.php?request=channels');
        if (response.ok) {
            console.log(`Erreur HTTP : ${Response.status}`);
        }
        else{
            displayChannels(await response.json());
            console.log(`texte ${variable}`);
        }
    } catch (error) {
        console.error(`Erreur lors de la requête: ${error}`)
    }
}

function displayChannels(){

}

getCookie();

function logout(event) {
    document.cookie = 'auth=; path=/; max-age=0';
    window.location.href = 'authentication.html';
}
document.getElementById('logout').addEventListener("click", logout);

