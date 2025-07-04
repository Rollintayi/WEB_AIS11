import joblib
import numpy as np
import json
import sys

# Charger le modèle et le scaler
model1 = joblib.load('pkl/best_random_forest_model.pkl')
model2 = joblib.load('pkl/lr_best.pkl')
model3 = joblib.load('pkl/svm_best.pkl')
model4 = joblib.load('pkl/dt_best.pkl')

scaler = joblib.load('pkl/scaler.pkl')

def predict_vessel_type(length, width, draft):
    X = np.array([[length, width, draft]])
    X_scaled = scaler.transform(X)
    prediction1 = model1.predict(X_scaled)
    prediction2 = model2.predict(X_scaled)
    prediction3 = model3.predict(X_scaled)
    prediction4 = model4.predict(X_scaled)

    return prediction1[0], prediction2[0], prediction3[0], prediction4[0]

if __name__ == "__main__":
    try:
        if len(sys.argv) != 4:
            raise ValueError("3 arguments requis : length, width, draft")

        # Récupération des arguments depuis la ligne de commande
        length = float(sys.argv[1])
        width = float(sys.argv[2])
        draft = float(sys.argv[3])

        predicted_type = predict_vessel_type(length, width, draft)

        # Format JSON structuré
        output = {
            "random forest": predicted_type[0],
            "logistic regression": predicted_type[1],
            "svm": predicted_type[2],
            "decision tree": predicted_type[3],

            "input": {
                "length": length,
                "width": width,
                "draft": draft
            }
        }

        print(json.dumps(output))

    except Exception as e:
        print(json.dumps({"error": str(e)}))
