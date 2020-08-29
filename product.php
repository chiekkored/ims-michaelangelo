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
    <a class="nav-link active" href="supplier.php"><i class="fa fa-briefcase" aria-hidden="true"></i> Supplier</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="material.php"><i class="fa fa-cubes" aria-hidden="true"></i> Material</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href=""><i class="fa fa-cube" aria-hidden="true"></i> Product</a>
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
    <h1 class="display-3">PRODUCTS</h1>
  <table class="table table-sm table-striped">
    <thead class="thead-dark">
 <tr>
  <th>IMAGE</th>
  <th>IDX</th>
  <th>PRODUCT NAME</th> 
  <th>PRODUCT PRICE</th> 
  <th></th>
 </tr>
</thead>
 <?php 
          $sql = mysqli_query($conn, "SELECT * FROM PRODUCT");
          while ($row = $sql->fetch_assoc()){
          echo "<tr><td><img src='images/pizzas/" . $row['PRODUCT_IMAGE'] . "'width='35px' height='35px'></td>" . "<td>" . $row['PRODUCT_ID'] . "</td>" . "<td>" . $row['PRODUCT_NAME'] . "</td>" . "<td>" . $row['PRODUCT_PRICE'] . " PHP</td>";
          echo "<td><a class='btn btn-danger' href='product-delete.php?id=" . $row['PRODUCT_ID'] . "'><i class='fa fa-window-close' aria-hidden='true'></i></a></td></tr>";
        }
          ?>
 </table>
</center>
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#material"><i class="fa fa-cart-plus" aria-hidden="true"></i> Manage Product</button>
</div>
<center>
  <div class="modal fade" id="material" tabindex="-1" role="dialog" aria-labelledby="Material" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="Addsupplier">Manage product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="product-process.php" enctype="multipart/form-data">
          <div class="form-group">
            <label for="message-text" class="col-form-label col-form-label-sm">Product Name</label>
            <div class="input-group">
              <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1"><i class="fa fa-cube   fa-fw"></i></span>
            </div> 
            <input type="text" class="form-control form-control-sm" name="product_name">
          </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label col-form-label-sm">Product Price</label>
            <div class="input-group">
              <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1"><i class="fa fa-cube   fa-fw"></i></span>
            </div> 
            <input type="text" class="form-control form-control-sm" name="product_price">
          </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label col-form-label-sm">Product Image</label>
            <div class="input-group">
              <div class="input-group-prepend">
            <input type="file" class="form-control-file form-control-sm" name="product_image">
            </div> 
          </div>
          </div>
      <div class="modal-footer">
        <input type="submit" value="Add">
      </div>
    </div>
</form>
</center>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>