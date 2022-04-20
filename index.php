<?php
// suppress warnings
error_reporting(0);
// init session
session_start();
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Groceri Dashboard</title>
        <link href="css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
        <link rel="stylesheet"
              href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body class="poppins">
<!--    navbar section -->
    <section id="navbar">
        <nav class="navbar navbar-expand-lg navbar-light bg-light p-3 ps-5 pe-5">
            <div class="container ps-5 pe-5">
                <a class="navbar-brand" href="dashboard.php">
                    <img src="assets/icons8-vegetables-box-100.png" alt="" width="30" height="30"
                         class="img-fluid align-text-bottom" style="transform: translateY(-3px)">
                    <span style="color:#689D6D ">Groceri</span><span style="color: gray"> Dashboard</span>
                </a>
            </div>
        </nav>
    </section>

<!-- login section -->
    <section id="login">
        <div class="container p-5">
            <div class="row">
                <div class="col-1">
                </div>
                <div class="col d-flex flex-column justify-content-center align-items-center">
                    <form style="border: 1px solid lightgray" class="p-5 rounded-3" method="post" action="login.php">
                        <h2>Sign in</h2>
                        <br>
                        <?php
                        // display log message
                        if (isset($_SESSION['loginError'])) {
                            echo '<p class="" style="color: indianred">' . $_SESSION['loginError'] . '</p>';
                        }
                        ?>
                        <p style="color: gray">Please insert account details below</p>
                        <div class="mb-3">
                            <label for="loginUsername" class="form-label">Username</label>
                            <input type="text" class="form-control" id="loginUsername" name="loginUsername" required>
                        </div>
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="loginPassword" name="loginPassword"
                                   required>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="las la-sign-in-alt"></i> Sign In
                        </button>
                    </form>
                </div>
                <div class="col text-center d-flex flex-column justify-content-center">
                    <h1><i class="las la-exclamation-circle"></i></h1>
                    <strong>You are not signed in yet!</strong>
                    <br>
                    <p>Please sign in to access<br>Groceri Dashboard</p>
                    <div class="d-flex ms-auto me-auto" style="opacity: 0.25;">
                        <img src="assets/icons8-cauliflower-64.png" alt="">
                        <img src="assets/icons8-radish-64.png" alt="">
                        <img src="assets/icons8-tomato-64.png" alt="">
                        <img src="assets/icons8-eggplant-64.png" alt="">
                    </div>
                </div>
                <div class="col-1">
                </div>
            </div>
        </div>
    </section>

<!-- Footer -->
    <section id="footer">
        <div class="container">
            <div class="text-center">
                <p class="text-black-50">Made with <span style="color: pink">&heartsuit;</span> by <span
                            class="text-black">D21125387</span> | Assets by
                    <a href="https://icons8.com" class="text-decoration-none text-black fw-bold">Icons8.com</a></p>
            </div>
        </div>
    </section>

<!-- Bootstrap requirement -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
            crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" crossorigin="anonymous"></script>
    </body>
    </html>
<?php
// clear log message
unset($_SESSION["loginError"]);
?>