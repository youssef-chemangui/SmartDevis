<style>
    body{
        font-family: Arial, Helvetica, sans-serif;
        background: #f4f6f9;
        margin: 20px;
        color: #333;
    }

    h1{
        text-align: center;
        margin-bottom: 25px;
        color: #2c3e50;
    }

    .table-container{
        overflow-x: auto;
        background: white;
        border-radius: 15px;
        padding: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    }

    table{
        width: 100%;
        border-collapse: collapse;
        min-width: 1200px;
    }

    thead{
        background: linear-gradient(135deg, #4e73df, #224abe);
        color: white;
    }

    thead th{
        padding: 15px;
        text-align: center;
        font-size: 14px;
        letter-spacing: 0.5px;
    }

    tbody tr{
        transition: 0.3s;
    }

    tbody tr:nth-child(even){
        background: #f8f9fc;
    }

    tbody tr:hover{
        background: #eef3ff;
        transform: scale(1.003);
    }

    tbody td{
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #e3e6f0;
        vertical-align: middle;
    }

    .response-ok{
        color: #1cc88a;
        font-weight: bold;
        background: rgba(28,200,138,0.12);
        padding: 8px 12px;
        border-radius: 8px;
        display: inline-block;
    }

    .response-pending{
        color: #f6c23e;
        font-weight: bold;
    }

    form{
        display: flex;
        gap: 8px;
        justify-content: center;
        align-items: center;
    }

    input[type="text"]{
        width: 220px;
        padding: 10px;
        border: 1px solid #d1d3e2;
        border-radius: 8px;
        outline: none;
        transition: 0.3s;
    }

    input[type="text"]:focus{
        border-color: #4e73df;
        box-shadow: 0 0 5px rgba(78,115,223,0.4);
    }

    button{
        background: linear-gradient(135deg, #1cc88a, #17a673);
        border: none;
        color: white;
        padding: 10px 16px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
        transition: 0.3s;
    }

    button:hover{
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }

    .empty-message{
        text-align: center;
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        color: #888;
        font-size: 18px;
    }

    @media screen and (max-width: 768px){

        body{
            margin: 10px;
        }

        h1{
            font-size: 22px;
        }

        input[type="text"]{
            width: 150px;
        }

        button{
            padding: 8px 12px;
            font-size: 13px;
        }
    }
</style>

<h1><?= $titre ?></h1>

<?php if (!empty($news)): ?>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Objet</th>
                <th>Contenu</th>
                <th>Code suivi</th>
                <th>Date</th>
                <th>Réponse actuelle</th>
                <th>Répondeur</th>
                <th>Nouvelle réponse</th>
            </tr>
        </thead>

        <tbody>

        <?php foreach($news as $msg): ?>

            <tr>

                <td><?= $msg['msg_id'] ?></td>

                <td><?= $msg['msg_email'] ?></td>

                <td>
                    <strong><?= $msg['msg_objet'] ?></strong>
                </td>

                <td style="max-width:250px; text-align:left;">
                    <?= $msg['msg_contenu'] ?>
                </td>

                <td>
                    <span style="background:#4e73df;color:white;padding:6px 10px;border-radius:6px;">
                        <?= $msg['msg_code'] ?>
                    </span>
                </td>

                <td><?= $msg['msg_date'] ?></td>

                <td>
                    <?php if ($msg['msg_response'] != 'Demande en cours de traitement'): ?>

                        <span class="response-ok">
                            <?= $msg['msg_response'] ?>
                        </span>

                    <?php else: ?>

                        <span class="response-pending">
                            En attente...
                        </span>

                    <?php endif; ?>
                </td>

                <td><?= $msg['cpt_pseudo'] ?></td>

                <td>

                    <?php if ($msg['msg_response'] != 'Demande en cours de traitement'): ?>

                        <span class="response-ok">
                            Réponse envoyée
                        </span>

                    <?php else: ?>

                        <form method="post" action="<?= base_url('index.php/message/repondre/'.$msg['msg_id']) ?>">

                            <input 
                                type="text" 
                                name="msg_response" 
                                placeholder="Écrire une réponse..."
                                required
                            >

                            <button type="submit">
                                Envoyer
                            </button>

                        </form>

                    <?php endif; ?>

                </td>

            </tr>

        <?php endforeach; ?>

        </tbody>
    </table>
</div>

<?php else: ?>

    <div class="empty-message">
        Aucun message pour le moment
    </div>

<?php endif; ?>