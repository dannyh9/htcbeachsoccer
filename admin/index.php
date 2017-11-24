<?php
session_start();
?>

<?php
include '../databaseconnection.php';
?>

<!DOCTYPE html>
<html>
<head>    
	<link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="./css/style.css" rel="stylesheet">
	<title>  Login</title>
</head>
<body>

	<script src="http://mymaplist.com/js/vendor/TweenLite.min.js"></script>
<!-- This is a very simple parallax effect achieved by simple CSS 3 multiple backgrounds, made by http://twitter.com/msurguy -->

<div class="container">
    <div class="row vertical-offset-100">
    	<div class ="row horizontal-offset-100"></div>
    	<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Please sign in</h3>
			 	</div>
			  	<div class="panel-body">
			    	<form method="post" action="index.php" accept-charset="UTF-8" role="form">
                    <fieldset>
			    	  	<div class="form-group">
			    		    <input class="form-control" placeholder="Username" name="username" type="text">
			    		</div>
			    		<div class="form-group">
			    			<input class="form-control" placeholder="Password" name="password" type="password" value="">
			    		</div>
			    		<div class="checkbox">
			    	    	<label>
			    	    		<input name="remember" type="checkbox" value="Remember Me"> Remember Me
			    	    	</label>
			    	    </div>
			    		<input class="btn btn-lg btn-success btn-block" name="login" type="submit" value="Login">
			    	</fieldset>
			      	</form>
			    </div>
			</div>
		</div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="./bootstrap/assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="../bootstrap/dist/js/bootstrap.min.js"></script>
     <script src="./js/script.js"></script> 
</body>
</html>
<?php
if (isset($_POST["login"])) {
  if(isset($_POST["username"]) && $_POST["password"] != "") {
	$username=$_POST['username'];
	$password=$_POST['password'];

	$loginquery = "SELECT * FROM `authenticatie` WHERE Username = '$username' AND Password = '$password'";

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
		//in sessie doen resultaten http://php.net/manual/en/mysqli.examples-basic.php
	}

	//$conn->
	//SELCTE * FROM AUTHENTICATIE WHERE username = $username AND password = $password 
  } 
}
?>