import pymysql
import pandas as pd
from sklearn.cluster import KMeans
import joblib
import json
from scipy.spatial.distance import cdist
import numpy as np

# Charger le scaler et le modèle KMeans
scaler = joblib.load('pkl/scaler_model.joblib')
kmeans = joblib.load('pkl/kmeans_model.joblib')
pca = joblib.load('pkl/pca_model.joblib')
# Connexion à la base
conn = pymysql.connect(
    host="localhost",
    user="root",
    password="",
    database="base_navale",
    port=3307
)

query = """
SELECT 
    b.MMSI, 
    p.Latitude AS LAT, 
    p.Longitude AS LON, 
    p.Vitesse_SOG AS SOG, 
    p.CAP_COG AS COG, 
    p.Cap_Reel AS Heading
FROM bateau b
JOIN point_de_navigation p ON b.MMSI = p.MMSI
"""
df = pd.read_sql(query, conn)

interesting_columns = ['SOG', 'COG', 'Heading', 'LON', 'LAT']

# Préparation des données pour le clustering
X = df[interesting_columns]
X_scaled = scaler.transform(X)
X_pca_reduced = pca.transform(X_scaled)
clusters = kmeans.predict(X_pca_reduced)

# Ajout des clusters au DataFrame
df['cluster'] = clusters

# Construction du résultat JSON
result = df[['MMSI', 'LAT', 'LON', 'cluster']].rename(
    columns={'LAT': 'Latitude', 'LON': 'Longitude'}
).to_dict(orient='records')

# Impression du JSON UNIQUEMENT
print(json.dumps(result, ensure_ascii=False))