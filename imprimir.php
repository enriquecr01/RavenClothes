<?php
$ID = $_SESSION['user']['id'];
$username = $_SESSION['user']['name'];
require("config.php");
	
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
	 	$tel = $_POST['tel'];
	 	$email=$_POST['email'];
	 	$cod_postal=$_POST['cod_postal'];
	 	$password = $_POST['password'];
	 	$password2 = $_POST['password2'];
	 //Hay campos en blando?
		if($password2!=NULL & $password!=NULL)
		{
				$resultPassOld=sqlsrv_query($conn,"declare @contra nvarchar(64);
									SET @contra = convert(nvarchar(64),hashbytes('sha1', '$password'),2);
									SELECT @contra as contraOld;");
				$resultPassNew=sqlsrv_query($conn,"declare @contra nvarchar(64);
									SET @contra = convert(nvarchar(64),hashbytes('sha1', '$password2'),2);
									SELECT @contra as contraNew;");
			while($passOld=sqlsrv_fetch_array($resultPassOld))
	    	{
		        $oldPass = $passOld['contraOld'];
		        //echo $oldPass;
		    }//while

	   		while($passNew=sqlsrv_fetch_array($resultPassNew))
	    	{
		        $newPass = $passNew['contraNew'];
		        //echo $newPass;
		    }//while

		    if($CON == $oldPass)
		    {
		    	$updateContra = "update usuariosCli
								set contrasena = '$newPass'
								where usuario = '$UUSER';";
				echo $CON." = ". $oldPass;
				sqlsrv_query($conn,$updateContra);
		    }//if
		    else
			{
				//header("Location: modificarUsu.php");
				echo"<p id='error'>Las contraseña antigua no coincide</p>";
				
			}



		}/*if*/


	if($nombre==NULL|$municipio==NULL|$tel==NULL|$cod_postal==NULL|$calle==NULL|$aPaterno==NULL|$aMaterno==NULL){
		echo"<p id='error'>Hay un campo vacio</p>";
		//header("Location: modificarUsu.php");
	}else
	{
	 
		$check_email=sqlsrv_query($conn,"SELECT usuario from usuariosCli where correo='$email'");
		$email_exist=sqlsrv_num_rows($check_email);
		if($email_exist>0){
		//header("Location: modificarUsu.php");
		echo"<p id='error'>El nombre de usuario o email esta en uso </p>";
		
		}else{

		
		$queryU="update clientes
				set apPaterno = '$aPaterno', apMaterno = '$aMaterno', nombre = '$nombre', calle = '$calle', numero = '$numero', numeroInt = '$numInt',	codigoPostal = '$cod_postal', ciudad = $municipio, telefono = '$tel'
				where id = $CLID;

				update usuariosCli
				set correo = '$email'
				where usuario = '$UUSER';";
		sqlsrv_query($conn,$queryU);
		echo 'El usuario '.$username." ha sido modificado";
		//header("Location: perfil.php");

		}//password

	}
?>