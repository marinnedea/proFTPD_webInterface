function checkUID(selectedType){
 
  
  if (selectedType == 'Yes'){
	document.getElementById('uid_manual').style.display = 'block';
	document.getElementById('uid_select').style.display = 'none';
  } else if(selectedType == 'No'){
	document.getElementById('uid_manual').style.display = 'none';
	document.getElementById('uid_select').style.display = 'block';
  } 
}