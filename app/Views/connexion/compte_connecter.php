<style>
/* Conteneur général */
form {
    max-width: 420px;
    margin: 40px auto;
    padding: 35px;
    background: #ffffff;
    border-radius: 15px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.15);
    font-family: "Poppins", Arial, sans-serif;
}

/* Titre */
h2 {
    text-align: center;
    font-family: "Poppins", sans-serif;
    font-size: 28px;
    color: #333;
    margin-bottom: 20px;
}

/* Labels */
form label {
    display: block;
    margin-top: 15px;
    font-weight: 600;
    color: #444;
    font-size: 15px;
}

/* Champs input */
form input[type="input"],
form input[type="password"] {
    width: 100%;
    padding: 12px 15px;
    margin-top: 5px;
    border: 2px solid #e5e5e5;
    border-radius: 10px;
    font-size: 15px;
    transition: 0.3s ease;
}

form input[type="input"]:focus,
form input[type="password"]:focus {
    border-color: #4a6cf7;
    box-shadow: 0 0 8px rgba(74,108,247,0.4);
    outline: none;
}

/* Bouton */
form input[type="submit"] {
    width: 100%;
    margin-top: 25px;
    padding: 12px;
    background: linear-gradient(135deg, #4a6cf7, #7f9ffb);
    border: none;
    border-radius: 12px;
    font-size: 17px;
    font-weight: 600;
    color: #fff;
    cursor: pointer;
    transition: 0.3s ease;
}

form input[type="submit"]:hover {
    background: linear-gradient(135deg, #3857d9, #6987f3);
    transform: translateY(-3px);
    box-shadow: 0 6px 15px rgba(74,108,247,0.4);
}

/* Message d'erreur */
.error {
    color: #d63031;
    font-weight: 600;
    margin-top: 10px;
    text-align: center;
}
</style>

<h2><?php echo $titre; ?></h2>


<?php echo form_open('/compte/connecter'); ?>
<?= csrf_field() ?>

    <label for="pseudo">Pseudo : </label>
    <input type="input" name="pseudo" value="<?= set_value('pseudo') ?>">
    <?= validation_show_error('pseudo') ?>
    <?php if (isset($error)) : ?>
        <div style="color:red; margin-bottom:10px;">
            <?= $error ?>
        </div>
    <?php endif; ?>
    <label for="mdp">Mot de passe : </label>
    <input type="password" name="mdp">
    <?= validation_show_error('mdp') ?>
    
    <input type="submit" name="submit" value="Se connecter">
</form>