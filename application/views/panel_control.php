<div class="panel_control">

    <h1>Hola: <?=$usuario ?></h1>
    
    <ul>
        <li>
            <a href="<?= site_url("usuario_controlador/editar");?>">Editar</a>
        </li>

        <li>
            <a href="<?= site_url("usuario_controlador/dar_baja"); ?>">Darse de baja</a>
        </li>

        <li>
            <a href="<?= site_url("usuario_controlador/pedidos_anteriores")?>">Historico pedidos</a>
        </li>
        <li>
            <a href="<?=site_url("usuario_controlador/salir")?>">Cerrar sesión</a>
        </li>
    </ul>



</div>


