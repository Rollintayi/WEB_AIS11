document.addEventListener("DOMContentLoaded", () => {
  const loadBtn = document.getElementById("load-data");
  const clearBtn = document.getElementById("clear-data");
  const tableBody = document.getElementById("table-body");

  function trajectories(data) {
    // Regrouper les points par MMSI
    const trajectoires = {};
    data.forEach((row) => {
      if (!trajectoires[row.MMSI]) {
        trajectoires[row.MMSI] = {
          lat: [],
          lon: [],
          text: [],
          name: row.Nom || row.MMSI,
        };
      }
      trajectoires[row.MMSI].lat.push(row.Latitude);
      trajectoires[row.MMSI].lon.push(row.Longitude);
      trajectoires[row.MMSI].text.push(
        `Nom: ${row.Nom || ""}<br>Type: ${row.Type || ""}<br>Horodatage: ${
          row.Horodatage || ""
        }`
      );
    });

    // Préparer les traces Plotly
    const traces = Object.values(trajectoires).map((traj) => ({
      type: "scattermapbox",
      mode: "lines+markers",
      lat: traj.lat,
      lon: traj.lon,
      text: traj.text,
      name: traj.name,
    }));

    const layout = {
      mapbox: {
        style: "open-street-map", // <-- Correction ici
        center: { lat: 48, lon: -4.5 },
        zoom: 7,
      },
      margin: { l: 0, r: 0, b: 0, t: 0 },
      showlegend: true,
      autosize: true,
    };

    Plotly.newPlot("map-container", traces, layout, {
      mapboxAccessToken:
        "pk.eyJ1Ijoicm9sbGludGF5aSIsImEiOiJjbWMybDFuMTgwOXhhMmxzZHNpcXlidnY2In0.A-oJhjFocH47TsX6y63A-g",
    });
  }

  function loadData() {
    fetch("database.php")
      .then((response) => response.json())
      .then((data) => {
        tableBody.innerHTML = "";
        if (data.error) {
          tableBody.innerHTML = `<tr><td colspan="12">${data.error}</td></tr>`;
          return;
        }
        if (data.length === 0) {
          tableBody.innerHTML = `<tr><td colspan="12">Aucune donnée trouvée.</td></tr>`;
          return;
        }
        data.forEach((row) => {
          tableBody.innerHTML += `
                        <tr>
                        <td>
                            <input type="radio" class="select-row" data-mmsi="${
                              row.MMSI
                            }" data-horodatage="${
            row.Horodatage
          }" name="selectedBoat">
                        </td>
                        <td>${row.MMSI}</td>
                        <td>${row.Nom || ""}</td>
                        <td>${row.Longueur || ""}</td>
                        <td>${row.Largeur || ""}</td>
                        <td>${row.Tirant_d_eau || ""}</td>
                        <td>${row.Type || ""}</td>
                        <td>${row.Latitude || ""}</td>
                        <td>${row.Longitude || ""}</td>
                        <td>${row.Vitesse_SOG || ""}</td>
                        <td>${row.CAP_COG || ""}</td>
                        <td>${row.Cap_Reel || ""}</td>
                        <td>${row.Horodatage || ""}</td>
                        </tr>
                    `;
        });
        // Après la boucle, ajoute ceci pour gérer le clic :
        // Appel de la fonction pour afficher les trajectoires sur la carte
        trajectories(data);
      })
      .catch((err) => {
        tableBody.innerHTML = `<tr><td colspan="12">Erreur de chargement des données.</td></tr>`;
      });
  }

  //Fonction pour supprimer les données
  function clearData() {
    // Récupère toutes les cases cochées
    const checked = Array.from(
      document.querySelectorAll(".select-row:checked")
    );
    if (checked.length === 0) {
      alert("Veuillez sélectionner au moins une donnée à supprimer.");
      return;
    }
    if (
      confirm(
        "Voulez-vous vraiment supprimer les données sélectionnées ? Cette action est irréversible."
      )
    ) {
      // Pour chaque case cochée, envoie une requête de suppression
      Promise.all(
        checked.map((box) => {
          return fetch("clear.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
              mmsi: box.dataset.mmsi,
              horodatage: box.dataset.horodatage,
            }),
          }).then((response) => response.json());
        })
      )
        .then((results) => {
          // Vérifie si toutes les suppressions ont réussi
          if (results.every((r) => r.success)) {
            checked.forEach((box) => box.closest("tr").remove());
            if (tableBody.children.length === 0) {
              tableBody.innerHTML =
                '<tr><td colspan="13">Toutes les données sélectionnées ont été supprimées.</td></tr>';
            }
          } else {
            alert("Erreur lors de la suppression de certaines données.");
          }
        })
        .catch(() => {
          alert("Erreur lors de la suppression.");
        });
    }
  }

  loadBtn.addEventListener("click", loadData);
  clearBtn.addEventListener("click", clearData);

  
});

document.getElementById("type").addEventListener("click", () => {
  const selected = document.querySelector(".select-row:checked");
  if (!selected) {
    alert("Veuillez sélectionner un bateau.");
    return;
  }
  const mmsi = selected.dataset.mmsi;

  fetch("prediction_api.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ mmsi: mmsi }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.error) {
        alert("Erreur : " + data.error);
      } else {
        const div = document.getElementById("prediction-result");
        div.textContent = `✅ Type prédit : ${data.predicted_type}`;
        div.style.color = "green";
      }
    })
    .catch((error) => {
      console.error("Erreur JS :", error);
      alert("Erreur de communication avec le serveur.");
    });
});

// Prédiction de la trajectoire
document.getElementById("path").addEventListener("click", () => {
  const selected = document.querySelector(".select-row:checked");
  if (!selected) {
    alert("Veuillez sélectionner un bateau.");
    return;
  }
  const mmsi = selected.dataset.mmsi;
  window.location.href = `http://localhost/WEB_AIS11(2)/prediction_t.php?mmsi=${encodeURIComponent(
    mmsi
  )}`;
});

//Prédiction des clusters
document.getElementById("predict-clusters").addEventListener("click",()=>{
  window.location.href = `http://localhost/WEB_AIS11(2)/cluster_predict.php`;
})