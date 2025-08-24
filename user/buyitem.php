<?php
    session_start();

    if(!isset($_SESSION['username'])){
        header('location:login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Page</title>
    <?php include('../assets/cdn.php') ?>
</head>
<body>
    <?php include('header.php') ?>
  
    <!-- php section to place order -->

    <?php
        
        if(isset($_POST['price'])){

            $userid=$_POST['userid'];
            $categoryid=$_POST['categoryid'];
            $productid=$_POST['productid'];
            $price=$_POST['price'];
            $address=$_POST['address'];
            $paymentmethod=$_POST['paymentmethod'];
            $phoneno=$_POST['phoneno'];

            $conn=new mysqli("localhost","root","","ecommerce");

            if($conn->connect_error){
                die("error occured ");
            }

            $sql="insert into orders(user_id,category_id,product_id,price,address,phoneno,payment_method) values({$userid},{$categoryid},
                          {$productid},{$price},'{$address}',{$phoneno},'{$paymentmethod}')";

            if($conn->query($sql))
            {
               echo "<script>alert('Thanks For Order, Order was placed successfully. Please Visit Your Buyed Product in Orders Page')</script>";

            }
            else{
                die("error");
                header("location:index.php");
            }

            $conn->close();
             echo "<script>window.location.href='index.php'</script>";
        }

    ?>

    <section>
        <div class="container mt-5 pt-5 border rounded">
            <h2 class="my-2">Order Details</h2>

    <?php 

         $categoryid=0;
         $productid=0;
         $price=0;

         
        if(isset($_GET['table']) && isset($_GET['column']) && isset($_GET['productid'])){


            $tablename=$_GET['table'];
            $productcolumn=$_GET['column'];       
            $productid=$_GET['productid'];
            $userid=$_SESSION['userid'];

            $conn=new mysqli("localhost","root","","ecommerce");

            if($conn->connect_error){
                die("error occured ");
            }

            $sql="select * from {$tablename} where {$productcolumn}={$productid}";

            if($res=$conn->query($sql)){
               
                if(mysqli_num_rows($res)== 1){
                    $row=$res->fetch_assoc();
                    
                    $categoryid=$row['category_id'];
                    $title=$row['title'];
                    $image=$row['image'];
                    $price=$row['price'];
                    $description=$row['description'];


    ?>
    
    
        <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4 d-flex align-items-center justify-content-center">
                    <img src="../admin/assets/<?php echo $tablename ?>/<?php echo $image ?>" class="img-fluid rounded-start" alt="product image" width="100px">
                    </div>
                    <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $title ?></h5>
                        <p class="card-text"><?php echo $description ?></p>
                        <p class="card-text"><small class="text-body-secondary"><b>₹</b><?php echo $price ?></small></p>
                    </div>
                    </div>
                </div>
        </div>

    <?php
                }
            }

            $conn->close();

        }
    ?>


          <h2>Payment Details</h2>

          <?php

            $userid=$_SESSION['userid'];
               
            $conn=new mysqli("localhost","root","","ecommerce");

            if($conn->connect_error){
                die("error occured ");
            }

            $sql="select * from user where user_id= {$userid}";

            if($res=$conn->query($sql)){
                if(mysqli_num_rows($res)==1){
                    $row=$res->fetch_assoc();
                    $name=$row['name'];
                    $phno=$row['phoneno'];
                    $address=$row['address'];


         ?> 
           
            <form action="buyitem.php" method="POST" class="border rounded p-3">
              <label class="form-label">Name</label>
              <input type="text" class="form-control" value="<?php echo $name ?>" readonly>
              <label class="form-label">Phone number</label>
              <input type="text" class="form-control" value="<?php echo $phno ?>" name="phoneno" required>
              <label class="form-label">User Address</label>
              <input type="text" class="form-control" value="<?php echo $address ?>" readonly>
              <label class="form-label">Delivery Address</label>
              <textarea class="form-control" name="address" placeholder="Address" required></textarea>

              <label class="form-label">Payment Method</label>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="paymentmethod" value="credit/debit card" required>
                <label class="form-check-label" >
                    Credit/Debit Card
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="paymentmethod" value="upi" required>
                <label class="form-check-label">
                    UPI
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="paymentmethod" value="cash on delivery" required>
                <label class="form-check-label" >
                    Cash on Delivery
                </label>


                <!-- user and category and product details -->
                <input type="text" class="form-control d-none" value="<?php echo $userid ?>" name="userid">
                <input type="text" class="form-control d-none" value="<?php echo $categoryid ?>" name="categoryid">
                <input type="text" class="form-control d-none" value="<?php echo $productid ?>" name="productid">



                <button class="btn btn-primary d-block m-2 mx-auto w-50 form-control" type="submit" name="price" value="<?php echo $price ?>">Total Price : <?php echo $price ?></button>
                </div>
          </form>
         
         
         <?php
                }
            }

            $conn->close();
          ?>

         
          
        </div>
    </section>





    <?php include('footer.php') ?>
</body>
</html>