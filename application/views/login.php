
<form method="post" action="<?=base_url('index.php/usuario_controlador/loguearse')?>">
   <?php
    //erro
    if(isset($mensaje_error)){
        echo $mensaje_error;
    }
    if (isset($logout)){
        echo $logout;       
    }
        
   ?> 
    <label> Loguear usuario</label>
    
    <p>
        Usuario:
        <input type="text" name="usuario" value="<?= set_value('usuario'); ?>">
        <?= form_error('usuario'); ?>
    </p>
    <p>
        Contraseña:
        <input type="password" name="password" value="">
        <?= form_error('password'); ?>
        <input type="checkbox" name="recordar"> Recordarme
    </p>
    <p>
        <a href=<?=site_url("usuario_controlador/registrousuario");?>>¿Registrarse?</a>
        
    </p>
    <button type="submit">Entrar</button>
</form>