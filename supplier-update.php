<!DOCTYPE html>
<?php
$id = $_GET['id'];
if (isset(Edit)) {
$supplier_name = $_POST['supplier_name'];
$supplier_address = $_POST['supplier_address'];
$supplier_num = $_POST['supplier_num'];
$supplier_status = $_POST['supplier_status'];

$query = "UPDATE supplier SET supplier_name= '$supplier_name', supplier_address= '$supplier_address', supplier_num= '$supplier_num', supplier_status= '$supplier_status' WHERE supplier_id = '$id'";

if(!$query){
	echo "error!";
}else{
header("location:supplier.php");
}
}

mysqli_close($conn);

?>
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
    <a class="nav-link active" href=""><i class="fa fa-briefcase" aria-hidden="true"></i> Supplier</a>
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
    <h1 class="display-3">SUPPLIER</h1>
  <table class="table table-sm table-striped">
    <thead class="thead-dark">
 <tr>
  <th>ID</th> 
  <th>NAME</th> 
  <th>ADDRESS</th>
  <th>NUMBER</th>
  <th>DATE SUPPLIED</th>
  <th>STATUS</th>
  <th></th>
 </tr>
</thead>
 <?php 
          $sql = mysqli_query($conn, "SELECT * FROM SUPPLIER");
          while ($row = $sql->fetch_assoc()){
          echo "<tr>";
          echo "<td>" . $row['SUPPLIER_ID'] . "</td>" . "<td>" . $row['SUPPLIER_NAME'] . "</td>" . "<td>" . $row['SUPPLIER_ADDRESS'] . "</td>" . "<td>" . $row['SUPPLIER_NUM'] . "</td>" . "<td>" . $row['SUPPLIER_DATE'] . "</td>" . "<td>" . $row['SUPPLIER_STATUS'] . "</td>" ;
          echo "<td><a class='btn btn-primary' href='supplier-update.php?id=" . $row['SUPPLIER_ID']. "'> Edit
                  </a>  <a class='btn btn-danger' href='supplier-delete.php?id=" . $row['SUPPLIER_ID'] . "'><i class='fa fa-window-close' aria-hidden='true'></i></a></td>";
          echo "</tr>";
          }
          ?>
 </table>
</center>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addsupplier"><i class="fa fa-plus" aria-hidden="true"></i> Manage Supplier</button>
</div>

<center>
  <div class="modal fade" id="addsupplier" tabindex="-1" role="dialog" aria-labelledby="Addsupplier" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="Addsupplier">Add supplier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="supplier-process.php">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label col-form-label-sm">Supplier Name</label>
            <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1"><i class="fa fa-address-card-o fa-fw"></i></span>
            </div>
            <input type="text" class="form-control form-control-sm" name="supplier_name" value="">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label col-form-label-sm">Contact No</label>
            <div class="input-group">
              <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1"><i class="fa fa-mobile fa-fw"></i></span>
            </div>
            <input type="text" class="form-control form-control-sm" name="supplier_num">
          </div>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label col-form-label-sm">Address</label>
            <div class="input-group">
              <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1"><i class="fa fa-home fa-fw"></i></span>
            </div>
            <input type="text" class="form-control form-control-sm" name="supplier_address">
          </div>
          </div>
      <div class="modal-footer">
        <input type="submit" value="Add">
      </div>
    </div>
</form>
</div>


<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit</h4>
            </div>

            <div class="modal-body">
            <?php include("classes/forms/edit.php"); ?>

            </div>
        </div>
    </div>
</div>


</center>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</script>
</body>
</html>
