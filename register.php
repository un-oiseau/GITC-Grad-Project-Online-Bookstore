<?php include('header.php');

$country = getCountries();

if(isset($_POST['register'])){
	
  $name = htmlspecialchars($_POST['name']);
  $lname = htmlspecialchars($_POST['lname']);  
  $email = htmlspecialchars($_POST['email']); 
  $city = htmlspecialchars($_POST['city']);  
  $country_id = htmlspecialchars($_POST['country']);
  $password = md5($_POST['password']);
  
  $id = addUser($name,$lname,$email,$city,$country_id,$password);
  
  $_SESSION['uid'] = $id;  
  
  header("Location: profile.php");
  
}

?>

<div class="container">

<h2 class="text-center mb-5">Registration</h2>
<div class="row">
<p class="error error_req col-md-12 text-center"></p>
<form action="" method="post" class="frm offset-md-2 col-md-8">

<input type="text" name="name" placeholder="Name*">
<input type="text" name="lname" placeholder="Last Name*">
<p class="error error_email text-center"></p>
<p class="error error_email_ex text-center"></p>
<input type="email" name="email" placeholder="Email*">
<input type="text" name="city" placeholder="City*">
<label>Country</label>
<select name="country">
<?php foreach($country as $c){?>
<option value="<?php echo $c['CountryID'];?>">
<?php echo $c['CountryName'];?></option>
<?php }?>
</select>
<div class="gen_pass_fields">
<button onclick = "generatePassword(12);return false;" class="gen_pass">Click to Generate Password</button>
<input type="text" id ="pass">
</div>
<p class="error error_pass text-center"></p>
<p class="error error_pass_l text-center"></p>
<input type="password" name="password"  placeholder="Password*">
<input type="password" name="cnf_password" placeholder="Confirm Password*">

<input type="submit" id="reg" name="register" value="Register" />
</form>
</div>
</div>

<?php include('footer.php');?>