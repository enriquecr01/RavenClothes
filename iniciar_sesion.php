		<html>
		<head>
			<title>Iniciar sesion | Raven Clothes</title>
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
		<?php include('include/navBar.php'); 
		include("config.php");?>
		<!-- END NAV BAR -->
			<center>
			<section id="section_1">
				<div class="panel panel-primary" id="registro">
					<div  class="panel-heading">Iniciar sesion.</div>
						<div class="panel-body">
							<form action="validar_usuario.php" method="post"> <!--Si dice que no hay un objeto encontrado entonces revisa la accion-->
								Usuario: 
								<br> 
								<input type="text" name="username" placeholder="Usuario"><br>
								Contraseña: 
								<br> 
								<input type="password" name="password" placeholder="Contraseña"><br>
								<br><a href="registro.php">¿No tienes cuenta? Unete.</a><br><br>
								<input type="submit" value="Iniciar Sesion"><br>
							</form>                
						</div>
					</div>
					</section>
			</center>

	<footer id="footer_1">
		<p>Derechos reservados a Raven Clothes</p>
	</footer>
	</body>
</html>