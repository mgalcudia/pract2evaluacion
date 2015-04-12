<div class="encabezado">
	<div class="logo">
		<a href="<?=base_url()?>">Tienda Virtual</a>
	</div>
    <div class="categorias">
        
        <ul>
     <?php foreach ($categoria as $valor) : ?>
            
             <li><a href='<?=site_url("productos/producto_categoria/$valor[id]");?>'><?=$valor['nombre']?></a></li>
            
         <?php endforeach; ?>   
        </ul>
    </div>
	<div class="opciones">
		<ul>
			<li>
				<a href="<?=site_url("carrito/mostrar_carro");?>">
				Carrito <span class="glyphicon glyphicon-shopping-cart"></span>
				</a>
			</li>
			
			<li>
				<a href="<?=site_url("usuario_controlador/panel_control")?>">Mis datos</a>
			</li>
                        <li>
				<a href="<?=site_url("usuario_controlador/salir")?>">Salir</a>
			</li>
		</ul>
	</div>
</div>


