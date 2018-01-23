<?php
session_start();
$titulo="Carrito de compras x";
include("estructura/config.php");

?>
<h1>Detalle de productos</h1>
<?php
echo "<table style=border:1px solid #333333>
	<tr>
		<th>ID</th>
		<th>Producto</th>
		<th>Precio</th>
		<th>Acción</th>
	</tr>";
	$resultado=mysql_query("select id,producto,precio from productos");
	while($productos=mysql_fetch_array($resultado)){
		echo"<tr>";
			echo"<td>".$productos['id']."</td>";
			echo"<td>".$productos['producto']."</td>";
			echo"<td>".$productos['precio']."</td>";
			echo"<td><a href='carro.php?id=".$productos['id']."&action=";
			/*Detectamos si el producto se ha añadido al carrito*/
			/*Se utilizara una imagen u otro dependiendo si se ha agregado*/
			if(isset($_SESSION['carro'][$productos['id']])){
				echo"removeProd' alt='Eliminar del carro'><img src='img/removeCar.png'
				alt='Eliminar del carro' title='Eliminar producto del carrito' width=48>";
			} /*if*/ else{
				echo"add' alt='Añadir al carro'><img src='img/addCar.png'
				alt='Añadir al carrito' title='Añadir productos' width=48>";
			} /*else*/ echo"</a></td></tr>";
	} /*While*/
echo "</table>";
?>
<a href = 'logout.php'>Salir</a>

<!-- 
	
 -->