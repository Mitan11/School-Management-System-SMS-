<?php include('header.php')?>

<!-- Login Section Start -->
<section id="login" class="bg-light py-3 vh-100 py-md-5">
    <div class="container h-100 d-grid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-11 col-lg-8 col-xl-7 col-xxl-6">
                <div class="bg-white p-4 p-md-5 rounded shadow-sm">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <!-- Section heading -->
                                <h3>Log in</h3>
                            </div>
                        </div>
                    </div>
                    <!-- Login form -->
                    <form action="./Action/login.php" method="post">
                        <div class="row gy-3 gy-md-4 overflow-hidden">
                            <!-- Email input field -->
                            <div class="col-12">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="name@example.com" required>
                            </div>
                            <!-- Password input field -->
                            <div class="col-12">
                                <label for="password" class="form-label">Password <span
                                        class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password" id="password" value=""
                                    required>
                            </div>
                            <!-- Submit button -->
                            <div class="col-12">
                                <div class="d-grid">
                                    <button class="btn w-100 btn-outline-primary" name="login" type="submit">Log in
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
</section>
<!-- Login Section End -->

<?php include('footer.php')?>