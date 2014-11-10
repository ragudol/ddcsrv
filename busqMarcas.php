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

$sql="select * from VMarcas where 1 ";
if(isset($_GET['n'])){
	$sql .= sprintf(" and Nombre like '%%%s%%'", addcslashes(mysql_real_escape_string($_GET['n']),'%_'));
	}
	
if(isset($_GET['t'])){
	$sql .= sprintf(" and Tipo = %s", addcslashes(mysql_real_escape_string($_GET['t']),'%_'));
}

if(isset($_GET['d'])){
	$sql .= sprintf(" and TipoDesc like '%%%s%%'", addcslashes(mysql_real_escape_string($_GET['d']),'%_'));
}

if(isset($_GET['pmin'])){
	$sql .= sprintf(" and Precio >= '%s'", addcslashes(mysql_real_escape_string($_GET['pmin']),'%_'));
}

if(isset($_GET['pmax'])){
	$sql .= sprintf(" and Precio <= '%s'", addcslashes(mysql_real_escape_string($_GET['pmax']),'%_'));
}

if(isset($_GET['vmin'])){
	$sql .= sprintf(" and Puntuacion >= %s", addcslashes(mysql_real_escape_string($_GET['vmin']),'%_'));
}

if(isset($_GET['vmax'])){
	$sql .= sprintf(" and Puntuacion <= %s", addcslashes(mysql_real_escape_string($_GET['vmax']),'%_'));
}

/*
if(isset($_GET['c'])){
	$sql .= sprintf(" and CodigoBarras = '%s'", addcslashes(mysql_real_escape_string($_GET['c']),'%_'));
}
*/


if(isset($_GET['b'])){
	$sql .= sprintf(" and IdBodega = %s", addcslashes(mysql_real_escape_string($_GET['b']),'%_'));
}


if(isset($_GET['o'])){
	$sql .= sprintf(" and IdDO = %s", addcslashes(mysql_real_escape_string($_GET['o']),'%_'));
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