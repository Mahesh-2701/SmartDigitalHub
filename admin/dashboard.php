<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("location:index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php include("../assets/cdn.php") ?>
</head>

<body>
    
    <?php include("header.php") ?>

    <section>
        <div class="container d-flex justify-content-center mt-5">
            <div class="d-flex flex-column gap-2 w-75">
                <a href="categories.php" class="btn btn-outline-dark btn-lg">Categories</a>
                <a href="ebook.php" class="btn btn-outline-dark btn-lg">Ebooks</a>
                <a href="resume.php" class="btn btn-outline-dark btn-lg">Resumes</a>
                <a href="portfolio.php" class="btn btn-outline-dark btn-lg">Portfolio</a>
                <a href="course.php" class="btn btn-outline-dark btn-lg">Courses</a>
                <a href="cartdetails.php" class="btn btn-outline-dark btn-lg">User's Cart Items</a>
                <a href="orderdetails.php" class="btn btn-outline-dark btn-lg">Orders</a>
            </div>
        </div>
    </section>
</body>

</html>