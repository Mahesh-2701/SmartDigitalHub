<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Signup</title>
<?php include("../assets/cdn.php") ?>
<style>
    /* Form Styling */
    .signup-form {
        max-width: 500px;
        width: 100%;
        border: 1px solid #ddd;
        border-radius: 12px;
        padding: 30px;
        background-color: #fff;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }
    .signup-form h2 {
        text-align: center;
        margin-bottom: 20px;
    }
    .form-check {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .btn-submit {
        border-radius: 25px;
        padding: 0.6rem 1.5rem;
        width: 100%;
    }
    .signup-link {
        display: block;
        text-align: center;
        margin-top: 10px;
        color: #0d6efd;
        text-decoration: none;
    }
    .signup-link:hover {
        text-decoration: underline;
    }
</style>
</head>
<body>

<?php include("header.php") ?>

<!-- Signup Form Section -->
<section class="py-5" style="background-color:#f8f9fa;">
    <div class="container d-flex justify-content-center">
        <form action="signup.php" method="POST" class="signup-form d-flex flex-column gap-3" enctype="multipart/form-data">
            <h2>Create Account</h2>
            <input type="text" name="name" placeholder="Full Name" class="form-control" required>
            <input type="email" name="email" placeholder="Email" class="form-control" required>
            <input type="password" name="password" placeholder="Password" class="form-control" required>
            <input type="number" name="phonenumber" placeholder="Phone Number" class="form-control" required>
            
            <label class="form-label">Profile Image</label>
            <input type="file" name="image" class="form-control">

            <label class="form-label mt-2">Gender</label>
            <div class="d-flex gap-3">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" value="male" id="genderMale" required>
                    <label class="form-check-label" for="genderMale">Male</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" value="female" id="genderFemale" required>
                    <label class="form-check-label" for="genderFemale">Female</label>
                </div>
            </div>

            <textarea name="address" placeholder="Address" class="form-control" rows="3" required></textarea>

            <button type="submit" name="submit" class="btn btn-primary btn-submit">Sign Up</button>
            <a href="login.php" class="signup-link">Already have an account? Login</a>
        </form>
    </div>
</section>

<!-- PHP Section to handle signup -->
<?php
try {
    if(isset($_POST['submit'])){

        $name=htmlspecialchars(filter_var(trim($_POST['name']),FILTER_SANITIZE_SPECIAL_CHARS));
        $email=filter_var(trim($_POST['email']),FILTER_VALIDATE_EMAIL);
        $password=trim($_POST['password']);
        $phone=htmlspecialchars(filter_var(trim($_POST['phonenumber']),FILTER_VALIDATE_INT));
        $gender=htmlspecialchars(filter_var(trim($_POST['gender']),FILTER_SANITIZE_SPECIAL_CHARS));
        $address=htmlspecialchars(trim($_POST['address']));
        $img=null;

        if(!empty($_FILES['image']['name'])){
            $directory="assets/users/";
            $basename=basename($_FILES['image']['name']);
            $imagename=time().$basename;
            $targetdir=$directory.$imagename;
            $filepathextension=pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
            $allowed=["jpg","jpeg","png","JPG","JPEG"];
            if(in_array($filepathextension,$allowed)){
                move_uploaded_file($_FILES['image']['tmp_name'],$targetdir);
                $img=$imagename;
            } else {
                echo "<script>alert('Invalid file format. Use JPG, JPEG, or PNG.')</script>";
                die();
            }
        }

        $conn=new mysqli("localhost","root","","ecommerce");
        if($conn->connect_error){
            echo "<script>alert('Connection error')</script>";
        }

        $sql="INSERT INTO user(name,email,password,phoneno,gender,address,img) 
              VALUES('{$name}','{$email}','{$password}',{$phone},'{$gender}','{$address}','{$img}')";

        if($conn->query($sql)){
            echo "<script>alert('Signup Successful');window.location.href='login.php'</script>";
        } else {
            echo "<script>alert('Signup Error')</script>";
        }

        $conn->close();
    }
} catch(Exception $error){
    echo '<script>alert("An error occurred: '.$error->getMessage().'")</script>';
}
?>

<?php include("footer.php") ?>
</body>
</html>
