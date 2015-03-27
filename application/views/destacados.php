<div class="destacados">
  <div class="titulo_destacado">
    <?= $titulo ?>
  </div>
  <div class="prod_destacados">
    <ul>
      <?=$paginador?>  
    </ul>
    <ul>
      
     
     <hr> <br/>
     <div class='produc_listado'>
      <?php foreach ($productos as $clave => $valor) :?>
       
      <?php endforeach;?>
      
    </ul>
    <ul>
      <?=$paginador?>  
    </ul>
  </div>

</div>