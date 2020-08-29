<?php include 'check_connection.php' ?>

<?php
$id = $_GET['id'];

$query = mysqli_query($conn,"DELETE FROM supplier WHERE SUPPLIER_ID = $id");



if(!$query){
	echo "error!";
}else{
header("location:supplier.php");
}

mysqli_close($conn);

?>