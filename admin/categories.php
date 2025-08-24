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
    <title>Categories</title>
    <script>
        function del(sno){
           if(confirm("If you want to Delete it?")){
             window.location.assign("categories.php?Id="+sno);
           }
        }
    </script>
    <?php
        include('../assets/cdn.php');
    ?>
</head>
<body>

    <?php include("header.php") ?>


    <section>
        <div class="container">
            <div class="w-100 d-flex justify-content-center my-5">
           <form action="categories.php" method="POST" class="d-flex flex-column align-items-center gap-2 w-50 rounded border p-3">
            <h2>Enter Details</h2>
            <input type="number" class="form-control" name="id" placeholder="Admin Id">
            <input type="Text" class="form-control" name="name" placeholder="Category Name">
            <button type="submit" name="submit" class="btn btn-dark">Submit</button>
           </form> 
           </div>
        </div>
    </section>

    <!-- php section  to insert-->

    <?php
       
       if(isset($_POST['submit'])){

        $adminid=filter_var(trim($_POST['id']),FILTER_VALIDATE_INT);
        $categoryname=htmlspecialchars(trim($_POST['name']));

        $conn=new mysqli("localhost","root","","ecommerce");

        $sql="insert into categories(name,admin_id) values('{$categoryname}',{$adminid})";

        if($conn->query($sql)){
            echo "<script>alert('inserted successfully')</script>";
        }
        else{
            echo "<script>alert('error')</script>";
        }

        $conn->close();

       }
    ?>


    <!-- php section to delete the content -->

    <?php
         
         if(isset($_GET['Id'])){

            $id=$_GET['Id'];

            $conn=new mysqli("localhost","root","","ecommerce");

            $sql="delete from categories where category_id={$id} ";

            if($conn->query($sql)){
                echo "<script>alert(Deleted Succesfully);</script>";
            }
            else{
                echo "<script>alert('error')</script>";
            }

            $conn->close();
         }


     ?>

    <!-- php section 2 to display when items in categories -->

    <section>
        <div class="container p-5">
            <h2>Category List</h2>
            <?php
               
               echo "<table class='table table-dark'>";
               echo "<tr>";
               echo "<th>Sno</th>";
               echo "<th>Name</th>";
               echo "<th>Actions</th>";
               echo "<tr>";

               $conn=new mysqli("localhost","root","","ecommerce");

               $sql="select * from categories";

               if($res=$conn->query($sql)){
                    
                  if(mysqli_num_rows($res)==0){
                    echo "<tr>No Data Found</tr>";
                  }
                  else{

                    while($row=$res->fetch_assoc()){
                          $sno=$row['category_id'];
                          $name=$row['name'];

            ?>
            
            
                          <tr>
                          <td><?php echo $sno ?></td>
                          <td><?php echo $name ?></td>
                          <td>
                            <button type="button" class="btnx btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Edit
                            </button>
                            <button class="btn btn-danger" onclick="del(<?php echo $sno ?>)" >Delete</button>
                          </td>
                          </tr>

            <?php              
                    }
                  }



               }
               else{
                echo "<script>alert('error')</script>";
               }
                  
               $conn->close();

              echo "<table>";
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

                $('#categoryno').val(data[0]);
                $('#name').val(data[1]);

            });
        });
     </script>

    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Details</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="categories.php" method="POST">
      <div class="modal-body">
            <input type="number" class="form-control mb-2" name="categoryid" id="categoryno" readonly>
            <input type="text" class="form-control" name="name" placeholder="Category Name" id="name"> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="savechanges" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

     <!-- php script to update the details -->

     <?php
          
          if(isset($_POST['savechanges'])){

            $categoryid=$_POST['categoryid'];
            $name=htmlspecialchars(trim($_POST['name']));

            $conn=new mysqli("localhost","root","","ecommerce");

            $sql="update categories set name='{$name}' where category_id={$categoryid}";

            if($conn->query($sql)){
                echo "<script>alert('Updated')</script>";
            }
            else{
                echo "<script>alert('error')</script>";
            }

            $conn->close();

            echo "<script>window.location.reload();</script>";
          }
     ?>

</body>
</html>