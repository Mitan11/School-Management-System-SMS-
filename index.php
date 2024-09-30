<?php include('./includes/config.php') ?>
<?php include('header.php') ?>


<!-- Navbar Start-->
<header id="nav" class="shadow-sm  position-sticky top-0 z-3">
    <nav class="navbar navbar-expand-md bg-body-tertiary" id="nav">
        <div class="container-fluid">
            <!-- Brand name or logo -->
            <a class="navbar-brand fw-semibold" href="#Hero"><img class="rounded-circle" width="40"
                    src="./Assets/imgs/GFA logo.png" alt=""></a>

            <!-- Toggler button for collapsing navbar on smaller screens -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fa-solid fa-bars-staggered"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-md-0 nav-underline">
                    <li class="nav-item">
                        <!-- Home link, set as active -->
                        <a class="nav-link active" aria-current="page" href="#Hero">Home</a>
                    </li>
                    <li class="nav-item">
                        <!-- Generic link -->
                        <a class="nav-link" href="#about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <!-- Generic link -->
                        <a class="nav-link" href="#courses">Courses</a>
                    </li>
                    <li class="nav-item">
                        <!-- Generic link -->
                        <a class="nav-link" href="#">Events</a>
                    </li>
                </ul>

                <!-- User profile dropdown menu -->
                <div class="d-flex align-items-center">
                    <div class="dropdown">
                        <!-- Check if the user is logged in -->
                        <?php if (isset($_SESSION['login'])) { ?>
                            <a data-mdb-dropdown-init="" class="dropdown-toggle d-flex align-items-center hidden-arrow"
                                href="#" id="navbarDropdownMenuAvatar" role="button" aria-expanded="false"
                                data-mdb-dropdown-initialized="true">
                                <!-- User avatar -->
                                <img src="./Assets/imgs/user.svg" alt="">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                                <!-- Profile-related links -->
                                <li>
                                    <a class="dropdown-item" href="./Admin/dashboard.php">Dashboard</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="logout.php">Logout</a>
                                </li>
                            </ul>
                        <?php } else { ?>
                            <!-- If user is not logged in, show the login link -->
                            <!-- <a href="login.php" class="nav-link">
                            <img src="./Assets/imgs/user.svg" alt="">&nbsp;User Login
                        </a> -->
                            <button type="button" class="btn p-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <img src="./Assets/imgs/user.svg" alt="">&nbsp;User Login
                            </button>
                            <div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="row justify-content-center">
                                                <div class="col-12">
                                                    <button type="button" class="btn-close float-end" aria-label="Close"
                                                        data-bs-dismiss="modal"></button>
                                                    <div class="bg-white p-4 p-md-5 rounded">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="mb-3">
                                                                    <!-- Section heading -->
                                                                    <h3>Login</h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Login form -->
                                                        <form action="./Action/login.php" method="post">
                                                            <div class="row gy-3 gy-md-4 overflow-hidden">
                                                                <!-- Email input field -->
                                                                <div class="col-12">
                                                                    <label for="email" class="form-label">Email <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="email" class="form-control" name="email"
                                                                        id="email" placeholder="name@example.com" required
                                                                        autocomplete="on">
                                                                </div>
                                                                <!-- Password input field -->
                                                                <div class="col-12">
                                                                    <label for="password" class="form-label">Password <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="password" class="form-control"
                                                                        name="password" id="password" value="" required placeholder="example@123"
                                                                        autocomplete="on">
                                                                </div>
                                                                <!-- Submit button -->
                                                                <div class="col-12">
                                                                    <div class="d-grid">
                                                                        <button class="btn w-100 btn-outline-primary"
                                                                            name="login" type="submit">Log in
                                                                            now</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <!-- End of Login form -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
<!-- Navbar End-->

<div class="toast-container position-fixed top-0 end-0 p-3">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">SMS</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" id="message">
            <!-- Message will be displayed here -->
        </div>
    </div>
</div>

<main class="position-fixed overflow-y-scroll" id="main" data-bs-spy="scroll" data-bs-target="#nav"
    data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true">

    <!-- Hero Section Start -->
    <section id="Hero" class="py-5 container-fluid">
        <div class="d-flex">
            <div class="container-fluid">
                <div class="row row-gap-5">
                    <div class="col-lg-6 my-auto">
                        <!-- Hero section with School Name and it's description -->
                        <h1 class="display-5 fw-bold text-black" id="Schoolname">Greenfield International Academy</h1>
                        <p>Greenfield International Academy is dedicated to providing a balanced education that combines
                            traditional values with modern learning. With state-of-the-art facilities and a
                            student-focused approach, we empower students to excel academically and develop essential
                            life skills.</p>
                        <a href="#" class="btn btn-primary">Call to action</a>
                    </div>
                    <div class="col-lg-6">
                        <!-- Admission form card -->
                        <div class="col-12 col-md-10 mx-auto card">
                            <div class="card-body">
                                <h3>Inquiry Form</h3>
                                <form action="" method="post">
                                    <!-- Name input field -->
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="Sname" id="name"
                                            placeholder="Jhon Deo" autocomplete="on" required>
                                        <label for="name">Enter Your Name</label>
                                    </div>

                                    <!-- Email input field -->
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" name="Semail" id="Iemail"
                                            placeholder="JhonDeo123@gmail.com" autocomplete="on" required>
                                        <label for="Iemail">Enter Your Email</label>
                                    </div>

                                    <!-- Phone number input field -->
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="Snumber" id="number"
                                            placeholder="1234567890" autocomplete="on" required>
                                        <label for="number">Enter Your Number</label>
                                    </div>

                                    <!-- Class input field -->
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="Sclasss" id="class"
                                            placeholder="11" autocomplete="on" required>
                                        <label for="class">Enter Your Query</label>
                                    </div>

                                    <!-- Submit button -->
                                    <button class="btn btn-outline-primary w-100" type="submit">Submit Form</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- About us Section Start -->
    <section class="py-5 container-fluid bg-light" id="about">
        <div class="container">
            <div class="row row-gap-5">
                <!-- About section content -->
                <div class="col-lg-6">
                    <!-- Section heading with emphasis on the academy's name -->
                    <h2 class="fw-bold">About<br><span class="text-primary">Greenfield International Academy</span></h2>
                    <div class="pe-lg-4">
                        <!-- First paragraph describing the school's mission and educational approach -->
                        <p>Welcome to Greenfield International Academy, where excellence in education meets a nurturing
                            environment. Our mission is to provide holistic education that fosters academic achievement,
                            personal growth, and social responsibility. We combine rigorous academic programs with
                            diverse extracurricular activities, ensuring a well-rounded education.</p>
                        <!-- Second paragraph highlighting the dedication of the educators and the focus on student development -->
                        <p>Our dedicated educators inspire and guide each student, nurturing their unique talents and
                            abilities. With a focus on critical thinking, creativity, and collaboration, we prepare our
                            students to succeed in an ever-changing world. Join our community and experience the
                            difference at Greenfield International Academy.</p>
                    </div>
                    <!-- Button linking to more information about the academy -->
                    <a href="about-us.php" class="btn btn-primary">Know more</a>
                </div>
                <!-- Image section next to the text content -->
                <div class="col-lg-6 my-auto">
                    <img src="./Assets/imgs/course.jpg" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </section>
    <!-- About us Section End -->

    <!-- Achievement Section Start -->
    <section class="py-5 container-fluid" id="achievement">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <!-- Achievements section heading -->
                    <h2 class="fw-bold">Our<br><span class="text-primary">Achievements</span></h2>
                    <!-- Description of the academy's achievements -->
                    <p>Greenfield International Academy is proud of its numerous achievements and milestones. Our
                        students consistently excel in academic performance, extracurricular activities, and community
                        service. They have won numerous awards in science fairs, math competitions, and sports
                        tournaments, showcasing their diverse talents and dedication. Our faculty is equally
                        accomplished, with many recognized for their innovative teaching methods and contributions to
                        educational research.
                    </p>
                    <!-- Placeholder image for the achievements section -->
                    <img src="./Assets/imgs/placeholder.jpg" alt="" class="img-fluid rounded">
                </div>
                <div class="col-lg-6 my-auto">
                    <div class="row row-gap-4">
                        <!-- Card displaying the number of graduates -->
                        <div class="col-sm-6">
                            <div class="border card">
                                <div class="card-body text-center">
                                    <span><i class="fa-solid fa-graduation-cap fa-2x"></i></span>
                                    <h2 class="mb-0 mt-3 fw-bold">334</h2>
                                    <hr>
                                    <h4>Graduates</h4>
                                </div>
                            </div>
                        </div>
                        <!-- Repeated card for achievements (can be modified with different data as needed) -->
                        <div class="col-sm-6">
                            <div class="border card">
                                <div class="card-body text-center">
                                    <span><i class="fa-solid fa-graduation-cap fa-2x"></i></span>
                                    <h2 class="mb-0 mt-3 fw-bold">334</h2>
                                    <hr>
                                    <h4>Graduates</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="border card">
                                <div class="card-body text-center">
                                    <span><i class="fa-solid fa-graduation-cap fa-2x"></i></span>
                                    <h2 class="mb-0 mt-3 fw-bold">334</h2>
                                    <hr>
                                    <h4>Graduates</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="border card">
                                <div class="card-body text-center">
                                    <span><i class="fa-solid fa-graduation-cap fa-2x"></i></span>
                                    <h2 class="mb-0 mt-3 fw-bold">334</h2>
                                    <hr>
                                    <h4>Graduates</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Achievement Section End -->

    <!-- Course Section Start -->
    <section class="py-5 container-fluid bg-light" id="courses">
        <div class="container">
            <div class="text-center mb-4">

                <h2 class="heading">Our Courses</h2>
                <p>Discover our diverse range of courses designed to equip you with the skills and knowledge needed for
                    success. From technology and business to creative arts and personal development, our offerings cater
                    to
                    all interests and career goals.</p>
            </div>
            <div class="row">

                <?php
                $query = mysqli_query($db_connection, "select * from courses");
                while ($course = mysqli_fetch_object($query)) { ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                        <div class="card">

                            <div>
                                <img class="rounded-top img-fluid" src="./dist/uploads/<?php echo $course->image ?>" alt="">
                            </div>
                            <div class="card-body">

                                <b><?php echo $course->name ?></b>
                                <p class="card-text">
                                    <b>Duration : </b><?php echo $course->duration ?><br>
                                    <b>Price : </b>4000-/ Rs
                                </p>

                                <button class="btn btn-outline-primary w-100">Enroll</button>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- Course Section End -->

    <!-- Our Teachers Section Start -->
    <section class="py-5 container-fluid" id="teachers">
        <div class="container">
            <div class="text-center mb-4">
                <!-- Section heading and description -->
                <h2 class="heading">Our Teachers</h2>
                <p>Meet our dedicated and experienced team of teachers who are committed to providing quality education
                    and
                    nurturing the potential of every student. Our educators bring a wealth of knowledge, passion, and
                    expertise to create an engaging and supportive learning environment.</p>
            </div>
            <div class="row py-2">
                <!-- PHP loop to generate teacher cards -->
                <?php for ($i = 0; $i < 8; $i++) { ?>
                    <div class="col-lg-3 my-5 col-md-4 col-sm-6 col-12">
                        <div class="mx-auto" style="max-width: 23rem;">
                            <div class="card testimonial-card">
                                <div class="avatar mx-auto white">
                                    <!-- Teacher image -->
                                    <img src="./Assets/imgs/teacher_1.jpg" class="rounded-circle img-fluid"
                                        alt="woman avatar">
                                </div>
                                <div class="card-body text-center">
                                    <!-- Teacher name -->
                                    <h4 class="card-title font-weight-bold">Martha Smith</h4>
                                    <hr>
                                    <!-- Teacher quote or description -->
                                    <p><i class="fas fa-quote-left"></i> Lorem ipsum dolor sit amet, consectetur
                                        adipisicing
                                        elit. Eos, adipisci</p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- Our Teachers Section End -->


    <!-- Testimonials Sectioon Start -->
    <section class="py-5 container-fluid bg-light" id="testimonials">
        <div class="container">
            <!-- Section heading and description -->
            <div class="text-center mb-4">
                <h2 class="heading">What People Say</h2>
                <p class="">At Greenfield International Academy, our community speaks highly of the enriching
                    educational experience we provide. Parents appreciate our commitment to holistic education and the
                    supportive
                    environment we offer. Students love the engaging curriculum and diverse extracurricular activities
                    that help them grow academically and personally. Our alumni often credit their success to the strong
                    foundation they built here, highlighting the dedication and expertise of our faculty.</p>
            </div>
            <!-- Testimonial cards -->
            <div class="row row-gap-4">
                <div class="col-lg-6">
                    <div class="border rounded position-relative">
                        <!-- Testimonial text -->
                        <div class="p-4 text-center">
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rem similique officia eius
                            fuga? Aut ullam eligendi molestiae commodi iure obcaecati incidunt Lorem, ipsum dolor sit
                            amet
                            consectetur adipisicing elit. Corporis similique iusto laudantium incidunt quam cumque!
                            Illo sit ab minus adipisci esse praesentium ex sed. es maiores iste, rerum impedit
                            voluptatem
                            accusantium est.
                        </div>
                        <!-- Quote icon -->
                        <i class="fa fa-quote-left fa-3x position-absolute" style="top:.5rem;left:.5rem;opacity:.2"></i>
                    </div>
                    <!-- Testimonial author details -->
                    <div class="text-center mt-n3">
                        <img src="./Assets/imgs/placeholder.jpg" alt="" class="rounded-circle border" width="100"
                            height="100">
                        <h6 class="mb-0 fw-bold">Name of Candidate</h6>
                        <p><i>Designation</i></p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="border rounded position-relative">
                        <div class="p-4 text-center">
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rem similique officia eius
                            fuga? Aut ullam eligendi molestiae commodi iure obcaecati incidunt Lorem, ipsum dolor sit
                            amet
                            consectetur adipisicing elit. Corporis similique iusto laudantium incidunt quam cumque!
                            Illo sit ab minus adipisci esse praesentium ex sed. es maiores iste, rerum impedit
                            voluptatem
                            accusantium est.
                        </div>
                        <i class="fa fa-quote-left fa-3x position-absolute" style="top:.5rem;left:.5rem;opacity:.2"></i>
                    </div>
                    <div class="text-center mt-n3">
                        <img src="./Assets/imgs/placeholder.jpg" alt="" class="rounded-circle border" width="100"
                            height="100">
                        <h6 class="mb-0 fw-bold">Name of Candidate</h6>
                        <p><i>Designation</i></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Sectioon End -->

    <!-- Footer Section Start -->
    <footer class="bg-dark py-5 container-fluid" id="footer">
        <div class="row row-gap-4">
            <!-- Logo Section -->
            <div class="col-lg-3 col-md-4 col-sm-6">
                <img src="./Assets/imgs/placeholder.jpg" alt="" class="img-fluid">
            </div>
            <!-- Useful Links Section -->
            <div class="col-lg-3 col-md-4 col-sm-6">
                <h5 class="text-white">Useful Links</h5>
                <ul>
                    <li><a href="#" class="text-white">Home</a></li>
                    <li><a href="#" class="text-white">About</a></li>
                    <li><a href="#" class="text-white">Services</a></li>
                    <li><a href="#" class="text-white">Contact</a></li>
                </ul>
            </div>
            <!-- Social Media Links Section -->
            <div class="col-lg-3 col-md-4 col-sm-6">
                <h5 class="text-white">Social Media</h5>
                <ul>
                    <li><a href="#" class="text-white">Facebook</a></li>
                    <li><a href="#" class="text-white">Instagram</a></li>
                    <li><a href="#" class="text-white">LinkedIn</a></li>
                    <li><a href="#" class="text-white">Twitter</a></li>
                </ul>
            </div>
            <!-- Subscription Form Section -->
            <div class="col-lg-3 col-md-4 col-sm-6">
                <h5 class="text-white">Subscribe Now</h5>
                <form action="" method="post">
                    <!-- Email Input -->
                    <div class="mb-3">
                        <label for="Semail" class="form-label text-white">Email address</label>
                        <input type="email" class="form-control text-white bg-transparent" id="Semail" name="Email"
                            aria-describedby="emailHelp" autocomplete="on" required>
                    </div>
                    <!-- Submit Button -->
                    <button class="btn btn-primary btn-block" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </footer>

    <!-- Copyrights -->
    <section class="container-fluid text-center bg-dark pb-3" id="copy">
        <p class="m-0 text-white">
            Copyright &copy; 2024 All Rights Reserved
            <a href="#" class="text-white">Greenfield International Academy</a>
        </p>
    </section>
    <!-- Footer Section End -->

</main>

<?php include('footer.php') ?>

<script>

$(document).ready(function() {
    <?php if (isset($_SESSION['toastMessage'])): ?>
    // Set the message inside the toast
    $('#message').text("<?php echo htmlspecialchars($_SESSION['toastMessage']); ?>");
    
    // Show the toast
    $('.toast').toast('show');
    
    // Unset the session message to avoid showing it again on page reload
    <?php unset($_SESSION['toastMessage']); ?>
    <?php endif; ?>
});

$(document).ready(function() {
    var toastMessage = localStorage.getItem('toastMessage');
    console.log(toastMessage);
    
    if(toastMessage){
        // Set the message inside the toast
        $('#message').text(toastMessage);
        
        // Show the toast
        $('.toast').toast('show');
        localStorage.removeItem('toastMessage');
    }
});
</script>