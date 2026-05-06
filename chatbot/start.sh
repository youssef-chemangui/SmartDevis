#!/bin/bash
# ============================================
# SmartDevis - Démarrage automatique
# Lance Ollama + Flask en une seule commande
# Usage : ./start.sh
# ============================================

SCRIPT_DIR="$(cd "$(dirname "$0")" && pwd)"
DB_HOST="${DB_HOST:-$(ip route | grep default | awk '{print $3}')}"
DB_USER="${DB_USER:-root}"
DB_PASSWORD="${DB_PASSWORD:-}"
DB_NAME="${DB_NAME:-smartdevis}"
OLLAMA_MODEL="${OLLAMA_MODEL:-mistral}"

echo "╔══════════════════════════════════════╗"
echo "║       SmartDevis Chatbot IA          ║"
echo "╚══════════════════════════════════════╝"

# ── 1. Ollama ───────────────────────────────
echo ""
echo "▶ Démarrage Ollama..."
if pgrep -x "ollama" > /dev/null; then
    echo "  ✅ Ollama tourne déjà"
else
    ollama serve > /tmp/ollama.log 2>&1 &
    sleep 3
    echo "  ✅ Ollama démarré (log: /tmp/ollama.log)"
fi

# ── 2. Vérifier que le modèle est présent ──
echo ""
echo "▶ Vérification du modèle $OLLAMA_MODEL..."
if ollama list 2>/dev/null | grep -q "$OLLAMA_MODEL"; then
    echo "  ✅ Modèle $OLLAMA_MODEL disponible"
else
    echo "  ⏳ Téléchargement de $OLLAMA_MODEL (première fois ~4GB)..."
    ollama pull "$OLLAMA_MODEL"
fi

# ── 3. Activer le venv ─────────────────────
echo ""
echo "▶ Activation de l'environnement Python..."
cd "$SCRIPT_DIR"
if [ ! -d "venv" ]; then
    echo "  ⏳ Création du venv..."
    python3 -m venv venv
    source venv/bin/activate
    pip3 install -q flask flask-cors requests pymysql
    echo "  ✅ Dépendances installées"
else
    source venv/bin/activate
    echo "  ✅ Venv activé"
fi

# ── 4. Lancer Flask ────────────────────────
echo ""
echo "▶ Lancement Flask sur http://127.0.0.1:5000"
echo "  DB_HOST  = $DB_HOST"
echo "  DB_NAME  = $DB_NAME"
echo "  MODÈLE   = $OLLAMA_MODEL"
echo ""
echo "  Pour arrêter : Ctrl+C"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

export DB_HOST DB_USER DB_PASSWORD DB_NAME OLLAMA_MODEL
python3 app.py
