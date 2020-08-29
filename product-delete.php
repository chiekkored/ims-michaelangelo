<?php include 'check_connection.php' ?>

<?php
$id = $_GET['id'];

$query = mysqli_query($conn,"DELETE FROM product WHERE PRODUCT_ID = $id");



if(!$query){
	echo "error!";
}else{
header("location:product.php");
}

mysqli_close($conn);

?>