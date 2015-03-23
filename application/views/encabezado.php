<div class="encabezado">
	<div class="logo">
		<a href="<?=base_url()?>">Tienda Virtual</a>
	</div>
    <div class="categorias">
        <ul>
    
     <?php   foreach ($categoria as $clave => $valor) : ?>
            
             <li><a href='<?=site_url("productos/producto_categoria/$valor[id]");?>'><?=$valor['nombre']?></a></li>
            
         <?php endforeach; ?>
    
   
        </ul>
    </div>
	<div class="opciones">
		<ul>
			<li>
				<a href="<?=site_url("");?>">Carrito</a>
			</li>
			
			<li>
				<a href="<?=site_url("usuario_controlador/loguearse");?>">Login</a>
			</li>
			
			<li>
				<a href="<?=site_url("usuario_controlador/registrousuario")?>">Registro</a>
			</li>
		</ul>
	</div>
</div>


