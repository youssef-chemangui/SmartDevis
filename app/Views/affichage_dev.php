<style>
/* ===== RESET & BASE ===== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
    padding: 40px 20px;
    color: #2c3e50;
    line-height: 1.6;
}

.container {
    max-width: 1400px;
    margin: 0 auto;
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.08);
    padding: 30px;
    transition: all 0.3s ease;
}

/* ===== TYPOGRAPHIE ===== */
h2 {
    font-size: 28px;
    font-weight: 600;
    background: linear-gradient(135deg, #2c3e50, #1a252f);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    border-left: 5px solid #3498db;
    padding-left: 20px;
    margin-bottom: 25px;
}

h3 {
    font-size: 22px;
    font-weight: 600;
    color: #2c3e50;
    margin: 30px 0 20px 0;
    padding-bottom: 10px;
    border-bottom: 3px solid #3498db;
    display: inline-block;
}

/* ===== TABLEAU ===== */
table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    margin-bottom: 40px;
}

th {
    background: linear-gradient(135deg, #2c3e50, #34495e);
    color: white;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 13px;
    letter-spacing: 0.5px;
    padding: 15px 12px;
    text-align: left;
}

td {
    padding: 12px;
    border-bottom: 1px solid #ecf0f1;
    background-color: #fff;
    transition: background-color 0.2s ease;
}

tr:hover td {
    background-color: #f8f9fa;
}

tr:last-child td {
    border-bottom: none;
}

/* Cellules spécifiques */
td:first-child, th:first-child {
    font-weight: 500;
    color: #2c3e50;
}

/* ===== STATUS BADGES ===== */
td:nth-child(6) {
    font-weight: 600;
}

/* Statut "P" (en attente) */
td:nth-child(6):contains("P") {
    /* Géré via JS ou inline, mais on garde le style */
}

/* Style pour les statuts si besoin de JS */
.status-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

/* ===== BOUTONS & LIENS ===== */
a {
    text-decoration: none;
    transition: all 0.3s ease;
}

td a {
    display: inline-block;
    background: linear-gradient(135deg, #27ae60, #2ecc71);
    color: white;
    padding: 6px 16px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 2px 5px rgba(46,204,113,0.2);
}

td a:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(46,204,113,0.3);
    background: linear-gradient(135deg, #219a52, #27ae60);
}

td:last-child span {
    display: inline-block;
    background: #d5f5e3;
    color: #27ae60;
    padding: 6px 16px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
}

/* ===== FORMULAIRE ===== */
form {
    background: #f8f9fa;
    padding: 25px;
    border-radius: 15px;
    margin: 20px 0 30px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.03);
    border: 1px solid #e9ecef;
}

form label {
    display: inline-block;
    font-weight: 600;
    margin-right: 15px;
    min-width: 140px;
    color: #2c3e50;
}

form input, form select {
    padding: 10px 15px;
    border: 2px solid #e0e4e8;
    border-radius: 10px;
    font-size: 14px;
    font-family: inherit;
    transition: all 0.3s ease;
    background: white;
    width: 250px;
}

form input:focus, form select:focus {
    outline: none;
    border-color: #3498db;
    box-shadow: 0 0 0 3px rgba(52,152,219,0.1);
}

button {
    background: linear-gradient(135deg, #3498db, #2980b9);
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 10px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(52,152,219,0.3);
}

button:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(52,152,219,0.4);
    background: linear-gradient(135deg, #2980b9, #1f6da0);
}

/* ===== MESSAGES ===== */
p {
    background: #fff3cd;
    border-left: 4px solid #ffc107;
    padding: 15px 20px;
    border-radius: 8px;
    margin: 20px 0;
    color: #856404;
}

/* ===== HR ===== */
hr {
    margin: 30px 0;
    border: none;
    height: 2px;
    background: linear-gradient(to right, #e0e4e8, transparent);
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .container {
        padding: 15px;
    }
    
    h2 {
        font-size: 22px;
    }
    
    table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }
    
    th, td {
        padding: 10px 8px;
        font-size: 13px;
    }
    
    form label {
        display: block;
        margin-bottom: 5px;
    }
    
    form input, form select {
        width: 100%;
        margin-bottom: 15px;
    }
    
    button {
        width: 100%;
    }
    
    td a, td:last-child span {
        padding: 4px 12px;
        font-size: 11px;
    }
}

/* ===== ANIMATIONS ===== */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

table, form {
    animation: fadeIn 0.5s ease-out;
}

/* ===== IMPRESSION ===== */
@media print {
    body {
        background: white;
        padding: 0;
    }
    
    .container {
        box-shadow: none;
        padding: 0;
    }
    
    button, form, hr, td a {
        display: none;
    }
    
    table {
        box-shadow: none;
    }
    
    th {
        background: #2c3e50;
        color: white;
    }
}
</style>
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