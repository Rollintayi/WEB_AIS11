import numpy as np
import joblib
import sys
import json
# Plotting
import plotly
import plotly.graph_objects as go

def main(args):
    if len(args)!= 7:
        print("ERREUR!")
        return
    try:
        #Conversion des arguments en float
        input = np.array([float(i) for i in args]).reshape(1, -1)

        #Chargement du modèle
        model_5 = joblib.load("pkl/model_5.pkl")
        model_10 = joblib.load("pkl/model_10.pkl")
        model_15 = joblib.load("pkl/model_15.pkl")

        #Prédiction
        pred_5 = model_5.predict(input)
        pred_10 = model_10.predict(input)
        pred_15 = model_15.predict(input)

        result = {
        "pred_5": {"lat": pred_5[0][0], "lon": pred_5[0][1]},
        "pred_10": {"lat": pred_10[0][0], "lon": pred_10[0][1]},
        "pred_15": {"lat": pred_15[0][0], "lon": pred_15[0][1]}
        }

        print(json.dumps(result))

        

        fig = go.Figure(data=go.Scattergeo(
            lat = [input[0][0], pred_5[0][0],pred_10[0][0],pred_15[0][0]],
            lon = [input[0][1], pred_5[0][1],pred_10[0][1],pred_15[0][1]],
            mode = 'lines',
            line = dict(width = 3, color = 'blue'),
        ))

        fig.update_layout(
            title_text = 'Trajectoire prédite (zoomer au Gold du Mexique)',
            showlegend = False,
            geo = dict(
                resolution = 50,
                showland = True,
                showlakes = True,
                landcolor = 'rgb(204, 204, 204)',
                countrycolor = 'rgb(204, 204, 204)',
                lakecolor = 'rgb(255, 255, 255)',
                projection_type = "equirectangular",
                coastlinewidth = 2,
            )
        )
    #Exporter vers un fichier HTML
        fig.write_html("trajectoire.html")
    except Exception as e:
        print(f"Une erreur s'est produite: {e}")
        return

if __name__ == "__main__":
    main(sys.argv[1:]) #Exclure le nom du script de la liste des arguments
#Commande: python script.py LAT1 LON1 SOG1 COG1 Heading1 Length1 Draft1 LAT2 LON2 ...
#Exemple pour LA LUNA:
# python script.py 25.95847 -97.37876  0.0  0.0 0 200 32 25.95846 -97.37880  0.0  0.0 0 200 32