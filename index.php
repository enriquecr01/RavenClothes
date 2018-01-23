<?php
    
    $caba = " where genero = 'H' ";
    $dama = " where genero = 'M' ";
    include("config.php");
    session_start();

    $queryC = "select distinct id
                from productos ".$caba ;
    $queryD = "select distinct id
                from productos ".$dama;
    $resultC = sqlsrv_query($conn,$queryC);
    $resultD = sqlsrv_query($conn,$queryD);
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
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
		<!-- NAV BAR -->
		<?php include('include/navBar.php'); ?>
		<!-- END NAV BAR -->
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <center>
            
            	<div class="panel panel-info">
                    <div class="panel-body">
                        <div id="indexCarrousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="item active">
                                    <a href="img/caballeros3.png"><img src="img/caballeros3.png" height="720" alt="Ropa de caballeros"></a>
                                    <div class="carousel-caption">Ropa de caballeros</div>
                                </div>
                                    <div class="item">
                                        <a href="img/damas3.png"><img src="img/damas3.png" height="720" alt="Ropa de dama"></a>
                                        <div class="carousel-caption">Ropa de dama</div>
                                    </div>
                                    <div class="item">
                                        <a href="img/ninos3.png"><img src="img/ninos3.png" height="720" alt="Ropa de niños con descuento"></a>
                                        <div class="carousel-caption">Ropa de ninios con descuento</div>
                                    </div>
                            </div>
                            <a class="left carousel-control" href="#indexCarrousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                            <a class="right carousel-control" href="#indexCarrousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
                        </div>
                        
                    </div>
                </div>
            </center>
        </div> 

        <!--Caballeros panel-->
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="panel panel-primary">
                    <div  class="panel-heading"><a href="consultarRopa.php?var=<?php echo $caba; ?>&action=<?php echo ''; ?>" id="heads"> Caballeros.</a></div>
                        <div class="panel-body">
                            <?php  
                            while($caballero=sqlsrv_fetch_array($resultC))
                            {
                                $iDC = $caballero['id'];
                                $queryImagenCaba = "select top 1 imagen as Ima
                                                    from imagenes 
                                                    where producto = ".$iDC;
                                $resultImaC = sqlsrv_query($conn,$queryImagenCaba);

                                //$name = $caballero['N'];
                                $imageen = sqlsrv_fetch_array($resultImaC);
                                $byteArray = $imageen['Ima'];
                                $imgData= base64_encode($byteArray);
                                $img = "<a href='producto.php?id=".$iDC."'><img src='data:image/jpeg;base64, ".$imgData."' width='170' height='200'></a>";
                                print($img);
                                
                                ?>
                            <?php
                            } /*While*/?>
                                
                        </div>
                </div>
           </div>

           <!--Damas panel-->
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="panel panel-primary">
                    <div  class="panel-heading"><a href="consultarRopa.php?var=<?php echo $dama; ?>&action=<?php echo ''; ?>" id="heads"> Damas.</a></div>
                        <div class="panel-body">
                            <?php  
                            while($damas=sqlsrv_fetch_array($resultD))
                            {
                                $iDC = $damas['id'];
                                $queryImagenDama = "select top 1 imagen as Ima
                                                    from imagenes 
                                                    where producto = ".$iDC;
                                $resultImaD = sqlsrv_query($conn,$queryImagenDama);

                                //$name = $caballero['N'];
                                $imageen = sqlsrv_fetch_array($resultImaD);
                                $byteArray = $imageen['Ima'];
                                $imgData= base64_encode($byteArray);
                                $img = "<a href='producto.php?id=".$iDC."'><img src='data:image/jpeg;base64, ".$imgData."' width='170' height='200'></a>";
                                print($img);
                                
                                ?>
                            <?php
                            } /*While*/?>
                                
                        </div>
                </div>
        </div>
	</div>	
	<div class="clearfix"></div>
	<footer id="footer_1">&copy; Derechos reservados a Raven Clothes <?php echo date("Y")?></footer>
</body>
</html>