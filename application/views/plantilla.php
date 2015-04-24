<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>TiendaOnline</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/estilos.css'); ?>">
        <script type="text/javascript" src="<?= base_url('assets/js/overlib.js');?>"><!-- overLIB (c) Erik Bosrup --></script>
</head>
<body>
	<div class="contenedor">
		<?=$encabezado?>
		<div class="cuerpo">
                        <?= $mensaje?>
			<?=$cuerpo?>
		</div>
		<?=$pie?>
	</div>
</body>
</html>

