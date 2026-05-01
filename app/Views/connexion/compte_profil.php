
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            justify-content: center;
            align-items: center;
            padding: 20px;
            color: #333;
        }
        
        .profile-container {
            width: 100%;
            max-width: 800px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .profile-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }
        
        .profile-header h2 {
            font-size: 2.2rem;
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .profile-header::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 40px;
            height: 4px;
            background: white;
            border-radius: 2px;
        }
        
        .message-container {
            padding: 20px;
            margin: 20px;
            border-radius: 10px;
            background-color: #e6f7ff;
            border-left: 4px solid #1890ff;
            color: #0050b3;
            font-weight: 500;
            box-shadow: 0 2px 8px rgba(24, 144, 255, 0.1);
        }
        
        .profile-content {
            padding: 30px;
        }
        
        .profile-card {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        
        .profile-field {
            display: flex;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eaeaea;
        }
        
        .profile-field:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }
        
        .field-label {
            flex: 0 0 150px;
            font-weight: 600;
            color: #555;
            font-size: 1rem;
        }
        
        .field-value {
            flex: 1;
            font-size: 1.05rem;
            color: #222;
        }
        
        .value-badge {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .role-admin {
            background-color: #e6e6ff;
            color: #434190;
            border: 1px solid #9f7aea;
        }
        
        .role-member {
            background-color: #f0fff4;
            color: #22543d;
            border: 1px solid #68d391;
        }
        
        .empty-value {
            color: #999;
            font-style: italic;
        }
        
        .profile-avatar {
            display: flex;
            justify-content: center;
            margin-bottom: 25px;
        }
        
        .avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 2.5rem;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }
        
        @media (max-width: 768px) {
            .profile-container {
                border-radius: 12px;
            }
            
            .profile-header {
                padding: 20px;
            }
            
            .profile-header h2 {
                font-size: 1.8rem;
            }
            
            .profile-content {
                padding: 20px;
            }
            
            .profile-field {
                flex-direction: column;
            }
            
            .field-label {
                flex: none;
                margin-bottom: 5px;
            }
        }
        
        @media (max-width: 480px) {
            body {
                padding: 10px;
            }
            
            .profile-container {
                border-radius: 10px;
            }
            
            .profile-header h2 {
                font-size: 1.5rem;
            }
            
            .profile-card {
                padding: 15px;
            }
        }
    </style>

<body>
   <div class="profile-card">

    <?php if ($profil['pfl_role'] == 'A' || $profil['pfl_role'] == 'M'): ?>

        <!-- Affichage complet -->
        <div class="profile-field">
            <div class="field-label">Pseudo</div>
            <div class="field-value"><?= $profil['cpt_pseudo'] ?></div>
        </div>

        <div class="profile-field">
            <div class="field-label">Email</div>
            <div class="field-value"><?= $profil['pfl_email'] ?></div>
        </div>

        <div class="profile-field">
            <div class="field-label">Nom</div>
            <div class="field-value"><?= $profil['pfl_nom'] ?></div>
        </div>

        <div class="profile-field">
            <div class="field-label">Prénom</div>
            <div class="field-value"><?= $profil['pfl_prenom'] ?></div>
        </div>

        <div class="profile-field">
            <div class="field-label">Rôle</div>
            <div class="field-value">
                <?php if ($profil['pfl_role'] == 'A'): ?>
                    <span class="value-badge role-admin">Administrateur</span>
                <?php else: ?>
                    <span class="value-badge role-member">Membre</span>
                <?php endif; ?>
            </div>
        </div>

    <?php else: ?>

        <!-- Affichage invité uniquement -->
        <div class="profile-field">
            <div class="field-label">Pseudo</div>
            <div class="field-value"><?= $profil['cpt_pseudo'] ?></div>
        </div>

        <div class="profile-field">
            <div class="field-label">Rôle</div>
            <div class="field-value">
                <span class="value-badge" style="
                    background:#fff7e6;
                    border:1px solid #faad14;
                    color:#d48806;
                ">Invité</span>
            </div>
        </div>

    <?php endif; ?>

</div>

</body>
</html>