
<h1>Detalle del pedido</h1>

<div class="tabla_carrito">
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
<div>
 <p><?= anchor("usuario_controlador/pedidos_anteriores", "Volver atrás") ?></p>