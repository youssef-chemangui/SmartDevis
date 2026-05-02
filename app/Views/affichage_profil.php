<style>
body {
    font-family: Arial, sans-serif;
    background: #f4f6f9;
    margin: 0;
}

.container {
    width: 95%;
    margin: auto;
    padding: 20px;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.btn-primary {
    background: #007bff;
    color: white;
    padding: 10px 15px;
    border-radius: 8px;
    text-decoration: none;
}

.stats-container {
    display: flex;
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: white;
    padding: 20px;
    border-radius: 12px;
    flex: 1;
    display: flex;
    align-items: center;
    gap: 15px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
}

.table-container {
    background: white;
    padding: 20px;
    border-radius: 12px;
}

.styled-table {
    width: 100%;
    border-collapse: collapse;
}

.styled-table th {
    background: #007bff;
    color: white;
    padding: 10px;
}

.styled-table td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

.styled-table tr:hover {
    background: #f1f1f1;
}

/* BADGES */
.status-badge {
    padding: 5px 10px;
    border-radius: 20px;
    color: white;
    font-size: 12px;
}

.active {
    background: green;
}

.inactive {
    background: red;
}

.role-badge {
    padding: 5px 10px;
    border-radius: 20px;
    color: white;
    font-size: 12px;
}

.admin { background: purple; }
.member { background: blue; }
.invite { background: gray; }

.empty-state {
    text-align: center;
    padding: 40px;
}
    </style>
<body>

<div class="container">

    <!-- En-tête -->
    <div class="header">
        <div class="header-title">
            <h1>Gestion des comptes utilisateurs</h1>
            <p>Administration complète des profils et invitations</p>
        </div>
    </div>

    <!-- Cartes -->
    <div class="stats-container">
        <div class="stat-card">
            <i class="fas fa-users"></i>
            <div>
                <h2><?= $membre->total ?></h2>
                <p>Comptes au total</p>
            </div>
        </div>

        <div class="stat-card">
            <i class="fas fa-id-card"></i>
            <div>
                <h2><?= $profil_num->total_profil ?></h2>
                <p>Profils actifs</p>
            </div>
        </div>
    </div>

    <!-- TABLE -->
    <div class="table-container">

    <?php if (!empty($logins) && is_array($logins)) : ?>

        <h2 class="table-title"><?= $titre ?></h2>

        <table class="styled-table">
            <thead>
                <tr>
                    <th>Pseudo</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Numéro</th>
                    <th>Adresse</th>
                    <th>Email</th>
                    <th>Statut</th>
                    <th>Rôle</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($logins as $pseudos) : ?>
                    <tr>
                        <td><?= htmlspecialchars($pseudos["cpt_pseudo"]) ?></td>
                        <td><?= htmlspecialchars($pseudos["pfl_nom"]) ?></td>
                        <td><?= htmlspecialchars($pseudos["pfl_prenom"]) ?></td>
                        <td><?= htmlspecialchars($pseudos["pfl_telephone"]) ?></td>
                        <td><?= htmlspecialchars($pseudos["pfl_adresse"]) ?> </td>
                        <td><?= htmlspecialchars($pseudos["pfl_email"]) ?></td>

                        <td>
                            <span class="status-badge <?= $pseudos["cpt_statut"] == 'A' ? 'active' : 'inactive' ?>">
                                <?= $pseudos["cpt_statut"] == 'A' ? 'Activé' : 'Désactivé' ?>
                            </span>
                        </td>

                        <td>
                            <span class="role-badge 
                                <?= $pseudos["pfl_role"] == 'A' ? 'admin' : ($pseudos["pfl_role"] == 'M' ? 'member' : 'invite') ?>">
                                
                                <?= $pseudos["pfl_role"] == 'A' ? 'Admin' : ($pseudos["pfl_role"] == 'M' ? 'Membre' : 'Invité') ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    <?php else : ?>

        <div class="empty-state">
            <h3>Aucun compte pour le moment</h3>
            <p>Les comptes utilisateurs apparaîtront ici une fois créés.</p>
        </div>

    <?php endif; ?>

    </div>

</div>
</body>