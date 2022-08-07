<?php session_start(); include('get_data.php'); 
if(!empty($_POST['a_name']) && !empty($_POST['a_lname'])){
	
	$last_insert_id = addAuthor($_POST['a_name'],$_POST['a_lname'],$_POST['wiki_link']);
	
	$authors = getAuthors();
	
	
	foreach($authors as $a){
		if($a['id'] == $last_insert_id){
		echo "<option selected value=".$a['id'].">".$a['name']." ".$a['lastName']."</option>";
		}		
		else{
			echo "<option value=".$a['id'].">".$a['name']." ".$a['lastName']."</option>";
		}
	}
}

if(!empty($_POST['id'])){
	
	removeBook($_POST['id'],$_SESSION['uid']);
	
}

?>