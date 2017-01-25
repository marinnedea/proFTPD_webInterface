	<h1>Admins Manager</h1>
		
		<div class="row">
		
			<div class="col-md-3">  <!-- Add "New User" button --> 
		
				<div class="list-group">
		
					<a class="list-group-item" href="?page=admins">	<i class="fa fa-plus"></i> New Admin	</a>
					
						<?php
							
							$q = "SELECT * FROM admins ORDER BY last ASC";
							$r = mysqli_query($dbc, $q);
							
							while($list = mysqli_fetch_assoc($r)) {
								
							$list = data_admins($dbc, $list['id']);
							//$blurb = substr(strip_tags($page_list['body']), 0, 160);
						?>
						

						
						
						<div id="admins_<?php echo $list['id']; ?>" class="list-group-item <?php selected($list['id'], $opened['id'], 'active' ); ?>">
							<h4 class="list-group-item-heading">
					
								<?php echo $list['fullname_reverse']; ?>
					
								<span class="pull-right" style="margin-left: 5px; margin-top: -5px;"><a href="#" id="dela_<?php echo $list['id']; ?>" class="btn btn-danger admins-delete"><i class="fa fa-trash-o"></i></a></span>				
								<span class="pull-right" style="margin-left: 5px; margin-top: -5px;"><a href="index.php?page=admins&id=<?php echo $list['id']; ?>" class="btn btn-default"><i class="fa fa-pencil-square-o"></i></a></span>
					
							</h4>
						
					
						</div>
									
						
						<?php } ?>
				</div>
		</div>  <!-- END "New User" button --> 
		
		

	
	<div class="col-md-6">
	
	<?php if(isset($message)) { echo $message; } ?>   <!-- Display messages depending on the action taken -->
	
	<form action="index.php?page=admins&id=<?php echo $opened['id']; ?>" method="post" role="form">  
		
		
		<!-- START the user form -->
		<div class="form-group">
			<label for="first">First Name:</label>
			<input class="form-control" type="text" name="first" id="first" value="<?php echo $opened['first']; ?>" placeholder="First Name" autocomplete="off">
		</div>
		
		<div class="form-group">
			<label for="last">Last Name:</label>
			<input class="form-control" type="text" name="last" id="last" value="<?php echo $opened['last']; ?>" placeholder="Last Name" autocomplete="off">
		</div>
		
		<div class="form-group">
			<label for="email">Email Address:</label>
			<input class="form-control" type="text" name="email" id="email" value="<?php echo $opened['email']; ?>" placeholder="Email Address" autocomplete="off">
		</div>
		
		<div class="form-group">
			<label for="phone">Phone:</label>
			<input class="form-control" type="text" name="phone" id="phone" value="<?php echo $opened['phone']; ?>" placeholder="Phone" autocomplete="off">
		</div>
		
		
		<div class="form-group">
			<label for="dep">Department:</label>
			<input class="form-control" type="text" name="dep" id="dep" value="<?php echo $opened['dep']; ?>" placeholder="Department" autocomplete="off">
		</div>
			
		
		<div class="form-group">
			<label for="password">Password:</label>
			<input class="form-control" type="password" name="password" id="password" value="" placeholder="Password" autocomplete="off">
		</div>
		
		<div class="form-group">
			<label for="passwordv">Verify Password:</label>
			<input class="form-control" type="password" name="passwordv" id="passwordv" value="" placeholder="Type Password Again" autocomplete="off">
		</div>
		
		<button type="submit" class="btn btn-default">Save</button>
		<input type="hidden" name="submitted" value="1">
		
			<?php if(isset($opened['id'])) { ?>
				<input type="hidden" name="id" value="<?php echo $opened['id']; ?>">
			<?php } ?>
		
	</form>
	<!-- END the user form -->
</div>
	
</div>
