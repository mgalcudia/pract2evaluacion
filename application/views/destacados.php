<div class="destacados">
    <div class="titulo_destacado">
        <?= $titulo ?>
    </div>
    <div class="prod_destacados">
        <ul>
          <?=$paginador?>  
        </ul>
        <ul>
            <?php
           
             echo "<hr> <br/>";
              echo "<div class='produc_listado'>";
            foreach ($productos as $clave => $valor) {
               //var_dump($valor);
               echo "<div class='imagen_produc'>";
               echo "<img src=".base_url().$valor['imagen'].">";
               echo "</div>";
               echo "<div class='valor_produc'>"; 
               echo $valor["nombre"];
               echo "</div>";
               echo "<div class='precio_produc'>";
               echo "precio: ".$valor["precioVenta"];
               echo "</div>";
               echo "<div class='descuento_produc'>";
               echo "descuento: ".$valor["descuento"];
               echo "</div>";
               echo "<div class='descr_produc'>";
               echo "descripcion: ".$valor["descripcion"];   
               echo "</div>";
               echo "<hr> <br/>";  
               }
                echo "</div";
            ?>
             
        </ul>
        <ul>
          <?=$paginador?>  
        </ul>
    </div>

</div>