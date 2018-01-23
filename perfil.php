<?php
    
    session_start();
    include("config.php");
    $ID = $_SESSION['user']['id'];
    $query="select * from consulta_info where IDU =".$ID;
    $resultado=sqlsrv_query($conn,$query);
    while($usu=sqlsrv_fetch_array($resultado))
    {
        $EC = $usu['EC'];
        $CN = $usu['CN'];
        $N = $usu['N'];
        $AP = $usu['AP'];
        $AM = $usu['AM'];
        $C = $usu['C'];
        $NU = $usu['NU'];
		$NI = $usu['NI'];
        $CP = $usu['CP'];
        $T = $usu['T'];
		$US = $usu['US'];
        $CO = $usu['CO'];
    }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Raven Clothes</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="http://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
	<script src="JS/script.js"></script>
	<script type="text/javascript" src="bs/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="bs\css\bootstrap.min.css">
    <link rel="stylesheet" href="bs\css\bootstrap-theam.min.css">
	<link rel="icon" href="img\favicon.ico">
</head>
<body>		    
		<!-- NAV BAR -->
		<?php include('include/navBar.php'); ?>
		<!-- END NAV BAR -->
        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">   
             <div class="panel panel-primary">
                <div class="panel-heading"> ¿Que quieres hacer?:</div> 
                <br>
                <center>
                    <a href="perfil.php" id="formA"> Mostrar perfil</a><br>
                    <a href="modificarUsu.php" id="formA"> Modificar perfil</a><br>
                    <a href="logout.php" id="formA">Cerrar Sesion</a>
                </center>
             </div>
        </div>


            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                <div class="panel panel-primary">
                    <div  class="panel-heading"><a href="consultarRopa.php?var=<?php echo $caba; ?>&action=<?php echo ''; ?>" id="heads"> Caballeros.</a></div>
                        <div class="panel-body">

                        <p><?php 
                        echo "<h3>Nombre<h3><p>".$N."</p><h3>Apellido Paterno<h3><p>"
						.$AP."</p><h3>Apellido Materno<h3><p>".$AM."</p><h3>Direccion<h3><p>"
						.$C."</p><h3>Numero<h3><p>".$NU."</p><h3>Numero Interior<h3><p>"
						.$NI."</p><h3>Codigo Postal<h3><p>".$CP."</p><h3>Telefono<h3><p>"
						.$T."</p><h3>Usuario<h3><p>".$US."</p><h3>Correo<h3><p>".$CO."</p>";
                            ?></p>

                        </div>
                </div>
           </div>

	</div>	
	<div class="clearfix"></div>
	<footer id="footer_1">&copy; Derechos reservados a Raven Clothes</footer>
</body>
</html>