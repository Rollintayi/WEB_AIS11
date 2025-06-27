document.addEventListener('DOMContentLoaded', () => {
    const loadBtn = document.getElementById('load-data');
    const clearBtn = document.getElementById('clear-data');
    const tableBody = document.getElementById('table-body');

    
    function trajectories(data) {
    // Regrouper les points par MMSI
    const trajectoires = {};
    data.forEach(row => {
        if (!trajectoires[row.MMSI]) {
            trajectoires[row.MMSI] = {
                lat: [],
                lon: [],
                text: [],
                name: row.Nom || row.MMSI
            };
        }
        trajectoires[row.MMSI].lat.push(row.Latitude);
        trajectoires[row.MMSI].lon.push(row.Longitude);
        trajectoires[row.MMSI].text.push(
            `Nom: ${row.Nom || ''}<br>Type: ${row.Type || ''}<br>Horodatage: ${row.Horodatage || ''}`
        );
    });

    // Préparer les traces Plotly
    const traces = Object.values(trajectoires).map(traj => ({
        type: 'scattermapbox',
        mode: 'lines+markers',
        lat: traj.lat,
        lon: traj.lon,
        text: traj.text,
        name: traj.name
    }));

    const layout = {
        mapbox: {
            style: 'open-street-map', // <-- Correction ici
            center: { lat: 48, lon: -4.5 },
            zoom: 7
        },
        margin: { l: 0, r: 0, b: 0, t: 0 },
        showlegend: true,
        autosize: true
    };

    Plotly.newPlot('map-container', traces, layout, {
        mapboxAccessToken: 'pk.eyJ1Ijoicm9sbGludGF5aSIsImEiOiJjbWMybDFuMTgwOXhhMmxzZHNpcXlidnY2In0.A-oJhjFocH47TsX6y63A-g'
    });
}

    function loadData() {
     fetch('database.php')
        .then(response => response.json())
        .then(data => {
            tableBody.innerHTML = '';
            if (data.error) {
                tableBody.innerHTML = `<tr><td colspan="12">${data.error}</td></tr>`;
                    return;
                }
                if (data.length === 0) {
                    tableBody.innerHTML = `<tr><td colspan="12">Aucune donnée trouvée.</td></tr>`;
                    return;
                }
                data.forEach(row => {
                    tableBody.innerHTML += `
                        <tr>
                            <td>${row.MMSI}</td>
                            <td>${row.Nom || ''}</td>
                            <td>${row.Longueur || ''}</td>
                            <td>${row.Largeur || ''}</td>
                            <td>${row.Tirant_d_eau || ''}</td>
                            <td>${row.Type || ''}</td>
                            <td>${row.Latitude || ''}</td>
                            <td>${row.Longitude || ''}</td>
                            <td>${row.Vitesse_SOG || ''}</td>
                            <td>${row.CAP_COG || ''}</td>
                            <td>${row.Cap_Reel || ''}</td>
                            <td>${row.Horodatage || ''}</td>
                        </tr>
                    `;
                });
                // Appel de la fonction pour afficher les trajectoires sur la carte
                trajectories(data);
        })  
            .catch(err => {
                tableBody.innerHTML = `<tr><td colspan="12">Erreur de chargement des données.</td></tr>`;
            });

    }

    function clearData() {
    if (confirm("Voulez-vous vraiment supprimer toutes les données de la base de données ? Cette action est irréversible.")) {
        fetch('clear_data.php', { method: 'POST' })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    tableBody.innerHTML = '<tr><td colspan="12">Toutes les données ont été supprimées.</td></tr>';
                } else {
                    tableBody.innerHTML = `<tr><td colspan="12">Erreur lors de la suppression : ${result.error}</td></tr>`;
                }
            })
            .catch(() => {
                tableBody.innerHTML = `<tr><td colspan="12">Erreur lors de la suppression des données.</td></tr>`;
            });
    }
}

    loadBtn.addEventListener('click', loadData);
    clearBtn.addEventListener('click', clearData);

    
});

// async function fetchBoatData() {
//     try {
//         const response = await fetch('get_boat.php');
//         if (!response.ok) {
//             throw new Error('Network response was not ok');
//         }
//         const data = await response.json();
//         populateTable(data);
//     } catch (error) {
//         console.error('Error fetching boat data:', error);
//     }
// }

// function populateTable(data) {
//     const tableBody = document.getElementById('table-body');
//     tableBody.innerHTML = ''; // Clear existing table rows

//     data.forEach(boat => {
//         const row = document.createElement('tr');
//         row.innerHTML = `
//             <td><input type="checkbox" class="select-boat" data-mmsi="${boat.MMSI}"></td>
//             <td>${boat.MMSI}</td>
//             <td>${boat.Nom}</td>
//             <td>${boat.Longueur}</td>
//             <td>${boat.Largeur}</td>
//             <td>${boat.Tirant_d_eau}</td>
//             <td>${boat.Type}</td>
//             <td>${boat.Horodotage}</td>
//             <td>${boat.Latitude}</td>
//             <td>${boat.Longitude}</td>
//             <td>${boat.Vitesse_SOG}</td>
//             <td>${boat.CAP_COG}</td>
//             <td>${boat.Cap_Reel}</td>
//         `;
//         tableBody.appendChild(row);
//     });
// }

// // Function to handle the prediction action
// function createMap(boats){
//     const trajectories = {};
//     boats.forEach(boat => {
//         if (!trajectories[boat.MMSI]) {
//             trajectories[boat.MMSI] = {
//                 lat: [],
//                 lon: [],
//                 text: [],
//                 name: boat.Nom,
//             };
//         }
//         trajectories[boat.MMSI].lat.push(boat.Latitude);
//         trajectories[boat.MMSI].lon.push(boat.Longitude);
//         trajectories[boat.MMSI].text.push(`Nom: ${boat.Nom}, Type: ${boat.Type}`, `MMSI: ${boat.MMSI}, Vitesse: ${boat.Vitesse_SOG} kn, Cap: ${boat.CAP_COG}°`, `Horodatage: ${boat.Horodotage}`);

//     });
//     // Call a function to render the map with the trajectories
//     const dataTraces = Object.keys(trajectories).map(traj => ({
//         type: 'scattermapbox',
//         mode: 'lines+markers',
//         lat: traj.lat,
//         lon: traj.lon,
//         text: traj.text,
//         name: traj.name,
//     }));
//     const mapLayout = {
//     mapbox: {
//         style: 'open-street-map',
//         center: { lat: 48, lon: -4.5 },
//         zoom: 2
//     },
//     title: 'Trajectoires des Bateaux',
//     autosize: true,
//     hovermode: 'closest',
//     showlegend: true,
//     margin: {
//         l: 0,
//         r: 0,
//         b: 0,
//         t: 0,
//         pad: 0
//     }
// };
// Plotly.newPlot('map', dataTraces, mapLayout, { mapboxAccessToken: 'pk.eyJ1Ijoicm9sbGludGF5aSIsImEiOiJjbWMybDFuMTgwOXhhMmxzZHNpcXlidnY2In0.A-oJhjFocH47TsX6y63A-g' });
// }
