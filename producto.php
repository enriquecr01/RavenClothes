<?php
	session_start();
	include("config.php");

	$id=($_GET['id']);
	//echo $id;

						$query="select p.id as IDD, p.nombre as N, round(p.precioUnitario,0,0) as pU, m.nombre as M,i.imagen as Ima, t.nombre as TA, co.nombre as CO, p.descripcion as DE, s.nombre SUC
								from imagenes i
								inner join productos p on i.producto = p.id
								inner join marcas m on m.clave = p.marca
								inner join categorias c on p.categoria = c.clave 
								inner join prod_col pc on pc.producto = p.id
								inner join tallas t on t.clave = pc.talla
								inner join colores co on co.clave = pc.color 
								inner join suc_prod sp on sp.producto = p.id
								inner join sucursales s on s.id = sp.sucursal 
								where p.id =".$id;
						$resultado=sqlsrv_query($conn,$query);
						while($producto=sqlsrv_fetch_array($resultado))
						{
							$title = $producto['N'];
							$descripcion = $producto['DE'];
							$precio = $producto['pU'];
							$byteArray = $producto['Ima'];
							$imgData= base64_encode($byteArray);
							$img = "<img src='data:image/jpeg;base64, $imgData' >";
							$talla = $producto['TA'];
							$color = $producto['CO'];
							$SUCC = $producto['SUC'];
							$IDD = $producto['IDD'];
							//echo $IDD;

						}

?>

<html>
		<head>
		<title> <?php echo $title; ?> | Raven Clothes </title>
		<!-- El viewport sirve para que lo agarre en Smartphones-->
		<meta name="viewport" content="width=device-width, intital-scale=1">
		<!-- Son los CSS de Bootstrap -->
		<link rel="stylesheet" href="bs\css\bootstrap.min.css">
		<link rel="stylesheet" href="bs\css\bootstrap-theam.min.css">
		<!-- Javascripts, primero el Jquery-->
			<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
			<script type="text/javascript" src="bs/js/bootstrap.min.js"></script>
		<link rel="icon" href="img\favicon.ico">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel = "stylesheet" href = "style.css" type = "text/css">
	</head>
	<body>
			<!-- NAV BAR -->
			<?php include('include/navBar.php'); ?>
			<!-- END NAV BAR -->
			
			<!--Informacion del producto-->
			<div class="content">
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">   
				 <div class="panel panel-primary">
					<div class="panel-heading"> Informacion del producto: </div> 
					<h1><?php echo $title; ?></h1>
					<p><?php echo $descripcion; ?></p>
					<h1>Tallas:</h1>
					<p> 
					<form action="carro.php" method="post">
					<select name='cbTalla'>
					<?php 	
							$queryTalla="select tallaClave, nombreTalla from getTallasProduto  where producto=".$id;
							$resultadoTalla=sqlsrv_query($conn, $queryTalla);
							while($productoTalla=sqlsrv_fetch_array($resultadoTalla))
							{

								$claveTalla=$productoTalla['tallaClave'];
								echo "<option value='$claveTalla'>".$productoTalla['nombreTalla']."</option>";	
							} 
							echo "</select>";

							?>
							
					<h1>Colores:</h1>
					<select name='cbColor'>
					<?php $queryColor="select colorClave, colorNombre from getColoresProducto where producto =".$id;
							$resultadoColor=sqlsrv_query($conn, $queryColor);
							while($productoColor=sqlsrv_fetch_array($resultadoColor))
							{

								$claveColor=$productoColor['colorClave'];
								echo "<option value='$claveColor'>".$productoColor['colorNombre']."</option>";	
							} 
							echo "</select>"; ?></p>
					<h1>Precio: <?php echo number_format($precio, 2, '.', '');?></h1>
					<br>
					<h3>Sucursales en donde esta este producto:</h3>
					
					<p>
					<?php
						$queryS="select s.nombre SUC, s.direccion as DIR
								from productos p
								inner join suc_prod sp on sp.producto = p.id
								inner join sucursales s on s.id = sp.sucursal 
								where p.id =".$id;
						$resultadoS=sqlsrv_query($conn,$queryS);
						while($sucursales=sqlsrv_fetch_array($resultadoS))
						{

							echo $sucursales['SUC']." ".$sucursales['DIR'];

						}
					echo "</p>";
			if(isset($_SESSION['user']['id']))
			{
				
				//echo "<input type='hidden' name='ID' value=".$IDD."> ";

				//if(isset($_SESSION['carro1'][$IDD]))
				//{
					//echo "<input type='hidden' name='action' value='removeProd'> ";
					//echo"removeProd'><input type='submit' id='buttonAdd buttonRemove' value = 'Remover del carrito'></input></a>";
					//echo "<input type='submit' id='buttonRemove' value = 'Remover del carrito'></input>";
				//} /*if*/ else{
					//echo "<input type='hidden' name='action' value='add'> ";
					//echo"add' ><input type='submit' id='buttonAdd' value = 'Añadir del carrito'></input></a>";
					//echo"<input type='submit' id='buttonAdd' value = 'Añadir del carrito'></input>";
				//} /*else*/ echo"</a>";

				echo"<a href='carro.php?id=".$IDD."&action=";

					/*Detectamos si el producto se ha aÃ±adido al carrito*/
					/*Se utilizara una imagen u otro dependiendo si se ha agregado*/
				if(isset($_SESSION['carro1'][$IDD])){
					echo"removeProd' alt='Eliminar del carro'><img src='img/removeCar.png'
					alt='Eliminar del carro' title='Eliminar producto del carrito' width=48>";
				} /*if*/ else{
					echo"add' alt='Añadir al carro'><img src='img/addCar.png'
					alt='Añadir al carrito' title='AÃ±adir productos' width=48>";
				} /*else*/ echo"</a>";
						 
			}

			else 
			{
				echo "<p>Necesitas tener una cuenta para poder agregar productos al carrito<br>
					<a href = 'registro.php'>Registrate</a>
					</p>";
			}
					 ?>
					 </form>
				 </div>
			</div>
			
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
				<center>
					<div class="panel panel-info">
							<div class="panel-body">
								<div id="indexCarrousel" class="carousel slide" data-ride="carousel">

									<div class="carousel-inner">
										
										<div class="item active">
											<?php print($img); ?>
										</div>

										<?php 
										/*CONTAR*/
										$queryContar = "select count(p.id) as contado
														from imagenes i
														inner join productos p on i.producto = p.id
														where p.id = ".$id;
										$resultadoCuenta =sqlsrv_query($conn,$queryContar);
										$cuenta=sqlsrv_fetch_array($resultadoCuenta);
										$contado=$cuenta['contado'];
										$contado = $contado - 1;

										/*Imagen*/
										$queryImagen="select top ".$contado." i.imagen as Ima
												from imagenes i
												inner join productos p on i.producto = p.id
												where p.id = ".$id;
										$resultadoIma=sqlsrv_query($conn,$queryImagen);
										while ($imagenn=sqlsrv_fetch_array($resultadoIma)) 
										{

											$byteArray1 = $imagenn['Ima'];
											$imgData1= base64_encode($byteArray1);
											$img1 = "<img src='data:image/jpeg;base64, $imgData1' >";
											echo "<div class='item'>".$img1."</div>";
										} ?>


									</div>



									<a class="left carousel-control" href="#indexCarrousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
									<a class="right carousel-control" href="#indexCarrousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
								</div>
							</div>
						</div>
					</center>
				
	        </div> 
	        	<div class="push"></div>
	       </div>
	<div class="push"></div>
	<div class="clearfix"></div>
	<footer id="footer_1">&copy; Derechos reservados a Raven Clothes <?php echo date("Y")?></footer>
		
	<script>
        $('#indexCarrousel').carousel({
            interval: 3000,
            pause: 'hover'
        });
    </script>
	</body>
</html>