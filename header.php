<?php ob_start(); session_start(); include('get_data.php'); include("helper/helper.php");

$slider = getSlider();

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo helper::$base_url;?>css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Goudy+Bookletter+1911&display=swap" rel="stylesheet">
	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <link rel="icon" type="image/png"  href="favicon.png">
	
    <title> Books Library </title>
</head>
<body>

<div class="container">
<div class="row mb-3">
<div class="col-md-2 mb-3">
<a href="<?php echo helper::$base_url;?>">
<img src="images/logo.jpg" class="logo">
</a>
</div>
<div class="col-md-10 text-right align-self-center mb-3">
<a href="login.php" class="top_btn">Log In</a>
<a href="register.php" class="top_btn">Register</a>
</div>
</div>
</div>

<div class="container-fluid m-0 p-0">

<div  class="slider">
<?php foreach($slider as $s){?>
<div style="background:url(slider/<?php echo $s['slider_img'];?>) no-repeat;background-size:cover;background-position:center" class="row m-0 pl-0 pr-0">
<div class="col-md-7 p-5 slider_desc">
<h1><?php echo $s['title'];?></h1>
<?php echo $s['description']; ?>
</div>
</div>
<?php }?>
</div>

</div>