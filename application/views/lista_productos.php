<h1><?=isset($titulo)? $titulo: ''?></h1>
<hr>
<div class="paginador">
	<?=$paginador?>  
</div>
<div class="lista_productos">
	<?php foreach ($productos as $producto) :?>
		<div class="producto">
			<div class="prod-contenido">
				<img class="imagen" src="<?=base_url($producto['imagen'])?>">
				<div class="datos">
					<h2><?=$producto['nombre']?></h2>
					<ul>
						<li>Precio: <?=$producto['precioVenta']?> €</li>
						<li>Descuento: 0€</li>
					</ul>
					<div class="descripcion"><?=$producto['descripcion']?></div>
				</div>

			</div>
			<div class="contenedor-botones">
				<a href="#" class="boton verde centrado">
					Añadir al carrito
				</a>
			</div>
			
		</div>
	<?php endforeach;?>
</div>