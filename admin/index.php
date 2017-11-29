<?php 
session_start();
	if(isset($_SESSION['rollid'],$_SESSION['user']) && !empty($_SESSION['rollid']) && !empty($_SESSION['user'])) {
		echo $_SESSION['rollid'];
		echo $_SESSION['user'];
		include("admin.php");
	}
	else {
		include("login.php");
	}
?>