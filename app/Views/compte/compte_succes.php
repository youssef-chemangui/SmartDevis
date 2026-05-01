<div class="form-card-wrapper">
  <div class="form-card" style="max-width:480px; text-align:center;">

    <div class="form-card__header" style="text-align:center; padding-bottom:2rem;">

      <!-- Icône succès -->
      <div style="
        width:56px; height:56px;
        border-radius:50%;
        background:#f0f7e6;
        border:1.5px solid #9FBE5A;
        display:flex; align-items:center; justify-content:center;
        margin: 0 auto 1.5rem;
      ">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
             stroke="#9FBE5A" stroke-width="2.5"
             stroke-linecap="round" stroke-linejoin="round">
          <polyline points="20 6 9 17 4 12"/>
        </svg>
      </div>

      <p class="form-card__tag">Inscription confirmée</p>
      <h2 class="form-card__title">Compte créé avec succès</h2>
      <p class="form-card__lead">Bienvenue sur la plateforme. Votre espace personnel est prêt.</p>
    </div>

    <div class="form-card__body">

      <!-- Bloc pseudo -->
      <div style="
        display:flex; align-items:center; gap:14px;
        border-bottom:1px solid #f0eeea;
        padding-bottom:1.25rem; margin-bottom:1.25rem;
        text-align:left;
      ">
        <div style="
          width:38px; height:38px; flex-shrink:0;
          border-radius:50%;
          background:#f5f4f0;
          display:flex; align-items:center; justify-content:center;
        ">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
               stroke="#999" stroke-width="2"
               stroke-linecap="round" stroke-linejoin="round">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
            <circle cx="12" cy="7" r="4"/>
          </svg>
        </div>
        <div>
          <p style="font-size:11px; font-weight:500; letter-spacing:.08em; text-transform:uppercase; color:#aaa; margin-bottom:3px;">Pseudo enregistré</p>
          <p style="font-size:16px; font-weight:500; color:#1a1a1a;"><?= htmlspecialchars($le_compte) ?></p>
        </div>
      </div>

      <!-- Bloc total -->
      <div style="
        display:flex; align-items:center; gap:14px;
        text-align:left;
        margin-bottom:2rem;
      ">
        <div style="
          width:38px; height:38px; flex-shrink:0;
          border-radius:50%;
          background:#f5f4f0;
          display:flex; align-items:center; justify-content:center;
        ">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
               stroke="#999" stroke-width="2"
               stroke-linecap="round" stroke-linejoin="round">
            <line x1="8" y1="6" x2="21" y2="6"/>
            <line x1="8" y1="12" x2="21" y2="12"/>
            <line x1="8" y1="18" x2="21" y2="18"/>
            <line x1="3" y1="6" x2="3.01" y2="6"/>
            <line x1="3" y1="12" x2="3.01" y2="12"/>
            <line x1="3" y1="18" x2="3.01" y2="18"/>
          </svg>
        </div>
        <div>
          <p style="font-size:11px; font-weight:500; letter-spacing:.08em; text-transform:uppercase; color:#aaa; margin-bottom:3px;"><?= htmlspecialchars($le_message) ?></p>
          <p style="font-size:16px; font-weight:500; color:#1a1a1a;"><?= htmlspecialchars($le_total->total) ?> comptes</p>
        </div>
      </div>

      <!-- CTA -->
      <a href="<?= base_url('index.php/compte/connecter') ?>" class="btn-submit" style="text-decoration:none;">
        Se connecter
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2"
             stroke-linecap="round" stroke-linejoin="round">
          <line x1="5" y1="12" x2="19" y2="12"/>
          <polyline points="12 5 19 12 12 19"/>
        </svg>
      </a>

      <p style="margin-top:1.25rem; font-size:13px; color:#aaa;">
        <a href="<?= base_url('index.php') ?>" style="color:#888; text-decoration:none;">← Retour à l'accueil</a>
      </p>

    </div>

  </div>
</div>