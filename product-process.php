<?php include 'check_connection.php' ?>

<?php
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
move_uploaded_file($_FILES["product_image"]["tmp_name"],"pizza/" . $_FILES["product_image"]["name"]);			
$location=$_FILES["product_image"]["name"];

$query = mysqli_query($conn,"INSERT INTO product (PRODUCT_NAME, PRODUCT_PRICE, PRODUCT_IMAGE)
	VALUES ('$product_name', '$product_price', '$location')");


if(!$query){
	echo "error!";
}else{
header("location:product.php");
}

mysqli_close($conn);

?>