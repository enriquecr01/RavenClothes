<?php  //Iniciamos o continuamos sesión  
	session_start(); 
	$titulo = "Carrito de Compra con Php y Mysql";  
	include("config.php");
			$usuario = $_SESSION['user']['name'];
		$queryCorreo = "select usuario from usuariosCli where usuario = '$usuario'";
		$resultadoCorreo = sqlsrv_query($conn, $queryCorreo);
		$resultadoCorreofetch = sqlsrv_fetch_array($resultadoCorreo);
		@$correo = $resultadoCorreofetch['correo'];

	function recuperar_productos(){   


		$contador = 0;   //recorremos el array de SESION hasta el final   
		include("config.php");

		foreach($_SESSION['carro'] as $id => $x){     
			$contador++; //Número de item que después usaremos en el atribute name de los inputs    
			$resultado = sqlsrv_query($conn,"SELECT p.id as ID, p.nombre as N, p.precioUnitario as pU, pc.talla as T , pc.color as C
											FROM productos p
											inner join prod_col pc on p.id = pc.producto
											WHERE p.id= $id");    
			$mifila = sqlsrv_fetch_array($resultado);
			$id = $mifila['ID'];    
			$producto = $mifila['N'];    //acortamos el nombre del producto a 40 caracteres    
			$producto = substr($producto,0,40);    
			$precio = $mifila['pU']; 

?>
 <input name="item_number_<?php echo $contador; ?>" type="hidden" value="<?php echo $id; ?>">    
 <input name="item_name_<?php echo $contador; ?>" type="hidden" value="<?php echo $producto; ?>">     
 <input name="amount_<?php echo $contador; ?>" type="hidden" value="<?php echo $precio; ?>">     
 <input name="quantity_<?php echo $contador; ?>" type="hidden" value="<?php echo $x; ?>">
 <?php  
 	 }  
 	 	}  
 ?>  
 
 <div id="derecha">
 <h1>Conectando con Paypal, espere un momento <?php echo $usuario; ?> ...... </h1>     
 <div class='text-border'>

 <form name='formTpv' action='https://www.sandbox.paypal.com/cgi-bin/webscr' method='post' style="border: 1px solid #CECECE;padding-left: 10px;">      
 <input name="cmd" type="hidden" value="_cart">       
 <input name="upload" type="hidden" value="1">      
 <input name="business" type="hidden" value="eric.jrz@gmail.com">      
 <input name="shopping_url" type="hidden" value="http://localhost/varios/paypal/carro/productos.php">      
 <input name="currency_code" type="hidden" value="MXN">      
 <input name="return" type="hidden" value="http://localhost:8080/RavenClothes/exito.php">      
 <input type='hidden' name='cancel_return' value='http://localhost:8080/RavenClothes/carro.php?id=0&action="mostrar"'>     
  <input name="notify_url" type="hidden" value="http://localhost/varios/paypal/carro/paypalipn.php">      
 <input name="rm" type="hidden" value="2">
 <?php
 	recuperar_productos();
 ?>
 </form>    <!-- Esto hará que se envie la información sin necesidad de hacer clic en ningún botón -->    <!-- Si lo quitamos, el usuario tendrá que hacer clic para realizar la compra -->    
 <script type='text/javascript'>     
 document.formTpv.submit();    
 </script>   
 </div> <!-- Cierro text-border --> 
  </div> <!-- Cierro derecha --> 