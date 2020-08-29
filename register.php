
<?php 
include 'check_connection.php';

if(isset($_POST['REGISTER'])){
    
    $uname=$_POST['username'];
    $password=md5($_POST['password']);
    $conpass= md5($_POST['con-pass']);
    
    $sql="SELECT * FROM user WHERE username = '$uname' LIMIT 1";
    $query = mysqli_query($conn, $sql);

    if(mysqli_fetch_row($query)){
    	$msg = 'Username is already taken!';
    	header("Location: register.php?msg=".$msg);
    }else{
    	if($password != $conpass){
    		$msg = 'Password Not Matched!';
    		header("Location: register.php?msg=".$msg);
    	}else{
    		$sql = "INSERT INTO user VALUES (null, '$uname', '$password')";
	    	$query = mysqli_query($conn, $sql);
	    	if($query){
	    		$msg = 'Successfully Registered!';
	    		header("Location: login.php?msg=".$msg);
	    	}	
    	}
    }


    
        
}
?>

<!DOCTYPE html>
<html>
<head>
	<title> Michelangelo Inventory System</title>
	<link rel="icon" href="images/logo.jpg">
	<link rel="stylesheet" a href="design.css">
	<link rel="stylesheet" a href="css\font-awesome.min.css">
</head>
<body>
	<div class="container" style="margin-top: 10%">
		<center>
			<?php
				if(isset($_GET['msg'])){
					$msg = $_GET['msg'];
					echo '<h1 style="color: white">'.$msg.'</h1>';
				}
			?>
			<form method="POST" action="">
				<div class="form-input">
					<input type="text" name="username" placeholder="Username"/>	
				</div>
				<br>
				<div class="form-input">
					<input type="password" name="password" placeholder="password"/>
				</div>
				<br>
				<div class="form-input">
					<input type="password" name="con-pass" placeholder="CONFIRM PASSWORD!"/>
				</div>
				<br>
				<input type="submit" name="REGISTER" value="REGISTER" class="btn-login"/>
			</form>
			<br>
			<a href="login.php" style="color:white">Already Sign Up? Sign In Here!</a>
		</center>
	</div>
</body>
</html>