<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume Templates</title>
    <?php include("../assets/cdn.php") ?>
    <style>
        body {
            background-color: #f8f9fa;
        }

        /* Resume Section */
        #resume h1 {
            text-align: center;
            font-weight: 700;
            margin-top: 3rem;
            margin-bottom: 2rem;
            color: #212529;
        }

        #resume .card {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 6px 18px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        #resume .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.15);
        }

        #resume .card-img-top {
            height: 300px;
            object-fit: cover;
            border-radius: 12px;
            transition: transform 0.5s ease;
        }

        #resume .card-img-top:hover {
            transform: scale(1.05);
        }

        #resume .card-body h5 {
            font-weight: 600;
            color: #212529;
            transition: color 0.3s ease;
        }

        #resume .card-body h5:hover {
            color: #0d6efd;
        }

        #resume .card-body p {
            color: #495057;
            font-size: 0.95rem;
        }
    </style>
</head>
<body>

    <?php include("header.php") ?>

    <section id="resume">
        <div class="container pt-5">
            <h1 class="mt-5 pt-5">Resume Templates</h1>

            <div class="row row-cols-1 row-cols-md-3 g-4 my-3">
                <?php
                    $conn = new mysqli("localhost","root","","ecommerce");

                    $tablename = "resume";
                    $tableuniquecolumn = "resume_id";

                    if($conn->connect_error){
                        die("Connection error");
                    }

                    $sql = "SELECT resume_id, title, description, image FROM {$tablename}";

                    if($res = $conn->query($sql)){
                        while($row = $res->fetch_assoc()){
                            $id = $row['resume_id'];
                            $title = $row['title'];
                            $image = $row['image'];
                            $description = $row['description'];
                ?>
                
                <div class="col">
                    <div class="card h-100 p-3">
                        <a href="productsviewpage.php?table=<?php echo $tablename ?>&column=<?php echo $tableuniquecolumn ?>&id=<?php echo $id ?>">
                            <img src="../admin/assets/resume/<?php echo $image ?>" class="card-img-top" alt="<?php echo $title ?>">
                        </a>
                        <div class="card-body">
                            <a href="productsviewpage.php?table=<?php echo $tablename ?>&column=<?php echo $tableuniquecolumn ?>&id=<?php echo $id ?>" class="text-decoration-none">
                                <h5 class="card-title"><?php echo $title ?></h5>
                            </a>
                            <p class="card-text"><?php echo substr($description,0,80)."..." ?></p>
                        </div>
                    </div>
                </div>

                <?php
                        }
                    } else {
                        die("Execution error");
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
