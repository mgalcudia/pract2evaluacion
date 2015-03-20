
<form method="post" action="<?=base_url('index.php/usuario_controlador/registrousuario')?>">

<legend>Datos personales</legend>	
<p>
		<label>Nombre</label>
		
			<input type="text" name="nombre" value="<?php echo set_value('nombre'); ?>"/>
			<?php echo form_error('nombre'); ?>
</p>
<p>
	
		<label>Apellidos</label>
		
			<input type="text" name="apellidos" value="<?php echo set_value('apellidos'); ?>" />
			<?php echo form_error('apellidos'); ?>
</p>
	<p>
                        <label>DNI</label>
		
			<input type="text" name="dni" value="<?php echo set_value('dni'); ?>" />
			<?php echo form_error('dni');?>

</p>
<p>
		<label>Dirección</label>
					
			<input type="text" name="direccion" value="<?php echo set_value('direccion'); ?>" />
			<?php echo form_error('direccion'); ?>

</p>	
<p>
		<label>Código Postal</label>
		
			
			<input type="text" name="codpostal" value="<?php echo set_value('codpostal'); ?>" />
			<?php echo form_error('codpostal'); ?>
</p>
	
<p>
		<label>Provincia</label>
		
			<?=form_dropdown('selprovincias', $provincias, set_value('selprovincias'));?>

</p>

<p>
		<label >Nombre usuario</label>

			<input type="text" name="usuario" value="<?php echo set_value('usuario'); ?>">
			<?php echo form_error('usuario'); ?>

</p>	
<p>	
		<label>Email</label>
		
			<input type="email"  name="email" value="<?php echo set_value('email'); ?>">
			<?php echo form_error('email'); ?>
</p>
	
<p>	
		<label>Contraseña</label>
		
			<input type="password" name="password" >
			<?php echo form_error('contraseña'); ?>

</p>	
<p>	
		<label>Confirma contraseña</label>
		
			<input type="password"  name="pConfirm">
			<?php echo form_error('pConfirm'); ?>
</p>


    
			<button type="submit">Enviar</button>

</form>
