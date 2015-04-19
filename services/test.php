<?php
require_once('../database.php');

$db = new Database();

$id = 2;
$sql = "SELECT * FROM parks WHERE ID = :id";
$stmt = $db->handler->prepare($sql);
$stmt->bindParam(':id', $id);

$stmt-> execute();
$result = $stmt->fetch();

echo $result['Name'];
?>