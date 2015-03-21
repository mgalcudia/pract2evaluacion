<div class="destacados">
    <div class="titulo_destacado">
        <?= $titulo ?>
    </div>
    <div class="prod_destacados">

        <ul>
            <?php
             echo "<hr> <br/>";
            foreach ($productos as $clave => $valor) {
               //var_dump($valor);
               echo "<img src=".base_url().$valor['imagen'].">";
               echo $valor["nombre"];
               echo "precio: ".$valor["precioVenta"];
               echo $valor["descuento"];
                
                echo "<hr> <br/>";

            }
            ?>
            
        </ul>

    </div>

</div>