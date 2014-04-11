<?php
require 'database.php';

if(!isset($_GET['id'])) header('Location: /');
$id = $_GET['id'];


$db = new Database('DEV');
$contact = $db->getById($id);

if($contact) {
	$db->delete($id);
}
header('Location: /');
?>