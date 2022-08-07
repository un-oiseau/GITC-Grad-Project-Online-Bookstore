<?php  include('header.php');include('head-profile.php');

$genres = getGenres();
$authors = getAuthors();
$error_ext = "";
$error_req = "";
$is_valid = true;
if(isset($_POST['add'])){
	
	$title = $_POST['title'];
	$genre = $_POST['genre'];
	$publisher = $_POST['publisher'];
	$price = $_POST['currency']." ".$_POST['price'];
	$author_id = $_POST['author'];
	$user_id = $_SESSION['uid'];
	

	
	$ext_array = array('jpg','png','gif','webp','jpeg');

	if(!empty($_FILES['file']['name'])){
	
	$filename = time()."-".$_FILES['file']['name'];
	$tmp_name = $_FILES['file']['tmp_name'];
	
	$ext = pathinfo($filename,PATHINFO_EXTENSION);
	
	if(in_array($ext,$ext_array)){
	
	@mkdir('books');
	
	move_uploaded_file($tmp_name,'books/'.$filename);
	
	}
	
	else{
		$error_ext = "Invalid Image type";
		$is_valid = false;
	}
	

	}
	
	if($title == "" || $publisher == "" || $price == "" ||    $author_id == "" || $filename == ""){
		
		$error_req = "Please Fill all required fields";
		$is_valid = false;
	}
	
	
	if($is_valid){
		addBook($title,$genre,$publisher,$price,$filename,$author_id,$user_id);
		
		header("Location: profile.php");
	}
}

?>



<div class="container">
<div class="row">
<form method="post" action="" class="frm offset-md-2 col-md-8" enctype='multipart/form-data'>
<p class="error"><?php echo $error_req;?></p>
<input type="text" name="title" placeholder="Title*">
<label>Genre</label>
<select name="genre">
<?php foreach($genres as $g){ ?>
<option value="<?php echo $g['id'];?>"><?php echo $g['title'];?></option>
<?php }?>
</select>
<input type="text" name="publisher" placeholder="Publisher*">
<input type="text" name="price" class="col-md-4 d-inline-block" placeholder="Price*" pattern="[0-9]+" title="Value Must be numeric">
<label class="col-md-6 d-inline-block">Currency
<select name="currency" >
<option>AMD</option>
<option>RUB</option>
<option>USD</option>
<option>EUR</option>
<option>PND</option>
</select>
</label>
<p class="error img_error"></p>
<p class="error"><?php echo $error_ext;?></p>
<label>Book Image*
<input type="file" name="file" class="mb-3 pl-3 pr-3" id="file" >
</label>
<label>Please Choose Author From List*</label>
<select name="author" id="author_lists">
<option value="">Please Choose the Author</option>
<?php foreach($authors as $a){?>
<option value="<?php echo $a['id'];?>">
<?php echo $a['name']." ".$a['lastName'];?></option>
<?php }?>
</select>

<label class="mt-3 mb-3">If You didn't find Your author from list above, please fill fields below to add new author</label>

<p class="error auth_msg"></p>
<input type="text" id="auth_name" placeholder="Author Name">
<input type="text" id="auth_lname" placeholder="Author last Name">
<p class="error auth_wiki"></p>
<input type="text" id="wiki_link" placeholder="Wikipedia Link">
<div class="mt-3 mb-3">
<a class="top_btn" id="add_auth">Add Author</a>
</div>
<input type="submit" name="add" value="Add">
</form>



</div>
</div>

<?php  include('footer.php');?>