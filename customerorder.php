<!DOCTYPE html>
<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
  case "add":
    if(!empty($_POST["PRODUCT_QTY"])) {
      $productByCode = $db_handle->runQuery("SELECT * FROM PRODUCT WHERE PRODUCT_ID='" . $_GET["PRODUCT_ID"] . "'");
      $itemArray = array($productByCode[0]["PRODUCT_ID"]=>array('PRODUCT_NAME'=>$productByCode[0]["PRODUCT_NAME"], 'PRODUCT_ID'=>$productByCode[0]["PRODUCT_ID"], 'PRODUCT_QTY'=>$_POST["PRODUCT_QTY"], 'PRODUCT_PRICE'=>$productByCode[0]["PRODUCT_PRICE"], 'PRODUCT_IMAGE'=>$productByCode[0]["PRODUCT_IMAGE"]));
      
      if(!empty($_SESSION["cart_item"])) {
        if(in_array($productByCode[0]["PRODUCT_ID"],array_keys($_SESSION["cart_item"]))) {
          foreach($_SESSION["cart_item"] as $k => $v) {
              if($productByCode[0]["PRODUCT_ID"] == $k) {
                if(empty($_SESSION["cart_item"][$k]["PRODUCT_QTY"])) {
                  $_SESSION["cart_item"][$k]["PRODUCT_QTY"] = 0;
                }
                $_SESSION["cart_item"][$k]["PRODUCT_QTY"] += $_POST["PRODUCT_QTY"];
              }
          }
        } else {
          $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
        }
      } else {
        $_SESSION["cart_item"] = $itemArray;
      }
    }
  break;
  case "remove":
    if(!empty($_SESSION["cart_item"])) {
      foreach($_SESSION["cart_item"] as $k => $v) {
          if($_GET["PRODUCT_ID"] == $k)
            unset($_SESSION["cart_item"][$k]);        
          if(empty($_SESSION["cart_item"]))
            unset($_SESSION["cart_item"]);
      }
    }
  break;
  case "empty":
    unset($_SESSION["cart_item"]);
  break;  
}
}
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
    <a class="nav-link active" href="supplier.php"><i class="fa fa-briefcase" aria-hidden="true"></i> Supplier</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="material.php"><i class="fa fa-cubes" aria-hidden="true"></i> Material</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="product.php"><i class="fa fa-cube" aria-hidden="true"></i> Product</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href=""><i class="fa fa-shopping-cart" aria-hidden="true"></i> Customer Order</a>
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
  <div class="row">
    
            <div class="col">
        <h2 class="sub-header">PIZZA
          <a href="product.php" class="btn btn-sm btn-primary"><i class="fa fa-plus" aria-hidden="true"></i></a></h2>
        <div class="table-responsive">
  <table class="table table-sm table-striped">
    
<?php
$count=0;
  $product_array = $db_handle->runQuery('SELECT * FROM PRODUCT ORDER BY PRODUCT_ID ASC');
  if (!empty($product_array)) { 
    foreach($product_array as $key=>$value){
      if ($count>=4) {
        echo "<tr>";
        $count=0;
      }
    $count++;
  ?>
    <td>
      <form method="post" action="customerorder.php?action=add&PRODUCT_ID=<?php echo $product_array[$key]["PRODUCT_ID"]; ?>">
        <div class="form-group">
      <img src="pizza/<?php echo $product_array[$key]["PRODUCT_IMAGE"]; ?>" width="150px" height="150px">
      <?php echo $product_array[$key]["PRODUCT_NAME"]; $product_array[$key]["PRODUCT_ID"]; ?>
      <hr>
      <?php echo $product_array[$key]["PRODUCT_PRICE"]. " PHP"; ?>
      <div class="input-group">
      <input type="text" class="form-control form-control-sm" name="PRODUCT_QTY" value="1" /><input type="submit" value="Add" class="btnAddAction" />
    </div>
      </div>
      </form>
    </td>
  <?php
    }
  }
  ?>

 </table>
</div>
      </div>






<div class="col">
        <h2 class="sub-header">CUSTOMER ORDER <a id="btnEmpty" class="btn btn-sm btn-danger" href="customerorder.php?action=empty"> EMPTY</a></h2>


        <div class="table-responsive">
  <table class="table table-sm table-striped">
    <thead class="thead-dark">
 <tr>
  <th>PIZZA</th>
  <th>QUANTITY</th>
  <th>PRICE</th>
  <th>SUBTOTAL</th>
  <th></th>
 </tr>
</thead>
<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>
 <?php    
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["PRODUCT_QTY"]*$item["PRODUCT_PRICE"];
    ?>
        <tr>
        <td class="PRODUCT_NAME"><img src="pizza/<?php echo $item["PRODUCT_IMAGE"]; ?>" width="35px" height="35px" /><?php echo  " " .  $item["PRODUCT_NAME"]; ?></td>
        <td class="PRODUCT_QTY" style="text-align:right;"><?php echo $item["PRODUCT_QTY"]; ?></td>
        <td class="PRODUCT_PRICE" style="text-align:right;"><?php echo $item["PRODUCT_PRICE"]. " PHP"; ?></td>
        <td style="text-align:right;"><?php echo  number_format($item_price,2). " PHP"; ?></td>
        <td style="text-align:center;"><a class='btn btn-danger btn-sm' href="customerorder.php?action=remove&PRODUCT_ID=<?php echo $item["PRODUCT_ID"]; ?>"><i class='fa fa-times' aria-hidden='true'></i></a></td>
        </tr>
        <?php
        $total_quantity += $item["PRODUCT_QTY"];
        $total_price += ($item["PRODUCT_PRICE"]*$item["PRODUCT_QTY"]);
    }
    ?>

<tr>
<td colspan="2" align="right">Total:</td>
<td align="right"><?php echo $total_quantity; ?></td>
<td align="right" colspan="2"><strong><?php echo number_format($total_price, 2). " PHP"; ?></strong></td>
<td></td>
</tr>
<?php 
}
?>
</table>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#invoicemodal"></i>PROCEED TO INVOICE</button>
</div>


</div>

<center>
  <div class="modal fade" id="invoicemodal" tabindex="-1" role="dialog" aria-labelledby="invoicemodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="Addsupplier">INVOICE <a href="#"><i class="fa fa-print" aria-hidden="true"></i></a></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="customerorder-process.php">
          <?php $invoicenum=rand(100,999); ?>
          <div class="form-group col-lg-3">
         <div class="input-group">
              <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">#</span>
            </div>
        <input class="form-control" type="text" name="ORDER_INVOICEID" value="<?php echo $invoicenum; ?>">
        </div>
      </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label col-form-label-sm">Customer Name</label>
            <div class="input-group">
            <input type="text" class="form-control form-control-sm" name="customer_name">
          </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label col-form-label-sm">Priority Number</label>
            <div class="input-group">
            <input type="number" class="form-control form-control-sm" name="priority_number" min="1" max="100">
          </div>
          </div>

        <div class="table-responsive">
  <table class="table">
 <tr>
  <th>PIZZA</th>
  <th>QUANTITY</th>
  <th>PRICE</th>
  <th>SUBTOTAL</th>
 </tr>
<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
    $productcount = 0;
?>
 <?php    
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["PRODUCT_QTY"]*$item["PRODUCT_PRICE"];
    ?> 
          <tr>
            <input type="hidden" name="PRODUCT_ID[]" value="<?php echo $item["PRODUCT_ID"];?>" />
        <td class="PRODUCT_NAME"><?php echo  " " .  $item["PRODUCT_NAME"]; ?><input type="hidden" name="PRODUCT_NAME[]" value="<?php echo $item["PRODUCT_NAME"];?>" /></td>
        <td class="PRODUCT_QTY" style="text-align:right;"><?php echo $item["PRODUCT_QTY"]; ?><input type="hidden" name="PRODUCT_QTY[]" value="<?php echo $item["PRODUCT_QTY"];?>" /></td>
<td class="PRODUCT_PRICE" style="text-align:right;"><?php echo $item["PRODUCT_PRICE"]. " PHP"; ?><input type="hidden" name="PRODUCT_PRICE[]" value="<?php echo $item["PRODUCT_PRICE"];?>" /></td>
        <td style="text-align:right;"><?php echo  number_format($item_price,2). " PHP"; ?></td>
        </tr>
        <?php
        $total_quantity += $item["PRODUCT_QTY"];
        $total_price += ($item["PRODUCT_PRICE"]*$item["PRODUCT_QTY"]);
        $productcount++;
    }
    ?>

<tr>
<td colspan="2" align="right">Total:</td>
<td align="right"><?php echo $total_quantity; ?></td>
<td align="right" colspan="2"><strong><?php echo number_format($total_price, 2); ?><input type="hidden" name="totalprice" value='<?php echo number_format($total_price, 2); ?>' /> PHP</strong></td>
<td></td>
</tr>
<?php 
}
?>
</table>


      <div class="modal-footer">
        <input type="submit" value="Check out & Pay">
      </div>
    </div>
</form>
</div>
</center>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!--<script>
 $('#save').click(function(){
  var customer_name = [];
  var priority_number = [];
  var PRODUCT_NAME = [];
  var PRODUCT_PRICE = [];
  var PRODUCT_QTY = [];
  $('.customer_name').each(function(){
   customer_name.push($(this).text());
  });
  $('.priority_number').each(function(){
   priority_number.push($(this).text());
  });
  $('.PRODUCT_NAME').each(function(){
   PRODUCT_NAME.push($(this).text());
  });
  $('.PRODUCT_PRICE').each(function(){
   PRODUCT_PRICE.push($(this).text());
  });  
  $('.PRODUCT_QTY').each(function(){
   PRODUCT_QTY.push($(this).text());
  });
  $.ajax({
   url:"customerorder-process.php",
   method:"POST",
   data:{customer_name:customer_name, priority_number:priority_number, PRODUCT_NAME:PRODUCT_NAME, PRODUCT_PRICE:PRODUCT_PRICE, PRODUCT_QTY:PRODUCT_QTY},
   success:function(data){
    alert(data);
    $("td[contentEditable='true']").text("");
    for(var i=2; i<= count; i++)
    {
     $('tr#'+i+'').remove();
    }
   }
  });
 });
</script> -->
</body>
</html>