<h2><?= esc($titre) ?></h2>


<br>

<?php if (empty($dev)) : ?>
    <p>Aucun devis trouvé.</p>
<?php else : ?>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Montant estimé</th>
        <th>Durée estimée</th>
        <th>Montant ML</th>
        <th>Durée ML</th>
        <th>Statut</th>
        <th>Date création</th>
        <th>Date validation</th>
        <th>Pseudo</th>
    </tr>

    <?php foreach ($dev as $d) : ?>
        <tr>
            <td><?= esc($d['dev_id']) ?></td>
            <td><?= esc($d['dev_montant_estime']) ?></td>
            <td><?= esc($d['dev_duree_estime']) ?></td>
            <td><?= esc($d['dev_montant_ml']) ?></td>
            <td><?= esc($d['dev_duree_ml']) ?></td>
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

    <button type="submit">Créer devis</button>
</form>

<hr>

<?php endif; ?>