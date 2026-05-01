<style>
    /* Style général */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

/* Conteneur principal */
form {
    background: white;
    border-radius: 10px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    padding: 40px;
    width: 100%;
    max-width: 450px;
    transition: transform 0.3s ease;
}

form:hover {
    transform: translateY(-5px);
}

/* Titre */
h2 {
    color: #333;
    text-align: center;
    margin-bottom: 30px;
    font-size: 28px;
    font-weight: 600;
    position: relative;
}

h2::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 50px;
    height: 3px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 2px;
}

/* Messages d'erreur flash */
h2 + :is(div, p) {
    background-color: #f8d7da;
    color: #721c24;
    padding: 12px;
    border-radius: 5px;
    margin-bottom: 20px;
    border-left: 4px solid #f5c6cb;
    font-size: 14px;
}

/* Labels */
label {
    display: block;
    margin-bottom: 8px;
    color: #555;
    font-weight: 500;
    font-size: 14px;
}

/* Champs de saisie */
input[type="input"],
input[type="password"] {
    width: 100%;
    padding: 12px 15px;
    margin-bottom: 5px;
    border: 2px solid #e1e5e9;
    border-radius: 8px;
    font-size: 14px;
    transition: all 0.3s ease;
    font-family: inherit;
}

input[type="input"]:focus,
input[type="password"]:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

/* Messages d'erreur de validation */
.error-message,
:is(div, p) + :is(div, p) {
    color: #e74c3c;
    font-size: 12px;
    margin-top: -3px;
    margin-bottom: 15px;
    display: block;
}

/* Bouton de soumission */
input[type="submit"] {
    width: 100%;
    padding: 14px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 10px;
    font-family: inherit;
}

input[type="submit"]:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
}

input[type="submit"]:active {
    transform: translateY(0);
}

/* Style pour le message d'erreur flash spécifique */
<?= session()->getFlashdata('error') ? "div:first-child" : "" ?> {
    animation: shake 0.5s ease;
}

/* Animation pour les erreurs */
@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
}

/* Responsive design */
@media (max-width: 480px) {
    form {
        padding: 25px;
    }
    
    h2 {
        font-size: 24px;
    }
    
    input[type="input"],
    input[type="password"],
    input[type="submit"] {
        padding: 10px 12px;
    }
}

/* Style pour les champs avec erreur */
input:invalid:not(:placeholder-shown) {
    border-color: #e74c3c;
}

/* Ajout d'un petit effet de placeholder */
input::placeholder {
    color: #bbb;
    font-size: 12px;
}

/* Style pour le champ pseudo spécifiquement */
label[for="pseudo"] {
    margin-top: 5px;
}
</style>
<?= session()->getFlashdata('error') ?>
<h2><?php echo $titre; ?></h2>
<?php
//...
// Création d’un formulaire qui pointe vers l’URL de base + /compte/creer
echo form_open_multipart('/compte/creer'); ?>
<?= csrf_field() ?>

<label for="pseudo">Pseudo : </label>
<input type="input" name="pseudo">
<?= validation_show_error('pseudo') ?>

<label for="prenom">Prénom : </label>
<input type="input" name="prenom">
<?= validation_show_error('prenom') ?>

<label for="nom">Nom : </label>
<input type="input" name="nom">
<?= validation_show_error('nom') ?>

<label for="adresse">Adresse : </label>
<input type="input" name="adresse">
<?= validation_show_error('adresse') ?>

<label for="telephone">Téléphone : </label>
<input type="input" name="telephone">
<?= validation_show_error('telephone') ?>

<label for="entreprise">Entreprise : </label>
<input type="input" name="entreprise">
<?= validation_show_error('entreprise') ?>

<label for="mdp">Mot de passe : </label>
<input type="password" name="mdp">
<?= validation_show_error('mdp') ?>

<input type="submit" name="submit" value="Créer un nouveau compte">

<?= form_close(); ?>