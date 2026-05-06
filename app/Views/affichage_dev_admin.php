<style>
  @import url('https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=DM+Sans:wght@400;500&display=swap');
  :root {
    --c-ink: #1a1a2e;
    --c-surface: #f7f5f0;
    --c-card: #ffffff;
    --c-accent: #3B6D11;
    --c-accent-light: #EAF3DE;
    --c-accent-mid: #639922;
    --c-muted: #888780;
    --c-border: rgba(0,0,0,0.1);
    --c-pending: #BA7517;
    --c-pending-bg: #FAEEDA;
  }
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body { font-family: 'DM Sans', sans-serif; background: var(--c-surface); color: var(--c-ink); padding: 2rem; }
  h2 { font-family: 'DM Serif Display', serif; font-size: 2rem; font-weight: 400; color: var(--c-ink); letter-spacing: -0.02em; margin-bottom: 0.25rem; }
  h3 { font-family: 'DM Serif Display', serif; font-size: 1.3rem; font-weight: 400; margin-bottom: 1.25rem; color: var(--c-ink); }
  table { width: 100%; border-collapse: collapse; font-size: 13px; }
  thead { background: var(--c-surface); }
  th { padding: 10px 16px; text-align: left; font-size: 11px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.08em; color: var(--c-muted); border-bottom: 0.5px solid var(--c-border); }
  td { padding: 12px 16px; border-bottom: 0.5px solid var(--c-border); color: var(--c-ink); vertical-align: middle; }
  tr:last-child td { border-bottom: none; }
  tr:hover td { background: var(--c-surface); }
  .badge { display: inline-flex; align-items: center; gap: 5px; font-size: 11px; font-weight: 500; padding: 3px 10px; border-radius: 20px; }
  .badge-pending { background: var(--c-pending-bg); color: var(--c-pending); }
  .badge-valid { background: var(--c-accent-light); color: var(--c-accent); }
  .btn-valider { font-size: 12px; font-family: 'DM Sans', sans-serif; font-weight: 500; background: var(--c-ink); color: #fff; border: none; padding: 6px 14px; border-radius: 6px; cursor: pointer; text-decoration: none; display: inline-block; transition: opacity 0.15s; }
  .btn-valider:hover { opacity: 0.75; }
  .validated-text { font-size: 12px; color: var(--c-accent); font-weight: 500; }
  .amount { font-weight: 500; }
  label { display: block; font-size: 12px; font-weight: 500; color: var(--c-muted); text-transform: uppercase; letter-spacing: 0.07em; margin-bottom: 6px; }
  input[type="number"], select {
    width: 100%; padding: 9px 12px; font-family: 'DM Sans', sans-serif; font-size: 14px;
    background: var(--c-surface); border: 0.5px solid var(--c-border); border-radius: 7px;
    color: var(--c-ink); outline: none; transition: border-color 0.15s; appearance: none;
  }
  input[type="number"]:focus, select:focus { border-color: var(--c-accent-mid); }
  hr { border: none; border-top: 0.5px solid var(--c-border); margin: 2rem 0; }

  /* Tarif block */
  .tarif-block {
    display: flex; align-items: center; gap: 12px; flex-wrap: wrap;
    background: var(--c-card); border: 0.5px solid var(--c-border);
    border-radius: 10px; padding: 1rem 1.25rem; max-width: 380px; margin-bottom: 2rem;
  }
  .tarif-block label { margin-bottom: 0; white-space: nowrap; }
  .tarif-block input[type="number"] { width: 110px; padding: 6px 10px; font-size: 13px; }

  /* Boutons inline */
  .btn-small {
    font-size: 11px; font-family: 'DM Sans', sans-serif; font-weight: 500;
    background: var(--c-accent); color: #fff; border: none;
    padding: 5px 11px; border-radius: 5px; cursor: pointer; white-space: nowrap;
  }
  .btn-small:hover { opacity: 0.8; }

  /* Montant inline */
  .montant-form { display: flex; align-items: center; gap: 6px; }
  .montant-form input[type="number"] { width: 90px; padding: 5px 8px; font-size: 13px; }
</style>

<h2><?= esc($titre) ?></h2>
<br>

<!-- ═══════════════════════════════════════════
     BLOC 1 — Modifier le tarif journalier
════════════════════════════════════════════ -->
<h3>Tarif journalier</h3>
<form method="post" action="<?= base_url('devis/modifier_tarif') ?>">
  <div class="tarif-block">
    <label>Tarif / jour (€) :</label>
    <input type="number" name="tarif_journalier"
           value="<?= esc($tarif_journalier) ?>" min="1" required>
    <button class="btn-small" type="submit">Enregistrer</button>
  </div>
</form>

<hr>

<!-- ═══════════════════════════════════════════
     BLOC 2 — Tableau de tous les devis
════════════════════════════════════════════ -->
<h3>Tous les devis</h3>

<?php if (empty($dev)) : ?>
  <p>Aucun devis trouvé.</p>
<?php else : ?>
  <table>
    <thead>
      <tr>
        <th>le nom de site</th>
        <th>description</th>
        <th>Montant estimé</th>
        <th>Durée estimée</th>
        <th>Statut</th>
        <th>Date création</th>
        <th>Date validation</th>
        <th>Pseudo</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($dev as $d) : ?>
      <tr>
        <td><?= esc($d['det_nom']) ?></td>
        <td><?= esc($d['det_description']) ?></td>
        <!-- Montant éditable -->
        <td>
          <form method="post"
                action="<?= base_url('devis/modifier_montant/' . $d['dev_id']) ?>"
                class="montant-form">
            <input type="number" name="montant"
                   value="<?= esc($d['dev_montant_estime']) ?>" min="1" required>
            <button class="btn-small" type="submit" title="Enregistrer">✓</button>
          </form>
        </td>

        <td><?= esc($d['dev_duree_estime']) ?> jours</td>

        <td>
          <?php if ($d['dev_statut'] == 'P') : ?>
            <span class="badge badge-pending">⏳ En attente</span>
          <?php else : ?>
            <span class="badge badge-valid">✔ Validé</span>
          <?php endif; ?>
        </td>

        <td><?= esc($d['dev_date_creation']) ?></td>
        <td><?= $d['dev_date_validation'] ? esc($d['dev_date_validation']) : '—' ?></td>
        <td><?= esc($d['cpt_pseudo']) ?></td>

        <td>
          <?php if ($d['dev_statut'] == 'P') : ?>
            <a class="btn-valider" href="<?= base_url('devis/valider/' . $d['dev_id']) ?>">
              Valider
            </a>
          <?php else : ?>
            <span class="validated-text">✔ Validé</span>
          <?php endif; ?>
        </td>

      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>

<hr>