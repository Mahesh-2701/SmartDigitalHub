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
    <title>Orders</title>
    <?php include("../assets/cdn.php") ?>
    <style>
        .order-card img {
            max-height: 120px; /* medium height */
            object-fit: cover;
        }
        .order-card .card-body h5 {
            margin-bottom: 0.3rem;
        }
        .order-card .card-body p {
            margin-bottom: 0.25rem;
            font-size: 0.95rem;
        }
        .btn-outline-success {
            padding: 0.35rem 1rem;
            font-size: 0.9rem;
            border-radius: 25px;
        }
        @media (max-width: 768px) {
            .order-card img {
                max-height: 90px;
            }
        }
    </style>
</head>
<body>
    <?php include("header.php") ?>

    <section>
        <div class="container mt-5 pt-5 border rounded p-3">
            <h2>Orders</h2>

            <?php
                $conn = new mysqli("localhost", "root", "", "ecommerce");
                $userid = $_SESSION['userid'];

                if($conn->connect_error){
                    die("Connection error");
                }

                $sql = "(SELECT orders.category_id, title, image, orders.price, description, ordered_at, payment_method, ebooks.filepath 
                         FROM orders JOIN ebooks ON orders.product_id=ebooks.ebook_id 
                         WHERE user_id={$userid} AND orders.category_id=1)
                        UNION ALL
                        (SELECT orders.category_id, title, image, orders.price, description, ordered_at, payment_method, resume.filepath 
                         FROM orders JOIN resume ON orders.product_id=resume.resume_id 
                         WHERE user_id={$userid} AND orders.category_id=2)
                        UNION ALL
                        (SELECT orders.category_id, title, image, orders.price, description, ordered_at, payment_method, portfolio.filepath 
                         FROM orders JOIN portfolio ON orders.product_id=portfolio.portfolio_id 
                         WHERE user_id={$userid} AND orders.category_id=3)
                        UNION ALL
                        (SELECT orders.category_id, title, image, orders.price, description, ordered_at, payment_method, course.filepath 
                         FROM orders JOIN course ON orders.product_id=course.course_id 
                         WHERE user_id={$userid} AND orders.category_id=4)
                        ORDER BY ordered_at DESC"; // recent orders first

                if($res = $conn->query($sql)){
                    while($row = $res->fetch_assoc()){
                        $categoryid = $row['category_id'];
                        $title = $row['title'];
                        $image = $row['image'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $orderedat = $row['ordered_at'];
                        $paymentmethod = $row['payment_method'];
                        $filepath = $row['filepath'];
            ?>
            
            <div class="card mb-3 w-100 order-card">
                <div class="row g-0">
                    <div class="col-md-4 p-2 d-flex align-items-center justify-content-center">
                        <img src="../admin/assets/<?php 
                            echo $categoryid==1?"ebooks":($categoryid==2?"resume":($categoryid==3?"portfolio":"course")); 
                        ?>/<?php echo $image ?>" class="img-fluid rounded-start" alt="product image">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $title ?></h5>
                            <p class="card-text"><?php echo substr($description,0,50)."..." ?></p>
                            <p class="card-text"><b>₹ </b><?php echo $price ?></p>
                            <p class="card-text"><b>Ordered Date:</b> <?php echo $orderedat ?></p>
                            <p class="card-text"><b>Payment By:</b> <?php echo $paymentmethod ?></p>
                            <a href="../admin/assets/<?php 
                                echo $categoryid==1?"ebooks":($categoryid==2?"resume":($categoryid==3?"portfolio":"course")); 
                            ?>/<?php echo $filepath ?>" class="btn btn-outline-success">Download</a>
                        </div>
                    </div>
                </div>
            </div>

            <?php
                    }
                }
                $conn->close();
            ?>
        </div>
    </section>

    <?php include("footer.php") ?>
</body>
</html>
