<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <?php include("../assets/cdn.php") ?>
    <style>
        /* Section titles */
        #categories h1.display-4 {
            color: #212529;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        #categories p.lead {
            color: #495057;
            font-size: 1.1rem;
            line-height: 1.7;
        }

        /* Buttons */
        .btn-outline-primary, .btn-outline-secondary {
            border-radius: 25px;
            padding: 0.6rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }

        .btn-outline-secondary:hover {
            background-color: #6c757d;
            color: #fff;
            border-color: #6c757d;
        }

        /* Image styling */
        .img-fluid {
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            transition: transform 0.5s ease, box-shadow 0.5s ease;
        }

        .img-fluid:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.15);
        }

        /* Section spacing */
        section {
            padding-top: 6rem;
            padding-bottom: 6rem;
        }

        /* Fade-in animation on scroll */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>

<body>

    <?php include("./header.php") ?>

    <section id="categories">
        <div class="container">

            <!-- Video Courses -->
            <div class="px-4 pt-5 my-5 text-center border-bottom fade-in">
                <h1 class="display-4">Video Courses</h1>
                <div class="col-lg-6 mx-auto">
                    <p class="lead">Stay ahead of the curve with our expertly crafted video courses covering the latest in AI, Machine Learning, Cloud Computing, Cybersecurity, and more. Step-by-step tutorials, real-world projects, and industry insights make complex topics easy to understand and apply.</p>
                    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
                        <a type="button" class="btn btn-outline-primary btn-lg px-4" href="course.php">Start Learning</a>
                    </div>
                </div>
                <div class="overflow-hidden" style="max-height: 30vh;">
                    <div class="container px-5">
                        <img src="./assets/images/pexels-ron-lach-8102680.jpg" class="img-fluid"  alt="Video Courses" loading="lazy">
                    </div>
                </div>
            </div>

            <!-- E-books -->
            <div class="container col-xxl-8 px-4 py-5 mt-5 mb-3 fade-in">
                <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                    <div class="col-10 col-sm-8 col-lg-6">
                        <img src="./assets/images/time machine.jpg" class="img-fluid" alt="E-books" loading="lazy">
                    </div>
                    <div class="col-lg-6">
                        <h1 class="display-5 fw-bold lh-1 mb-3">E-books</h1>
                        <p class="lead">Explore our collection of insightful eBooks designed to deepen your understanding of today’s most in-demand technologies. Practical knowledge, real-world examples, and clear explanations perfect for students and professionals alike.</p>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                            <a type="button" class="btn btn-outline-primary btn-lg px-4" href="ebooks.php">View Books</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Portfolio Templates -->
            <div class="px-4 pt-5 my-5 text-center border-bottom fade-in">
                <h1 class="display-4">Portfolio Templates</h1>
                <div class="col-lg-6 mx-auto">
                    <p class="lead">Showcase your work with stunning portfolio templates tailored for designers, developers, photographers, and creatives. Fully responsive and visually engaging to reflect your unique style and skills.</p>
                    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
                        <a type="button" class="btn btn-outline-secondary btn-lg px-4" href="portfolio.php">Preview</a>
                    </div>
                </div>
                <div class="overflow-hidden" style="max-height: 30vh;">
                    <div class="container px-5">
                        <img src="./assets/images/webdev.png" class="img-fluid" alt="Portfolio Templates" loading="lazy">
                    </div>
                </div>
            </div>

            <!-- Resume Templates -->
            <div class="container col-xxl-8 px-4 py-5 fade-in">
                <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                    <div class="col-10 col-sm-8 col-lg-6">
                        <img src="./assets/images/Graphic designer resume cv design psd template _ Premium PSD.jpg" class="img-fluid" alt="Resume Templates" loading="lazy">
                    </div>
                    <div class="col-lg-6">
                        <h1 class="display-5 fw-bold lh-1 mb-3">Resume Templates</h1>
                        <p class="lead">Professionally designed resume templates to help you make a lasting first impression. Clean, modern, and creative layouts optimized for job applications across industries.</p>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                            <a type="button" class="btn btn-outline-secondary btn-lg px-4" href="resume.php">Explore</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <?php include("./footer.php") ?>

    <script>
        // Fade-in animation on scroll
        const faders = document.querySelectorAll('.fade-in');

        const appearOptions = {
            threshold: 0.2,
            rootMargin: "0px 0px -50px 0px"
        };

        const appearOnScroll = new IntersectionObserver(function(entries, appearOnScroll){
            entries.forEach(entry => {
                if(!entry.isIntersecting) return;
                entry.target.classList.add('visible');
                appearOnScroll.unobserve(entry.target);
            });
        }, appearOptions);

        faders.forEach(fader => {
            appearOnScroll.observe(fader);
        });
    </script>

</body>
</html>
