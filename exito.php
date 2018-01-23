	<?php
	require("config.php");
	session_start();
	//unset($_SESSION['carro']);
	//unset($_SESSION['carro1']);

?>
	<html>
		<head>
			<title>Exito | Raven Clothes</title>
			<link rel = "stylesheet" href = "style.css" type = "text/css">
			<!-- El viewport sirve para que lo agarre en Smartphones-->
			<meta name="viewport" content="width=device-width, intital-scale=1">
			<!-- Son los CSS de Bootstrap -->
			<link rel="stylesheet" href="bs\css\bootstrap.min.css">
			<link rel="stylesheet" href="bs\css\bootstrap-theam.min.css">
			<!-- Javascripts, primero el Jquery-->
			<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
			<script type="text/javascript" src="bs/js/bootstrap.min.js"></script>
		</head>
	<body>
		<!-- NAV BAR -->
		<?php include('include/navBar.php'); ?>
		<!-- END NAV BAR -->
	    <div class="container">
	    <section id="section_c">
		    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-8">   
				<div class="panel panel-primary">
					<div class="panel-heading"> Encuentranos!</div> 
						<br>

			<!-- INICIA CODIGO AQUI -->
			<?php
				$uuser = $_SESSION['user']['name'];
				$query = "		select c.nombre as N, c.calle as C, c.numero as NU, c.numeroInt as NI, 
								c.codigoPostal as CP, c.ciudad as CI, c.apPaterno as AP, c.apMaterno as AM, 
								c.telefono as T, c.id as IDC
								from clientes c 
								inner join usuariosCli uc on c.id = uc.cliente 
								where uc.usuario = '$uuser'";
				$result =  sqlsrv_query($conn,$query);
				$partir = sqlsrv_fetch_array($result);
				$nombre = $partir['N'];
				$AP = $partir['AP'];
				$AM = $partir['AM'];
				$Tele = $partir['T'];
				$IDC = $partir['IDC'];
				$NU = $partir['NU'];
				$NI = $partir['NI'];
				$CI = $partir['CI'];
				$CP = $partir['CP'];
				$C = $partir['C'];
				@$total_pedido = $_SESSION["costoTotal"];
				//echo $total_pedido;
				//echo $IDC;
				//echo $IDC;
				
				
				//STORED PROCEDURE
				$insertar= "exec usp_AddOrder '$IDC', '$nombre', '$C', '$NU', '$NI', '$CP', '$CI', '$Tele', '$total_pedido'";
				$recurso=sqlsrv_prepare($conn,$insertar);
				if(sqlsrv_execute($recurso))
				{
					foreach($_SESSION['carro'] as $id => $x)
					{     
						$cant = 1;
						$resultado = sqlsrv_query($conn,"select p.id as ID, p.precioUnitario as pU, pc.color as C, pc.talla as T
														from productos p 
														inner join prod_col pc on p.id = pc.producto
 														WHERE id=$id");    
						$mifila = sqlsrv_fetch_array($resultado);
						$id = $mifila['ID'];    
						$pU = $mifila['pU'];
						$c = $mifila['C'];
						$t = $mifila['T'];
						//echo $id;
						$queryOD="	declare @orden int;
									select @orden=id from Ordenes order by id DESC;
									insert into detalleOrdenes values (@orden, '$id', '$t', '$c', 1, '$pU', 0);
									update prod_col set stock = stock - 1 where producto = '$id';";
					sqlsrv_query($conn,$queryOD);

						
					}
				}
				else 
				{
					//Nada porque si
					echo "No se pudo registrar su orden. Porque los programadores tuvieron poco tiempo.";
					$cant = $_SESSION['carro'][$x];
				}
				
				//print_r($_POST);
				
						foreach($_SESSION['carro'] as $id => $x)
						{     
							$resultado = sqlsrv_query($conn,"SELECT id FROM productos WHERE id=$id");    
							$mifila = sqlsrv_fetch_array($resultado);
							$id = $mifila['id'];    
							//echo $id;

						
							$x = $_SESSION["costoTotal"];
						}
				
				//@$nombre = $_POST['first_name'];
				//@$apellido = $_POST['last_name'];
				@$email_client = $_POST['payer_email'];
				@$calle_client = $_POST['address_name'];
				@$ciudad_client = $_POST['address_city'];
				@$pais_client = $_POST['address_country'];
				@$zonaRes_client = $_POST['residence_country'];

				        $mensaje = "Cliente ".$nombre." ".$AP." ".$AM." "."su compra por ".$total_pedido." se ha realizado con exito. Gracias por comprar en RavenClothes.";
                        $mensaje  = str_replace(" ", "%20", $mensaje);
                        $numero  =  $Tele;


                        curl_setopt_array($ch = curl_init(), array(
                            CURLOPT_URL => "http://smsmasivos.com.mx/sms/api.envio.new.php",/*Pagina para registrarse y de donde es la API*/
                            CURLOPT_POST => TRUE,
                            CURLOPT_RETURNTRANSFER => TRUE,
                            CURLOPT_POSTFIELDS => array(
                            "apikey" => "",/*Aqui va el ApiKey de smsmasivos*/
                            "mensaje" => $mensaje,
                            "numcelular" => $numero,
                            "numregion" => "52"
                                    )
                                )
                        );
                        $respuesta=curl_exec($ch);
                        curl_close($ch);
                        	unset($_SESSION['carro']);
	unset($_SESSION['carro1']);

				// OBTENER NUMERO CECLULAR DEL CLIENTE
			?>

			<p>Estimado cliente, <?php echo $nombre." ".$AP." ".$AM." le enviaremos un mensaje a su telefono que es ".$Tele; ?>.</p>
			<p>Confirmamos su compra por <?php echo  $total_pedido ?>. En breve recibira un mensaje de texto confirmando su compra actual.</p>
			<!-- TERMINA CODIGO AQUI -->
				</div>
			</div>

			
			</div>
		</section>
		</div>
		<div class="push"></div>
	<div class="clearfix"></div>
	<footer id="footer_1">&copy; Derechos reservados a Raven Clothes</footer>

  	<!--
	<footer>
		<div class="container">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<p>Derechos reservados a Raven Clothes</p>
			</div>
		</div>
	</footer>
	-->
	</body>
</html>