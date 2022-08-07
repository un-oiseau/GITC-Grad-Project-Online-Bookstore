<?php

$error_message = "";

$userMessage = sendMessage();

if(isset($_POST['submit'])){

  $name = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);
  $message = htmlspecialchars($_POST['message']);

  $message = sendMessage($name,$email,$message);

if(!empty($message)){
  $id = $message[0]["id"];
  $_SESSION["uid"] = $id;
  header("Location: helper/helper.php");
}

else{
	$error_message = "Invalid Name os email!";
}
  
}
?>


<?php include('footer.php');?>
