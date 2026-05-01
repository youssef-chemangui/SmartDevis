<!-- ═══ CONFIRMATION - SUCCÈS ════════════════════════════════════════ -->
<section id="message" class="reveal">
  <div class="section-tag">Succès</div>
  <h1 class="section-title">Merci pour votre message</h1>
  <p class="section-lead">Votre demande a bien été enregistrée. Conservez votre code de suivi pour vérifier son avancement.</p>

  <div class="message-card">
    <div class="confirm-body">



      <p class="confirm-label">Votre code de suivi</p>
      <div class="code-block"><?= esc($le_code) ?></div>

      <div class="confirm-actions">
        <a href="<?= base_url('index.php/message/faire_suivre') ?>" class="btn-primary">Suivre votre demande →</a>
        <a href="<?= base_url('/') ?>" class="btn-ghost">Retour à l'accueil</a>
      </div>

    </div>
  </div>
</section>