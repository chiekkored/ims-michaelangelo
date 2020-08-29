<?php include 'check_connection.php' ?>

<?php
$material_qty = $_POST['material_qty'];
$material_unit = $_POST['material_unit'];
$material_price = $_POST['material_price'];
$material_name = $_POST['material_name'];
$supplier_name = $_POST['supplier_name'];

$query = mysqli_query($conn,"INSERT INTO material (MATERIAL_NAME, MATERIAL_QTY, MATERIAL_UNIT, MATERIAL_PRICE, SUPPLIER_NAME)
	VALUES ('$material_name', '$material_qty', '$material_unit', '$material_price', '$supplier_name')");


if(!$query){
	echo "error!";
}else{
header("location:material.php");
}

mysqli_close($conn);

?>