<?php 
	include 'check_connection.php';
	session_start();
	if(isset($_POST['LOGIN'])){
	    
	    $uname=$_POST['username'];
	    $password=md5($_POST['password']);
	    
	    $sql = "SELECT * FROM user WHERE username= '$uname' AND password = '$password' LIMIT 1"; 
	    $query=mysqli_query($conn, $sql);

	    $_SESSION['username'] = $_POST['username'];

	    if(!mysqli_fetch_row($query)){
	    	$msg = 'You Have Entered Incorrect Username/Password!';
	    	header("Location: login.php?msg=".$msg);
	    }else{
	    	if ($uname=='employee') {
	    		header("Location: customerorder-employee.php");
	    	}else{
	    	header("Location: supplier.php");
	    }
	    }
	}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="images\logo.jpg">
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" a href="design.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<title> Michelangelo Inventory System</title>
	<link rel="icon" href="images/logo.jpg">
	<link rel="stylesheet" a href="design.css">
	<link rel="stylesheet" a href="css\font-awesome.min.css">
</head>
<body>
	<div class="container" style="margin-top:5%">
		<center>
			<?php
				if(isset($_GET['msg'])){
					$msg = $_GET['msg'];
					echo '<h1 style="color: white">'.$msg.'</h1>';
				}
			?>
			<br>
			<img src="images\logo.png" height="200" width="200">
			<br><br><br>
			<form method="POST" action="">
				<div class="form-input">
					<input type="text" name="username" placeholder="Username"/>	
				</div>
				<br>
				<div class="form-input">
					<input type="password" name="password" placeholder="password"/>
				</div>
				<br>
				<input type="submit" name="LOGIN" value="LOGIN" class="btn-login"/>
			</form>
		</center>
	</div>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>