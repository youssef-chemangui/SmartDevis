<style>
<style>
    /* ========== VARIABLES DYNAMIQUES ========== */
    :root {
        --primary: #4361ee;
        --primary-dark: #3a0ca3;
        --primary-light: #4895ef;
        --success: #06d6a0;
        --danger: #ef233c;
        --warning: #f8961e;
        --info: #4cc9f0;
        --dark: #2b2d42;
        --gray: #6c757d;
        --light: #f8f9fa;
        --white: #ffffff;
        --shadow-sm: 0 2px 4px rgba(0,0,0,0.08);
        --shadow-md: 0 4px 12px rgba(0,0,0,0.1);
        --shadow-lg: 0 8px 24px rgba(0,0,0,0.12);
        --shadow-xl: 0 12px 36px rgba(0,0,0,0.15);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        margin: 0;
        animation: fadeIn 0.5s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes slideUp {
        from {
            transform: translateY(30px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @keyframes slideInLeft {
        from {
            transform: translateX(-30px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes shimmer {
        0% {
            background-position: -1000px 0;
        }
        100% {
            background-position: 1000px 0;
        }
    }

    /* ========== CONTAINER ========== */
    .container {
        width: 95%;
        max-width: 1400px;
        margin: auto;
        padding: 30px 20px;
        animation: slideUp 0.6s ease-out;
    }

    /* ========== EN-TÊTE ========== */
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        background: rgba(255, 255, 255, 0.95);
        padding: 20px 30px;
        border-radius: 20px;
        backdrop-filter: blur(10px);
        box-shadow: var(--shadow-lg);
        animation: slideInLeft 0.5s ease-out;
    }

    .header-title h1 {
        font-size: 28px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        margin-bottom: 8px;
    }

    .header-title p {
        color: var(--gray);
        font-size: 14px;
    }

    /* ========== STATS CARDS ========== */
    .stats-container {
        display: flex;
        gap: 25px;
        margin-bottom: 40px;
        flex-wrap: wrap;
    }

    .stat-card {
        background: linear-gradient(135deg, var(--white) 0%, #f8f9fa 100%);
        padding: 25px;
        border-radius: 24px;
        flex: 1;
        min-width: 200px;
        display: flex;
        align-items: center;
        gap: 20px;
        box-shadow: var(--shadow-md);
        transition: var(--transition);
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, transparent 30%, rgba(67, 97, 238, 0.05) 50%, transparent 70%);
        transform: translateX(-100%);
        transition: transform 0.6s;
    }

    .stat-card:hover::before {
        transform: translateX(100%);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-xl);
    }

    .stat-card i {
        font-size: 48px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .stat-card div h2 {
        font-size: 36px;
        font-weight: 700;
        background: linear-gradient(135deg, var(--dark) 0%, var(--primary) 100%);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        margin-bottom: 5px;
    }

    .stat-card div p {
        color: var(--gray);
        font-size: 14px;
        font-weight: 500;
    }

    /* ========== TABLE CONTAINER ========== */
    .table-container {
        background: var(--white);
        padding: 0;
        border-radius: 24px;
        box-shadow: var(--shadow-lg);
        overflow: hidden;
        transition: var(--transition);
    }

    .table-title {
        padding: 25px 30px 0 30px;
        font-size: 22px;
        color: var(--dark);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* ========== TABLE STYLES ========== */
    .styled-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .styled-table thead tr {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    }

    .styled-table th {
        color: var(--white);
        padding: 18px 15px;
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-align: left;
        position: relative;
    }

    .styled-table th:first-child {
        border-top-left-radius: 20px;
    }

    .styled-table th:last-child {
        border-top-right-radius: 20px;
    }

    .styled-table td {
        padding: 16px 15px;
        color: var(--dark);
        font-size: 14px;
        border-bottom: 1px solid #e9ecef;
        transition: var(--transition);
    }

    .styled-table tbody tr {
        transition: var(--transition);
        animation: slideUp 0.4s ease-out;
        animation-fill-mode: backwards;
    }

    .styled-table tbody tr:hover {
        background: linear-gradient(90deg, #f8f9fa 0%, #ffffff 100%);
        transform: scale(1.01);
        box-shadow: var(--shadow-sm);
    }

    /* Animation delay pour chaque ligne */
    .styled-table tbody tr:nth-child(1) { animation-delay: 0.1s; }
    .styled-table tbody tr:nth-child(2) { animation-delay: 0.15s; }
    .styled-table tbody tr:nth-child(3) { animation-delay: 0.2s; }
    .styled-table tbody tr:nth-child(4) { animation-delay: 0.25s; }
    .styled-table tbody tr:nth-child(5) { animation-delay: 0.3s; }

    /* ========== BADGES DYNAMIQUES ========== */
    .status-badge, .role-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 0.3px;
        transition: var(--transition);
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .status-badge::before, .role-badge::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: translate(-50%, -50%);
        transition: width 0.4s, height 0.4s;
    }

    .status-badge:hover::before, .role-badge:hover::before {
        width: 100px;
        height: 100px;
    }

    .status-badge:hover, .role-badge:hover {
        transform: translateY(-2px);
        filter: brightness(1.1);
    }

    /* Status Badges */
    .status-badge.active {
        background: linear-gradient(135deg, #06d6a0 0%, #059669 100%);
        box-shadow: 0 4px 12px rgba(6, 214, 160, 0.3);
    }

    .status-badge.inactive {
        background: linear-gradient(135deg, #ef233c 0%, #991b1b 100%);
        box-shadow: 0 4px 12px rgba(239, 35, 60, 0.3);
    }

    /* Role Badges */
    .role-badge.admin {
        background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 100%);
        box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
    }

    .role-badge.member {
        background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .role-badge.invite {
        background: linear-gradient(135deg, #6c757d 0%, #4b5563 100%);
        box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
    }

    /* ========== EMPTY STATE ========== */
    .empty-state {
        text-align: center;
        padding: 60px 40px;
        animation: fadeIn 0.6s ease-out;
    }

    .empty-state h3 {
        font-size: 24px;
        color: var(--dark);
        margin-bottom: 12px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .empty-state p {
        color: var(--gray);
        font-size: 14px;
    }

    /* ========== SCROLLBAR PERSONNALISÉE ========== */
    ::-webkit-scrollbar {
        width: 10px;
        height: 10px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: var(--primary-dark);
    }

    /* ========== RESPONSIVE ========== */
    @media (max-width: 1024px) {
        .stats-container {
            gap: 15px;
        }
        
        .styled-table {
            font-size: 12px;
        }
        
        .styled-table th,
        .styled-table td {
            padding: 12px 10px;
        }
    }

    @media (max-width: 768px) {
        .container {
            width: 98%;
            padding: 15px;
        }
        
        .stats-container {
            flex-direction: column;
        }
        
        .stat-card {
            min-width: auto;
        }
        
        .header {
            flex-direction: column;
            text-align: center;
            gap: 15px;
        }
        
        .table-container {
            overflow-x: auto;
        }
        
        .styled-table {
            min-width: 800px;
        }
        
        .status-badge, .role-badge {
            padding: 4px 10px;
            font-size: 10px;
        }
    }

    /* ========== LOADING STATE ========== */
    .loading {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 1000px 100%;
        animation: shimmer 1.5s infinite;
    }

    /* ========== TOOLTIPS ========== */
    [data-tooltip] {
        position: relative;
        cursor: pointer;
    }

    [data-tooltip]:before {
        content: attr(data-tooltip);
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        padding: 5px 10px;
        background: var(--dark);
        color: var(--white);
        font-size: 12px;
        border-radius: 8px;
        white-space: nowrap;
        opacity: 0;
        pointer-events: none;
        transition: var(--transition);
        z-index: 1000;
    }

    [data-tooltip]:hover:before {
        opacity: 1;
        transform: translateX(-50%) translateY(-5px);
    }
</style>
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