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
  .table-wrap { background: var(--c-card); border-radius: 12px; border: 0.5px solid var(--c-border); overflow: hidden; margin-bottom: 2.5rem; }
  table { width: 100%; border-collapse: collapse; font-size: 13px; }
  thead { background: var(--c-surface); }
  th { padding: 10px 16px; text-align: left; font-size: 11px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.08em; color: var(--c-muted); border-bottom: 0.5px solid var(--c-border); }
  td { padding: 12px 16px; border-bottom: 0.5px solid var(--c-border); color: var(--c-ink); vertical-align: middle; }
  tr:last-child td { border-bottom: none; }
  tr:hover td { background: var(--c-surface); }
  .badge { display: inline-flex; align-items: center; gap: 5px; font-size: 11px; font-weight: 500; padding: 3px 10px; border-radius: 20px; }
  .badge-pending { background: var(--c-pending-bg); color: var(--c-pending); }
  .badge-valid { background: var(--c-accent-light); color: var(--c-accent); }
  .amount { font-weight: 500; }
  label { display: block; font-size: 12px; font-weight: 500; color: var(--c-muted); text-transform: uppercase; letter-spacing: 0.07em; margin-bottom: 6px; }
  input[type="number"], select {
    width: 100%; padding: 9px 12px; font-family: 'DM Sans', sans-serif; font-size: 14px;
    background: var(--c-surface); border: 0.5px solid var(--c-border); border-radius: 7px;
    color: var(--c-ink); outline: none; transition: border-color 0.15s; appearance: none;
  }
  input[type="number"]:focus, select:focus { border-color: var(--c-accent-mid); }
  .btn-submit {
    width: 100%; padding: 10px; font-family: 'DM Sans', sans-serif; font-size: 14px; font-weight: 500;
    background: var(--c-ink); color: #fff; border: none; border-radius: 7px; cursor: pointer; transition: background 0.15s;
  }
  .btn-submit:hover { background: #2d2d44; }
  hr { border: none; border-top: 0.5px solid var(--c-border); margin: 2rem 0; }
  /* Style global des champs */
input[type="text"],
textarea {
    width: 100%;
    max-width: 500px;
    padding: 12px 15px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 14px;
    font-family: Arial, sans-serif;
    transition: all 0.3s ease;
    box-sizing: border-box;
}

/* Effet au focus */
input[type="text"]:focus,
textarea:focus {
    border-color: #4CAF50;
    outline: none;
    box-shadow: 0 0 5px rgba(76, 175, 80, 0.3);
}

/* Style du textarea */
textarea {
    min-height: 120px;
    resize: vertical;
}

/* Placeholder */
input::placeholder,
textarea::placeholder {
    color: #999;
    font-style: italic;
}
</style>

<h2><?= esc($titre) ?></h2>
<br>

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
      </tr>
    </thead>
    <tbody>
      <?php foreach ($dev as $d) : ?>
      <tr>
        <td><?= esc($d['det_nom']) ?></td>
        <td><?= esc($d['det_description']) ?></td>
        <td class="amount">
            <?php if ($d['dev_statut'] == 'V') : ?>
                <?= esc($d['dev_montant_estime']) ?> €
            <?php else : ?>
                <span class="badge badge-pending">En cours d'évaluation</span>
            <?php endif; ?>
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
        <td>
            <a href="<?= base_url('/devis/supprimer/' . $d['dev_id']) ?>" 
            onclick="return confirm('Tu es sûr de vouloir supprimer ce devis ?');"
            class="btn-delete">
                Supprimer
            </a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>

<hr>

<h3>Créer un devis</h3>

<form method="post" action="<?= base_url('devis/creer') ?>">
    <label>Nom de site :</label>
    <input type="text" name="det_nom" placeholder="Nom du site">
    <label>Description :</label>
    <textarea name="det_description" placeholder="Description"></textarea>
    <label>Nombre de pages :</label>
    <input type="number" name="nb_pages" required>
    <br><br>

    <label>Paiement en ligne :</label>
    <select name="paiement_ligne">
        <option value="oui">Oui</option>
        <option value="non">Non</option>
    </select>
    <br><br>
    <button class="btn-submit" type="submit">Créer le devis</button>
</form>

<hr>
<?= view("chatbot_widget") ?>