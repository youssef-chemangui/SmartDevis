<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --warning: #f72585;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --light-gray: #e9ecef;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: var(--dark);
            line-height: 1.6;
            min-height: 100vh;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Header Styles */
        .admin-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 2rem 0;
            box-shadow: var(--shadow);
            margin-bottom: 2rem;
        }
        
        .admin-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-align: center;
        }
        
        .admin-header h2 {
            font-size: 1.5rem;
            font-weight: 400;
            text-align: center;
        }
        
        .welcome-message {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 1rem;
            margin-top: 1rem;
            text-align: center;
            backdrop-filter: blur(10px);
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        
        /* Table Styles */
        .table-container {
            background: white;
            border-radius: 15px;
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-bottom: 2rem;
        }
        
        .table-title {
            background: linear-gradient(135deg, var(--success) 0%, #4895ef 100%);
            color: white;
            padding: 1.5rem;
            font-size: 1.5rem;
            font-weight: 600;
            text-align: center;
        }
        
        .reservation-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .reservation-table th {
            background-color: var(--primary);
            color: white;
            padding: 1.2rem;
            text-align: left;
            font-weight: 500;
            border-bottom: 2px solid var(--secondary);
        }
        
        .reservation-table td {
            padding: 1.2rem;
            border-bottom: 1px solid var(--light-gray);
            transition: var(--transition);
        }
        
        .reservation-table tr:last-child td {
            border-bottom: none;
        }
        
        .reservation-table tr:hover td {
            background-color: rgba(67, 97, 238, 0.05);
        }
        
        .participants-list {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }
        
        .participant-tag {
            background: var(--light-gray);
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
            display: inline-block;
        }
        
        /* Stats Cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            transition: var(--transition);
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1.5rem;
            color: white;
        }
        
        .stat-1 .stat-icon {
            background: linear-gradient(135deg, #ff9a9e 0%, #fad0c4 100%);
        }
        
        .stat-2 .stat-icon {
            background: linear-gradient(135deg, #a1c4fd 0%, #c2e9fb 100%);
        }
        
        .stat-3 .stat-icon {
            background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
        }
        
        .stat-info h3 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.2rem;
        }
        
        .stat-info p {
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem;
            background: white;
            border-radius: 15px;
            box-shadow: var(--shadow);
            margin-bottom: 2rem;
        }
        
        .empty-state i {
            font-size: 4rem;
            color: var(--light-gray);
            margin-bottom: 1rem;
        }
        
        .empty-state h3 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            color: var(--gray);
        }
        
        /* Footer */
        .admin-footer {
            text-align: center;
            padding: 1.5rem;
            color: var(--gray);
            font-size: 0.9rem;
            margin-top: 2rem;
            border-top: 1px solid var(--light-gray);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .reservation-table {
                display: block;
                overflow-x: auto;
            }
            
            .admin-header h1 {
                font-size: 2rem;
            }
            
            .admin-header h2 {
                font-size: 1.2rem;
            }
            
            .stats-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="admin-header">
        <div class="container">
            <h1>Espace Admin</h1>
            <h2>Espace d'administration</h2>
            <div class="welcome-message">
                <h2>Session ouverte ! Bienvenue 
                <?php
                    $session = session();
                    echo $session->get('user');
                ?>
                </h2>
            </div>
        </div>
    </div>
        

    </div>
</body>
</html>