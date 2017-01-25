<?php 

include('../config/connection.php');

$id = $_GET['id'];

$q1 = "DELETE FROM ftpquotalimits WHERE name = '".$id."'";
$r1 = mysqli_query($dbc,$q1);
if($r1){
	
	echo 'Quota deleted<br />';
	
	
} else {
	
	echo 'There was an error deleting quota.<br />';
	echo $q1.'<br />';
	echo mysqli_error($dbc);
}

$q2 = "DELETE FROM ftpquotatallies WHERE name = '".$id."'";
$r2 = mysqli_query($dbc,$q2);
if($r2){
	
	echo 'Quota tallies deleted<br />';
	
} else {
	
	echo 'There was an error deleting quota tallies.<br />';
	echo $q2.'<br />';
	echo mysqli_error($dbc);
}

$q3 = "DELETE FROM ftpgroup WHERE groupname = '".$id."'";
$r3 = mysqli_query($dbc,$q3);

if($r3){
	
	echo 'Group Deleted<br />';
		
} else {
	
	echo 'There was an error.<br />';
	echo $q3.'<br />';
	echo mysqli_error($dbc);
}


?>