	<?php

	session_start();
	include("config.php");

?>
	<html>
		<head>
			<title>Contactanos | Raven Clothes</title>
			<link rel = "stylesheet" href = "style.css" type = "text/css">
			<!-- El viewport sirve para que lo agarre en Smartphones-->
			<meta name="viewport" content="width=device-width, intital-scale=1">
			<!-- Son los CSS de Bootstrap -->
			<link rel="stylesheet" href="bs\css\bootstrap.min.css">
			<link rel="stylesheet" href="bs\css\bootstrap-theam.min.css">
			<!-- Javascripts, primero el Jquery-->
			<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
			<script type="text/javascript" src="bs/js/bootstrap.min.js"></script>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
			
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3366.4658492531166!2d-116.82774048443815!3d32.46022948106882!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xec96057a20cdb611!2sutt!5e0!3m2!1ses-419!2smx!4v1499988224926" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
		
				</div>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">   
				<div class="panel panel-primary">
					<div class="panel-heading"> Contactanos!!</div> 
						<br>
						<center>
							Llamanos o envianos un correo.<br> Para nosotros es importante conocer tus inquietudes acerca de nuestros 	productos, por tal motivo ponemos a tu disposicion este espacio de contacto.
							<br>
							<br>
							Nota: Los datos que comentes via telefonica o introducidos en el correo electronico, son tratados por Grupo 	Raven Clothes para brindarte el servicio que nos solicitas, conocer tus necesidades, comunicarte promociones 	y en su caso tratarlos para los fines analogos descritos en el Aviso de Privacidad.
							</p>
							<img src="img/ac.jpg" height="200">
							<p>01800 RAVENCLOTHES</p>
							<P>telacomesriendo@ravenclothes.com</P>
						</center>
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