<?php 

# Start a session:
ini_set('session.cookie_domain', '.domain.com');
ini_set('session.cookie_path', '/');
session_start();

# Database connection:
include('config/connection.php');  

if($_POST) {
	
	$q = "SELECT * FROM admins WHERE email='$_POST[email]' AND password=SHA1('$_POST[password]')";
	$r = mysqli_query($dbc, $q);
	
	// $num = mysqli_num_rows($r);  // No need to define a variable since is used only once.
	
	if(mysqli_num_rows($r) == 1){
		
		$_SESSION['username'] = $_POST['email'];
		header('Location: index.php');
		
	}
		
}


?>


<!DOCTYPE html>
<html>
	
<head>
	
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<?php include('config/css.php'); // Add the CSS to the page ?>
	
	<?php include('config/js.php'); // Add the JavaScript to the page ?>
	
	
</head>

<body>
	<div class="wrap">
		
	<?php // include(D_TEMPLATE.'/navigation.php'); //Main Navigation ?>
		<div class="container">
			
			
			<div class="row">
				
								
				<div class="col-md-4 col-md-offset-4">
					
					<div class="panel panel-primary">
						
						<div class="panel-heading">
							<strong>Login</strong>
						</div>  <!-- END Panel Heading -->
						
						<div class="panel-body">
							
							<form action="login.php" method="post" role="form">
								
						
							  <div class="form-group">
							    <label for="email">Email address</label>
							    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
							  </div>
							  
							  <div class="form-group">
							    <label for="password">Password</label>
							    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
							  </div>
							  								
							  <button type="submit" class="btn btn-default">Submit</button>
							</form>  <!-- END Form -->
						
						</div> <!-- END Panel body -->
								
					</div> <!-- END panel -->
					
				</div>  <!-- END Column -->
				
			</div> <!-- END row -->			
			
		</div>	
		
	</div> <!-- END Wrapper -->

</body>
	
</html>
