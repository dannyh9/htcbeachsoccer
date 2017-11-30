<?php
include '../databaseconnection.php';
?>
<!DOCTYPE html>
<html>
<head>    
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <style type="text/css">
    body{
    	padding-top:20px;
    }
    </style>
    <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
		<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Login</h3>
			 	</div>
			  	<div class="panel-body">
			    	<form method="POST" action="index.php" accept-charset="UTF-8" role="form">
                    <fieldset>
			    	  	<div class="form-group">
			    		    <input class="form-control" placeholder="Gebruikersnaam" name="username" type="text">
			    		</div>
			    		<div class="form-group">
			    			<input class="form-control" placeholder="Wachtwoord" name="password" type="password" value="">
			    		</div>
			    		<input class="btn btn-lg btn-success btn-block" name="login" type="submit" value="Login">
			    	</fieldset>
			      	</form>
			    </div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<?php
if (isset($_POST["login"])) {
  if(isset($_POST["username"]) && $_POST["password"] != "") {
	$username=$_POST['username'];
	$password=$_POST['password'];
	$hashpassword = md5($password);

	$loginquery = "SELECT * FROM `authenticatie` WHERE Username = '$username' AND Password = '$hashpassword'";

	if (!$result = $conn->query($loginquery)) {
    	// Oh no! The query failed. 
    	echo "gebruiker komt niet voor???\n";
    	echo "Error: Our query failed to execute and here is why: \n";
    echo "Query: " . $loginquery . "\n";
    echo "Errno: " . $conn->errno . "\n";
    echo "Error: " . $conn->error . "\n";
    	exit;
	}
	if ($result->num_rows === 0) {
    // Oh, no rows! Sometimes that's expected and okay, sometimes
    // it is not. You decide. In this case, maybe actor_id was too
    // large? 
    echo "Username of password onjuist";
    exit;
	} else {
		$row = mysqli_fetch_array($result);
		$_SESSION['rollid'] = $row['RolID'];
		$_SESSION['user'] = $row['Username'];
		header("Refresh:1");
		//in sessie doen resultaten http://php.net/manual/en/mysqli.examples-basic.php
	}

	//$conn->
	//SELCTE * FROM AUTHENTICATIE WHERE username = $username AND password = $password 
  } 
}
?>