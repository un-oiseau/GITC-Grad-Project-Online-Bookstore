<?php $user = getUserById($_SESSION['uid']);

if(!isset($_SESSION['uid'])){
	header("Location:".helper::$base_url);
}

?>

<div class="container">
<div class="row">
<div class="col-md-6">
<h3>Hello <?php echo $user[0]['name']. " ".$user[0]['lastName'];?></h3>
<a href="edit_profile.php" class="top_btn">Edit Profile</a>
</div>
<div class="col-md-6 text-right">
<a href="logout.php" class="top_btn">LOGOUT</a>
</div>
</div>
</div>

