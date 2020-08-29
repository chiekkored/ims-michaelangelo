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
    <a class="nav-link" href=""><i class="fa fa-cubes" aria-hidden="true"></i> Material</a>
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
<!-- FOR MATERIALS -->
<div class="container">
  <center>
    <h1 class="display-3">MATERIALS</h1>
  <table class="table table-sm table-striped">
    <thead class="thead-dark">
 <tr>
  <th>ID</th> 
  <th>MATERIAL NAME</th> 
  <th>SUPPLIER NAME</th>
  <th>UNIT</th>
  <th>QUANTITY</th>
  <th>PRICE</th>
  <th>DATE ORDERED</th>
  <th>TOTAL PRICE</th>
  <th></th>
 </tr>
</thead>
 <?php 
          $sql = mysqli_query($conn, "SELECT * FROM MATERIAL");
          while ($row = $sql->fetch_assoc()){
          $sum = 0;
          $sum = $row['MATERIAL_QTY']*$row['MATERIAL_PRICE'];
          echo "<tr>";
          echo "<td>" . $row['MATERIAL_ID'] . "</td>" . "<td>" . $row['MATERIAL_NAME'] . "</td>" . "<td>" . $row['SUPPLIER_NAME'] . "</td>" . "<td>" . $row['MATERIAL_UNIT'] . "</td>" . "<td>" . $row['MATERIAL_QTY'] . "</td>" . "<td>" . $row['MATERIAL_PRICE'] . "</td>" . "<td>" . $row['MATERIAL_TIMEDATE'] . "</td>" . "<td>" . $sum . " PHP" . "</td>";
          echo "<td><a class='btn btn-danger' href='material-delete.php?id=" . $row['MATERIAL_ID'] . "'><i class='fa fa-window-close' aria-hidden='true'></i></a></td>";
          echo "</tr>";
          }
          ?>
 </table>
</center>
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#material"><i class="fa fa-plus" aria-hidden="true"></i> Manage Materials</button>
</div>
<center>
  <div class="modal fade" id="material" tabindex="-1" role="dialog" aria-labelledby="Material" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="Addsupplier">Manage material</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="material-process.php">
          <div class="form-group">
            <label for="message-text" class="col-form-label col-form-label-sm">Material</label>
            <div class="input-group">
              <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1"><i class="fa fa-cube fa-fw"></i></span>
            </div>
            <input type="text" class="form-control form-control-sm" name="material_name">
          </div>
          </div>
          <div class="form-group">
          <label for="exampleFormControlSelect1">Supplier</label>
          <div class="input-group">
          <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1"><i class="fa fa-address-card-o fa-fw"></i></span>
            </div>  
          <select class="form-control" name="supplier_name">
          <?php 
          $sql = mysqli_query($conn, "SELECT SUPPLIER_NAME FROM SUPPLIER");
          while ($row = $sql->fetch_assoc()){
          echo "<option>" . $row['SUPPLIER_NAME'] . "</option>";
          }
          ?>
          </select>
          </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label col-form-label-sm">Quantity</label>
            <div class="input-group">
              <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1"><i class="fa fa-cubes   fa-fw"></i></span>
            </div>  
            <input type="text" class="form-control form-control-sm" name="material_qty">
          </div>
          </div>
          <div class="form-group">
          <label for="message-text" class="col-form-label col-form-label-sm">Unit</label>
           <div class="input-group">
          <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1"><i class="fa fa-flask fa-fw"></i></span>
            </div>
          <select class="form-control" name="material_unit">
          <option>-</option>
          <option>Per Piece</option>
          <option>Gram(s)</option>
          <option>Kilogram(s)</option>
          <option>Liter(s)</option>
          </select>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label col-form-label-sm">Price</label>
            <div class="input-group">
              <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1"><i class="fa fa-money   fa-fw"></i></span>
            </div>
            <input type="text" class="form-control form-control-sm" name="material_price">
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