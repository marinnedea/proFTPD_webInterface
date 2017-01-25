<?php 

include('../config/connection.php');

$id = $_GET['id'];

$q = "DELETE FROM `admins` WHERE id = $id" ;
$r = mysqli_query($dbc, $q);

if($r) {
	
	echo 'User Deleted';
		
} else {
	
	echo 'There was an error:  ';
	echo $q.'<br />';
	echo 'Error was: '. mysqli_error($dbc);
}


?>