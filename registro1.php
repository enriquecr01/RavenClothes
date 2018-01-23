<?php
	session_start();
	require("config.php");
	

	function formRegistro(){
		require("config.php");
			$query = "SELECT clave, nombre FROM estados";
	$resultado=sqlsrv_query($conn,$query);
?>
	<html>
	<head>
		<title>Registro de usuario | Raven Clothes</title>
		<link rel = "stylesheet" href = "style.css" type = "text/css">
			<!-- El viewport sirve para que lo agarre en Smartphones-->
			<meta name="viewport" content="width=device-width, intital-scale=1">
			<!-- Son los CSS de Bootstrap -->
			<link rel="stylesheet" href="bs\css\bootstrap.min.css">
			<link rel="stylesheet" href="bs\css\bootstrap-theam.min.css">
			<!-- Javascripts, primero el Jquery-->
			<script type="text/javascript" src="js\jquery-2.2.3.min.js"></script>
			<script type="text/javascript" src="bs\js/bootstrap.min.js"></script>
			<script language="javascript" src="js/jquery-3.1.1.min.js"></script>
			<link rel="icon" href="img\Cuanto meme\favicon.ico">


			<script language="javascript">
				$(document).ready(function(){
					$("#cbx_estado").change(function () {
					$('#cbx_localidad').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
					$("#cbx_estado option:selected").each(function () {
						id_estado = $(this).val();
						$.post("otros/getMunicipio.php", { id_estado: id_estado }, function(data){
							$("#cbx_municipio").html(data);
						});            
					});
				})
			});
			</script>

	</head>
	<body>
		<!-- NAV BAR -->
		<?php include('include/navBar.php'); ?>
		<!-- END NAV BAR -->
		<center>
		
			<div class="panel panel-primary" id="registro">
				<div  class="panel-heading">Registro.</div>
	                <div class="panel-body">
	                	<form action="registrar.php" method="post">
							Usuario: 
							<br> 
							<input type="text" name="username" placeholder="Usuario"><br>
							Apellido Paterno:
							<br>
							<input type="text" name="aPaterno" placeholder="ApellidoPaterno"><br>
							Apellido Materno:
							<br>
							<input type="text" name="aMaterno" placeholder="ApellidoMaterno"><br>
							Nombre:
							<br>
							<input type="text" name="nombre" placeholder="Nombre"><br>
							Calle:
							<br>
							<input type="text" name="calle" placeholder="Calle"><br>
							Numero:
							<br>
							<input type="text" name="num" placeholder="Numero"><br>
							Numero Interior:
							<br>
							<input type="text" name="numInt" placeholder="Numero Interior"><br>
							Selecciona Estado : 
							<br>
							<select name="cbx_estado" id="cbx_estado">
							<option value="0">Seleccionar Estado</option>
							<?php while($row = sqlsrv_fetch_array($resultado)) { ?>
							<option value="<?php echo $row['clave']; ?>"><?php echo $row['nombre']; ?></option>
							<?php } ?>
							</select>
							<br>
							Ciudad:
							<br>
							<select name="cbx_municipio" id="cbx_municipio"></select><br>
							Telefono:
							<br>
							<input type="text" name="tel" placeholder="Telefono"><br>
							E-mail: 
							<br>
							<input type="email" name="email" placeholder="E-mail"><br>
							Contraseña: 
							<br> 
							<input type="password" name="password" placeholder="Contraseña"><br>
							Confirmar Contraseña:
							<br>
							<input type="password" name="password2" placeholder="Confirmar Contraseña"><br>

							<input type="text" name="cod_postal" placeholder="Codigo Postal"><br>
							<input type="submit" value="Enviar"><br>    
	            </div>
			</div>			
		</center>
		<div class="push"></div>
	<div class="clearfix"></div>
	<footer id="footer_1">&copy; Derechos reservados a Raven Clothes</footer>
	</body>
</html>
<?php
}

formRegistro();?>