<!DOCTYPE html>
<html lang="en">
<?php include 'check_connection.php' ?>
<head>
	<link rel="icon" href="images\logo.jpg">
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
    <a class="nav-link active" href="supplier.php"><i class="fa fa-briefcase" aria-hidden="true"></i> Supplier</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="material.php"><i class="fa fa-cubes" aria-hidden="true"></i> Material</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="product.php"><i class="fa fa-cube" aria-hidden="true"></i> Product</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="customerorder.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Customer Order</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="invoice.php"><i class="fa fa-info" aria-hidden="true"></i> Invoice</a>
  </li>
</ul>
 <ul class="nav">
  <li class="nav-item">
    <a class="nav-link" href="login.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
  </li>
  </ul>
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
 </tr>
</thead>
 <?php 
          $sql = mysqli_query($conn, "SELECT * FROM order_invoice ORDER BY ORDER_DATE ASC");
          while ($row = $sql->fetch_assoc()){
          echo "<tr>";
          echo "<td>" . $row['ORDER_INVOICEID'] . "</td>" . "<td>" . $row['CUSTOMER_NAME'] . "</td>" . "<td>" . $row['ORDER_INVOICE_AMOUNT'] . "</td>" . "<td>" . $row['ORDER_DATE'] . "</td>";
          $order_invoiceid = $row['ORDER_INVOICEID'];
          echo "</tr>";
          }
          ?>
 </table>



</div>
</center>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>