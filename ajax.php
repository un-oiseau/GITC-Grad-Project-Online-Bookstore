<?php include('get_data.php'); include("helper/helper.php");

$email = checkMail($_POST['mail']);

if(!empty($email)){
	echo "This email are already exists";
}

if(!empty($_POST['sbs_email'])){
	$id = addSubscriber($_POST['sbs_email'],"No");
	$url = "http://localhost/library/verify.php?id=".$id;
	sendSubscribeEmail($_POST['sbs_email'],$url);
	
	echo "Thank You For Choose Us, For Verifying it's You Please check Your Email!";
}

?>