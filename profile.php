<?php  include('header.php');
include('head-profile.php');

$user_books = getBooksByUserId($_SESSION['uid']);

?>

<div class="container mt-3 ">
<div class="row justify-content-between">
<?php foreach($user_books as $b){?>
<div class="books_profile text-center shadow_b mb–4">
<div class="mb-2"><img src="books/<?php echo $b['Image']?>" class="img-fluid">
</div>
<h3><?php echo $b['BookTitle'];?></h3>
<p><strong>Genre:</strong> <?php echo $b['genreTitle'];?></p>
<p><strong>Author:</strong> <?php echo $b['author'];?></p>
<a href="edit-book.php?book_id=<?php echo $b['id'];?>"  class="manage_btns">Edit</a>
<a id="<?php echo $b['id'];?>" class="manage_btns rmv_book">Remove</a>
</div>
<?php } ?>
</div>
</div>


<div class="container mt-5">
<div class="row">
<div class="col-md-12 text-center">
<a href="add-book.php" class="top_btn">Add Book</a>
</div>
</div>
</div>

<?php include('footer.php');?>