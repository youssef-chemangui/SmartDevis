
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
  .subtitle { font-size: 13px; color: var(--c-muted); margin-bottom: 2rem; }
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
  .btn-valider { font-size: 12px; font-family: 'DM Sans', sans-serif; font-weight: 500; background: var(--c-ink); color: #fff; border: none; padding: 6px 14px; border-radius: 6px; cursor: pointer; text-decoration: none; display: inline-block; transition: opacity 0.15s; }
  .btn-valider:hover { opacity: 0.75; }
  .validated-text { font-size: 12px; color: var(--c-accent); font-weight: 500; }
  .amount { font-weight: 500; }
  h3 { font-family: 'DM Serif Display', serif; font-size: 1.3rem; font-weight: 400; margin-bottom: 1.25rem; color: var(--c-ink); }
  .form-card { background: var(--c-card); border-radius: 12px; border: 0.5px solid var(--c-border); padding: 1.5rem; max-width: 420px; }
  .field { margin-bottom: 1.25rem; }
  label { display: block; font-size: 12px; font-weight: 500; color: var(--c-muted); text-transform: uppercase; letter-spacing: 0.07em; margin-bottom: 6px; }
  input[type="number"], select {
    width: 100%; padding: 9px 12px; font-family: 'DM Sans', sans-serif; font-size: 14px;
    background: var(--c-surface); border: 0.5px solid var(--c-border); border-radius: 7px;
    color: var(--c-ink); outline: none; transition: border-color 0.15s;
    appearance: none;
  }
  input[type="number"]:focus, select:focus { border-color: var(--c-accent-mid); }
  .btn-submit {
    width: 100%; padding: 10px; font-family: 'DM Sans', sans-serif; font-size: 14px; font-weight: 500;
    background: var(--c-ink); color: #fff; border: none; border-radius: 7px; cursor: pointer;
    transition: background 0.15s;
  }
  .btn-submit:hover { background: #2d2d44; }
  hr { border: none; border-top: 0.5px solid var(--c-border); margin: 2rem 0; }
</style>

<h2><?= esc($titre) ?></h2>


<br>

<?php if (empty($dev)) : ?>
    <p>Aucun devis trouvé.</p>
<?php else : ?>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>Montant estimé</th>
        <th>Durée estimée</th>
        <th>Statut</th>
        <th>Date création</th>
        <th>Date validation</th>
        <th>Pseudo</th>
    </tr>

    <?php foreach ($dev as $d) : ?>
        <tr>
            <td><?= esc($d['dev_montant_estime']) ?> €</td>
            <td><?= esc($d['dev_duree_estime']) ?> jours</td>
            <td><?= esc($d['dev_statut']) ?></td>
            <td><?= esc($d['dev_date_creation']) ?></td>
            <td><?= esc($d['dev_date_validation']) ?></td>
            <td><?= esc($d['cpt_pseudo']) ?></td>
            <td>
                <?php if ($d['dev_statut'] == 'P') : ?>
                    <a href="<?= base_url('devis/valider/'.$d['dev_id']) ?>">
                        Valider
                    </a>
                <?php else : ?>
                    ✔ Validé
                <?php endif; ?>
                </td>
        </tr>
    <?php endforeach; ?>
    

</table>
<?php endif; ?>

<h3>Créer un devis</h3>

<form method="post" action="<?= base_url('devis/creer') ?>">

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

