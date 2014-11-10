<?php
require_once 'libs/global.inc.php';
require 'libs/func.php';
header('Content-type: application/json');

$page = 1;
$per_page = 20;
if(isset($_GET['page']))
    $page = $_GET['page'];
$start = ($page-1)*$per_page;


$con = mysql_connect($dbhost, $dbuser, $dbpass) or die ("Error en la conexión: " . mysql_error());
mysql_select_db($dbname, $con);

if(isset($_GET['q'])){
	$filtrado = addcslashes(mysql_real_escape_string($_GET['q']),'%_');
	$sql .= sprintf("select * from Busquedas WHERE Nombre like '%%%s%%' or CodigoBarras like '%s%%'", $filtrado, $filtrado);	
}

else if(isset($_GET['b'])){
	$sql .= sprintf("select * from BusquedasBC WHERE CodigoBarras = '%s'", addcslashes(mysql_real_escape_string($_GET['b']),'%_'));
	//$sql.=" where Nombre LIKE '%"+mysql_real_escape_string($_GET[q])+"%'";
	}
	
	
$sql.=" limit $start,$per_page";

$result = mysql_query($sql) or die ("Query error: " . mysql_error());

$records = array();

while($row = mysql_fetch_assoc($result)) {
	$records[] = convertArrayKeysToUtf8($row);
}



mysql_close($con);

echo $_GET['jsoncallback'] . '(' . json_encode($records) . ');';
?>