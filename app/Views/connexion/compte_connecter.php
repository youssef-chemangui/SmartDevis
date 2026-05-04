

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