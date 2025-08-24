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
    <title>Document</title>
    <script>
        function del(Id){
            if(confirm("If you want to Delete it?")){
                window.location.assign("resume.php?Id="+Id);
            }
        }
    </script>
    <?php
        include('../assets/cdn.php');
    ?>
</head>
<body>

    <?php include("header.php") ?>

    <section class="my-4">
        <div class="container">
            <form action="resume.php" method="POST" enctype="multipart/form-data" class="border rounded p-4 d-flex flex-column gap-2">
                <h2>Resume Details</h2>
                <input type="number" placeholder="Category Id" class="form-control" name="categoryid" required>
                <input type="text" placeholder="Resume Title" class="form-control" name="title" required>
                <input type="text" placeholder="Resume Author" class="form-control" name="author" required>
                <label class="form-label fs-5">File</label>
                <input type="file" placeholder="FilePath" class="form-control" name="file" required>
                <label class="form-label fs-5">Fileimage</label>
                <input type="file" class="form-control" placeholder="Image" name="fileimage" required>
                <input type="number" placeholder="Price" class="form-control" name="price" required>
                <textarea placeholder="Description" class="form-control" name="description"></textarea>
                <input type="date" placeholder="Released Date" class="form-control" name="date" required>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </form>
        </div>
    </section>

    <!-- php section to insert to db -->

    <?php
          
          if(isset($_POST['submit']) && !empty($_FILES['file']['name'])){

            $categoryid=filter_var(trim($_POST['categoryid']),FILTER_VALIDATE_INT);
            $title=filter_var(trim($_POST['title']),FILTER_SANITIZE_SPECIAL_CHARS);
            $author=filter_var(trim($_POST['author']),FILTER_SANITIZE_SPECIAL_CHARS);
            $price=filter_var(trim($_POST['price']),FILTER_VALIDATE_INT) ;
            $description=htmlspecialchars(trim($_POST['description'])) ;
            $date=$_POST['date'];


            $directory="assets/resume/";

            $basename=basename($_FILES['file']['name']);
            $filename=time().$basename;
            $targetdirectoryfile=$directory.$filename;

            $basenameofimage=basename($_FILES['fileimage']['name']);
            $fileimagename=time().$basenameofimage;
            $targetdirectoryfileimage=$directory.$fileimagename;
 
            $format=["jpg","png","JPG","gif","doc","ppt","txt","pdf"];
            $fileextensionoffile=pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
            $fileextensionoffileimage=pathinfo($_FILES['fileimage']['name'],PATHINFO_EXTENSION);
                      

            if(in_array($fileextensionoffile,$format)){

              if(in_array($fileextensionoffileimage,$format))
                {

                $conn=new mysqli("localhost","root","","ecommerce");

                $sql="insert into resume(title,author,image,price,description,released_date,filepath,category_id) 
                                 values('{$title}','{$author}','{$fileimagename}',{$price},'{$description}','{$date}','{$filename}',{$categoryid})";

                    if($conn->query($sql)){
                        echo "<script>alert('inserted successfully')</script>";
                    }
                    else{
                        echo "<script>alert('error')</script>";
                    }

                    

                    if(move_uploaded_file($_FILES['file']['tmp_name'],$targetdirectoryfile) && move_uploaded_file($_FILES['fileimage']['tmp_name'],$targetdirectoryfileimage)){
                                echo "<script>alert(' uploaded successfully')</script>";
                     }
                    else{
                            echo "<script>alert(' uploading')</script>";
                    }

                $conn->close();
               
               } 
               else{
                    echo "<script>alert('Sorry Please Enter Valid Fomat File(Only Jpg or Png)')</script>";
               }
            }
            else{
                echo "<script>alert('Sorry Please Enter Valid Format image(Only Jpg or Png)')</script>";
            }


          }
      
    ?>

    <!-- php section to delete from Db -->

    <?php
       
       if(isset($_GET['Id'])){

        $Id=$_GET['Id'];

        $conn=new mysqli("localhost","root","","ecommerce");

        $sql="delete from resume where resume_id={$Id}";

        if($conn->query($sql)){
            echo "<script>alert('deleted')</script";
        }
        else{
             echo "<script>alert('Connection error')</script";
        }
        
        $conn->close();
       }
    ?>

    <!-- php section to display -->

    <section>
        <div class="container-fluid">
            <h2>Resume List</h2>
               <?php
       
       $conn=new mysqli("localhost","root","","ecommerce");

        $sql="select * from resume";

        if($res=$conn->query($sql)){

    ?>
    
    <table class="table bg-dark text-light">
    <tr>
        <th>Category Id</th>
        <th>Resume ID</th>
        <th>Title</th>
        <th>Author</th>
        <th>File</th>
        <th>Image</th>
        <th>Price</th>
        <th>Description</th>
        <th>Release Date</th>
        <th>Download Count</th>
        <th>Actions</th>
    </tr>

    <?php
            
            while($row=$res->fetch_assoc()){

                $resumeid=$row['resume_id'];
                $title=$row['title'];
                $author=$row['author'];
                $file=$row['filepath'];
                $image=$row['image'];
                $price=$row['price'];
                $description=$row['description'];
                $releasedate=$row['released_date'];
                $downloadcount=$row['download_count'];
                $categoryid=$row['category_id'];

    ?>
    
    <tr>
        <td><?php echo $categoryid ?></td>
        <td><?php echo $resumeid ?></td>
        <td><?php echo $title ?></td>
        <td><?php echo $author ?></td>
        <td><a href="assets/resume/<?php echo $file ?>"><?php echo $file ?></a></td>
        <td><img src="assets/resume/<?php echo $image ?>" class="img-fluid" width="100" height="60"><small><?php echo $image ?></small></td>
        <td><?php echo $price ?></td>
        <td><?php echo substr($description,0,50) ?></td>
        <td><?php echo $releasedate ?></td>
        <td><?php echo $downloadcount ?></td>
        <td>
            <button type="button" class="btnx btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Edit
            </button>
            <button class="btn btn-danger" onclick="del(<?php echo $resumeid ?>)">Delete</button>
        </td>
    </tr>
    
    <?php

            }

    echo "</table>";    
            
        }
        else{
            echo "<script>alert('connection error')</script>";
        }
          
       $res->free();

       $conn->close();


    ?>
        </div>
    </section>


    <!-- jquery for choosing element -->
    <!-- script for getting input from above -->
     <script>
        $(document).ready(function(){
            $('.btnx').on('click',function(){
                $('#exampleModal').modal('show');
                $tr=$(this).closest('tr');
                var data=$tr.children("td").map(function(){
                    return $(this).text();
                }).get();

               $('#categoryid').val(data[0]);
               $('#resumeid').val(data[1]);
               $('#title').val(data[2]);
               $('#author').val(data[3]);
               $('#file').val(data[4])
               $('#image').val(data[5]);
               $('#price').val(data[6]);
               $('#description').val(data[7]);
               $('#date').val(data[8]);
               $('#downloadcount').val(data[9]);

            });
        });
     </script>




    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Details </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="resume.php" method="POST" enctype="multipart/form-data">
      <div class="modal-body">
                <label class="form-label">Category Id</label>
                <input type="number" placeholder="Category Id" class="form-control" id="categoryid" readonly>
                <label class="form-label">Resume Id</label>
                <input type="number" placeholder="Id" class="form-control" name="resumeid" id="resumeid" readonly>
                <label class="form-label">Title</label>
                <input type="text" placeholder="Title" class="form-control" name="title" id="title" required>
                <label class="form-label">Author</label>
                <input type="text" placeholder="Author" class="form-control" name="author" id="author" required>
                <label class="form-label">Current File</label>
                <input type="text" class="form-control" name="currentfile" id="file" required>
                <label class="form-label">File to Change</label>
                <input type="file" class="form-control" name="changedfile">
                <label class="form-label">Current Image</label>
                <input type="text" class="form-control" name="currentimage" id="image" required>
                <label class="form-label">Image to Change</label>
                <input type="file" class="form-control" name="changedimage">
                <label class="form-label">Price</label>
                <input type="number" placeholder="Price" class="form-control" name="price" id="price" required>
                <label class="form-label">Description</label>
                <textarea placeholder="Description" class="form-control" name="description" id="description"></textarea>
                <label class="form-label">Released Date</label>
                <input type="date" placeholder="Released Date" class="form-control" name="date" id="date" required>
                <label class="form-label">downloadcount</label>
                <input type="number"  class="form-control" id="downloadcount" readonly>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="update" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- php section to update details -->

<?php
     
    if(isset($_POST['update'])){
         
        $directorytostore="assets/resume/";
        $resumeid=$_POST['resumeid'];
        $title=$_POST['title'];
        $author=$_POST['author'];
        $currentfile=$_POST['currentfile'];
        $currentimage=$_POST['currentimage'];
        $price=$_POST['price'];
        $description=$_POST['description'];
        $date=$_POST['date'];


        if(!empty($_FILES['changedfile']['name'])){

            $directory="assets/resume/";
            $basename=basename($_FILES['changedfile']['name']);
            $filename=time().$basename;
            $targetdirectory=$directory.$filename;

            $allowed=["pdf","doc","docx","ppt"];
            $fileextensionoffile=pathinfo($_FILES['changedfile']['name'],PATHINFO_EXTENSION);

            if(in_array($fileextensionoffile,$allowed)){

                if(move_uploaded_file($_FILES["changedfile"]["tmp_name"],$targetdirectory)){

                    $deletefile=$directory.$currentfile;
                      
                    if(file_exists($deletefile)){
                        unlink($deletefile);
                    }
                    echo "<script>alert('file upload success and old file deleted')</script>";

                    $currentfile=$filename;
                }
                else{
                    echo "<script>alert('file upload error')</script>";
                }
            }
            else{
                echo "<script>alert('Invalid Format')</script>";
            }

        }


         if(!empty($_FILES['changedimage']['name'])){

            $directory="assets/resume/";
            $basename=basename($_FILES['changedimage']['name']);
            $fileimagename=time().$basename;
            $targetdirectory=$directory.$fileimagename;

            $allowed=["jpg","png","JPG","jpeg","gif"];
            $fileextensionoffile=pathinfo($_FILES['changedimage']['name'],PATHINFO_EXTENSION);

            if(in_array($fileextensionoffile,$allowed)){

                if(move_uploaded_file($_FILES['changedimage']['tmp_name'],$targetdirectory)){

                    $deleteimage=$directory.$currentimage;
                      
                    if(file_exists($deleteimage)){
                        unlink($deleteimage);
                    }
                    echo "<script>alert('file image upload success and old file deleted')</script>";

                    $currentimage=$fileimagename;
                }
                else{
                    echo "<script>alert('file image upload error')</script>";
                }
            }

        }

        
        $conn=new mysqli("localhost","root","","ecommerce");

        $sql="update resume set title='{$title}',author='{$author}',image='{$currentimage}',price={$price},
                          description='{$description}',released_date='{$date}',filepath='{$currentfile}' where resume_id='{$resumeid}'";

        if($conn->query($sql)){

            echo "<script>alert('update sucess')</script>";
        }
        else{
             echo "<script>alert('Connection error')</script>";
        }

        $conn->close();
        echo "<script>window.location.reload()</script>";

        }


?>

</body>
</html>