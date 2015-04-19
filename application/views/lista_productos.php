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
                        <form action='<?= site_url("carrito/agregar_carrito")?>' method="post">
                          <input type="hidden" name="id_producto" value="<?=$producto['id']?>"/>
                          <input type="hidden" name="descuento" value="<?=$producto['descuento']?>"/>
                          <input type="hidden" name="url" value="<?= current_url() ?>" />
                          
                          <button type="submit" class="boton verde centrado" onclick="window.open('añadido.php', 'Añadido', 'width=200,height=200')">
					Añadir al carrito 
				</button>
                        </form>
			</div>
			
		</div>
	<?php endforeach;?>
</div>