<?php
require 'database.php';
//If no id then redirect
if(!isset($_GET['id'])) header('Location: /');
$id = $_GET['id'];

//Get contact by id
$db = new Database('DEV');
$contact = $db->getById($id);
//If contact doesnt exists redirect
if(!$contact) header('Location: /');
$cc = $contact->CON_country_code;

//Script holds php code for both add and edit
include('script.php');

//Once post is escaped and validated then update
function postAccepted($info, $count, $db) {
	
	if($db->update($_GET['id'])) header('Location: /');
	else echo "Could not update!";
}
?>

<html>
<head>
	<title>Contacts</title>
	<link rel="stylesheet" href="css/style.css">
	<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
</head>

<body>
	<div>
	<h1>Edit Contact</h1>
	<a href='/'><button>Back</button></a>
	
	<form name="input" action="/edit.php?id=<?php echo $id; ?>" method="post" id='form'>
		First Name <input type="text" name="firstname" value="<?php echo (isset($_POST['firstname'])?$_POST['firstname']:$contact->CON_first_name); ?>" />
		Surname <input type="text" name="surname" value="<?php echo (isset($_POST['surname'])?$_POST['surname']:$contact->CON_surname); ?>" />
		Email <input type="text" name="email" value="<?php echo (isset($_POST['email'])?$_POST['email']:$contact->CON_email); ?>" />
		Home Phone <input type="text" name="home" value="<?php echo (isset($_POST['home'])?$_POST['home']:$contact->CON_home_phone); ?>" />
		Mobile Phone <input type="text" name="mobile" value="<?php echo (isset($_POST['mobile'])?$_POST['mobile']:$contact->CON_mobile_phone); ?>" />
		Work Phone <input type="text" name="work" value="<?php echo (isset($_POST['work'])?$_POST['work']:$contact->CON_work_phone); ?>" />
		Address 
		<input type="text" name="address_1" value="<?php echo (isset($_POST['address_1'])?$_POST['address_1']:$contact->CON_address_1); ?>" />
		<input type="text" name="address_2" value="<?php echo (isset($_POST['address_2'])?$_POST['address_2']:$contact->CON_address_2); ?>" />
		<input type="text" name="address_3" value="<?php echo (isset($_POST['address_3'])?$_POST['address_3']:$contact->CON_address_3); ?>" />
		<input type="text" name="address_4" value="<?php echo (isset($_POST['address_4'])?$_POST['address_4']:$contact->CON_address_4); ?>" />
		Postcode <input type="text" name="postcode" value="<?php echo (isset($_POST['postcode'])?$_POST['postcode']:$contact->CON_postal_code); ?>" />
		Country 
		<select name='country'><?php echo $select; ?></select>
		Notes<textarea name='notes'><?php echo (isset($_POST['notes'])?$_POST['notes']:$contact->notes); ?></textarea>
		<input type="submit" value="Submit">
	</form>
	<div>
</body>
</html>