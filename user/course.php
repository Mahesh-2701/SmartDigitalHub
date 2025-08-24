<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
    <?php include("../assets/cdn.php") ?>
    <style>
        body {
            background-color: #f8f9fa;
        }

        /* Courses Section */
        #courses .card {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 6px 18px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        #courses .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.15);
        }

        #courses .card-img-top {
            border-radius: 12px;
            height: 200px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        #courses .card-img-top:hover {
            transform: scale(1.05);
        }

        #courses .card-body h5 {
            font-weight: 600;
            color: #212529;
            transition: color 0.3s ease;
        }

        #courses .card-body h5:hover {
            color: #0d6efd;
        }

        #courses .card-body p {
            color: #495057;
            font-size: 0.95rem;
        }

        #courses h2 {
            text-align: center;
            font-weight: 700;
            margin-bottom: 2rem;
            margin-top: 3rem;
            color: #212529;
        }
    </style>
</head>
<body>

    <?php include("header.php") ?>
      
   <!-- Courses Section -->
   <section id="courses">
     <div class="container mt-5">
        <h2 class="mt-5 pt-5">Our Courses</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4 mt-5 ">

        <!-- PHP section to display courses dynamically -->
        <?php
            $conn = new mysqli("localhost","root","","ecommerce");

            $tablename = "course";
            $tableuniquecolumn = "course_id";

            $sql = "SELECT course_id, title, description, image FROM {$tablename}";

            if($conn->connect_error){
                die("Connection error");
            }

            if($res = $conn->query($sql)){
                while($row = $res->fetch_assoc()){
                    $courseid = $row['course_id'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $image = $row['image'];
        ?>
             
        <div class="col">
            <div class="card p-3 h-100">
             <a href="productsviewpage.php?table=<?php echo $tablename ?>&id=<?php echo $courseid ?>&column=<?php echo $tableuniquecolumn ?>">
                 <img src="../admin/assets/course/<?php echo $image ?>" class="card-img-top" alt="<?php echo $title ?>">
             </a>
             <div class="card-body">
                <a href="productsviewpage.php?table=<?php echo $tablename ?>&id=<?php echo $courseid ?>&column=<?php echo $tableuniquecolumn ?>" class="text-decoration-none">
                    <h5 class="card-title"><?php echo $title ?></h5>
                </a>
                <p class="card-text"><?php echo substr($description,0,80)."..." ?></p>
             </div>
            </div>
        </div>

        <?php
                }
            } else {
                die("Connection error");
            }

            $res->free();
            $conn->close();
        ?>
            
        </div>
     </div>
   </section>

    <?php include("footer.php") ?>
</body>
</html>
