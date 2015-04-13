<form method="post" action="<?=base_url("index.php/usuario_controlador/restablece_pass")?>" >
    <div class="form-group <?=(isset($clase_campo_form['email']))?$clase_campo_form['email']:''?>">
        <p>Email</p>
        <input type="text" name="email" id="email" value="<?= set_value('email'); ?>" placeholder="Introduzca el email">
            <?= form_error('email') ?>
    </div>
    <button type="submit" >Enviar</button>
</form>
