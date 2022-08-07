<?php include('header.php');

$error_login = "";


if(isset($_POST['login'])){
	
      $username = htmlspecialchars($_POST['username']);
      $pass = md5($_POST['password']);
	  
 $user = login($username, $pass); 

  if(!empty($user)){
	  
  
  $id = $user[0]['id'];

  $_SESSION['uid'] = $id;

  header("Location: profile.php");
  }
  
  else{
	  $error_login = "Invalid Username os Password!";
  }
}
  
?>

<div class="container">

<h2 class="text-center mb-5">Login</h2>
<div class="row">
<p class="error error_req col-md-12 text-center"></p>
<form action="" method="post" class="frm offset-md-2 col-md-8">

<p class="error error_login text-center"><?php echo $error_login;?></p>
<input type="email" name="username" placeholder="Username*">
<input type="password" name="password" placeholder="Password*">

<input type="submit" id="login" name="login" value="Login" />
</form>
</div>
</div>

<?php include('footer.php');?>
