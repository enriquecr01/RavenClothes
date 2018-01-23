<?php
	include("config.php");
	$categoria = " ";
	$action = " ";
	$var="" ;
	$var=($_GET['var']);
	$action =($_GET['action']);
	$caba = " where p.genero = 'H' ";
    $dama = " where p.genero = 'M' ";
	session_start();


	switch($action)
	{
		case "camisas":
			$categoria = " and c.nombre like 'Camisa' ";
		break;
		
		case "pantalones":
			$categoria = " and c.nombre like 'Pantalon' ";	
		break;
		default: break;
	}
?>

<html>
	<head>
		<title> Ropa de caballero | Raven Clothes </title>
		<!-- El viewport sirve para que lo agarre en Smartphones-->
		<meta name="viewport" content="width=device-width, intital-scale=1">
		<!-- Son los CSS de Bootstrap -->
		<link rel="stylesheet" href="bs\css\bootstrap.min.css">
		<link rel="stylesheet" href="bs\css\bootstrap-theam.min.css">
		<!-- Javascripts, primero el Jquery-->
			<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
			<script type="text/javascript" src="bs/js/bootstrap.min.js"></script>
		<link rel="icon" href="img\favicon.ico">
		<link rel = "stylesheet" href = "style.css" type = "text/css">
	</head>
	<body>
		<!-- NAV BAR -->
		<?php include('include/navBar.php'); ?>
		<!-- END NAV BAR -->
		<!--Para buscar-->
		<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">   
			 <div class="panel panel-primary">
				<div class="panel-heading"> Filtrar por:</div> 
				<br>
				<center>
					<a href="consultarRopa.php?action=<?php echo "camisas"; ?>&var=<?php echo $var; ?>" id="formA">Camisas</a><br>
					<a href="consultarRopa.php?action=<?php echo "pantalones"; ?>&var=<?php echo $var; ?>" id="formA">Pantalones</a>
				</center>
			 </div>
	    </div>
		
		<!--Para el resultado de la consulta-->
		<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">   
			<div class="panel panel-primary">
				<div class="panel-heading"> Resultados:</div> 
					<?php 
						$query="select distinct p.id as iD, p.nombre as N, round(p.precioUnitario,0,0) as pU, m.nombre as M
								from imagenes i
								inner join productos p on i.producto = p.id
								inner join marcas m on m.clave = p.marca
								inner join categorias c on p.categoria = c.clave ".$var." ".$categoria;
						$resultado=sqlsrv_query($conn,$query);
						while($productos=sqlsrv_fetch_array($resultado))
						{
							$iDC = $productos['iD'];
                            $queryImagen = "select top 1 imagen as Ima
                                                    from imagenes 
                                                    where producto = ".$iDC;
                            $resultIma = sqlsrv_query($conn,$queryImagen);

                                //$name = $caballero['N'];
                            $imageen = sqlsrv_fetch_array($resultIma);
                            $byteArray = $imageen['Ima'];
							$imgData= base64_encode($byteArray);
							$img = "<img src='data:image/jpeg;base64, $imgData' width='120' height='130' >";
							$iD = $productos['iD'];
							?>

							<div id="caja">
								<h4><?php echo "".$productos['N']." Marca ".$productos['M']; ?></h4>


								<?php print($img); ?>
								<p><?php echo "".$productos['pU']; ?></p>
								<a href="producto.php?id=<?php echo $iD ?>"> Detalles</a>
							</div>
						<?php
						} /*While*/
					?>		
				</div>
			</div>
		<div class="push"></div>
		<div class="clearfix"></div>
	<div id="footer_cc">&copy; Derechos reservados a Raven Clothes <?php echo date("Y")?></div>
	</body>
</html>