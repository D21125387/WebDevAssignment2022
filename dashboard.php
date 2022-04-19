<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: index.php");
        exit(0);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Groceri Dashboard</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="poppins">
<section id="navbar">
    <nav class="navbar navbar-expand-lg navbar-light bg-light p-3 ps-5 pe-5">
        <div class="container ps-5 pe-5">
            <a class="navbar-brand" href="dashboard.php">
                <img src="assets/icons8-vegetables-box-100.png" alt="" width="30" height="30" class="img-fluid align-text-bottom" style="transform: translateY(-3px)">
                <span style="color:#689D6D ">Groceri</span><span style="color: gray"> Dashboard</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item m-auto me-3">
                        <div class="m-auto">
                            <i class="lar la-user-circle"></i> <span style="color: gray">Signed in as:</span>
                            <?php
                                echo $_SESSION['username'];
                            ?>
                        </div>
                    </li>
                    <li class="nav-item">
                        <form class="m-auto" method="post" action="signout.php">
                            <button type="submit" class="btn btn-danger"><i class="las la-sign-out-alt"></i> Sign Out</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</section>

<section id="dashboard">
    <div class="container p-5">
        <div class="row">
            <div class="col">
                <div class="card h-100 text-center" style="background: rgba(184,233,148,0.25);">
                    <div class="card-body">
                        <h1><i class="las la-list-ol"></i></h1>
                        <h5 class="card-title fw-bold">View Stock</h5>
                        <p class="card-text">View items within the system</p>

                        <a href="viewitems.php" class="btn btn-primary"><i class="las la-arrow-right"></i> Go</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 text-center" style="background:rgba(130,204,221,0.25);">
                    <div class="card-body">
                        <h1><i class="las la-plus-circle"></i></h1>
                        <h5 class="card-title fw-bold">Add Item</h5>
                        <p class="card-text">Add an item to the system</p>
                        <a href="additem.php" class="btn btn-primary"><i class="las la-arrow-right"></i> Go</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 text-center" style="background: rgba(106,137,204,0.25);">
                    <div class="card-body">
                        <h1><i class="las la-edit"></i></h1>
                        <h5 class="card-title fw-bold">Edit Item</h5>
                        <p class="card-text">Edit an item of the system</p>
                        <a href="edititem.php" class="btn btn-primary"><i class="las la-arrow-right"></i> Go</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 text-center" style="background: rgba(248,194,145,0.25);">
                    <div class="card-body">
                        <h1><i class="las la-backspace"></i></h1>
                        <h5 class="card-title fw-bold">Delete Item</h5>
                        <p class="card-text">Delete an item from the system</p>
                        <a href="deleteitem.php" class="btn btn-primary"><i class="las la-arrow-right"></i> Go</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="footer">
    <div class="container">
        <div class="d-flex justify-content-center m-auto mb-5" style="opacity: 0.25;">
            <img src="assets/icons8-cauliflower-64.png" width="40" height="40" alt="">
            <img src="assets/icons8-radish-64.png" width="40" height="40" alt="">
            <img src="assets/icons8-tomato-64.png" width="40" height="40" alt="">
            <img src="assets/icons8-eggplant-64.png" width="40" height="40" alt="">
        </div>
        <div class="text-center">
            <p class="text-black-50">Made with <span style="color: pink">&heartsuit;</span> by <span class="text-black">D21125387</span> | Assets by
                <a href="https://icons8.com" class="text-decoration-none text-black fw-bold">Icons8.com</a></p>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>
