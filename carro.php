<?php
	session_start();
	include("config.php");
	//$id=($_POST['id']);

	/*
	// Si no se ha establecido la variable, o su valor es nulo:
	if (!isset($_SESSION['contador']) || $_SESSION['contador'] === null) 
	{
    	$_SESSION['contador'] = -1;
	}

	if ($_SESSION['contador'] == -1) 
	{
    	$_SESSION['contador']++;
    	$tallas[] = array();
	} 
	else 
	{
    	$_SESSION['contador']++;
	}

	if(isset($id))
		@$id2=($_GET['id']);
	else
		
	

	
	//echo $action1;
	$contador1 = $_SESSION['contador'];
	
	if ($_SESSION['contador'] >= 0) 
	{
		$tallas = $talla;
	}

	print_r($tallas);
	echo $contador1;
	*/
	@$id=($_GET['id']);
	$caba = " where p.genero = 'H' ";
	@$action1=($_POST['action']);
	@$talla= $_POST['cbTalla'];
	@$color = $_POST['cbColor'];
	//echo $id;
	@$_SESSION['carro1'][$id] = $id;
	//@$_SESSION['carro'][$talla] = $talla;
	//@$_SESSION['carro'][$color] = $color;

?>
<!DOCTYPE html>
<html>
<head>
	<?php 
	if (isset($_SESSION['user']['id']))
	{
		echo "<title>Carrito de ".$_SESSION['user']['name']."</title>";
	}
	else
	{
		echo "<title>Carrito de nadie</title>";
	}
	?>
	<title>Carrito de <?php echo $_SESSION['user']['name']; ?></title>
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
<?php if (isset($_SESSION['user']['id'])) 
{ ?>
	<h1>Carrito de compras</h1>
<?php
include("config.php");
	if(isset($id))
	{
		$id=$id;
	}
	else
		$id=1;
	
	if(isset($_GET['action']))
		$action = $_GET['action'];
	else
		$action = "empty";
	
	switch($action){
		case "add":
			if(isset($_SESSION['carro'][$id]))
			{
				$_SESSION['carro'][$id]++;
				echo $_SESSION['carro'][$id];

			}
			else
			{
				$_SESSION['carro'][$id]=1;
				echo $_SESSION['carro'][$id];
			}
		break;
		
		case "remove":
			if(isset($_SESSION['carro'][$id])){
				$_SESSION['carro'][$id]--;
					if($_SESSION['carro'][$id]==0)
						unset($_SESSION['carro'][$id]);
					
			}
		break;
		
		case "removeProd":
			if(isset($_SESSION['carro'][$id])){
				unset($_SESSION['carro'][$id]);
				unset($_SESSION['carro1'][$id]);
			}
		break;
		
		case "mostrar":
			if(isset($_SESSION['carro'][$id]))
				continue;
		break;
		
		case "empty":
		{
			unset($_SESSION['carro']);
			unset($_SESSION['carro1']);
		}
		break;
	}
	if(isset($_SESSION['carro'])){
		echo "<table align='center' style='width:90%;'>";
		$costoTotal=0;
		$xTotal=0;
		?>
		<tr>
		<th>Imagen</th>
		<th>Producto</th>
		<th>Cantidad</th>
		<th colspan=3>Accion</th>
		<th>Total</th>
		</tr>
		<tr><td colspan=6></td></tr>
<?php
	
	foreach($_SESSION['carro'] as $id=>$x){
		$query = "	SELECT p.id as ID, p.nombre as N, p.precioUnitario as PU, i.imagen as Ima
					FROM productos p 
					inner join imagenes i on i.producto = p.id 
					where p.id = ".$id;
		$resultado = sqlsrv_query($conn,$query);
		$mifamilia=sqlsrv_fetch_array($resultado);
		$id1=$mifamilia['ID'];
		$producto = $mifamilia['N'];
		$producto=substr($producto,0,40);//Solo agarra los primeros caracteres
		$precio = $mifamilia['PU'];
		$costo=$precio*$x;
		$costoTotal = $costoTotal + $costo;
		$xTotal = $xTotal + $x;
		$byteArray = $mifamilia['Ima'];
        $imgData= base64_encode($byteArray);
        $img = "<img src='data:image/jpeg;base64, $imgData' width='40' height='50'>";
        

 ?>
		<tr>
		<?php
		echo "<td>".$img."</td>";
		echo"<td>$producto</td>";
		echo "<td>$x</td>";
		?>
		<td>
		<?php 

		echo "<a href ='carro.php?id=".$id."&action=add'> 
			  <img src='img/plus.png' width=40></a>";
		
		echo "<a href ='carro.php?id=".$id."&action=remove'> 
			  <img src='img/minus.png' width=40></a>";
			  
		echo "<a href ='carro.php?id=".$id."&action=removeProd'> 
			  <img src='img/trash.png' width=40></a>";

		?>
		</td>
		<td align='right'>=</td>
		<?php echo"<td align='right'>$ $costo</td>"; ?>
		</tr>
	
<?php
		}
	
	?>

	<tr><td colspan=5><hr><br>Total = </td>
	<?php echo "<td><b><br> $ $costoTotal</b></td>";?>
	<td colspan=5><a href='Compra.php'><input type='button' value = 'Comprar'></input></a></td>
	</tr>
	</table>
	
<?php
	}else
		echo "El carro esta vacio";
	@$_SESSION["costoTotal"]=$costoTotal;
	@$_SESSION["cantidadTotal"]=$xTotal;
	?>
	<p>Volver a la <a href="consultarRopa.php?var=<?php echo $caba; ?>&action=<?php echo ''; ?>" title='Lista'>lista</a></p>
</body>
</html>
<?php 
} 
else
{
	echo "<p>Aun no estas registrado, por eso no tienes carrito <a href = 'registro.php'>registrate</a></p>";
}
?>


	

  
