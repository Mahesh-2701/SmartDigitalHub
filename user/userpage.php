<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");
    exit();
}

$useremail= $_SESSION['username'];

$conn=new mysqli("localhost","root","","ecommerce");
if($conn->connect_error){
    die("Connection error");
}

$sql="SELECT * FROM user WHERE email='{$useremail}'";
if($res=$conn->query($sql)){
    $row=$res->fetch_assoc();
    $name=$row['name'];
    $email=$row['email'];
    $password=$row['password'];
    $phno=$row['phoneno'];
    $gender=$row['gender'];
    $address=$row['address'];
    $image=$row['img'];
    $userid=$row['user_id'];
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Account - SmartDigitalHub</title>
<?php include("../assets/cdn.php") ?>
<style>
.container {
    max-width: 900px;
}
h2 {
    font-weight: 700;
    margin-bottom: 2rem;
    text-align: center;
    color: #212529;
}

/* Profile Card */
.user-card {
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    padding: 2rem 1.5rem;
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.user-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.15);
}
.user-card img {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border-radius: 50%;
    border: 3px solid #6c63ff;
    margin-bottom: 1rem;
}
.user-card h5 {
    font-weight: 600;
    margin-bottom: 0.3rem;
}
.user-card p {
    color: #6c757d;
    font-size: 0.95rem;
    margin-bottom: 0.3rem;
}

/* Form Card */
.form-card {
    background: #fff;
    border-radius: 15px;
    padding: 2rem 1.5rem;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}
.form-card label {
    font-weight: 500;
}
.form-card input, .form-card textarea {
    border-radius: 8px;
    border: 1px solid #ced4da;
    padding: 0.6rem 1rem;
    width: 100%;
    margin-bottom: 1rem;
}
.form-card input:focus, .form-card textarea:focus {
    border-color: #6c63ff;
    outline: none;
    box-shadow: 0 0 10px rgba(108, 99, 255, 0.2);
}
.form-card button {
    background-color: #6c63ff;
    color: #fff;
    border-radius: 50px;
    padding: 0.6rem 2rem;
    font-weight: 600;
    border: none;
    transition: all 0.3s ease;
}
.form-card button:hover {
    background-color: #5950d4;
    transform: scale(1.05);
}
@media(max-width:768px){
    .user-card, .form-card {
        margin-bottom: 2rem;
    }
}
</style>
</head>
<body>

<?php include("header.php") ?>

<section>
<div class="container my-5 pt-5">
    <h2><?php echo $_SESSION['username'] ?> Account</h2>

    <div class="row g-4 mt-4">
        <!-- Profile Card -->
        <div class="col-md-4">
            <div class="user-card">
                <img src="assets/users/<?php echo $image ?>" alt="Profile Image">
                <h5><?php echo $name ?></h5>
                <p><?php echo $email ?></p>
                <p><?php echo $phno ?></p>
                <p><?php echo $gender ?></p>
            </div>
        </div>

        <!-- Edit Form -->
        <div class="col-md-8">
            <div class="form-card">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label>Name</label>
                            <input type="text" name="name" value="<?php echo $name ?>">
                        </div>
                        <div class="col-md-6">
                            <label>Password</label>
                            <input type="password" name="password" value="<?php echo $password ?>">
                        </div>
                        <div class="col-md-6">
                            <label>Phone Number</label>
                            <input type="number" name="phno" value="<?php echo $phno ?>">
                        </div>
                        <div class="col-md-6">
                            <label>Gender</label>
                            <input type="text" name="gender" value="<?php echo $gender ?>">
                        </div>
                        <div class="col-md-6">
                            <label>Profile Image</label>
                            <input type="text" value="<?php echo $image ?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label>Change Image</label>
                            <input type="file" name="changedimage">
                        </div>
                        <div class="col-12">
                            <label>Address</label>
                            <textarea name="address" rows="3"><?php echo $address ?></textarea>
                        </div>
                        <div class="col-12 text-end">
                            <button type="submit" name="update">Update Details</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</section>

<?php
if(isset($_POST['update'])){
    $name=htmlspecialchars(filter_var(trim($_POST['name']),FILTER_SANITIZE_SPECIAL_CHARS));
    $password=trim($_POST['password']);
    $phno=htmlspecialchars(filter_var(trim($_POST['phno']),FILTER_VALIDATE_INT));
    $gender=htmlspecialchars(filter_var(trim($_POST['gender']),FILTER_SANITIZE_SPECIAL_CHARS));
    $address=htmlspecialchars(trim($_POST['address']));
    $image=$_POST['image'];

    if(!empty($_FILES['changedimage']['name'])){
        $directory="assets/users/";
        $basename=basename($_FILES['changedimage']['name']);
        $imagename=time().$basename;
        $targetdir=$directory.$imagename;
        $filepathextension=pathinfo($_FILES['changedimage']['name'],PATHINFO_EXTENSION);
        $allowed=["jpg","jpeg","png","JPG","JPEG"];

        if(in_array($filepathextension,$allowed)){
            if(move_uploaded_file($_FILES['changedimage']['tmp_name'],$targetdir)){
                $deletefile=$directory.$image;
                if(file_exists($deletefile)) unlink($deletefile);
                $image=$imagename;
                $_SESSION['image']=$image;
            }
        }else{
            echo "<script>alert('Invalid file format')</script>";
            die();
        }
    }

    $conn=new mysqli("localhost","root","","ecommerce");
    if($conn->connect_error){ echo "<script>alert('Connection error')</script>"; }

    $sql="UPDATE user SET name='{$name}', password='{$password}', phoneno={$phno}, gender='{$gender}', address='{$address}', img='{$image}' WHERE user_id={$userid}";

    if($conn->query($sql)){
        echo "<script>alert('Update Successful'); window.location.reload();</script>";
    }else{
        echo "<script>alert('Update Error')</script>";
    }
    $conn->close();
}
?>

<?php include("footer.php") ?>
</body>
</html>
