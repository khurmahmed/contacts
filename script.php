<?php	

//If is post
if($_POST) {
	$information = 'firstname surname email home mobile work address_1 address_2 address_3 address_4 postcode country notes';
	$info = explode(' ', $information);
	$error = 0;
	//Loop through info and check if exists and is not empty 
	foreach($info as $item) {
		if(!isset($_POST["$item"]) || empty($_POST["$item"])) $error = 1;
	}
	
	//Validate $_POST this needs to be extended. Things like phone number need to be checked for length and isNumerical. Email => email. etc.
	if(!$error) {
		$error = validate();
	}
	
	//Escape $_POST
	if(!$error) {
		$count = count($info);
		
		foreach($info as $item) {
			$_POST["$item"] = mysqli_real_escape_string($db->db, $_POST["$item"]);
		}
		postAccepted($info, $count, $db);
		
	}
	
}

//Validate $_POST this needs to be extended. Things like phone number need to be checked for length and isNumerical. Email => email. etc.
function validate() {
	
	foreach($_POST as $name=>$item) {
		if($name !== 'country' && strlen($item) < 3) return 1;
	}
}

$result = $db->getCountries();

//Loop through countries for select box.
$select = '';
foreach($result as $item) {
	$selected = '';
	if($item->COU_country_code == $cc) $selected = 'selected="selected"';
	$select .= "<option $selected value='$item->COU_country_code'>$item->COU_name</option>";
}	
	
?>