<h1>Detalle del pedido</h1>
  <table class="tabla_carrito">
        <tr>
            <th>Nombre Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th><p onmouseover="return overlib('e para pedidos entregados, p para pedidos pendientes\n\
         y c para pedidos cancelados');
               " onmouseout="return nd();">Estado</p></th>
               <th>Iva</th>
        </tr>
        <?php $total=0;
              $siniva=0;?>
        <?php foreach ($productos as $producto): ?>
            <tr>
                <td><?=  $producto['nombre']?></td>
                <td><?=  $producto['cantidad']?></td>
                <td><?=  $producto['precio_venta']?></td>   
                <td onmouseover="return overlib('e para pedidos entregados, p para pedidos pendientes\n\
         y c para pedidos cancelados');
               " onmouseout="return nd();"><?=  $producto['estado']?></td>
                <td><?=  $producto['iva']?></td>
            </tr>
            <?php $siniva+=($producto['precio_venta']*$producto['cantidad']);
             $total+=($producto['precio_venta']*$producto['cantidad'])*($producto['iva'] / 100) ?>

        <?php endforeach; ?>
        <tr>
        <td> </td>
        <td>Importe compra: </td>
        <td> <?= $siniva.' €' ?></td>
        <td>Precio final: </td>
        <td> <?=($siniva+$total).(' €');?></td>

        </tr>
       
    </table>
    
<p><?= anchor("usuario_controlador/pedidos_anteriores", "Volver atrás") ?></p>