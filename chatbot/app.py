"""
SmartDevis - Chatbot IA de création de devis
Microservice Flask + Ollama (100% local, gratuit)
Insère le devis final directement en base MySQL.
"""

import os
import json
from datetime import date
from flask import Flask, request, jsonify
from flask_cors import CORS
import requests as http_requests
import pymysql

app = Flask(__name__)
CORS(app, origins=["http://localhost:8080", "http://127.0.0.1:8080",
                   "http://localhost", "http://127.0.0.1"])

# ─────────────────────────────────────────────
# Config
# ─────────────────────────────────────────────
OLLAMA_URL   = os.getenv("OLLAMA_URL",   "http://localhost:11434")
OLLAMA_MODEL = os.getenv("OLLAMA_MODEL", "mistral")
DB_HOST      = os.getenv("DB_HOST",      "127.0.0.1")
DB_USER      = os.getenv("DB_USER",      "root")
DB_PASSWORD  = os.getenv("DB_PASSWORD",  "")
DB_NAME      = os.getenv("DB_NAME",      "smartdevis")

# ─────────────────────────────────────────────
# Prompt système
# ─────────────────────────────────────────────
SYSTEM_PROMPT = """Tu es l'assistant de SmartDevis, une agence web.
Tu aides les clients à créer leur demande de devis en posant des questions naturelles.

Ton objectif est de collecter ces 4 informations :
  - nom_site    : le nom ou type du site souhaité
  - description : une description claire du projet
  - nb_pages    : le nombre de pages estimé (nombre entier, minimum 1)
  - paiement    : est-ce que le site nécessite un paiement en ligne ? (oui / non)

Règles de conversation :
1. Pose une seule question à la fois, de façon chaleureuse et professionnelle.
2. Si l'utilisateur donne plusieurs infos en une seule réponse, note-les toutes.
3. Quand tu as les 4 informations, génère un résumé clair et demande confirmation.
4. Après confirmation, réponds UNIQUEMENT avec ce bloc JSON (rien d'autre avant ni après) :

DEVIS_READY:{"nom_site":"...","description":"...","nb_pages":5,"paiement":"oui"}

Commence toujours par te présenter brièvement et demander le nom/type du site.
Réponds toujours en français. Sois concis."""


# ─────────────────────────────────────────────
# Appel Ollama
# ─────────────────────────────────────────────
def call_ollama(history: list) -> str:
    payload = {
        "model": OLLAMA_MODEL,
        "messages": [{"role": "system", "content": SYSTEM_PROMPT}] + history,
        "stream": False
    }
    resp = http_requests.post(
        f"{OLLAMA_URL}/api/chat",
        json=payload,
        timeout=120
    )
    resp.raise_for_status()
    return resp.json()["message"]["content"]


# ─────────────────────────────────────────────
# Connexion MySQL
# ─────────────────────────────────────────────
def get_db():
    return pymysql.connect(
        host=DB_HOST,
        user=DB_USER,
        password=DB_PASSWORD,
        database=DB_NAME,
        charset="utf8mb4",
        cursorclass=pymysql.cursors.DictCursor
    )


def insert_devis(pseudo: str, data: dict) -> int:
    nb_pages = int(data.get("nb_pages", 1))
    paiement = data.get("paiement", "non").lower()
    duree    = nb_pages + (3 if paiement == "oui" else 0)

    conn = get_db()
    try:
        with conn.cursor() as cur:
            cur.execute(
                "SELECT prm_valeur FROM t_parametre_prm WHERE prm_cle = %s",
                ("tarif_journalier",)
            )
            row   = cur.fetchone()
            tarif = int(row["prm_valeur"]) if row else 300

        montant = duree * tarif
        today   = date.today().isoformat()

        with conn.cursor() as cur:
            cur.execute(
                """INSERT INTO t_devis_dev
                   (dev_montant_estime, dev_duree_estime, dev_statut,
                    dev_date_creation, cpt_pseudo)
                   VALUES (%s, %s, 'P', %s, %s)""",
                (montant, duree, today, pseudo)
            )
            dev_id = conn.insert_id()

            cur.execute(
                """INSERT INTO t_detail_det
                   (dev_id, det_nom, det_description)
                   VALUES (%s, %s, %s)""",
                (dev_id, data.get("nom_site", ""), data.get("description", ""))
            )

        conn.commit()
        return dev_id
    finally:
        conn.close()


# ─────────────────────────────────────────────
# Route /chat
# ─────────────────────────────────────────────
@app.route("/chat", methods=["POST"])
def chat():
    body     = request.get_json(force=True)
    pseudo   = body.get("pseudo", "")
    history  = body.get("history", [])
    user_msg = body.get("message", "").strip()

    if not pseudo:
        return jsonify({"error": "pseudo manquant"}), 400
    if not user_msg:
        return jsonify({"error": "message vide"}), 400

    history.append({"role": "user", "content": user_msg})

    try:
        assistant_text = call_ollama(history)
    except Exception as e:
        return jsonify({"error": f"Ollama inaccessible : {e}"}), 503

    history.append({"role": "assistant", "content": assistant_text})

    dev_id       = None
    display_text = assistant_text

    if "DEVIS_READY:" in assistant_text:
        try:
            json_str   = assistant_text.split("DEVIS_READY:")[1].strip()
            devis_data = json.loads(json_str)
            dev_id     = insert_devis(pseudo, devis_data)
            display_text = (
                f"✅ Votre devis a bien été créé (n°{dev_id}) ! "
                f"Il apparaîtra dans votre liste dans quelques secondes."
            )
            history = []
        except Exception as e:
            display_text = f"Erreur lors de la création : {e}"

    return jsonify({"reply": display_text, "history": history, "dev_id": dev_id})


# ─────────────────────────────────────────────
# Route /health
# ─────────────────────────────────────────────
@app.route("/health", methods=["GET"])
def health():
    try:
        r = http_requests.get(f"{OLLAMA_URL}/api/tags", timeout=3)
        ollama_ok = r.status_code == 200
    except Exception:
        ollama_ok = False

    return jsonify({
        "status":  "ok",
        "service": "smartdevis-chatbot",
        "ollama":  "ok" if ollama_ok else "unreachable",
        "model":   OLLAMA_MODEL
    })


if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5000, debug=True)