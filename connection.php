<?php 

#Database Connection Here...

$dbc = mysqli_connect('localhost', 'my_user', 'my_password', 'my_database') OR die('Could not connect because: '.mysqli_connect_error());

?>
