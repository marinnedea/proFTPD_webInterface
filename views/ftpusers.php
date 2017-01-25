<script>
	$(function() {
	  $("#generate").click(function() {
		 $("#genpass").load("views/passwdgen.php")
	  })
	})
</script>

	<h1>FTP Users Manager</h1>
		<hr>
		<div class="row">
		
			<div class="col-md-3">  <!-- Add "New User" button --> 
		
				<div class="list-group">
		
					<a class="list-group-item" href="?page=ftpusers">	<i class="fa fa-plus"></i> ADD New FTP User	</a>
					
						<?php
							
							$ftpuser_id = $_GET['id'];
							$q = "SELECT * FROM ftpuser WHERE id = $ftpuser_id ORDER BY id ASC";
							$r = mysqli_query($dbc, $q);
							
							while($list = mysqli_fetch_assoc($r)) {
								
							$list = data_ftpuser($dbc, $list['id']);
							
						?>
						

						
						
						<div id="ftpusers_<?php echo $list['id']; ?>" class="list-group-item <?php selected($list['id'], $opened['id'], 'active' ); ?>">
							<h4 class="list-group-item-heading">
					
								<?php echo $list['id']; ?>	<?php echo $list['userid']; ?>
					
								<span class="pull-right" style="margin-left: 5px; margin-top: -5px;"><a href="#" id="delf_<?php echo $list['id']; ?>" class="btn btn-danger ftpusers-delete"><i class="fa fa-trash-o"></i></a></span>				
								<span class="pull-right" style="margin-left: 5px; margin-top: -5px;"><a href="index.php?page=ftpusers&id=<?php echo $list['id']; ?>" class="btn btn-default"><i class="fa fa-pencil-square-o"></i></a></span>
					
							</h4>
						
					
						</div>
									
						
						<?php } ?>
				</div>
		</div>  <!-- END "New ftp User" button --> 
		
		

	
	<div class="col-md-6">
	
	<?php if(isset($message)) { echo $message; } ?>   <!-- Display messages depending on the action taken -->

	<form action="index.php?page=ftpusers&id=<?php echo $opened['id']; ?>" method="post" role="form">  
				
		<!-- START the user form -->
		<div class="form-group col-sm-12">
			<label for="userid">Username (E-mail Address, firstname.lastname or Project Name )</label>
			<input class="form-control" type="text" name="userid" id="userid" value="<?php echo $opened['userid']; ?>" placeholder="Username (firstname.lastname, e-mail or Project Name)" autocomplete="off">
		</div>
		
		<div class="form-group col-sm-6">
			<label for="passwd">Password:</label>
			<input class="form-control" type="password" name="passwd" id="passwd" value="" placeholder="Password" autocomplete="off">

		</div>
		
		<div class="form-group col-sm-6">
			<label for="passwdv">Verify password:</label>
			<input class="form-control" type="password" name="passwdv" id="passwdv" value="" placeholder="Type Password Again" autocomplete="off">
		</div>

	
	<?php
		$q = "SELECT * FROM ftpuser ORDER BY uid AND gid";
		$r = mysqli_query($dbc, $q);

		$array = array();
		while($list = mysqli_fetch_array($r)){
		 $uarray[] = $list['uid'];
		 $garray[] = $list['gid'];
		}
		$range = range(1001, 6000);

		// the array_diff() function returns the values in the "$range" array
		// that are not present in the array of "$array".
		$allUidRanges = array_diff($range, $uarray);
		$allGidRanges = array_diff($range, $garray);
		//$i = 1;
		//foreach ($allRanges as $range) {
		//	echo '<option value="'.$range.'">'.$range.'</option>';
		//	if ($i++ == 10) break; // limiting results to 10 options
		//}
		
	?>
			<?php if($opened['uid'] != ''){ ?>
			<div class="form-group col-sm-6">
				<label for="uid">UID:</label>
				<input class="form-control" type="text" name="uid" id="uid" value="<?php echo $opened['uid']; ?>" placeholder="1002" autocomplete="off" readonly>
			</div>
			<?php } else { ?>
			<div class="form-group col-sm-3">
			<label for="manualUID">Select UID input method</label>			
			<span class="input-group">
				<input type="radio" name="manualUID" value="Yes" onclick="checkUID(this.value)"> Add UID manualy <br />
				<input type="radio" name="manualUID" value="No"  onclick="checkUID(this.value)" checked="checked">Select UID from list
			</span>	
			</div>
			<div class="form-group col-sm-3">
			<label for="uid">User UID</label>
				 <div id="uid_manual" style="display: none;">
					
					<input class="form-control" type="text" name="uid" id="uid" value="" placeholder="1002" autocomplete="off">
					
				 </div>			
			
				<select class="form-control" name="uid" id="uid_select" style="display: block;">
					<option value="">--</option>
					<?php 
					$i = 1;
						foreach ($allUidRanges as $range) {
							echo '<option value="'.$range.'">'.$range.'</option>';
							if ($i++ == 10) break; // limiting results to 10 options
						}
					?>
				</select>
			</div>	
		<?php } ?>



		<div class="form-group col-sm-3">
			<label for="homedir">HomeDir:</label>
			<input class="form-control" type="text" name="homedir" id="homedir" value="<?php echo $opened['homedir']; ?>" placeholder="project.name " autocomplete="off" <?php if($opened['homedir'] != ''){ echo 'readonly'; }?>>
		</div>
		
	
				
		<?php if($opened['gid'] != ''){ ?>
		<div class="form-group col-sm-3">
			<label for="gid">GID:</label>
			<input class="form-control" type="text" name="gid" id="gid" value="<?php echo $opened['gid']; ?>" placeholder="1002" autocomplete="off" readonly>
		</div>
		<?php } else { ?>
		<div class="form-group col-sm-3">
			<label for="gid">Existing Group</label>
			<select class="form-control" name="uid" id="uid">
			<option value="">--</option>
			<?php 
		
				foreach ($garray as $value) {
					
					$q5 = "SELECT * FROM ftpgroup WHERE gid = '".$value."'";
					$r5 = mysqli_query($dbc, $q5);
					
					while($list5 = mysqli_fetch_assoc($r5)){
						
						$group_name = $list5['groupname'];						
					
					echo '<option value="'.$value.'">'.$group_name.'</option>';	
					}					
				}
			?>
			</select>
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

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Generate Random Password</h3>
  </div>
<div class="panel-body" id="genpass"></div>





  <div class="panel-footer">
	 <button class="btn btn-default" id="generate">Generate</button>
  	 <button class="btn btn-default btn-danger" id="copybutton" data-clipboard-target="genpass"> Copy </button>

	<script src="./views/ZeroClipboard.js"></script>
<script>

var clip = new ZeroClipboard(
	document.getElementById('copybutton'), {
	moviewPath: "./views/ZeroClipboard.swf"
	});


clip.on( 'noflash', function ( client, args ) {
    $("#copybutton").click(function(){            
        var txt = $(this).attr('data-clipboard-text');
        prompt ("Copy link, then click OK.", txt);
    });
}); 

</script>


</div>
</div>



</div>

</div>
