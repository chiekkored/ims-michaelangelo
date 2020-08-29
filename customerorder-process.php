<?php include 'check_connection.php' ?>

<?php

$parts = array();
foreach($_POST['PRODUCT_ID'] as $row=>$PRODUCT_ID) {
	$PRODUCT_ID = mysqli_real_escape_string($conn, $PRODUCT_ID);
	$product_qty = mysqli_real_escape_string($conn, $_POST['PRODUCT_QTY'][$row]);
	$product_name = mysqli_real_escape_string($conn, $_POST['PRODUCT_NAME'][$row]);
	$PRODUCT_PRICE = mysqli_real_escape_string($conn, $_POST['PRODUCT_PRICE'][$row]);
	$priority_number = $_POST['priority_number'];
	$order_invoiceid = $_POST['ORDER_INVOICEID'];
	$totalprice = $_POST['totalprice'];
	$customer_name = $_POST['customer_name'];


	$parts[] = "('$customer_name','$PRODUCT_ID', '$product_qty','$product_name','$PRODUCT_PRICE')";
	}
$count=0;
if ($count<1) {
	
	$query = mysqli_query($conn,"INSERT INTO customer (CUSTOMER_NAME, PRIORITY_NUMBER)
	VALUES ('$customer_name', '$priority_number')");

	$query1 = mysqli_query($conn,"INSERT INTO order_invoice (ORDER_INVOICEID, CUSTOMER_NAME, ORDER_INVOICE_AMOUNT)
	VALUES ('$order_invoiceid', '$customer_name', '$totalprice')");
	$count++;
}

	$query2 = "INSERT INTO customer_order (CUSTOMER_NAME, PRODUCT_ID, PRODUCT_QTY, PRODUCT_NAME, PRODUCT_PRICE) VALUES " . implode(', ', $parts);

$result = mysqli_query($conn, $query2);

if(!$result){
	echo mysqli_error($conn);
}else{
header("location:customerorder.php");
}

mysqli_close($conn);

?>