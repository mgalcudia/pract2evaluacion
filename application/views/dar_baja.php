<form method="post" action="<?=base_url('index.php/usuario_controlador/dar_baja')?>">
<div class="baja">
    <h2>  Hola <?=$usuario?> ¿Desea darse de baja?</h2>
    <p>
        Si: <input type="checkbox" name="baja" value="Si">
    </p>
    <p>
        No: <input type="checkbox" name="baja" value="No">
    </p>
    
    
    
    <button type="submit">Aceptar</button>
</div>
    
    
</form>