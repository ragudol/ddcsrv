<?php
require_once 'libs/global.inc.php';
require 'libs/func.php';
header('Content-type: application/json');

$page = 1;
$per_page = 20;


$con = mysql_connect($dbhost, $dbuser, $dbpass) or die ("Error en la conexión: " . mysql_error());
mysql_select_db($dbname, $con);

$sql="SELECT IdDO, DenominacionOrigen, Localizacion FROM 2dc_DenominacionesOrigen order by DenominacionOrigen";

if(isset($_GET['page'])){
	$page = $_GET['page'];
	$start = ($page-1)*$per_page;
	$sql.=" limit $start,$per_page";
}

$result = mysql_query($sql) or die ("Query error: " . mysql_error());


$records = array();

while($row = mysql_fetch_assoc($result)) {
	$records[] = convertArrayKeysToUtf8($row);
}

mysql_close($con);

echo $_GET['jsoncallback'] . '(' . json_encode($records) . ');';
?>