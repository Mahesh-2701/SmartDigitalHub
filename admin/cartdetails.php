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
    <title>Cart Details</title>
    <?php include("../assets/cdn.php") ?>
</head>
<body>
    <?php include("header.php") ?>
    
    <section>
        <div class="container">
            <h2>Cart Details</h2>

            <table class="table table-dark table-striped">
            
            <tr>
                <th>Cart Id</th>
                <th>User Id</th>
                <th>Category Id</th>
                <th>Product Id</th>
                <th>Price</th>
                <th>Created Date</th>
            </tr>


            <?php
                $conn=new mysqli("localhost","root","","ecommerce");

                if($conn->connect_error){
                    echo "<script>alert('connection error')</script>";
                }
                
                $sql="select * from cart";

                if($res=$conn->query($sql)){

                    while($row=$res->fetch_assoc()){

                        $cartid=$row['cart_id'];
                        $userid=$row['user_id'];
                        $categoryid=$row['category_id'];
                        $productid=$row['product_id'];
                        $price=$row['price'];
                        $createddate=$row['created_at'];

                ?>
                 
                  <tr>
                    <td><?php echo $cartid ?></td>
                    <td><?php echo $userid ?></td>
                    <td><?php echo $categoryid ?></td>
                    <td><?php echo $productid ?></td>
                    <td><?php echo $price ?></td>
                    <td><?php echo $createddate ?></td>
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