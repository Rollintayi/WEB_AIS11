'use strict';

const form = document.querySelector(".form-bateau");
form.addEventListener("submit", function (e) {
    e.preventDefault();

    const formulaire = new FormData(form);

    fetch("insertbase.php", {
        method: "POST",
        body: formulaire
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const toast = document.getElementById("toast");
            toast.textContent = "Le bateau a bien été ajouté !";
            toast.classList.add("show");
            setTimeout(() => toast.classList.remove("show"), 3000);
            form.reset(); // vide les champs après ajout
        } else {
            alert("Erreur : " + data.message);
        }
    })
    .catch(error => {
        console.error("Erreur AJAX :", error);
        alert("Une erreur est survenue.");
    });
});
