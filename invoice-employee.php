<!DOCTYPE html>
<html lang="en">
<?php include 'check_connection.php' ?>
<head>
	<link rel="icon" href="images\logo.jpg">
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" a href="design.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>MICHAELANGELO INVENTORY</title>
</head>
<body>
	<nav class="navbar" style="background-color: #26292d;">
  <ul class="nav">    
  <a class="navbar-brand" href="">
    <img src="images\logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
  </a>
  <li class="nav-item">
    <a class="nav-link" href="customerorder-employee.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Customer Order</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href=""><i class="fa fa-info" aria-hidden="true"></i> Invoice</a>
  </li>
</ul>
<div class="dropdown">
 <ul class="nav">
  <li class="nav-item">
    <a class="nav-link" href="login.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
  </li>
  </ul>
  </div>
  </nav>

<div class="container">
<center>
<h1 class="display-3">INVOICE</h1>
  <table class="table table-sm table-striped">
    <thead class="thead-dark">
 <tr>
  <th>INVOICE NUMBER</th> 
  <th>CUSTOMER NAME</th> 
  <th>AMOUNT PAID</th>
  <th>DATE ISSUED</th>
  <th></th>
 </tr>
</thead>
 <?php 
          $sql = mysqli_query($conn, "SELECT oi.*, co.CUSTOMER_NAME FROM order_invoice oi, customer_order co WHERE oi.CUSTOMER_ORDERID=co.CUSTOMER_ORDERID");
          while ($row = $sql->fetch_assoc()){
          echo "<tr>";
          echo "<td>" . $row['ORDER_INVOICEID'] . "</td>" . "<td>" . $row['CUSTOMER_NAME'] . "</td>" . "<td>" . $row['ORDER_DATE'] . "</td>" . "<td>" . $row['ORDER_INVOICE_AMOUNT'] . "</td>";
          echo "<td><button data-id='" . $row['ORDER_INVOICEID'] . "' type='button' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#invoice' id='getinvoice'><i class='fa fa-eye' aria-hidden='true'></i></button></td>";
          echo "</tr>";
          }
          ?>
 </table>




  <div class="modal fade" id="invoice<?php echo $row['ORDER_INVOICEID'];?>" tabindex="-1" role="dialog" aria-labelledby="invoice" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="Addsupplier">Add supplier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php 
          $sql2 = mysqli_query($conn, "SELECT c.CUSTOMER_NAME, c.PRIORITY_NUMBER,  co.PRODUCT_NAME, co.PRODUCT_QTY, co.PRODUCT_PRICE, SUM(co.PRODUCT_PRICE*co.PRODUCT_QTY) AS SUBTOTAL, oi.ORDER_INVOICE_AMOUNT, oi.ORDER_INVOICEID FROM customer_order AS co, customer AS c, order_invoice AS oi WHERE oi.CUSTOMER_ORDERID=co.CUSTOMER_ORDERID AND co.CUSTOMER_NAME=c.CUSTOMER_NAME");
          $count=0;
          while ($row = $sql2->fetch_assoc()){
            if ($count<1) {
            echo "<center>" . $row['ORDER_INVOICEID'] . "</center>";
            echo $row['CUSTOMER_NAME'];
            echo $row['PRIORITY_NUMBER'] . "<hr>";
          echo "<div class='table-responsive'>
              <table class='table'>
             <tr>
              <th>PIZZA</th>
              <th>QUANTITY</th>
              <th>PRICE</th>
              <th>SUBTOTAL</th>
             </tr>";
             $count++;
            }
          echo "<td>" . $row['PRODUCT_NAME'] . "</td>" . "<td>" . $row['PRODUCT_QTY'] . "</td>" . "<td>" . $row['PRODUCT_PRICE'] . "</td>" . "<td>" . $row['SUBTOTAL'] . "</td>";
          echo "</tr>";
          }
          echo "<td>" . $row['ORDER_INVOICE_AMOUNT'] . "</td>";
          ?>


</div>
</center>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript">
        $(document).ready(function() {
            $('.details').click(function(e) {
                e.preventDefault();
                $('.CUSTOMER_NAME', '#modal').html( $(this).data('CUSTOMER_NAME') );
                $('.PRIORITY_NUMBER', '#modal').html( $(this).data('PRIORITY_NUMBER') );
                $('.PRODUCT_NAME', '#modal').html( $(this).data('PRODUCT_NAME') );
                $('.PRODUCT_QTY', '#modal').html( $(this).data('PRODUCT_QTY') );
                $('.PRODUCT_PRICE', '#modal').html( $(this).data('PRODUCT_PRICE') );
                $('.SUBTOTAL', '#modal').html( $(this).data('SUBTOTAL') );
                $('.ORDER_INVOICE_AMOUNT', '#modal').html( $(this).data('ORDER_INVOICE_AMOUNT') );
                $('.ORDER_INVOICEID', '#modal').html( $(this).data('ORDER_INVOICEID') );
            });
        });
        </script> 
</body>
</html>