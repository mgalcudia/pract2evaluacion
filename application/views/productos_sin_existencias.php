<h2>Los siguientes productos no están almacenados con suficientes existencias</h2>
<div class="sin_existencias">
    <ul>
        <?php foreach ($productos as $producto) : ?>
        <li>
            <?= $producto ?>
        </li>
        <?php endforeach; ?>
    </ul>
</div>