<h1>Historicos de pedidos</h1>

<table class="tabla_carrito">

    <tr>
        <th href="#" onmouseover="return overlib('clickee para mas detalle del pedido');
               " onmouseout="return nd();">Pedido</th>
        <th>Nombre cliente</th>
        <th>Apellidos</th>
        <th>Correo electrónico</th>       
        <th href="#" onmouseover="return overlib('e para pedidos entregados, p para pedidos pendientes\n\
         y c para pedidos cancelados');
               " onmouseout="return nd();">Estado</th>
        <th>Fecha pedido</th>
        <th>Dirección de entrega</th>
        <th>Productos</th>
        <th>Importe</th>

    </tr>
    <?php foreach ($pedidos as $p => $valor): ?>
        <tr>

            <td><?= anchor("usuario_controlador/detalle_pedido/{$valor['id']}", "{$valor['id']}") ?> </td>
            <td><?= $valor['nombre'] ?></td>
            <td><?= $valor['apellidos'] ?></td>
            <td><?= $valor['email'] ?></td>
            <td><?= $valor['estado'] ?></td>
            <td><?= $valor['fecha_pedido']?></td>
            <td><?= $valor['direccion'] ?></td>
            <td><?= $valor['cantidad'] ?></td>
            <td><?= $valor['importe'] ?> €</td>
            <td><?= anchor("usuario_controlador/cancelar_pedido/{$valor['id']}/{$valor['estado']}", "Cancelar") ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<p><?= anchor("usuario_controlador/panel_control", "Volver atrás")?></p>