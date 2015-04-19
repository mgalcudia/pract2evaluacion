<form method="post" action="<?=base_url("index.php/usuario_controlador/restablece_pass")?>" >
    <div>
        <p>Email:</p>
        <input type="text" name="email" id="email" value="<?= set_value('email'); ?>">
            <?= form_error('email') ?>
    </div>
    <button type="submit" >Enviar</button>
</form>
