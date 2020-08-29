<?php include 'check_connection.php' ?>


<?php 
$id = $_GET['name'];
          $sql2 = mysqli_query($conn, "SELECT c.*, co.*, oi.* FROM customer_order AS co, customer AS c, order_invoice AS oi WHERE oi.CUSTOMER_ORDERID=co.CUSTOMER_ORDERID AND co.CUSTOMER_NAME=c.CUSTOMER_NAME AND co.CUSTOMER_NAME = $id");
          $count=0;
          while ($row = $sql2->fetch_assoc()){
            if ($count<1) {
            echo "<center>" . $row['ORDER_INVOICEID'] . "</center>";
            echo $id;
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
          $total_price = ($row["PRODUCT_PRICE"]*$row["PRODUCT_QTY"]);
          echo "<td>" . $row['PRODUCT_NAME'] . "</td>" . "<td>" . $row['PRODUCT_QTY'] . "</td>" . "<td>" . $row['PRODUCT_PRICE'] . "</td>" . "<td>" . $total_price . "</td>";
          echo "</tr>";
          }
          echo "<tr>" . $row['ORDER_INVOICE_AMOUNT'] . "</tr>";
          ?>