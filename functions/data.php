<?php

function data_admins($dbc, $id) {
	
	if(is_numeric($id)) {
		
		$cond = "id = '$id'";  // Define condition to change the query, looking for ID
				
	} else {
		
		$cond = "email = '$id'";  // Define condition to change the query, looking for email
		
	}
	
	$q = "SELECT * FROM admins WHERE $cond";
	$r = mysqli_query($dbc, $q);

	$data = mysqli_fetch_assoc($r);

	$data['fullname'] = $data['first'].' '.$data['last'];	
	$data['fullname_reverse'] = $data['last'].', '.$data['first'];	
		
	return $data;
	
}


function data_ftpuser($dbc, $id) {

	$q = "SELECT * FROM ftpuser WHERE id = '$id'";
	$r = mysqli_query($dbc,$q);

	$ftpuser = mysqli_fetch_assoc($r);
	return $ftpuser;


}

function data_ftpgroup($dbc, $id) {

	$q = "SELECT * FROM ftpgroup WHERE id = '$id'";
	$r = mysqli_query($dbc,$q);

	$ftpgroup = mysqli_fetch_assoc($r);
	return $ftpgroup;


}

function data_ftpquota($dbc, $id) {

	$q = "SELECT * FROM ftpquotalimits WHERE id = '$id'";
	$r = mysqli_query($dbc,$q);

	$ftpquota = mysqli_fetch_assoc($r);
	return $ftpquota;


}


?>
