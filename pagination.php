<?php 
$q = "SELECT COUNT(id) FROM $table_name $cond";
$r = mysqli_query($dbc, $q);
$row = mysqli_fetch_row($r);
// Here we have the total row count
$rows = $row[0];


// This is the number of results we want displayed per page
$page_rows = 10;

// This tells us the page number of our last page
$last = ceil($rows/$page_rows);
// This makes sure $last cannot be less than 1
if($last < 1){
	$last = 1;
}
// Establish the $pagenum variable
$pagenum = 1;
// Get pagenum from URL vars if it is present, else it is = 1
if(isset($_GET['pn'])){
	$pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
}
// This makes sure the page number isn't below 1, or more than our $last page
if ($pagenum < 1) { 
    $pagenum = 1; 
} else if ($pagenum > $last) { 
    $pagenum = $last; 
}
// This sets the range of rows to query for the chosen $pagenum
$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;

// This is your query again, it is for grabbing just one page worth of rows by applying $limit

	
if(isset($_POST['submitSearch']))  {

	$q = "SELECT * FROM $table_name $cond ORDER BY id ASC $limit";

}	else {
	
	$q = "SELECT * FROM $table_name $sortby $limit";
}
$r = mysqli_query($dbc, $q);	
	

// echo $q;
// Establish the $paginationCtrls variable
$paginationCtrls = '<nav>
					  <ul class="pagination">
						';
// If there is more than 1 page worth of results


if($last != 1){
	/* First we check if we are on page one. If we are then we don't need a link to 
	   the previous page or the first page so we do nothing. If we aren't then we
	   generate links to the first page, and to the previous page. */
	
	//else 
		if ($pagenum > 1) {
        $previous = $pagenum - 1;
		$paginationCtrls .= '<li><a href="'.$_SERVER['PHP_SELF'].'?page='.$page.'&pn='.$previous.'"  aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li> ';
		// Render clickable number links that should appear on the left of the target page number
		
		for($i = $pagenum-4; $i < $pagenum; $i++){
			if($i > 0){
		        $paginationCtrls .= '<li><a href="'.$_SERVER['PHP_SELF'].'?page='.$page.'&pn='.$i.'">'.$i.'</a></li> ';
			}
	    }
    }
	
	// Render the target page number, but without it being a link
	$paginationCtrls .= '<li class="active">
      <span>'.$pagenum.' <span class="sr-only">(current)</span></span>
    </li>';
	
	// Render clickable number links that should appear on the right of the target page number
	for($i = $pagenum+1; $i <= $last; $i++){
		$paginationCtrls .= '<li><a href="'.$_SERVER['PHP_SELF'].'?page='.$page.'&pn='.$i.'">'.$i.'</a> </li> ';
		if($i >= $pagenum+4){
			break;
		}
	}
	
	// This does the same as above, only checking if we are on the last page, and then generating the "Next"
    if ($pagenum != $last) {
        $next = $pagenum + 1;
        $paginationCtrls .= ' <li><a href="'.$_SERVER['PHP_SELF'].'?page='.$page.'&pn='.$next.'"   aria-label="Next" ><span aria-hidden="true">&raquo;</span></a></li>
						</ul>
						</nav>
					  ';
    }
}

echo $paginationCtrls;
?>