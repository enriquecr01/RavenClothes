<?php
	require("config.php");
	session_start();
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

	$ID = $_SESSION['user']['id'];
    $query="select c.apPaterno as AP, c.apMaterno as AM, c.nombre as N, c.calle as C, c.numero as NU, c.numeroInt as NI,
            c.codigoPostal as CP, c.ciudad CI, c.telefono T, uc.correo as CO, uc.contrasena as CON, 
            ci.estado as ES, c.id as CLID
            from clientes c
            inner join usuariosCli uc on uc.cliente = c.id
            inner join ciudades ci on ci.id = c.ciudad
            where uc.id =".$ID;
    $resultado=sqlsrv_query($conn,$query);
    $UUSER= $_SESSION['user']['name'];
    while($usu=sqlsrv_fetch_array($resultado))
    {
        $AP = $usu['AP'];
        $AM = $usu['AM'];
        $N = $usu['N'];
        $C = $usu['C'];
        $NU = $usu['NU'];
        $NI = $usu['NI'];
        $CP = $usu['CP'];
        $CI = $usu['CI'];
        $T = $usu['T'];
        $CO = $usu['CO'];
        $CON = $usu['CON'];
        $ES = $usu['ES'];
        $CLID = $usu['CLID'];
    }

	$queryE = "SELECT clave, nombre FROM estados order by nombre ASC";
	$resultadoE = sqlsrv_query($conn,$queryE);
	$queryM = "SELECT id, nombre FROM ciudades where estado = '$ES' ORDER BY nombre";
	$resultadoM = sqlsrv_query($conn,$queryM);

?>


		<center>
		
			<div class="panel panel-primary" id="registro">
				<div  class="panel-heading">Registro.</div>
				<div class="panel-body">
					<?php if(isset($_POST['send'])): require('imprimir.php');?>
							<script>window.alert('La modificacion a sido existosa!!'); </script>
					<?php endif;?>
					<form action="" method="post">
						Usuario: 
						<br> 
						<input type="text" name="username" value="<?php echo $UUSER; ?>" disabled ><br>
						Apellido Paterno:
						<br>
						<input type="text" name="aPaterno" placeholder="Apellido Paterno" value = "<?php echo $AP; ?>"><br>
						Apellido Materno:
						<br>
						<input type="text" name="aMaterno" placeholder="Apellido Materno" value = "<?php echo $AM; ?>"><br>
						Nombre:
						<br>
						<input type="text" name="nombre" placeholder="Nombre" value = "<?php echo $N; ?>"><br>
						Calle:
						<br>
						<input type="text" name="calle" placeholder="Calle" value = "<?php echo $C; ?>"><br>
						Numero:
						<br>
						<input type="text" name="num" placeholder="Numero" value = "<?php echo $NU; ?>"><br>
						Numero Interior:
						<br>
						<input type="text" name="numInt" placeholder="Numero Interior" value = "<?php echo $NI; ?>"><br>
						Selecciona Estado : 
						<br>
						<select name="cbx_estado" id="cbx_estado">
						<option value="0">Seleccionar Estado</option>
						<?php while($rowE = sqlsrv_fetch_array($resultadoE)) { ?>
						<option value="<?php echo $rowE['clave']; ?>" <?php if($rowE['clave']==$ES) { echo 'selected'; } ?>><?php echo $rowE['nombre']; ?></option>
						<?php } ?>
						</select>
						<br>
						Ciudad:
						<br>
						<select name="cbx_municipio" id="cbx_municipio">
							<?php while($rowM = sqlsrv_fetch_array($resultadoM)) { ?>
							<option value="<?php echo $rowM['id']; ?>" <?php if($rowM['id']==$CI) { echo 'selected'; } ?>><?php echo $rowM['nombre']; ?></option><?php } ?>
						</select><br>
						Telefono:
						<br>
						<input type="text" name="tel" placeholder="Telefono" value = "<?php echo $T; ?>"><br>
						E-mail: 
						<br>
						<input type="email" name="email" placeholder="E-mail" value = "<?php echo $CO; ?>"><br>
						Vieja Contrase&ntilde;a: 
						<br> 
						<input type="password" name="password" placeholder="Contraseña"><br>
						Nueva Contrase&ntilde;a:
						<br>
						<input type="password" name="password2" placeholder="Confirmar Contraseña"><br>
						Codigo Postal:
						<br>
						<input type="text" name="cod_postal" placeholder="Codigo Postal" value = "<?php echo $CP; ?>"><br>
						<input type="submit" value="Enviar" Name = "send"><br>
						<?php echo $CLID; echo $UUSER;?>    
					</form>
	            </div>	
			</div>			
		</center>
		<div class="push"></div>
	<div class="clearfix"></div>
	<footer id="footer_1">&copy; Derechos reservados a Raven Clothes <?php echo date("Y")?></footer>
	</body>
	</html>