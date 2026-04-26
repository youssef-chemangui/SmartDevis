<!-- ═══ FORMULAIRE DE SUIVI ══════════════════════════════════════════ -->
<section id="message" class="reveal">
  <div class="section-tag">Suivez votre demande</div>
  <h1 class="section-title">Où en est votre demande ?</h1>
  <p class="section-lead">Entrez le code reçu par email pour suivre l'avancement de votre demande.</p>

  <div class="message-card">

    <?php if (!empty($erreur)) : ?>
      <div class="message-error">
        <span class="message-error__icon">!</span>
        <?= esc($erreur) ?>
      </div>
    <?php endif; ?>

    <?= form_open('/message/faire_suivre', ['class' => 'message-form']) ?>
    <?= csrf_field() ?>

      <div class="form-group">
        <label for="code">Votre code de suivi</label>
        <input type="text" id="code" name="code"
               placeholder="ex : A3F9-K12X-7BQZ-MWPR"
               value="<?= set_value('code') ?>"
               required>
      </div>

      <button type="submit" class="btn-submit">Suivre →</button>

    <?= form_close() ?>
  </div>
</section>