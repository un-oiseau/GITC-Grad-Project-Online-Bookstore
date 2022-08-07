<?php  include('header.php');
include('head-profile.php');

$country = getCountries();

if(isset($_POST['edit'])){
	
	editProfile($_SESSION['uid'],$_POST['name'],
	$_POST['lname'],$_POST['email'],$_POST['city'],$_POST['country'],md5($_POST['password']));
	
	header("Location: profile.php");
	
}

?>

<div class="container">
<div class="row">
<form method="post" action="" class="frm offset-md-2 col-md-8">
<p class="error error_req col-md-12 text-center"></p>
<label>Name*</label>
<input type="text" name="name" value="<?php echo $user[0]['name'];?>">
<label>Last Name*</label>
<input type="text" name="lname" value="<?php echo $user[0]['lastName'];?>">
<label>Email*</label>
<p class="error error_email text-center"></p>
<p class="error error_email_ex text-center"></p>
<input type="email" name="email" value="<?php echo $user[0]['email'];?>">
<label>City*</label>
<input type="text" name="city" value="<?php echo $user[0]['city'];?>">
<label>Country</label>
<select name="country">
<?php foreach($country as $c){?>
<?php if($user[0]['country_id']==$c['CountryID']){?>
<option value="<?php echo $c['CountryID'];?>" selected>
<?php echo $c['CountryName'];?></option>
<?php } else {?>
<option value="<?php echo $c['CountryID'];?>">
<?php echo $c['CountryName'];?></option>
<?php } }?>
</select>
<label>Password*</label>
<p class="error error_pass text-center"></p>
<p class="error error_pass_l text-center"></p>
<input type="password" name="password" value="<?php echo $user[0]['password'];?>">
<input type="submit" value="Edit" name="edit" id="edit_prof">
</form>
</div>
</div>

<?php include('footer.php');?>