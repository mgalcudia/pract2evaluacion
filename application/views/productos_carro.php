<h1>Productos para comprar</h1>
<table class="tabla_carrito">
    <tr>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Cantidad</th>
        <th>Eliminar</th>
    </tr>
    <?php foreach ($productos as $articulo) : ?>
        <tr>
            <td><?= $articulo['name'] ?></td>
            <td><?= $articulo['price'] ?></td>
            <td><?= $articulo['qty'] ?></td>
            <td class="eliminar"><?= anchor("carrito/eliminarProducto/" . $articulo['rowid'], 'Eliminar') ?></td>
        </tr>
    <?php endforeach; ?>
    <tr id="total">
        <td><strong>Total:</strong></td>
        <td colspan="1"><?= $precio ?> euros.</td>
        <td colspan="3"><a href="<?= site_url('carrito/eliminar_carrito') ?>">Vaciar carrito</a></td>
    </tr>
</table>
<a href="<?=site_url('carrito/finalizar_compra')?>">Finalizar compra</a>