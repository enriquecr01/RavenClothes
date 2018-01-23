<?php
	$serverName = "integradora1.database.windows.net"; //Nombre del server
	$connectionInfo = array( "Database"=>"integradora1", "UID"=>"ejuarez", "PWD"=>"e@Utt_3742!"); //Si tienen la autenticacion de Windows no le ponen UID ni PWD
																							///el tratara de conectarse por si mismo
														//, "UID"=>"proyect", "PWD"=>"utt2017!"
	$conn = sqlsrv_connect( $serverName, $connectionInfo);
		    $caba = " where genero = 'H' ";
    $dama = " where genero = 'M' ";
?>