<nav class="navbar navbar-default" >
			
	<!-- Split button -->

	
	<ul class="nav navbar-nav">
		<li><a href="?page=ftpusers_list">List accounts</a></li>
		<li><a href="?page=ftpusers">Create account</a></li>	
		<li><a href="?page=newgids">Manage groups</a></li>
		<li><a href="?page=admins">Admins Manager</a></li>		
		<li><a href="?page=stats">FTP Stats</a></li>
	</ul>
	
	<!-- Split button -->
	<div class="btn-group pull-right" style="margin-right: 20px;">
	
	  <button type="button" class="btn btn-success navbar-btn">Welcome, <?php echo $admins['fullname']; ?></button>
	  <button type="button" class="btn btn-success navbar-btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
	    <span class="caret"></span>
	    <span class="sr-only"></span>
	  </button>
	  <ul class="dropdown-menu nav" role="menu">
	    <li><a href="logout.php">Logout</a></li>	   
	  </ul>
	</div>	
				
</nav> <!-- END Main Top Navigation -->