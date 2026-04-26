<!-- ═══ FORMULAIRE DE CRÉATION DE MESSAGE ════════════════════════════ -->
<section id="message" class="reveal">
  <div class="section-tag">Envoyez-nous un message</div>
  <h1 class="section-title"><?= $titre ?? 'Envoyer une demande' ?></h1>
  <p class="section-lead">Nous répondons à vos messages dans les meilleurs délais.</p>

  <div class="message-card">

    <?php if (!empty($erreur)) : ?>
      <div class="message-error">
        <span class="message-error__icon">!</span>
        <?= esc($erreur) ?>
      </div>
    <?php endif; ?>

    <?= form_open('/message/creer', ['class' => 'message-form']) ?>
    <?= csrf_field() ?>

      <div class="form-group">
        <label for="email">Adresse email</label>
        <input type="email" id="email" name="email"
               placeholder="votre@email.com"
               value="<?= set_value('email') ?>"
               required>
      </div>

      <div class="form-group">
        <label for="objet">Objet</label>
        <input type="text" id="objet" name="objet"
               placeholder="Sujet de votre demande"
               value="<?= set_value('objet') ?>"
               required>
      </div>

      <div class="form-group">
        <label for="contenu">Message</label>
        <textarea id="contenu" name="contenu"
                  placeholder="Décrivez votre demande en détail..."
                  required><?= set_value('contenu') ?></textarea>
      </div>

      <button type="submit" class="btn-submit">Envoyer →</button>

    <?= form_close() ?>

  </div>
</section>