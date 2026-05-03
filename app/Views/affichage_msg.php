
<h1><?= $titre ?></h1>

<?php if (!empty($news)): ?>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Objet</th>
                <th>Contenu</th>
                <th>Code pour la suivi</th>
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
                    <td><?= $msg['msg_objet'] ?></td>
                    <td><?= $msg['msg_contenu'] ?></td>
                    <td><?= $msg['msg_code'] ?></td>
                    <td><?= $msg['msg_date'] ?></td>
                    <td><?= $msg['msg_response'] ?></td>
                    <td><?= $msg['cpt_pseudo'] ?></td>
                    <td>
                        <?php if ($msg['msg_response'] != 'Demande en cours de traitement'): ?>
                            <span style="color:green; font-weight:bold;">Réponse envoyée</span>
                        <?php else: ?>
                            <form method="post" action="<?= base_url('index.php/message/repondre/'.$msg['msg_id']) ?>">
                                <input type="text" name="msg_response" style="width:200px">
                                <button type="submit">Envoyer</button>
                            </form>
                        <?php endif; ?>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Pas de message pour le moment</p>
<?php endif; ?>