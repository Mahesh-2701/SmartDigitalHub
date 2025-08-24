<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Page</title>
    <?php include("../assets/cdn.php") ?>
</head>
<body>
     
    <?php include("header.php") ?>

     
    <!-- php section to retrive value and display the retrieved value from db and display it on this page -->

    <?php
        
        if(isset($_GET['table'])  && isset($_GET['id']) && isset($_GET['column'])){

            $tablename=$_GET['table'];
            $productcolumn=$_GET['column'];
            $productid=$_GET['id'];

            $conn=new mysqli("localhost","root","","ecommerce");

            if($conn->connect_error){
                die("error occured ");
            }

            $sql="select * from {$tablename} where {$productcolumn}={$productid}";

            if($res=$conn->query($sql)){

                if(mysqli_num_rows($res) == 1)
                {
                $row=$res->fetch_assoc();
                $categoryid=$row['category_id'];
                $title=$row['title'];
                $author=$row['author'];
                $image=$row['image'];
                $price=$row['price'];
                $description=$row['description'];
                $releaseddate=$row['released_date'];

                }
                else{
                echo "<script>alert('no data error')</script>";
                }
            }
            else{
                
                die("connection error");
            
            }
           
        }
    ?>

    <section>
        <div class="container mt-5">


            <div class="row row-lg-col-2 py-5 border rounded px-2">
                     
                <div class="col-12 col-lg-7 border rounded d-flex justify-content-center align-items-center">
                    <img src="../admin/assets/<?php echo $tablename ?>/<?php echo $image ?>" alt="productimage" class="img-fluid rounded" width="" height="">
                </div>

                <div class="col-12 col-lg-5 d-flex flex-column gap-2 justify-content-center ps-md-5">
                    <h2><?php echo $title ?></h2>
                    <h5 class="text-secondary">By <?php echo $author ?></h5>
                    <p>Released Date : <small><?php echo $releaseddate ?></small></p>
                    <div class="d-flex gap-2 align-items-center">
                      <h5>Price <h4>₹ <?php echo $price ?></h4></h5>
                    </div>
                    
                    <a href="cart.php?categoryid=<?php echo $categoryid ?>&productid=<?php echo $productid ?>&price=<?php echo $price ?>" class="btn btn-warning d-block w-50 "  >Add to Cart</a>
                    <a href="buyitem.php?table=<?php echo $tablename ?>&column=<?php echo $productcolumn ?>&productid=<?php echo $productid ?>" class="btn btn-warning d-block w-50 ">Buy Now</a>

                </div>
            </div>

            <div class="row row-col-1 my-5">

                  <div class="col-12 border rounded p-4">
                     <h3 class=" border-secondary border-bottom pb-2">Description</h3>
                     <p class="ms-5 ps-5 pt-3"><?php echo $description ?></p>
                  </div>
            </div>
        </div>
    </section>
    
    <section>
        <div class="container">
            <h2 class=" border-secondary border-bottom pb-2">Similar items</h2>
            <div class="row row-cols-1 row-cols-md-4 g-4 mt-3">

    <!-- php section to show similar items -->

    <?php
         
          $conn=new mysqli("localhost","root","","ecommerce");

            if($conn->connect_error){
                die("error occured ");
            }

            $sql="select * from $tablename limit 4";

            if($res=$conn->query($sql)){
                while($row=$res->fetch_assoc()){
                    $title=$row['title'];
                    $description=$row['description'];
                    $price=$row['price'];
                    $image=$row['image'];

    ?>

            <div class="col ">
                <div class="card d-flex flex-column gap-1 align-items-center p-2">
                <img src="../admin/assets/<?php echo $tablename ?>/<?php echo $image ?>" class="card-img-top" alt="productimage" width="140" height="200">
                <div class="card-body">
                    <h5 class="card-title text-center"><?php echo substr($title,0,40); ?></h5>
                </div>
                 <a href="<?php echo $tablename ?>.php" class="btn btn-outline-primary  d-block w-50">Visit</a>
                </div>
            </div>



    <?php
                }
            }

    ?>
           </div>
        </div>
    </section>


    <?php include("footer.php") ?>

</body>
</html>