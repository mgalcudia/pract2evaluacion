
<h1>Detalle del pedido</h1>
  <table class="tabla_carrito">
        <tr>
            <th>Nombre Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th><a href="#" onmouseover="return overlib('e para pedidos entregados, p para pedidos pendientes\n\
         y c para pedidos cancelados');
               " onmouseout="return nd();">Estado</a></th>
        </tr>
        <?php foreach ($productos as $producto): ?>
            <tr>
                <td><?=  $producto['nombre']?></td>
                <td><?=  $producto['cantidad']?></td>
                <td><?=  $producto['precio_venta']?></td>   
                <td><?=  $producto['estado']?></td>
            </tr>
        <?php endforeach; ?>
       
    </table>
<p><?= anchor("usuario_controlador/pedidos_anteriores", "Volver atrás") ?></p>