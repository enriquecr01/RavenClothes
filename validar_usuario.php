<?php
	session_start();
	require("config.php");
	function quitar($mensaje){
		$nopermitidos=array("'",'\\','<','>',"\"");
		$mensaje=str_replace($nopermitidos,"",$mensaje);
		return $mensaje;
	}
	//echo "".$_POST["username"];
	echo "".$_POST["password"];
	if(trim($_POST['username'])!=""&& trim($_POST["password"])!=""){
		$usuario=strtolower(htmlentities($_POST['username'], ENT_QUOTES));//Si tiene un caracter en mayuscula lo pone en minuscula
		$pass=$_POST["password"];
		/*$tipo_usuario=["k_tipo_usuario"];*/
		$result=sqlsrv_query($conn,"select id, usuario, contrasena from usuariosCli where usuario='$usuario';");//Verifica si resulta esta cosa
		$result2=sqlsrv_query($conn,"declare @contra nvarchar(64);
									SET @contra = convert(nvarchar(64),hashbytes('sha1', '$pass'),2);
									SELECT @contra as contra;");
		while ($row2=sqlsrv_fetch_array($result2))
			{
				$pass2 = $row2['contra'];
			}
		if($row=sqlsrv_fetch_array($result)){
			if($pass2==$row['contrasena']){
				$iD = $row['id'];
				$usern=$row['usuario'];
				//$_SESSION["k_username"]=$row['usuario'];//Inicia la sesion y le pone un nombre
				header("Location: index.php");
				//echo "Ya chingaste";
				$_SESSION['user']['id'] = $iD;;
				$_SESSION['user']['name'] = $usern;
				//echo "<a href='index.php'>Volver a indice</a>";

			}else{
				echo "Passsword incorrecto ".$pass."".$row["contrasena"];
				echo "<br><br><br><br><br><br><br><br><br><br>".$pass2;
			}
		
		}else{
			echo "Usuario no existe en la base de datos".$usuario;
		}
		//sqlsrv_free_result($result);//Si tiene una consulta la libera
	}else{
		echo "Debe especificar un usuario y password";
	}
	sqlsrv_close($conn);
?>