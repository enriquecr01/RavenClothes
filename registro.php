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
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">


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
<?php
	session_start();
	require("config.php");
	
	$query = "SELECT clave, nombre FROM estados";
	$resultado=sqlsrv_query($conn,$query);
	function formRegistro(){
			require("config.php");
	
	$query = "SELECT clave, nombre FROM estados";
	$resultado=sqlsrv_query($conn,$query);
?>


		<center>
		
			<div class="panel panel-primary" id="registro">
				<div  class="panel-heading">Registro.</div>
	                <div class="panel-body">
	                	<form action="registro.php" method="post">
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
							Codigo Postal:
							<br>
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

	if(isset($_POST['username'])){
		$username=$_POST['username'];
		$aPaterno = $_POST['aPaterno'];
	 	$aMaterno = $_POST['aMaterno'];
	 	$nombre=$_POST['nombre'];
	 	$calle=$_POST['calle'];
	 	$numero=$_POST['num'];
	 	if (isset($_POST['numInt'])) 
	 	{
	 		$numInt = $_POST['numInt'];
	 	}
	 	else
	 	{
	 		$numInt = "";
	 	}
	 	$municipio=$_POST['cbx_municipio'];
	 	$password=$_POST['password'];
	 	$password2=$_POST['password2'];
	 	$tel = $_POST['tel'];
	 	$email=$_POST['email'];
	 	$cod_postal=$_POST['cod_postal'];
	 //Hay campos en blando?
	 
	 if($username==NULL|$nombre==NULL|$password==NULL){
		echo"<p id='error'>Hay un campo vacio</p>";
		formRegistro();
	 }else{
		if($password!=$password2){
		echo"<p id='error'>Las contraseñas no coinciden</p>";
		formRegistro();
	 }else{
		$check_user=sqlsrv_query($conn,"SELECT usuario from usuariosCli where usuario='$username'");
		$username_exist=sqlsrv_num_rows($check_user);
	 
		$check_email=sqlsrv_query($conn,"SELECT usuario from usuariosCli where correo='$email'");
		$email_exist=sqlsrv_num_rows($check_email);
		if($username_exist>0|$email_exist>0){
		echo"<p id='error'>El nombre de usuario o email esta en uso </p>";
		formRegistro();
		}else{

		
		$queryU="insert into clientes (apPaterno, apMaterno, nombre, calle, numero,numeroInt, ciudad, telefono,codigoPostal)
					values ('$aPaterno', '$aMaterno', '$nombre', '$calle', '$numero','$numInt',$municipio, '$tel', '$cod_postal');
					declare @id int;
					declare @contra nvarchar(64);
					SET @contra = convert(nvarchar(64),hashbytes('sha1', '$password'),2);
					select top 1 @id = id from clientes order by id desc;
					insert into usuariosCli(cliente, usuario, correo, contrasena)
					values(@id,'$username','$email', @contra);";
		sqlsrv_query($conn,$queryU);
		
		/*
		// Crea una nueva sentencia
		$myparams[]

		$stmt = sqlsrv_init('usp_AddClientUser');
		// Vincular valores
		sqlsrv_bind($stmt, '@aPaterno',    $aPaterno,  SQLVARCHAR,     false,  false,   20);
		sqlsrv_bind($stmt, '@aMaterno',    $aMaterno,  SQLVARCHAR,     false,  false,   20);
		sqlsrv_bind($stmt, '@nombre',    $nombre,  SQLVARCHAR,     false,  false,   20);
		sqlsrv_bind($stmt, '@calle',    $calle,  SQLVARCHAR,     false,  false,   50);
		sqlsrv_bind($stmt, '@numero',    $numero,  SQLVARCHAR,     false,  false,   5);
		sqlsrv_bind($stmt, '@numeroInt',    $numInt,  SQLVARCHAR,     false,  false,   5);
		sqlsrv_bind($stmt, '@codPost',      $cod_postal,   SQLCHAR,     false,  false,   5);
		sqlsrv_bind($stmt, '@ciudad',     $municipio,         SQLINT4);
		sqlsrv_bind($stmt, '@tel',   $tel, SQLCHAR);
		sqlsrv_bind($stmt, '@usuario',      $usuario,   SQLVARCHAR,     false,  false,   20);
		sqlsrv_bind($stmt, '@correo',      $email,   SQLVARCHAR,     false,  false,   160);
		sqlsrv_bind($stmt, '@contrasena',      $password,   SQLVARCHAR,     false,  false,   64);

		// Ejecutar la sentencia
		sqlsrv_execute($stmt);
		*/

		/*
		// Crea una nueva sentencia
		$stmt = sqlsrv_init('usp_AddClientUser');
		// Vincular valores
		sqlsrv_bind($stmt, '@aPaterno',    $aPaterno,  SQLVARCHAR,     false,  false,   20);
		sqlsrv_bind($stmt, '@aMaterno',    $aMaterno,  SQLVARCHAR,     false,  false,   20);
		sqlsrv_bind($stmt, '@nombre',    $nombre,  SQLVARCHAR,     false,  false,   20);
		sqlsrv_bind($stmt, '@calle',    $calle,  SQLVARCHAR,     false,  false,   50);
		sqlsrv_bind($stmt, '@numero',    $numero,  SQLVARCHAR,     false,  false,   5);
		sqlsrv_bind($stmt, '@numeroInt',    $numInt,  SQLVARCHAR,     false,  false,   5);
		sqlsrv_bind($stmt, '@codPost',      $cod_postal,   SQLCHAR,     false,  false,   5);
		sqlsrv_bind($stmt, '@ciudad',     $municipio,         SQLINT4);
		sqlsrv_bind($stmt, '@tel',   $tel, SQLCHAR);
		sqlsrv_bind($stmt, '@usuario',      $usuario,   SQLVARCHAR,     false,  false,   20);
		sqlsrv_bind($stmt, '@correo',      $email,   SQLVARCHAR,     false,  false,   160);
		sqlsrv_bind($stmt, '@contrasena',      $password,   SQLVARCHAR,     false,  false,   64);

		// Ejecutar la sentencia
		sqlsrv_execute($stmt);
		*/
				echo 'El usuario '.$username." ha sido registrado";
				header("Location: iniciar_sesion.php");
	 ?>
	 <?php
		}//username
		}//password
		}//username
	 }else{//isset
	 formRegistro();
	}
?>