<?php
require_once 'libs/global.inc.php';
require 'libs/func.php';
header('Content-type: application/json');



$con = mysql_connect($dbhost, $dbuser, $dbpass) or die ("Error en la conexión: " . mysql_error());
mysql_select_db($dbname, $con);

$sql="select distinct(Tipo) from 2dc_TiposVino where Tipo is not null order by Tipo";

$result = mysql_query($sql) or die ("Query error: " . mysql_error());

$records = array();

while($row = mysql_fetch_assoc($result)) {
	$records[] = convertArrayKeysToUtf8($row);
}

mysql_close($con);

echo $_GET['jsoncallback'] . '(' . json_encode($records) . ');';
?>