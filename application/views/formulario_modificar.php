<form method="post" action="<?=base_url('index.php/usuario_controlador/editar')?>">

    <input type="hidden" name="id" value="<?=$datos['id']?>">
<legend>Modificar datos usuario<legend>	
        <br>
        
<p>
		<label>Nombre</label>
		
			<input type="text" name="nombre" value="<?=(set_value('nombre'))?set_value('nombre'):$datos['nombre'];?>"/>
			<?php echo form_error('nombre'); ?>
</p>
<p>
	
		<label>Apellidos</label>
		
			<input type="text" name="apellidos" value="<?=(set_value('apellidos'))?set_value('apellidos'):$datos['apellidos'];?>" />
			<?php echo form_error('apellidos'); ?>
</p>
	<p>
                        <label>DNI</label>
		
			<input type="text" name="dni" value="<?=(set_value('dni'))?set_value('dni'):$datos['dni'];?>" />
			<?php echo form_error('dni');?>

</p>
<p>
		<label>Dirección</label>
					
			<input type="text" name="direccion" value="<?=(set_value('direccion'))?set_value('direccion'):$datos['direccion'];?>" />
			<?php echo form_error('direccion'); ?>

</p>	
<p>
		<label>Código Postal</label>
		
			
			<input type="text" name="codpostal" value="<?=(set_value('codpostal'))?set_value('codpostal'):$datos['codpostal'];?>" />
			<?php echo form_error('codpostal'); ?>
</p>
	
<p>
		<label>Provincia</label>
		
			<?=form_dropdown('selprovincias', $provincias,(set_value('selprovincias'))?set_value('selprovincias'):$datos['provincia_id']  );?>
                                
</p>

<p>
		<label >Nombre usuario</label>

                <input type="text" name="usuario" readonly="readonly" value="<?=$datos['usuario']?>">
			<?php echo form_error('usuario'); ?>

</p>	
<p>	
		<label>Email</label>
		
			<input type="email"  name="email" value="<?=(set_value('email'))?set_value('email'):$datos['email'];?>">
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
