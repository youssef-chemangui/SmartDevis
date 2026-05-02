<style>
  main {
    display: block !important;
    width: 100% !important;
    max-width: 100% !important;
    padding: 0 !important;
    margin: 0 !important;
  }
  /* Compacter le wrapper pour éviter le scroll */
  .form-card-wrapper {
    padding: 1.2rem 1rem 2rem !important;
    min-height: unset !important;
  }
  /* Réduire les espacements internes de la carte */
  .form-card__header {
    padding: 1.2rem 2rem 1rem !important;
  }
  .form-card__title {
    font-size: 22px !important;
    margin-bottom: .2rem !important;
  }
  .form-card__lead {
    font-size: 13px !important;
  }
  .form-card__body {
    padding: 1rem 2rem 1.5rem !important;
  }
  .form-group {
    margin-bottom: .75rem !important;
  }
  .form-group label {
    margin-bottom: .2rem !important;
  }
  .form-group input {
    padding: .3rem 0 !important;
  }
</style>

<div class="form-card-wrapper" style="width:100%; box-sizing:border-box;">
  <div class="form-card" style="max-width:700px; width:100%;">

    <div class="form-card__header">
      <p class="form-card__tag">Inscription</p>
      <h2 class="form-card__title">Créer un compte</h2>
      <p class="form-card__lead">Remplissez le formulaire pour rejoindre la plateforme.</p>
    </div>

    <div class="form-card__body">

      <?php if (session()->getFlashdata('error')) : ?>
        <div class="form-error">
          <?= session()->getFlashdata('error') ?>
        </div>
      <?php endif; ?>

      <?= form_open_multipart('/compte/creer') ?>
      <?= csrf_field() ?>

        <!-- Ligne 1 : Pseudo + Prénom -->
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:0 2rem;">
          <div class="form-group">
            <label for="pseudo">Pseudo</label>
            <input type="text" id="pseudo" name="pseudo" value="<?= set_value('pseudo') ?>" placeholder="Votre pseudo">
            <div class="error-message"><?= validation_show_error('pseudo') ?></div>
          </div>
          <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom" value="<?= set_value('prenom') ?>" placeholder="Votre prénom">
            <div class="error-message"><?= validation_show_error('prenom') ?></div>
          </div>
        </div>

        <!-- Ligne 2 : Nom + Adresse -->
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:0 2rem;">
          <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" value="<?= set_value('nom') ?>" placeholder="Votre nom">
            <div class="error-message"><?= validation_show_error('nom') ?></div>
          </div>
          <div class="form-group">
            <label for="adresse">Adresse</label>
            <input type="text" id="adresse" name="adresse" value="<?= set_value('adresse') ?>" placeholder="Votre adresse">
            <div class="error-message"><?= validation_show_error('adresse') ?></div>
          </div>
        </div>

        <!-- Ligne 3 : Téléphone + Entreprise -->
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:0 2rem;">
          <div class="form-group">
            <label for="telephone">Téléphone</label>
            <input type="tel" id="telephone" name="telephone" value="<?= set_value('telephone') ?>" placeholder="Votre téléphone">
            <div class="error-message"><?= validation_show_error('telephone') ?></div>
          </div>
          <div class="form-group">
            <label for="entreprise">Entreprise <span style="font-size:10px;color:#bbb;">(optionnel)</span></label>
            <input type="text" id="entreprise" name="entreprise" value="<?= set_value('entreprise') ?>" placeholder="Votre entreprise">
            <div class="error-message"><?= validation_show_error('entreprise') ?></div>
          </div>
        </div>

        <!-- Ligne 4 : Mot de passe -->
        <div class="form-group">
          <label for="mdp">Mot de passe</label>
          <input type="password" id="mdp" name="mdp" placeholder="Votre mot de passe">
          <div class="error-message"><?= validation_show_error('mdp') ?></div>
        </div>

        <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:.75rem; margin-top:.5rem;">
          <button type="submit" class="btn-submit">
            Créer mon compte
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <line x1="5" y1="12" x2="19" y2="12"/>
              <polyline points="12 5 19 12 12 19"/>
            </svg>
          </button>
          <p style="margin:0; font-size:13px; color:#aaa;">
            Déjà un compte ?
            <a href="<?= base_url('index.php/compte/connecter') ?>" style="color:#1a1a1a; text-decoration:none;">Se connecter →</a>
          </p>
        </div>

      <?= form_close() ?>

    </div>
  </div>
</div>