<?php include('get_data.php');include("helper/helper.php");

if(isset($_GET['id'])){
verifySubscriber($_GET['id'],"Yes");
header("Location:".helper::$base_url);
}
?>