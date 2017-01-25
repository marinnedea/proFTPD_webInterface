	<h1>FTP Groups Manager</h1>
		<hr>
		<div class="row">
		
			<div class="col-md-3">  <!-- Add "New User" button --> 
		
				<div class="list-group">
		
					<a class="list-group-item" href="?page=newgids">	<i class="fa fa-plus"></i> ADD New Group (Project name)</a>
					
						<?php
														
							$q = "SELECT * FROM ftpgroup ORDER BY id DESC";
							$r = mysqli_query($dbc, $q);
							
							while($list = mysqli_fetch_assoc($r)) {
								
							$list = data_ftpgroup($dbc, $list['id']);
							
						?>
						
						<div id="newgids_<?php echo $list['groupname']; ?>" class="list-group-item <?php selected($list['id'], $opened['id'], 'active' ); ?>">
							<h4 class="list-group-item-heading">
					
								<?php echo $list['id']; ?>	<?php echo $list['groupname']; ?>
					
								<span class="pull-right" style="margin-left: 5px; margin-top: -5px;"><a href="#" id="delg_<?php echo $list['groupname']; ?>" class="btn btn-danger ftpgroup-delete"><i class="fa fa-trash-o"></i></a></span>				
								<span class="pull-right" style="margin-left: 5px; margin-top: -5px;"><a href="index.php?page=newgids&id=<?php echo $list['id']; ?>" class="btn btn-default"><i class="fa fa-pencil-square-o"></i></a></span>
					
							</h4>
						
					
						</div>
									
						
						<?php } ?>
				</div>
			</div>  <!-- END "New ftp User" button --> 
		
		

	
	<div class="col-md-6">
	
	<?php if(isset($message)) { echo $message; } ?>   <!-- Display messages depending on the action taken -->

	<form action="index.php?page=newgids&id=<?php echo $opened['id']; ?>" method="post" role="form">  
				
		<!-- START the user form -->
		<div class="form-group col-sm-6">
			<label for="groupname">Group (Project) Name</label>
			<input class="form-control" type="text" name="groupname" id="groupname" value="<?php echo $opened['groupname']; ?>" placeholder="Group name" autocomplete="off" <?php if($opened['gid'] != ''){ ?>readonly<?php }?>>
		</div>
		
		<?php 
		
		$q = "SELECT * FROM ftpgroup ORDER BY gid";
		$r = mysqli_query($dbc, $q);

		$array = array();
		while($list = mysqli_fetch_array($r)){
		
		 $garray[] = $list['gid'];
		}
		$range = range(1001, 6000);

		// the array_diff() function returns the values in the "$range" array
		// that are not present in the array of "$array".
		$allGidRanges = array_diff($range, $garray);
	
		
		?>
		
		
		<div class="form-group col-sm-3">
		
		<?php if($opened['gid'] != ''){ ?>
			
				<label for="gid">Group ID:</label>
				<input class="form-control" type="text" name="gid" id="gid" value="<?php echo $opened['gid']; ?>" placeholder="gid" autocomplete="off" readonly>
			
		<?php } else { ?>
			<label for="gid">Available GID</label>
			<select class="form-control" name="gid" id="gid">
			<option value="">--</option>
		<?php 
	
			$i = 1;
			foreach ($allGidRanges as $range) {
				echo '<option value="'.$range.'">'.$range.'</option>';
				if ($i++ == 10) break; // limiting results to 10 options
			}
		?>
			</select>
		
		<?php } ?>
		</div>	
		
		<?php if(isset($opened['id'])) { ?>
		<div class="form-group col-sm-3">
			<label for="gb_quota">Quota (in GB)</label>
			<?php 
				
				$gname = $opened['groupname'];
							
				$q2 = "SELECT * FROM ftpquotalimits WHERE name = '".$gname."'";
				$r2 = mysqli_query($dbc, $q2);
				
				while($list2 = mysqli_fetch_assoc($r2)) {
					
					$quota_val = $list2['bytes_in_avail']; 					
					$quota_gb = $quota_val / 1024 / 1024 / 1024 ;  // getting value in GB	

					$quota_array = explode(".", $quota_gb);
					$quota_final = $quota_array[0];					
										
				?>	  
				
				
			<input class="form-control" type="text" name="gb_quota" id="gb_quota" value="<?php echo $quota_final; ?>" placeholder="Quota (default is 50GB)" autocomplete="off">
			
			<?php } ?> 
		</div>
		<?php } ?>
	
		<div class="form-group col-sm-12">
		<button type="submit" class="btn btn-default">Save</button>
		<input type="hidden" name="submitted" value="1">
		
			<?php if(isset($opened['id'])) { ?>
				<input type="hidden" name="id" value="<?php echo $opened['id']; ?>">
				
			<?php } ?>
		</div>
	</form>
	<!-- END the ftp user form -->
</div>
<div class="col-md-3">
<?php /*
$headers = apache_request_headers();

foreach ($headers as $header => $value) {
    echo "$header: $value <br />\n";
} */
?>





</div>

</div>
