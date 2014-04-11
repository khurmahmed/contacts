<?php
require 'database.php';

$db = new Database('DEV');

$cc = '';
if(isset($_POST['country'])) $cc = $_POST['country'];

//Script holds php code for both add and edit
include('script.php');

//Once post is escaped and validated then insert
function postAccepted($info, $count, $db) {
	
	$i = 0;
	$values = '';
	foreach($info as $item) {
		$val = $_POST["$item"];
		if(++$i === $count) {
			$values .= "'$val'";
		} else {
			$values .= "'$val', ";
		}
	}
	if($db->insert($values)) header('Location: /');
	else echo "Could not insert!";
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
	<h1>Add Contact</h1>
	<a href='/'><button>Back</button></a>
	<form name="input" action="/add.php" method="post" id='form'>
		First Name <input type="text" name="firstname" value="<?php if(isset($_POST['firstname'])) echo $_POST['firstname']; ?>" />
		Surname <input type="text" name="surname" value="<?php if(isset($_POST['surname'])) echo $_POST['surname']; ?>" />
		Email <input type="text" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" />
		Home Phone <input type="text" name="home" value="<?php if(isset($_POST['home'])) echo $_POST['home']; ?>" />
		Mobile Phone <input type="text" name="mobile" value="<?php if(isset($_POST['mobile'])) echo $_POST['mobile']; ?>" />
		Work Phone <input type="text" name="work" value="<?php if(isset($_POST['work'])) echo $_POST['work']; ?>" />
		Address 
		<input type="text" name="address_1" value="<?php if(isset($_POST['address_1'])) echo $_POST['address_1']; ?>" />
		<input type="text" name="address_2" value="<?php if(isset($_POST['address_2'])) echo $_POST['address_2']; ?>" />
		<input type="text" name="address_3" value="<?php if(isset($_POST['address_3'])) echo $_POST['address_3']; ?>" />
		<input type="text" name="address_4" value="<?php if(isset($_POST['address_4'])) echo $_POST['address_4']; ?>" />
		Postcode <input type="text" name="postcode" value="<?php if(isset($_POST['postcode'])) echo $_POST['postcode']; ?>" />
		Country 
		<select name='country'><?php echo $select; ?></select>
		<textarea name='notes'></textarea>
		<input type="submit" value="Submit">
	</form>
</body>
</html>