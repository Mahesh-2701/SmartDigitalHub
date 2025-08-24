<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SmartDigitalHub</title>
<?php include("../assets/cdn.php") ?>
<style>
/* Body */
body {
    font-family: 'Poppins', sans-serif;
    background-color: #f8f9fa;
    scroll-behavior: smooth;
    color: #333;
}

/* Hero Section */
#hero {
    background: linear-gradient(135deg, #6c63ff, #a29bfe);
    padding: 8rem 1rem 6rem;
    text-align: center;
    color: #fff;
    position: relative;
}

#hero img {
    border-radius: 20px;
    box-shadow: 0 12px 40px rgba(0,0,0,0.25);
    transition: transform 0.7s ease, box-shadow 0.7s ease;
    /* Removed float animation */
}

#hero h1 {
    font-size: 3rem;
    font-weight: 700;
    margin-top: 1rem;
    text-shadow: 0 2px 8px rgba(0,0,0,0.3);
}

#hero h3 {
    font-weight: 500;
    margin-bottom: 1.5rem;
    text-shadow: 0 1px 6px rgba(0,0,0,0.3);
}

#hero p.lead {
    font-size: 1.1rem;
    line-height: 1.8;
    max-width: 700px;
    margin: 0 auto 2rem;
    text-shadow: 0 1px 4px rgba(0,0,0,0.2);
}

#hero .btn {
    border-radius: 50px;
    padding: 0.75rem 2rem;
    font-weight: 600;
    transition: all 0.3s ease;
    margin: 0.25rem;
}

#hero .btn-outline-light:hover,
#hero .btn-light:hover {
    background-color: #fff;
    color: #6c63ff;
    transform: scale(1.05);
}

/* Features Section */
#features {
    padding: 6rem 1rem;
    background-color: #fff;
}

#features h2 {
    font-weight: 700;
    margin-bottom: 3rem;
    text-align: center;
    color: #6c63ff;
}

.feature-card {
    background-color: #f1f1ff;
    border-radius: 20px;
    padding: 2rem;
    transition: transform 0.4s ease, box-shadow 0.4s ease;
    height: 100%;
    text-align: center;
}

.feature-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
}

.feature-card svg {
    margin-bottom: 1rem;
    color: #6c63ff;
    width: 50px;
    height: 50px;
}

.feature-card h4 {
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.feature-card p {
    color: #495057;
}

/* About Section */
#about {
    background: linear-gradient(120deg, #e9ecef, #f8f9fa);
    padding: 6rem 1rem;
    text-align: center;
}

#about h1 {
    font-weight: 700;
    margin-bottom: 2rem;
    color: #6c63ff;
}

#about p {
    color: #495057;
    font-size: 1.15rem;
    line-height: 1.8;
    max-width: 800px;
    margin: 0 auto;
}

/* Responsive Typography */
@media (max-width: 768px) {
    #hero h1 { font-size: 2.2rem; }
    #hero h3 { font-size: 1.3rem; }
    #hero p.lead { font-size: 1rem; }
}
</style>
</head>

<body>
<?php include("header.php") ?>

<!-- Hero Section -->
<section id="hero">
    <div class="container">
        <img src="./assets/images/ChatGPT Image Aug 12, 2025, 01_47_31 PM.png" alt="SmartDigitalHub" width="450" height="170">
        <h1>Welcome to SmartDigitalHub</h1>
        <h3>Your One-Stop Digital Marketplace</h3>
        <p class="lead">Discover the ultimate destination for digital creators, professionals, and learners. We bring you a curated collection of high-quality eBooks, online courses, and professionally designed portfolio and resume templates all in one place.</p>
        <div class="d-flex justify-content-center flex-wrap">
            <a type="button" class="btn btn-light btn-lg px-4" href="#about">About</a>
            <a href="categories.php" type="button" class="btn btn-outline-light btn-lg px-4">Show More</a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features">
    <div class="container">
        <h2>Features</h2>
        <div class="row row-cols-1 row-cols-md-2 g-5">
            <div class="col d-flex flex-column justify-content-center">
                <h3 class="fw-bold mb-3">Modern, Affordable & User-Friendly</h3>
                <p>Whether you're looking to upgrade your skills, enhance your career profile, or build a stunning personal brand, SmartDigitalHub has everything you need to succeed in the digital age.</p>
            </div>
            <div class="col">
                <div class="row row-cols-1 row-cols-sm-2 g-4">
                    <div class="col feature-card">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
                            <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
                        </svg>
                        <h4>Ebooks</h4>
                        <p>Explore a growing library of eBooks across tech, business, self-growth, and more. Learn at your own pace.</p>
                    </div>
                    <div class="col feature-card">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-file-earmark-person" viewBox="0 0 16 16">
                            <path d="M11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                            <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2v9.255S12 12 8 12s-5 1.755-5 1.755V2a1 1 0 0 1 1-1h5.5z"/>
                        </svg>
                        <h4>Resume</h4>
                        <p>Stand out with clean, professional resume templates for every industry.</p>
                    </div>
                    <div class="col feature-card">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                        <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z"/>
                        </svg>
                        <h4>Courses</h4>
                        <p>Master new skills with video courses on trending technologies for beginners & professionals alike.</p>
                    </div>
                    <div class="col feature-card">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z"/>
                        </svg>
                        <h4>Portfolio</h4>
                        <p>Showcase your work with modern, customizable portfolio templates designed to impress clients & employers.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about">
    <div class="container">
        <h1>About Us</h1>
        <p class="col-lg-8 mx-auto lead my-3">
            At SmartDigitalHub, we’re dedicated to empowering professionals, students, and creatives with high-quality digital resources designed to fuel career growth and personal success. From sleek, industry-ready resume and portfolio templates to expertly curated video courses and engaging e-books, every product we offer is built with precision, professionalism, and purpose.
        </p>
    </div>
</section>

<?php include("footer.php") ?>
</body>
</html>
