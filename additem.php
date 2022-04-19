<?php

error_reporting(0);

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

<section id="additem">
    <div class="container p-5">
        <p><small><span>Dashboard</span><span style="color: gray">/Add Item</span></small></p>
        <a href="dashboard.php" class="btn btn-outline-dark"><i class="las la-arrow-left"></i> Back</a>
        <div class="text-center col-6 m-auto">
            <?php
            $name = $_POST['name'];
            $desc = $_POST['description'];
            $stock = intval($_POST['stock']);
            $price = doubleval($_POST['price']);


            if(isset($name) && isset($desc) && isset($stock) && isset($price)){
                if(is_string($name) && is_string($desc) && is_int($stock) && is_double($price)){
                    if(!empty($name) || !empty($desc) || $stock > 0 || $price > 0){
                        try {
                            include 'conn.php';
                            $sql = "INSERT INTO `products` (`id`, `name`, `description`, `stock`, `price`) VALUES (NULL, '$name', '$desc', $stock, $price);";
                            $conn->exec($sql);
                        } catch(PDOException $e) {
                            echo $sql . "<br>" . $e->getMessage();
                        }
                        $conn = null;
                        echo "<div class='alert alert-success'><i class='lar la-check-circle'></i> Successfully added new product: $name</div>";
                    }
                }
            }
            ?>
        </div>
        <div class="row m-5">
            <form action="additem.php" method="post" class="col-6 m-auto">
                <div class="row mb-3">
                    <label for="name" class="col-sm-4 col-form-label col-form-label-sm">Product Name</label>
                    <div class="col">
                        <input type="text" class="form-control form-control-sm" id="name" name="name" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="description" class="col-sm-4 col-form-label col-form-label-sm">Product Description</label>
                    <div class="col">
                        <input type="text" class="form-control form-control-sm" id="description" name="description" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="stock" class="col-sm-4 col-form-label col-form-label-sm">Product Stock</label>
                    <div class="col">
                        <input type="number" class="form-control form-control-sm" id="stock" min="0" step="1" name="stock" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="price" class="col-sm-4 col-form-label col-form-label-sm">Product Price</label>
                    <div class="col">
                        <input type="number" class="form-control form-control-sm" id="price" min="0.00" step="0.01" name="price" required>
                    </div>
                </div>
                <div class="m-auto text-center">
                    <button type="submit" class="btn btn-primary"><i class="las la-plus-circle"></i> Add Item</button>
                </div>
            </form>
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
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>