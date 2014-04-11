<?php
//Log into database
require 'database.php';
$db = new Database('DEV');

//Result holds all contacts
$result = $db->getAll();
$text = '';

//Loop through contacts and make table
foreach($result as $row=>$col) {
	
	$text .= "<tr><td>$col->CON_first_name $col->CON_surname</td><td>$col->CON_home_phone</td><td>$col->CON_work_phone</td><td>$col->CON_mobile_phone</td><td><a href='/edit.php?id=$col->CON_id'><button>Edit</button></a></td><td><a href='/delete.php?id=$col->CON_id'><button>Delete</button></a></td></tr>";
}

?>

<html>
<head>
	<title>Contacts</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<h1>Contact List</h1> 
<a href='/add.php'><button>Add</button></a>

<table>
	<tr>
		<th>Name</th>
		<th>Home</th>
		<th>Work</th>
		<th>Mobile</th>
		<th></th>
		<th></th>
	</tr>
	<?php echo $text; ?>
</table>