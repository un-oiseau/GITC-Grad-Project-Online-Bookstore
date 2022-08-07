<?php session_start(); include("header.php");

session_unset();
session_destroy();

header("Location:".helper::$base_url);

 ?>