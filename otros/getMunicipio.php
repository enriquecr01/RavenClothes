<?php
require ('../config.php');
$id_estado = $_POST['id_estado'];
$queryC = "SELECT id, nombre FROM ciudades WHERE estado = '$id_estado'";
$resultadoC = sqlsrv_query($conn,$queryC);
$html= "<option value='0'>Seleccionar Municipio</option>";
while($rowM = sqlsrv_fetch_array($resultadoC))
{
$html.= "<option value='".$rowM['id']."'>".$rowM['nombre']."</option>";
}
echo $html;
?>