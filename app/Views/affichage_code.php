<!-- ═══ PAGE DE SUIVI ════════════════════════════════════════════ -->
<section class="message-section reveal">
  <div class="section-container">
    <div class="section-tag">État de votre demande</div>
    <h1 class="section-title">Suivi de votre demande</h1>
  </div>

  <div class="suivi-container reveal">
    <?php if (!empty($suivi) && is_array($suivi)): ?>
      <?php foreach ($suivi as $info): ?>
        <div class="suivi-card">
          <div class="suivi-header">
            <div class="suivi-code">
              <span class="suivi-label">Code de suivi</span>
              <span class="suivi-value"><?= htmlspecialchars($info["msg_code"]) ?></span>
            </div>
            
            <div class="detail-item">
              <span class="detail-label">📋 Objet</span>
              <span class="detail-value"><?= htmlspecialchars($info["msg_objet"]) ?></span>
            </div>
            
            <div class="detail-item">
              <span class="detail-label">💬 Contenu</span>
              <span class="detail-value"><?= htmlspecialchars($info["msg_contenu"]) ?></span>
            </div>
            
            <div class="detail-item">
              <span class="detail-label">📅 Date</span>
              <span class="detail-value"><?= htmlspecialchars($info["msg_date"]) ?></span>
            </div>

            <?php if (!empty($info["msg_response"])): ?>
              <div class="detail-item response">
                <span class="detail-label">💡 Réponse</span>
                <span class="detail-value"><?= htmlspecialchars($info["msg_response"]) ?></span>
              </div>
            <?php endif; ?>
          </div>

          <div class="suivi-actions">
            <a href="<?= base_url('index.php/message/faire_suivre') ?>" class="btn-ghost">← Retour</a>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="suivi-empty">
        <div class="empty-icon">❌</div>
        <h2>Code non trouvé</h2>
        <p>Aucune demande trouvée pour ce code. Vérifiez que vous avez saisi le code correctement.</p>
        <a href="<?= base_url('index.php/message/faire_suivre') ?>" class="btn-primary">Essayer à nouveau</a>
      </div>
    <?php endif; ?>
  </div>
</section>

