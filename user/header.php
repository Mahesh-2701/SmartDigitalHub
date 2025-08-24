<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Header</title>
  <style>
/* Font & general styling */
body, .navbar, .nav-link, .btn, .dropdown-menu {
    font-family: 'Poppins', sans-serif;
}

/* Navbar background & shadow */
.navbar {
    background-color: #ffffff;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    padding: 0.8rem 1rem;
    border-bottom-left-radius: 12px;
    border-bottom-right-radius: 12px;
}

/* Brand */
.navbar-brand {
    font-size: 1.6rem;
    font-weight: 700;
    color: #6c63ff !important;
    letter-spacing: 0.5px;
    transition: transform 0.3s ease;
}
.navbar-brand:hover {
    transform: scale(1.05);
}

/* Nav links */
.nav-link {
    font-size: 1.05rem;
    font-weight: 500;
    color: #333 !important;
    transition: color 0.3s ease, transform 0.3s ease;
}
.nav-link:hover, .nav-link.active {
    color: #6c63ff !important;
    transform: scale(1.05);
}

/* Buttons */
.btn-primary, .btn-outline-primary {
    border-radius: 50px;
    padding: 0.45rem 1.3rem;
    font-weight: 500;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}
.btn-primary:hover {
    background-color: #fff;
    color: #6c63ff;
    border: 1px solid #6c63ff;
    transform: scale(1.05);
}
.btn-outline-primary:hover {
    background-color: #6c63ff;
    color: #fff;
    border: 1px solid #6c63ff;
    transform: scale(1.05);
}

/* Dropdown toggle */
.dropdown-toggle::after {
    margin-left: 0.5rem;
    transition: transform 0.3s ease;
}
.dropdown-toggle:focus::after, .dropdown-toggle:hover::after {
    transform: rotate(90deg);
}

/* User image */
.dropdown img {
    border-radius: 50%;
    border: 2px solid #6c63ff;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.dropdown img:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}

/* Cart icon */
.d-flex.gap-1 a svg {
    color: #6c63ff;
    transition: transform 0.3s ease, color 0.3s ease;
}
.d-flex.gap-1 a svg:hover {
    transform: scale(1.2);
    color: #ff6b6b;
}

/* Responsive tweaks */
@media (max-width: 991px) {
    .navbar-nav {
        text-align: center;
    }
    .d-flex.gap-1 {
        justify-content: center;
        margin-top: 0.5rem;
    }
}
</style>

</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary bg-light fixed-top rounded-bottom shadow">
    <div class="container-fluid ">
      <a class="navbar-brand text-primary fs-4" href="index.php"><b>SmartDigitalHub</b></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0 ">
          <li class="nav-item">
            <a class="nav-link active text-dark fs-5" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark fs-5" href="categories.php">Categories</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark fs-5" href="course.php">Courses</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark fs-5" href="resume.php">Resume</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark fs-5" href="portfolio.php">Portfolio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark fs-5" href="ebooks.php">Ebooks</a>
          </li>
        </ul>

      <!-- php code for showing login signup when not logged in or otherwise show the user page dropdown   -->

      <?php

          if(isset($_SESSION["username"])){

      ?>
      
      <div class="dropdown pe-4"> 
          <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle text-dark" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="./assets/users/<?php echo $_SESSION['image'] ?>" alt="" width="32" height="32" class="rounded-circle border d-inline"> 
          <p class="d-inline"><?php echo $_SESSION['name'] ?></p>
          </a>
          
          <ul class="dropdown-menu text-small" >
            <li><a class="dropdown-item" href="userpage.php">Profile</a></li>
            <li><a class="dropdown-item" href="cart.php">Cart</a></li>
            <li><a class="dropdown-item" href="orders.php">Orders</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
          </ul>
      </div>
      <div class="d-flex gap-1">
        <a href="cart.php"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
          <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
        </svg></a>
        <a href="cart.php" class="text-decoration-none"><p>Cart</p></a>
      </div>

      <?php

          }
          else{

      ?>

      <a href="login.php" class="btn btn-primary mx-2">Login</a>
      <a href="signup.php" class="btn btn-outline-primary">Signup</a>
      
      <?php

        }

      ?>
       
      </div>
    </div>
  </nav>
</body>

</html>