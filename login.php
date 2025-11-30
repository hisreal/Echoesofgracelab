<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Echoes of Grace Medical Laboratory</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully responsive admin theme which can be used to build CRM, CMS,ERP etc." name="description" />
    <meta content="Techzaa" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/echoes.png">

    <!-- Theme Config Js -->
    <script src="assets/js/config.js"></script>

    <!-- App css -->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
</head>

<body class="position-relative">
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card overflow-hidden">
                                <div class="d-flex flex-column h-100">
                                    <div class="auth-brand p-4">
                                       <!-- <a href="index-2.html" class="logo-light">
                                            <img src="assets/images/logo.png" alt="logo" height="22">
                                        </a>
                                        <a href="index-2.html" class="logo-dark">
                                            <img src="assets/images/logo-dark.png" alt="dark logo" height="22">
                                        </a>-->
                                    </div>
                                    <div class="p-4 my-auto">
                                        <h4 class="fs-20">Sign In</h4>
                                        <p class="text-muted mb-3">Enter your email address and password to access
                                            account.
                                        </p>

                                        <!-- form -->
                                        <form action="#">
                                            <div class="mb-3">
                                                <label for="emailaddress" class="form-label">Email address</label>
                                                <input class="form-control" type="email" id="emailaddress" name="UserId" required placeholder="Enter your email">
                                                <small class="text-danger" id="emailError"></small>
                                            </div>

                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input class="form-control" type="password" id="password" name="pwd" required placeholder="Enter your password">
                                                <small class="text-danger" id="passwordError"></small>
                                            </div>

                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input"
                                                        id="checkbox-signin">
                                                    <label class="form-check-label" for="checkbox-signin">Remember
                                                        me</label>
                                                </div>
                                            </div>
                                            <div class="mb-0 text-start">
                                                <button class="btn btn-soft-primary w-100" type="submit"><i
                                                        class="ri-login-circle-fill me-1"></i> <span class="fw-bold">Log
                                                        In</span> </button>
                                            </div>

                                           
                                        </form>
                                         <!-- Bootstrap Toast Container -->
        <div class="toast-container position-fixed bottom-0 end-0 p-3">

            <!-- Success Toast -->
            <div id="successToast" class="toast text-bg-success border-0" role="alert">
                <div class="d-flex">
                <div class="toast-body" id="successToastMsg"></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>

            <!-- Error Toast -->
            <div id="errorToast" class="toast text-bg-danger border-0" role="alert">
                <div class="d-flex">
                <div class="toast-body" id="errorToastMsg"></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            </div>

            </div>
                                            <!-- end form-->
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
          
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->
       

    <footer class="footer footer-alt fw-medium">
        <span class="text-dark">
            <script>document.write(new Date().getFullYear())</script> © Hisrealitech
    </footer>
    <!-- Vendor js -->

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const form = document.querySelector("form");
            const loginBtn = document.querySelector("button[type='submit']");

            const emailError = document.getElementById("emailError");
            const passwordError = document.getElementById("passwordError");

            const successToastEl = document.getElementById("successToast");
            const errorToastEl = document.getElementById("errorToast");

            const successToast = new bootstrap.Toast(successToastEl);
            const errorToast = new bootstrap.Toast(errorToastEl);

            form.addEventListener("submit", (e) => {
                e.preventDefault();

                emailError.textContent = "";
                passwordError.textContent = "";

                let formData = new FormData(form);

                loginBtn.disabled = true;
                loginBtn.innerHTML = "Signing in...";

                fetch("includes/login.inc.php", {
                    method: "POST",
                    body: formData
                })
                    .then(res => res.json())
                    .then(data => {

                        loginBtn.disabled = false;
                        loginBtn.innerHTML = "<i class='ri-login-circle-fill me-1'></i><span class='fw-bold'>Log In</span>";

                        if (!data.success) {

                            // show inline errors
                            if (data.field === 'UserId') emailError.textContent = data.message;
                            if (data.field === 'pwd') passwordError.textContent = data.message;
                            if (data.field === 'general') passwordError.textContent = data.message;

                            // show toast error
                            document.getElementById("errorToastMsg").innerText = data.message;
                            errorToast.show();
                            
                            return;
                        }

                        // SUCCESS
                        document.getElementById("successToastMsg").innerText = data.message;
                        successToast.show();

                        setTimeout(() => {
                            window.location.href = data.redirect;
                        }, 800);
                    })
                    .catch(() => {
                        loginBtn.disabled = false;
                        loginBtn.innerHTML = "<i class='ri-login-circle-fill me-1'></i><span class='fw-bold'>Log In</span>";

                        document.getElementById("errorToastMsg").innerText = "Network error. Please try again.";
                        errorToast.show();
                    });
            });
        });
        </script>

    <script src="assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

</body>
</html>