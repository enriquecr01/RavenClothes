<?php
	include("config.php");
	session_start();
	$query = "select s.nombre as N, s.direccion as D, c.nombre as CN, e.nombre as E 
				from sucursales s
				inner join ciudades c on s.ciudad = c.id
				inner join estados e on e.clave = c.estado";
	$resultS = sqlsrv_query($conn,$query);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Raven Clothes | Stores</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="http://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
	<script src="JS/script.js"></script>
	<script type="text/javascript" src="bs/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="bs\css\bootstrap.min.css">
    <link rel="stylesheet" href="bs\css\bootstrap-theam.min.css">
	<link rel="icon" href="img\favicon.ico">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
		<header id="header">			    
			<!-- NAV BAR -->
			<?php include('include/navBar.php'); ?>
			<!-- END NAV BAR -->
		</header>           	

		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="panel panel-primary">
		<table  align="center" style="width:100%;">
		<div class="panel-heading"> Informacion del producto: </div> 
  			<tr>
    		<th>Sucursal</th>
    		<th>Direccion</th>
    		<th>Ciudad</th>
    		<th>Estado</th>
  			</tr>
            <?php  
            while($sucursales=sqlsrv_fetch_array($resultS))
            {
	            $nombre = $sucursales['N'];
	            $direccion = $sucursales['D'];
	            $nombreCiudad = $sucursales['CN'];
	            $estado = $sucursales['E'];
	            echo "<tr>";
	            echo "<td>$nombre</td>";
	            echo "<td>$direccion</td>";
	            echo "<td>$nombreCiudad</td>";
	            echo "<td>$estado</td>";
	            echo "</tr>";
                                
            ?>
            <?php
            } /*While*/?>

		</table>
		</div>
		</div>

	<div class="clearfix"></div>
	<footer id="footer_1">&copy; Derechos reservados a Raven Clothes</footer>

</body>
</html>