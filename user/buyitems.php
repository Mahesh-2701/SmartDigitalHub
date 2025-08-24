<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("location:login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include("../assets/cdn.php") ?>
</head>
<body>
    <?php include("header.php") ?>

    <section>
        <div class="container mt-5 pt-5">
              
          
        <?php

         if(isset($_POST['proceed'])){

            $categoryidarr=explode(",",$_POST['categoryid']);
            $productidarr=explode(",",$_POST['productid']);
            $pricearr=explode(",",$_POST['price']);
            

            $userid=$_SESSION['userid'];
            
            
            $address=$_POST['address'];
            $paymentmethod=$_POST['paymentmethod'];
            $phoneno=$_POST['phoneno'];
            

            $conn=new mysqli("localhost","root","","ecommerce");

            
            for($i=0;$i<count($productidarr);$i++){

                 $sql="insert into orders(user_id,category_id,product_id,price,address,payment_method,phoneno) values({$userid},{$categoryidarr[$i]},{$productidarr[$i]}
                                            ,{$pricearr[$i]},'{$address}','{$paymentmethod}',{$phoneno})";

                 $conn->query($sql);
            }

            $sql1="delete from cart where user_id={$userid}";

            $conn->query($sql1);

            echo "<script>alert('Thanks For Order, Order was placed successfully. Please Visit Your Buyed Product in Orders Page')</script>";

            $conn->close();

             echo "<script>window.location.href='index.php'</script>";

            }
            else{
                echo "<script>alert('Cart is empty!')</script>";
                echo "<script>window.location.href='cart.php'</script>";
            }
        ?>

        </div>
    </section>

    

    <?php include("footer.php") ?>
</body>
</html>