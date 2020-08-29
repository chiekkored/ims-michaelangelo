<?php include 'check_connection.php' ?>

<?php
$id = $_GET['id'];

$query = mysqli_query($conn,"DELETE FROM material WHERE MATERIAL_ID = $id");



if(!$query){
	echo "error!";
}else{
header("location:material.php");
}

mysqli_close($conn);

?>