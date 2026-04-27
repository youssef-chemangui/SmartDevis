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

<style>
  .suivi-container {
    max-width: 800px;
    margin: 40px auto;
  }

  .suivi-card {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    overflow: hidden;
  }

  .suivi-header {
    display: flex;
    gap: 30px;
    padding: 30px;
    background: linear-gradient(135deg, #9FBE5A 0%, #7db665 100%);
    color: white;
  }

  .suivi-code,
  .suivi-status {
    flex: 1;
  }

  .suivi-label {
    display: block;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    opacity: 0.9;
    margin-bottom: 8px;
  }

  .suivi-value {
    display: block;
    font-size: 18px;
    font-weight: 700;
    font-family: 'Roboto Mono', monospace;
    word-break: break-all;
  }

  .suivi-badge {
    display: inline-block;
    background: rgba(255, 255, 255, 0.2);
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 600;
  }

  .suivi-details {
    padding: 30px;
  }

  .detail-item {
    margin-bottom: 25px;
  }

  .detail-item:last-child {
    margin-bottom: 0;
  }

  .detail-label {
    display: block;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #9FBE5A;
    margin-bottom: 8px;
  }

  .detail-value {
    display: block;
    font-size: 16px;
    color: #333;
    line-height: 1.6;
    word-break: break-word;
  }

  .detail-item.response {
    background: #f5f5f5;
    padding: 15px;
    border-left: 4px solid #E08183;
    border-radius: 4px;
  }

  .suivi-actions {
    padding: 20px 30px;
    border-top: 1px solid #e0e0e0;
    text-align: center;
  }

  .suivi-empty {
    text-align: center;
    padding: 60px 30px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  }

  .empty-icon {
    font-size: 60px;
    margin-bottom: 20px;
  }

  .suivi-empty h2 {
    color: #333;
    font-size: 28px;
    margin-bottom: 15px;
  }

  .suivi-empty p {
    color: #666;
    font-size: 16px;
    margin-bottom: 30px;
  }

  @media (max-width: 768px) {
    .suivi-header {
      flex-direction: column;
      gap: 15px;
      padding: 20px;
    }

    .suivi-details {
      padding: 20px;
    }

    .detail-item {
      margin-bottom: 18px;
    }
  }
</style>
