<?php 

include('../config/connection.php');

$id = $_GET['id'];

$q = "DELETE FROM ftpuser WHERE id = $id";
$r = mysqli_query($dbc,$q);

if($r) {
	
	echo 'User Deleted';
	
	
} else {
	
	echo 'There was an error ....<br>';
	echo $q.'<br>';
	echo mysqli_error($dbc);
}


?>