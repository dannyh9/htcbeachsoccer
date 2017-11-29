<?php

if (isset($_POST['loguit'])) {
	session_start();
	session_unset();
	session_destroy();
	header("Location: index.php");
	exit();
}