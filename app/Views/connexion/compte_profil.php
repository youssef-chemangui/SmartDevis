<style>
    .profile-card {
        max-width: 400px;
        margin: 20px auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #f9f9f9;
    }
    .profile-header {
        text-align: center;
        margin-bottom: 20px;
    }
    .profile-field {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }
    .field-label {
        font-weight: bold;
    }
    .badge {
        padding: 5px 10px;
        border-radius: 4px;
        color: #fff;
    }
    .badge-admin {
        background-color: #007bff;
    }
    .badge-member {
        background-color: #28a745;
    }
    .badge-guest {
        background-color: #6c757d;
    }
</style>
<body>
    <div class="profile-card">

        <!-- Header -->
        <div class="profile-header">
            <h2>Profil utilisateur</h2>
        </div>

        <div class="profile-content">

            <!-- Champ commun -->
            <div class="profile-field">
                <span class="field-label">Pseudo</span>
                <span class="field-value"><?= esc($profil['cpt_pseudo']) ?></span>
            </div>

            <?php if ($profil['pfl_role'] === 'A' || $profil['pfl_role'] === 'M'): ?>

                <!-- Infos complètes -->
                <div class="profile-field">
                    <span class="field-label">Email</span>
                    <span class="field-value"><?= esc($profil['pfl_email']) ?></span>
                </div>

                <div class="profile-field">
                    <span class="field-label">Nom</span>
                    <span class="field-value"><?= esc($profil['pfl_nom']) ?></span>
                </div>

                <div class="profile-field">
                    <span class="field-label">Prénom</span>
                    <span class="field-value"><?= esc($profil['pfl_prenom']) ?></span>
                </div>

                <div class="profile-field">
                    <span class="field-label">Rôle</span>
                    <span class="field-value">
                        <?php if ($profil['pfl_role'] === 'A'): ?>
                            <span class="badge badge-admin">Administrateur</span>
                        <?php else: ?>
                            <span class="badge badge-member">Membre</span>
                        <?php endif; ?>
                    </span>
                </div>

            <?php else: ?>

                <!-- Invité -->
                <div class="profile-field">
                    <span class="field-label">Rôle</span>
                    <span class="field-value">
                        <span class="badge badge-guest">Invité</span>
                    </span>
                </div>

            <?php endif; ?>

        </div>
    </div>
</body>