<div class="row">
	<div class="col-md-3 pull-left">
		<h1>Quota stats</h1>
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

$table_name = 'ftpquotalimits';
$sortby = 'ORDER BY id ASC';
$cond = "WHERE name LIKE '%" . $_POST[term] . "%'  OR limit_type LIKE '%" . $_POST[term] ."%'  ";
include('pagination.php');

?> 
</div>
<div class="row">
	<table class="table table-responsive table-striped table-bordered">
		<thead>			
			  <th>#</th>
			  <th>Group Name</th>
			  <th>Group ID</th>
			  <th>Group members</th>
			  <th>Quota ( in GB)</th>
			  <th>Used Quota ( in GB) </th>
			  <th>Quota Type</th>
			  <th>Limit Type</th>		 

		</thead>
		<tbody class="table table-responsive">	
		
		<?php	// Building the list of devices
			//$q = "SELECT * FROM ftpuser ORDER BY id ASC";
			$r = mysqli_query($dbc, $q);
			
			while($list = mysqli_fetch_assoc($r)) {	?>
			
			
				<?php // echo $q; ?> 
				<tr id="stats<?php echo $list['id']; ?> res_line" class="<?php selected($list['id'], $opened['id']); ?>">
					
					<td><?php echo $list['id']; ?></td>
					<td><?php echo $list['name']; ?></td>	
					<td>
						<?php 
						
						$gname = $list['name'];
						$q1 = "SELECT * FROM ftpgroup WHERE groupname = '$gname'";	
						//echo $q1;
						$r1 = mysqli_query($dbc, $q1) or die ("ERR sql2<br><font color=red>".mysqli_error($dbc).".</font>");   

						$list1 = mysqli_fetch_assoc($r1);					

						echo $list1['gid']; ?>


					 
					</td>
					<td><ul>
						<?php 
						
						$gr_id = $list1['gid'];
						
						//echo $gr_id;
						
						$q2 = "SELECT * FROM ftpuser WHERE gid = '$gr_id'";	
						//echo $q2;
						$r2 = mysqli_query($dbc, $q2) or die ("ERR sql2<br><font color=red>".mysqli_error($dbc).".</font>");   

						while($list2 = mysqli_fetch_assoc($r2)){
						?>              

							<li><?php echo $list2['userid'];?></li>


					<?php  } ?> 
						</ul>
					</td>
					<td><?php echo number_format((($list['bytes_in_avail']) / 1073741824),0).' GB'; ?></td>
					<td>
						<?php 
						
						$gr_name = $list1['groupname'];
						
						//echo $gr_id;
						
						$q3 = "SELECT * FROM ftpquotatallies WHERE name = '$gr_name'";	
						//echo $q3;
						$r3 = mysqli_query($dbc, $q3) or die ("ERR sql3<br><font color=red>".mysqli_error($dbc).".</font>");   
							
						while($list3 = mysqli_fetch_assoc($r3)){

							echo number_format((($list3['bytes_in_used']) / 1073741824),2).' GB'; 

						} 
						 
						
						?> 
					</td>
					<td><?php echo $list['quota_type']; ?></td>			
					<td><?php echo $list['limit_type']; ?></td>
					
				
				</tr>
		
		<?php }  ?>
						
		</tbody>
	</table>
	</div>
	<div class="row">
	<div id="pagination_controls"><?php echo $paginationCtrls; ?></div>
	</div>
<hr>