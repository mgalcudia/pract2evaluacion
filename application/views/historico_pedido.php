<h1>Historicos de pedidos</h1>

<table class="tabla_carrito">
    
    <tr>
        <th>Pedido</th>
        <th>Nombre cliente</th>
        <th>Apellidos</th>
        <th>Correo electrónico</th>       
        <th>Estado</th>
        <th>Fecha</th>
        <th>Dirección de entrega</th>
        <th>Productos</th>
        <th>Importe</th>
       <th></th>
    </tr>
    <?php foreach ($pedidos as $p =>$valor): ?>
    <tr>
        <td><?=$valor['id']?></td>
        <td><?=$valor['nombre']?></td>
         <td><?=$valor['apellidos']?></td>
        <td><?=$valor['email']?></td>
       <td><?=$valor['estado']?></td>
       <td><?=$valor['fecha_pedido']?></td>
        <td><?=$valor['direccion']?></td>
        <td><?=$valor['cantidad']?></td>
        <td><?=$valor['importe']?> €</td>
        <td><?= anchor("usuario_controlador/cancelar_pedido/{$valor['id']}/{$valor['estado']}", "Cancelar pedido") ?></td>
    </tr>
    <?php endforeach; ?>
    
    
</table>