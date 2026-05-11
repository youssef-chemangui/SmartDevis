<?php

$pseudo_js = esc(session()->get('user') ?? '');
?>

<style>
  /* Bouton flottant */
  #chat-fab {
    position: fixed; bottom: 28px; right: 28px; z-index: 999;
    width: 56px; height: 56px; border-radius: 50%;
    background: #1a1a2e; color: #fff; border: none;
    font-size: 24px; cursor: pointer; box-shadow: 0 4px 16px rgba(0,0,0,.18);
    display: flex; align-items: center; justify-content: center;
    transition: transform .15s;
  }
  #chat-fab:hover { transform: scale(1.08); }

  /* Fenêtre de chat */
  #chat-window {
    position: fixed; bottom: 96px; right: 28px; z-index: 998;
    width: 360px; max-height: 520px;
    background: #fff; border-radius: 16px;
    box-shadow: 0 8px 32px rgba(0,0,0,.14);
    display: none; flex-direction: column;
    font-family: 'DM Sans', sans-serif; font-size: 14px;
    border: 0.5px solid rgba(0,0,0,.1);
    overflow: hidden;
  }
  #chat-window.open { display: flex; }

  /* Header */
  #chat-header {
    background: #1a1a2e; color: #fff;
    padding: 14px 18px; display: flex; align-items: center; gap: 10px;
  }
  #chat-header span { font-weight: 500; flex: 1; }
  #chat-close {
    background: none; border: none; color: rgba(255,255,255,.7);
    font-size: 18px; cursor: pointer; line-height: 1; padding: 0;
  }
  #chat-close:hover { color: #fff; }

  /* Messages */
  #chat-messages {
    flex: 1; overflow-y: auto; padding: 16px;
    display: flex; flex-direction: column; gap: 10px;
    min-height: 200px; max-height: 320px;
  }
  .msg { max-width: 85%; padding: 10px 14px; border-radius: 12px; line-height: 1.5; }
  .msg-bot  { background: #f7f5f0; color: #1a1a2e; align-self: flex-start; border-radius: 4px 12px 12px 12px; }
  .msg-user { background: #1a1a2e; color: #fff;    align-self: flex-end;   border-radius: 12px 4px 12px 12px; }
  .msg-ok   { background: #EAF3DE; color: #3B6D11; align-self: flex-start; border-radius: 4px 12px 12px 12px; }

  /* Typing indicator */
  .typing { display: flex; gap: 4px; align-items: center; padding: 10px 14px; }
  .typing span { width: 7px; height: 7px; background: #888; border-radius: 50%; animation: bounce .9s infinite; }
  .typing span:nth-child(2) { animation-delay: .15s; }
  .typing span:nth-child(3) { animation-delay: .3s; }
  @keyframes bounce { 0%,60%,100%{transform:translateY(0)} 30%{transform:translateY(-6px)} }

  /* Input zone */
  #chat-form {
    display: flex; gap: 8px; padding: 12px 14px;
    border-top: 0.5px solid rgba(0,0,0,.08);
  }
  #chat-input {
    flex: 1; padding: 9px 12px; border: 0.5px solid rgba(0,0,0,.15);
    border-radius: 8px; font-family: inherit; font-size: 14px; outline: none;
    resize: none; height: 38px;
    transition: border-color .15s;
  }
  #chat-input:focus { border-color: #639922; }
  #chat-send {
    padding: 0 16px; background: #1a1a2e; color: #fff;
    border: none; border-radius: 8px; cursor: pointer;
    font-family: inherit; font-size: 13px; font-weight: 500;
    transition: opacity .15s;
  }
  #chat-send:hover { opacity: .8; }
  #chat-send:disabled { opacity: .4; cursor: default; }
</style>

<!-- Bouton FAB -->
<button id="chat-fab" title="Créer un devis avec l'assistant IA" onclick="toggleChat()">
  💬
</button>

<!-- Fenêtre chat -->
<div id="chat-window">
  <div id="chat-header">
    <span>🤖 Assistant devis</span>
    <button id="chat-close" onclick="toggleChat()">✕</button>
  </div>
  <div id="chat-messages"></div>
  <form id="chat-form" onsubmit="sendMessage(event)">
    <input id="chat-input" type="text" placeholder="Votre réponse..." autocomplete="off">
    <button id="chat-send" type="submit">Envoyer</button>
  </form>
</div>

<script>
(function () {
  const FLASK_URL = 'http://127.0.0.1:5000';
  const PSEUDO    = '<?= $pseudo_js ?>';

  let history  = [];
  let started  = false;
  let finished = false;

  // ── toggle fenêtre ──────────────────────────────
  window.toggleChat = function () {
    const win = document.getElementById('chat-window');
    win.classList.toggle('open');
    if (win.classList.contains('open') && !started) {
      started = true;
      // Démarrer la conversation (message vide = bonjour de l'IA)
      // Message de bienvenue affiché localement sans appel Flask
      addMsg("Bonjour ! Je suis l'assistant SmartDevis. Pour commencer, quel est le nom ou le type de site que vous souhaitez créer ?", 'bot');
    }
  };

  // ── envoi du message ────────────────────────────
  window.sendMessage = function (e) {
    e.preventDefault();
    if (finished) return;
    const input = document.getElementById('chat-input');
    const text  = input.value.trim();
    if (!text) return;
    input.value = '';
    addMsg(text, 'user');
    callFlask(text);
  };

  // ── appel Flask ─────────────────────────────────
  async function callFlask(text) {
    const send = document.getElementById('chat-send');
    send.disabled = true;
    showTyping();

    try {
      const res = await fetch(FLASK_URL + '/chat', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ pseudo: PSEUDO, history: history, message: text })
      });
      const data = await res.json();
      removeTyping();

      if (data.error) {
        addMsg('⚠️ Erreur : ' + data.error, 'bot');
      } else {
        const type = data.dev_id ? 'ok' : 'bot';
        addMsg(data.reply, type);
        history = data.history;

        if (data.dev_id) {
          finished = true;
          send.disabled = true;
          document.getElementById('chat-input').disabled = true;
          document.getElementById('chat-input').placeholder = 'Devis créé avec succès !';
          // Rafraîchir la liste après 2s
          setTimeout(() => location.reload(), 2500);
        }
      }
    } catch (err) {
      removeTyping();
      addMsg('⚠️ Impossible de joindre le service IA. Vérifiez que Flask tourne sur le port 5000.', 'bot');
    }

    if (!finished) send.disabled = false;
    document.getElementById('chat-input').focus();
  }

  // ── helpers UI ──────────────────────────────────
  function addMsg(text, type) {
    const box  = document.getElementById('chat-messages');
    const div  = document.createElement('div');
    div.className = 'msg msg-' + type;
    div.textContent = text;
    box.appendChild(div);
    box.scrollTop = box.scrollHeight;
  }

  function showTyping() {
    const box = document.getElementById('chat-messages');
    const div = document.createElement('div');
    div.id = 'typing';
    div.className = 'msg msg-bot typing';
    div.innerHTML = '<span></span><span></span><span></span>';
    box.appendChild(div);
    box.scrollTop = box.scrollHeight;
  }

  function removeTyping() {
    const t = document.getElementById('typing');
    if (t) t.remove();
  }
})();
</script>