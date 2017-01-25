<?php 

// Setup file:

error_reporting(0);

#Database Connection: 

include('config/connection.php');
//include('config/test.php');

#Constants:

//DEFINE('D_TEMPLATE', 'template');


# Functions:

include('functions/data.php');
//include('functions/template.php');
include('functions/sandbox.php');

#Site Setup:
//$debug = data_setting_value($dbc, 'debug-status');


$site_title = 'FTPS - My Site';

if(isset($_GET['page'])) {
	
	$page = $_GET['page'];
	
} else {

	$page = 'ftpusers_list'; // Set $pageid equal to 1 or to Home Page

}

#Page Setup
include('config/queries.php');


// testing some variables //
// $anotherpage = data_page($dbc, 2);
// echo $anotherpage['title'];

#User setup:

$admins = data_admins($dbc, $_SESSION['username']);

?>

