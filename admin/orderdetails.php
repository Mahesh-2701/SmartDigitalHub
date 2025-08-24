<?php
   session_start();

   if(!isset($_SESSION['admin'])){
       header("location:index.php");
   }
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <?php include("../assets/cdn.php") ?>
</head>
<body>
    <?php include("header.php") ?>
    
    <section>
        <div class="container">
            <h2>Order Details</h2>

            <table class="table table-dark table-striped">
            
            <tr>
                <th>Order Id</th>
                <th>User Id</th>
                <th>Category Id</th>
                <th>Product Id</th>
                <th>Price</th>
                <th>Ordered Date</th>
                <th>Payment Method</th>
                <th>Address</th>
                <th>Phone no</th>
            </tr>


            <?php
                $conn=new mysqli("localhost","root","","ecommerce");

                if($conn->connect_error){
                    echo "<script>alert('connection error')</script>";
                }
                
                $sql="select * from orders";

                if($res=$conn->query($sql)){

                    while($row=$res->fetch_assoc()){

                        $orderid=$row['order_id'];
                        $userid=$row['user_id'];
                        $categoryid=$row['category_id'];
                        $productid=$row['product_id'];
                        $price=$row['price'];
                        $ordereddate=$row['ordered_at'];
                        $paymentmethod=$row['payment_method'];
                        $address=$row['address'];
                        $phoneno=$row['phoneno']

                ?>
                 
                  <tr>
                    <td><?php echo $orderid ?></td>
                    <td><?php echo $userid ?></td>
                    <td><?php echo $categoryid ?></td>
                    <td><?php echo $productid ?></td>
                    <td><?php echo $price ?></td>
                    <td><?php echo $ordereddate ?></td>
                    <td><?php echo $paymentmethod ?></td>
                    <td><?php echo $address ?></td>
                    <td><?php echo $phoneno ?></td>
                  </tr>
                
                <?php
                    }

                   
                }

                $conn->close();
            ?>

            </table>
            
        </div>
    </section>
</body>
</html>