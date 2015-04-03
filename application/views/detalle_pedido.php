
<h1>Resumen compra</h1>
<form action="<?=site_url('carrito/finalizar_compra')?>" method="post">

    <table>
        <tr>
            <td>Nombre Producto</td>
            <td>Cantidad</td>
            <td>Precio</td>
        </tr>
        <?php foreach ($productos as $producto): ?>
            <tr>
                <td><?= $producto['name'] ?></td>
                <td><?= $producto['qty'] ?></td>
                <td><?= $producto['price'] ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td></td>
            <td>Total:</td>
            <td><?= $total ?></td>
        </tr>   
    </table>
<input type="submit" name="detalle_pedido" value="Continuar"/>





</form> 