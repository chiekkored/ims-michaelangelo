<?php include 'check_connection.php' ?>

<?php

$customer_name = $_POST['customer_name'];
$priority_number = $_POST['priority_number'];
$customer_orderid = $_POST['customer_orderid'];
$orderqty = $_POST['orderqty']; 


$custquery = mysqli_query($conn, "SELECT * FROM customer");
while ($row = mysqli_fetch_array($custquery)) {
	$cust_id = $row['CUSTOMER_ID'];
}
$_SESSION['CUSTOMER_ID'] = $cust_id;

$query = mysqli_query($conn,"INSERT INTO customer (CUSTOMER_NAME, PRIORITY_NUMBER)
	VALUES ('$customer_name', '$priority_number')");
$query2 = mysqli_query($conn,"INSERT INTO customer_order (CUSTOMER_ORDERID, CUSTOMER_ID, ORDERQTY)
	VALUES ('$customer_orderid', '$cust_id', '$orderqty')");

echo "Success";

mysqli_close($conn);

?>