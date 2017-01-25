<?php 
//JavaScript File:

?> 
<!-- JQuery -->
<script src="//code.jquery.com/jquery-2.1.3.min.js"></script>

<!-- JQuery Ui -->
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

<!-- Custom JS -->

<script type="text/javascript" src="template/checkuid.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

<script>
	
	$(document).ready (function() {
	
		$(".admins-delete").on("click", function() {
			
			var selected = $(this).attr("id");
			var pageid = selected.split("dela_").join("");	
			
			var confirmed = confirm("Are you sure you want to delete this user?");
			
			if(confirmed == true) {
				
				$.get("ajax/admins.php?id="+pageid); 		//send info to another page
			
				$("#admins_"+pageid).remove();
				
			}
			
			//alert(selected);
		})



		$(".ftpusers-delete").on("click", function() {

				var selected = $(this).attr("id");
				var pageid = selected.split("delf_").join("");  

				var confirmed = confirm("Are you sure you want to delete this user?");

				if(confirmed == true) {

						$.get("ajax/ftpusers.php?id="+pageid);            //send info to another page

						$("#ftpusers_"+pageid).remove();

				}

				//alert(selected);
		})

		$(".ftpgroup-delete").on("click", function() {

				var selected = $(this).attr("id");
				var pageid = selected.split("delg_").join("");  

				var confirmed = confirm("Are you sure you want to delete this group?");

				if(confirmed == true) {

						$.get("ajax/ftpgroup.php?id="+pageid);            //send info to another page

						$("#newgids_"+pageid).remove();

				}

				//alert(selected);
		})
		
		



})
</script>
