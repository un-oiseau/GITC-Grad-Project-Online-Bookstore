<?php  include('header.php');
include('head-profile.php');

$book = getUserBookById($_GET['book_id'],$_SESSION['uid']);
$genres = getGenres();
$authors = getAuthors();
$error_ext = "";
$error_req = "";
$is_valid = true;

$price_array = explode(" ",$book[0]["Price"]);

$currency = array("AMD","RUB","USD","EUR","PND");


if(isset($_POST['edit'])){
	
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
	
	move_uploaded_file($tmp_name,'books/'.$filename);
	
	unlink("books/".$book[0]['Image']);
	
	}
	
	else{
		$error_ext = "Invalid Image type";
		$is_valid = false;
	}
	}
	
	else{
		$filename = $book[0]['Image'];
	}
	
	if($title == "" || $publisher == "" || $price == "" ||    $author_id == "" || $filename == ""){
		
		$error_req = "Please Fill all required fields";
		$is_valid = false;
	}
	
	
	if($is_valid){
		editBook($_GET['book_id'],$title,$genre,$publisher,$price,$filename,$author_id,$user_id);
		
		header("Location: profile.php");
	}
}

?>

<div class="container">
<div class="row">
<form method="post" action="" class="frm offset-md-2 col-md-8" enctype='multipart/form-data'>
<p class="error"><?php echo $error_req;?></p>
<label>Title</label>
<input type="text" name="title" placeholder="Title*" value="<?php echo $book[0]['BookTitle'];?>">
<label>Genre</label>
<select name="genre">
<?php foreach($genres as $g){ ?>
<?php if($g['id'] == $book[0]['Genre_id']){?>
<option selected value="<?php echo $g['id'];?>"><?php echo $g['title'];?></option>
<?php } else{?>
<option value="<?php echo $g['id'];?>"><?php echo $g['title'];?></option>
<?php }?>
<?php }?>
</select>
<label>Publisher</label>
<input type="text" name="publisher" placeholder="Publisher*" value="<?php echo $book[0]['Publisher'];?>">
<label>Price</label>
<input type="text" name="price" class="col-md-4 d-inline-block" placeholder="Price*" pattern="[0-9]+" title="Value Must be numeric" value="<?php echo $price_array[1];?>">
<label class="col-md-6 d-inline-block">Currency
<select name="currency" >
<?php for($i = 0; $i < count($currency); $i++){?>
<?php if($currency[$i] == $price_array[0]){?>
<option selected><?php echo  $currency[$i]?></option>
<?php } else {?>
<option><?php echo  $currency[$i]?></option>
<?php }?>
<?php }?>
</select>
</label>
<p class="error img_error"></p>
<p class="error"><?php echo $error_ext;?></p>
<label><img src="books/<?php echo $book[0]['Image'];?>" style="width:100px">
Book Image*
<input type="file" name="file" class="mb-3 pl-3 pr-3" id="file" >
</label>
<label>Please Choose Author From List*</label>
<select name="author" id="author_lists">
<option value="">Please Choose the Author</option>
<?php foreach($authors as $a){?>
<?php if($a['id'] == $book[0]['author_id']){?>
<option selected value="<?php echo $a['id'];?>">
<?php echo $a['name']." ".$a['lastName'];?></option>
<?php } else {?>
<option  value="<?php echo $a['id'];?>">
<?php echo $a['name']." ".$a['lastName'];?></option>
<?php }?>
<?php }?>
</select>

<input type="submit" name="edit" value="Edit">
</form>
</div>
</div>
<?php include('footer.php');?>