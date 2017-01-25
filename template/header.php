<?php 

# Start the session:

session_start();

if(!isset($_SESSION['username'])) {
	header('Location: login.php');
}

?>

<?php include ('config/setup.php'); // Include the configuration files for the page ?>

<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="utf-8">	
	<title> <?php echo $page['title'].' | '.$site_title; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<?php include('config/css.php'); // Add the CSS to the page ?>
	
	<?php include('config/js.php'); // Add the JavaScript to the page ?>
	
	
</head>

<body>
	<div class="wrap">
		
	<?php include('template/navigation.php'); //Main Navigation ?>
