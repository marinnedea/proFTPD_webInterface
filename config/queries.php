<?php 

	switch ($page) {   // Start a switch

		// Dashboard Manager
		case 'dashboard':

			break;


		// Admins Manager

		case 'admins':

			if(isset($_POST['submitted']) == 1) {

				$first = mysqli_real_escape_string($dbc, $_POST['first']);
				$last = mysqli_real_escape_string($dbc, $_POST['last']);

				if($_POST['password'] != '') {

					if($_POST['password'] == $_POST['passwordv']) {  	// Compare password with passwordv

						$verify = true;
						$password = "password = SHA1('$_POST[password]'),";		// Set the variable to use in the query

					}

					else { $verify = false; }		// If password != passwordv ==> set $verify to false

				} else { $verify = false; }			// If password is empty ==> set $verify to false

				if(isset($_POST['id']) != '') {		// If user ID is not empty ==> a user is selected, therefore we will update an existing user

					$action = 'updated';

					$q = "UPDATE admins SET first = '$first', last = '$last', email = '$_POST[email]', phone = '$_POST[phone]', dep = '$_POST[dep]' WHERE id = $_GET[id]";
                                        $r = mysqli_query($dbc, $q);

				} else {	// If user ID is empty ==> we will create a new user

					$action = 'added';

					$q = "INSERT INTO admins (first, last, email, password, phone, dep) VALUES ('$first', '$last', '$_POST[email]', SHA1('$_POST[password]'), '$_POST[phone]', '$_POST[dep]')";


				if($verify == true) {   //  to perform if verify  (password = passwordv ) is true

					$r = mysqli_query($dbc, $q);  // get the result of the query
					}

				}

				if($r){	   // Message for user added/updated succesfuly


					$message = '<p class="alert alert-success">User was '.$action.'!</p>';
				  	if($verify == false) {

							$message .= '<p class="alert alert-danger">Password fields empty and/or do not match, therefore password was not changed</p>';

						}


				} else {	 // Message for user not added/updated

					$message = '<p class="alert alert-danger">User could not be '.$action.' because: '.mysqli_error($dbc);

					if($verify == false) {

						$message .= '<p class="alert alert-danger">Password fields empty and/or do not match.</p>';

						}

					$message .= '<p class="alert alert-warning">Query: '.$q.'</p>';   // Get the query for debugging purposes

				}

			}

			if(isset($_GET['id'])) { $opened = data_admins($dbc, $_GET['id']); }

		break;

		// FTP Users Manager

		case 'ftpusers':

			if(isset($_POST['submitted']) == 1) {

			$userid = mysqli_real_escape_string($dbc, $_POST['userid']);
			$homedirectory = '/var/ftp/'.$_POST['homedir'] ;
				
				if($_POST['passwd'] != '') {

					if($_POST['passwd'] == $_POST['passwdv']) {  	// Compare password with passwdv

						$verify = true;
						//$passwd = SHA1($passwd);
				 		$password1 = $_POST['passwd'];
					 	$password = base64_encode(pack("H*", md5($password1)));

					}

					else { $verify = false; }		// If password != passwdv ==> set $verify to false

				} else { $verify = false; }			// If passwd is empty ==> set $verify to false

				if(isset($_POST['id']) != '') {			// If user ID is not empty ==> a user is selected, therefore we will update an existing user

					$action = 'updated';

					if ($_POST['passwd'] != '') {
						
						
					

					$q = "UPDATE ftpuser SET userid = '$userid', passwd = '$password', uid = '$_POST[uid]', gid = '$_POST[gid]', homedir = '$homedirectory', shell= '/sbin/nologin'  WHERE id = $_GET[id]";
					$r = mysqli_query($dbc, $q);

					} else { // if password is empty

						$q = "UPDATE ftpuser SET userid = '$userid', uid = '$_POST[uid]', gid = '$_POST[gid]', homedir = '$homedirectory', shell= '/sbin/nologin'  WHERE id = $_GET[id]";
        	            $r = mysqli_query($dbc, $q);

					}


				} else {	// If ID is empty ==> we will create a new user

					$action = 'added';

					$q = "INSERT INTO ftpuser (userid, passwd, uid, gid, homedir, shell ) VALUES ('$userid', '$password', '$_POST[uid]', '$_POST[gid]', '$homedirectory', '/sbin/nologin')";

					if($verify == true) {   //  to perform if verify  (passwd = passwdv ) is true

					$r = mysqli_query($dbc, $q);  // get the result of the query

					}

				}

				if($r){	   // Message for user added/updated succesfuly

					$message = '<p class="alert alert-success">User was '.$action.'!</p>';
				  	if($verify == false) {

							$message .= '<p class="alert alert-danger">Password fields empty and/or do not match, therefore password was not changed</p>';
							// $message .= '<p class="alert alert-warning">Query: '.$q.'</p>';   // Get the query for debugging purposes
						}

				} else {	 // Message for user not added/updated

					$message = '<p class="alert alert-danger">User could not be '.$action.' because: '.mysqli_error($dbc);

					if($verify == false) {

							$message .= '<p class="alert alert-danger">Password fields empty and/or do not match.</p>';

						}

					// $message .= '<p class="alert alert-warning">Query: '.$q.'</p>';   // Get the query for debugging purposes

				}

			}

			if(isset($_GET['id'])) { $opened = data_ftpuser($dbc, $_GET['id']); }

		break;

		case 'newgids':

			if(isset($_POST['submitted']) == 1) {
				
			$groupname = mysqli_real_escape_string($dbc, $_POST['groupname']);
			$gid = mysqli_real_escape_string($dbc, $_POST['gid']);
			
			$gb_quota =  mysqli_real_escape_string($dbc, $_POST['gb_quota']);
			$quota = 1024 * 1024 * 1024 * $gb_quota;

				if(isset($_POST['id']) != '') {			// If user ID is not empty ==> a user is selected, therefore we will update an existing user

					$action = 'updated';
					$q3 = "UPDATE ftpquotalimits SET bytes_in_avail = '".$quota."' WHERE name = '".$groupname."'";	
					$r3 = mysqli_query($dbc, $q3);
					
					if($r3){	   // Message for user added/updated succesfuly

					$message = '<p class="alert alert-success">Group quota was '.$action.'!</p>';
				  	
					} else {	 // Message for user not added/updated

						$message = '<p class="alert alert-danger">Group quota could not be '.$action.' because: '.mysqli_error($dbc);					

					}
						

				} else {	// If ID is empty ==> we will create a new user

					$action = 'added';
					$q  = "INSERT INTO ftpgroup (gid, groupname, members) VALUES ('".$gid."', '".$groupname."', 'ftpuser')";
					$q1 = "INSERT INTO ftpquotalimits (name) VALUES ('".$groupname."')";
					$q2 = "INSERT INTO ftpquotatallies (name) VALUES ('".$groupname."')";
				}
				$r = mysqli_query($dbc, $q);
				$r1 = mysqli_query($dbc, $q1);
				$r2 = mysqli_query($dbc, $q2);
				
				
				if($r){	   // Message for user added/updated succesfuly

					$message = '<p class="alert alert-success">Group was '.$action.'!</p>';
				  	
				} else {	 // Message for user not added/updated

					$message = '<p class="alert alert-danger">Group could not be '.$action.' because: '.mysqli_error($dbc);					

				}

				

				
			}

			if(isset($_GET['id'])) { $opened = data_ftpgroup($dbc, $_GET['id']); }
			//if(isset($_GET['id'])) { $opened = data_ftpquota($dbc, $_GET['id']); }

		break;
		
		
		default:

		break;
	}
?>
