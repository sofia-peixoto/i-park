<?php

require('../global.php');
require('../Entities/park.php');

try {
 
    $handler = new PDO("mysql:host=$serverName;dbname=$serverDB", $serverUser, $serverPass);
    $handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(PDOException $e)
{
	echo "Connection failed: " . $e->getMessage();
}

$sql = "SELECT * FROM parks";
$query = $handler->query($sql, PDO::FETCH_CLASS, 'Park');

$parks = Array();

echo "<pre>";

while($park = $query->fetch()) {
	$parks[] = $park;
}

print_r($parks);
//foreach( as $row) {
//	echo $row['ID'];
//}

$handler = null;

?>