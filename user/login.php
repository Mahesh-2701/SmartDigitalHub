<?php
   session_start();

   if(isset([$_SESSION]['username'])){
        header("location:index.php");
   }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <?php include("../assets/cdn.php") ?>

</head>
<body>

    <?php include("header.php") ?>

    <!-- login form -->
    <section>
        <div class="container d-flex justify-content-center my-5 p-5 ">
            <form action="login.php" method="POST" class="border rounded-2 w-50 d-flex flex-column gap-3 text-center my-5 p-3">
                <h2>Login</h2>
                <input type="email" placeholder="Email" name="email" class="form-control" required>
                <input type="password" placeholder="Password" name="password" class="form-control" required>
                <button type="submit" name="submit" class="btn btn-primary">Login</button>
                <a href="signup.php">Don't Have an Account ? Signup</a>
            </form>
        </div>
    </section>

    <!-- php section to validate login -->
    
    <?php
       if(isset($_POST['submit'])){

        $email=filter_var(trim($_POST['email']),FILTER_VALIDATE_EMAIL);
        $password=trim($_POST['password']);

        $conn=new mysqli("localhost","root","","ecommerce");

        if($conn->connect_error){
            echo "<script>alert('connection error')</script>";
        }

        $sql="select * from user where email='{$email}' and password='{$password}'";

        if($res=$conn->query($sql)){
            if(mysqli_num_rows($res) == 1){
                $row=$res->fetch_assoc();
                $id=$row['user_id'];
                $email=$row['email'];
                $image=$row['img'];
                $name=$row['name'];
                $_SESSION['username']=$email;
                $_SESSION['userid']=$id;
                $_SESSION['image']=$image;
                $_SESSION['name']=$name;
                echo "<script>alert('Login Sucess')</script>";
                echo "<script>window.location.href='index.php'</script>";
            }
            else{
             echo "<script>alert('Invalid Username or Password')</script>";
            }
        }
        


       }
    ?>

    <?php include("footer.php") ?>
</body>
</html>