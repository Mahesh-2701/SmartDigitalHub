<?php
session_start();

if(!isset($_SESSION['username'])){
    echo "<script>alert('Please Login to Continue for Cart')</script>";
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
    <?php include("../assets/cdn.php") ?>
    <style>
        .cart-card img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
        }
        .cart-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .cart-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }
        .checkout-form {
            max-width: 600px;
            margin-top: 30px;
        }
        .checkout-form label {
            font-weight: 500;
        }
        .checkout-form input, .checkout-form textarea {
            margin-bottom: 15px;
        }
        .checkout-form .payment-methods label {
            margin-right: 20px;
            font-weight: normal;
        }
    </style>
    <script>
        function delitem(cartid){
            if(confirm("Are you sure want to delete the item from cart?")){
                window.location.assign("cart.php?delitem="+cartid);
            }
        }
    </script>
</head>
<body>
    <?php include("header.php") ?>

    <?php
        // Delete item from cart
        if(isset($_GET['delitem'])){
            $delitem=$_GET['delitem'];
            $conn=new mysqli("localhost","root","","ecommerce");
            if($conn->connect_error){ die("Connection error"); }
            $sql="DELETE FROM cart WHERE cart_id ={$delitem}";
            $conn->query($sql);
            $conn->close();
            echo "<script>window.location='cart.php'</script>";
        }

        // Add item to cart if passed via GET
        if(isset($_GET['categoryid']) && isset($_GET['productid']) && isset($_GET['price'])){
            $userid=$_SESSION['userid'];
            $categoryid=$_GET['categoryid'];
            $productid=$_GET['productid'];
            $price=$_GET['price'];

            $conn=new mysqli("localhost","root","","ecommerce");
            if($conn->connect_error){ die("Connection error"); }

            $sql = "INSERT INTO cart (user_id, category_id, product_id, price) VALUES ({$userid},{$categoryid},{$productid},{$price})
                    ON DUPLICATE KEY UPDATE category_id= values(category_id),product_id=values(product_id),price=values(price)";

            $conn->query($sql);
            $conn->close();
        }
    ?>

    <section>
        <div class="container mt-5 pt-5">
            <h2 class="mb-4">My Shopping Cart</h2>

            <div class="row row-cols-1 row-cols-md-2 g-4">
                <?php
                    $categoryidarray = [];
                    $productidarray = [];
                    $pricearray = [];
                    $i = 0;
                    $itemscount = 0;
                    $totalprice = 0;

                    $conn = new mysqli("localhost","root","","ecommerce");
                    $userid = $_SESSION['userid'];

                    $sql = "
                        SELECT cart_id,title, image, ebooks.price,cart.category_id,description,cart.product_id 
                        FROM cart JOIN ebooks ON cart.product_id = ebooks.ebook_id WHERE user_id = {$userid} AND cart.category_id = 1
                        UNION ALL
                        SELECT cart_id,title, image, resume.price,cart.category_id ,description,cart.product_id 
                        FROM cart JOIN resume ON cart.product_id = resume.resume_id WHERE user_id = {$userid} AND cart.category_id = 2
                        UNION ALL
                        SELECT cart_id,title, image, portfolio.price,cart.category_id ,description,cart.product_id 
                        FROM cart JOIN portfolio ON cart.product_id = portfolio.portfolio_id WHERE user_id = {$userid} AND cart.category_id = 3
                        UNION ALL
                        SELECT cart_id,title, image, course.price,cart.category_id ,description,cart.product_id 
                        FROM cart JOIN course ON cart.product_id = course.course_id WHERE user_id = {$userid} AND cart.category_id = 4
                    ";

                    if($res = $conn->query($sql)){
                        while($row=$res->fetch_assoc()){
                            $cartid = $row['cart_id'];
                            $categoryid = $row['category_id'];
                            $productid = $row['product_id'];
                            $image = $row['image'];
                            $title = $row['title'];
                            $description = $row['description'];
                            $price = $row['price'];

                            $categoryidarray[$i] = $categoryid;
                            $productidarray[$i] = $productid;
                            $pricearray[$i] = $price;
                            $i++;

                            $totalprice += $price;
                            $itemscount++;
                ?>
                <div class="col">
                    <div class="card cart-card p-3 h-100 d-flex flex-row align-items-center gap-3">
                        <img src="../admin/assets/<?php 
                            echo $categoryid==1?'ebooks':($categoryid==2?'resume':($categoryid==3?'portfolio':'course')); ?>/<?php echo $image ?>" alt="Product" class="img-fluid">
                        <div class="flex-grow-1">
                            <h5><?php echo $title ?></h5>
                            <p class="mb-1"><?php echo substr($description,0,80)."..." ?></p>
                            <p><b>Price:</b> ₹ <?php echo $price ?></p>
                            <button class="btn btn-danger btn-sm" onclick="delitem(<?php echo $cartid ?>)">Delete</button>
                        </div>
                    </div>
                </div>
                <?php
                        }
                        $conn->close();
                    }
                ?>
            </div>

            <div class="checkout-form border p-4 mt-4 rounded">
                <h4>Checkout</h4>
                <p><b>Total Items:</b> <?php echo $itemscount ?> &nbsp; | &nbsp; <b>Total Amount:</b> ₹ <?php echo $totalprice ?></p>
                <form action="buyitems.php" method="POST">
                    <label>Phone Number</label>
                    <input type="text" class="form-control" name="phoneno" required>
                    <label>Delivery Address</label>
                    <textarea class="form-control" name="address" placeholder="Address" required></textarea>

                    <label>Payment Method</label>
                    <div class="payment-methods mb-3">
                        <input type="radio" name="paymentmethod" value="credit/debit card" required> Credit/Debit Card
                        &nbsp;&nbsp;
                        <input type="radio" name="paymentmethod" value="upi" required> UPI
                        &nbsp;&nbsp;
                        <input type="radio" name="paymentmethod" value="cash on delivery" required> Cash on Delivery
                    </div>

                    <input type="hidden" name="categoryid" value="<?php echo implode(",", $categoryidarray); ?>">
                    <input type="hidden" name="productid" value="<?php echo implode(",", $productidarray); ?>">
                    <input type="hidden" name="price" value="<?php echo implode(",", $pricearray); ?>">

                    <button class="btn btn-primary w-50 d-block mx-auto" name="proceed" type="submit">Proceed</button>
                </form>
            </div>
        </div>
    </section>

    <?php include("footer.php") ?>
</body>
</html>
