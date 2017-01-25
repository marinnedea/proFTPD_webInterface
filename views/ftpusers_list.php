<div class="row">
	<div class="col-md-3 pull-left">
		<h1>FTP Accounts list</h1>
	</div>
	
	
	
</div>	
<hr />
<div class="row">
		
	<?php if(isset($message)) {echo $message;} ?>	
	
			
	<div class="col-xs-12 col-sm-12 col-md-2 btn-group" role="group" aria-label="Add new entry">
		<a class="btn btn-success" href="?page=ftpusers">
			<i class="fa fa-plus"></i> Add new FTP Account
		</a>
	</div>	
	
	
	<form class="navbar-form  col-xs-12 col-sm-6 col-md-6  pull-right" role="search"  action="" method="POST" >
	<div class="input-group">		
	  <input type="text" class="form-control col-xs-12" name="term" placeholder="Caută.."  data-toggle="tooltip" data-placement="top" title="Caută ...">
		  <span class="input-group-btn">
			<button class="btn btn-success" accesskey="Enter" type="submit button" name="submitSearch">GO!</button>
		  </span>
	</div><!-- /input-group -->
	</form>
		

</div>
<hr>
<div class="row">
<?php 

$table_name = 'ftpuser';
$sortby = 'ORDER BY id ASC';
$cond = "WHERE userid LIKE '%" . $_POST[term] . "%'  OR uid LIKE '%" . $_POST[term] ."%'   OR gid LIKE '%" . $_POST[term] ."%'  OR homedir LIKE '%" . $_POST[term] ."%'";
include('pagination.php');

?> 
</div>
<div class="row">
	<table class="table table-responsive table-striped table-bordered">
		<thead>			
			  <th>#</th>
			  <th>Username</th>
			  <th>User ID</th>
			  <th>Group ID</th>
			  <th>Homedir</th>
			  <th>Used quota</th>
			  <th>Conections</th>
			  <th>Last accessed</th>
			  <th>Last change</th>				  
			  <th>Edit</th>	
		</thead>
		<tbody class="table table-responsive">	
		
		<?php	// Building the list of devices
			//$q = "SELECT * FROM ftpuser ORDER BY id ASC";
			$r = mysqli_query($dbc, $q);			
			while($list = mysqli_fetch_assoc($r)) {	?>
			
			
				<?php // echo $q; ?> 
				<tr id="ftpusers_list_<?php echo $list['id']; ?> res_line" class="<?php selected($list['id'], $opened['id']); ?>">
					
					<td><?php echo $list['id']; ?></td>
					<td><?php echo $list['userid']; ?></td>					
					<td><?php echo $list['uid']; ?></td>
					<td><?php echo $list['gid']; ?></td>
					<td><?php echo $list['homedir']; ?></td>
					<td><?php  
					
							$qa = "SELECT * FROM ftpgroup WHERE gid = ".$list['gid']."";
							$ra = mysqli_query($dbc, $qa);
							
							
							while($la = mysqli_fetch_assoc($ra)){
							
							//print_r($la);
							
							$gname  = $la['groupname'];	
							//echo $gname.'<br />';
							
							}

							
							$qb = "SELECT  * FROM ftpquotalimits WHERE name = '".$gname."'";
							$rb = mysqli_query($dbc, $qb);
							//echo $qb.'<br />';
							while($lb = mysqli_fetch_assoc($rb)){
								$gquota  = $lb['bytes_in_avail'];
								//echo $gquota.'<br />';								
							}
							
							
							
							$qc = "SELECT bytes_in_used FROM ftpquotatallies WHERE name = '".$gname."'";
							$rc = mysqli_query($dbc, $qc);			
							
							//echo $qc.'<br />';
							while($lc = mysqli_fetch_assoc($rc)){
								
								$uquota  = $lc['bytes_in_used'];
								//echo $uquota.'<br />';								
							}
											
							
							
							
						
							
							
							$multiplier = 1024*1024*1024;
							
							$uquota = $uquota / $multiplier;
							$gquota = $gquota / $multiplier;
							
							$uquota_array = explode(".", $uquota);
							$gquota_array = explode(".", $gquota);
							
							$uquota_final = $uquota_array[0];	
							$gquota_final = $gquota_array[0];	
							
							$used_quota = $uquota_final .'GB/'. $gquota_final .'GB';
						
						
							echo $used_quota;
					
					
					?></td>
					<td><?php echo $list['count']; ?></td>
					<td><?php echo $list['accessed']; ?></td>
					<td><?php echo $list['modified']; ?></td>
					<td>
						<span style="margin: 5px;">
							<a href="index.php?page=ftpusers&pn=<?php echo $pagenum; ?>&id=<?php echo $list['id']; ?>"  class="btn btn-default"  data-toggle="tooltip" data-placement="top" title="Modifică">
								<i class="fa fa-pencil-square-o"></i>
							</a>
						</span>
									
					</td>
			
				</tr>
		
		<?php }  ?>
						
		</tbody>
	</table>
	</div>
	<div class="row">
	<div id="pagination_controls"><?php echo $paginationCtrls; ?></div>
	</div>
<hr>