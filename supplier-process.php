<?php include 'check_connection.php' ?>

<?php
$supplier_name = $_POST['supplier_name'];
$supplier_address = $_POST['supplier_address'];
$supplier_num = $_POST['supplier_num'];

$query = mysqli_query($conn,"INSERT INTO supplier (SUPPLIER_NAME, SUPPLIER_ADDRESS, SUPPLIER_NUM, SUPPLIER_STATUS)
	VALUES ('$supplier_name', '$supplier_address', '$supplier_num', 'Not Delivered')");



if(!$query){
	echo "error!";
}else{
header("location:supplier.php");
}

mysqli_close($conn);

?>