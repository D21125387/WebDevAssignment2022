<?php
session_start();
// check user login
if (!isset($_SESSION['username'])) {
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
    <link rel="stylesheet"
          href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body class="poppins">
<!-- Navbar section -->
<section id="navbar">
    <nav class="navbar navbar-expand-lg navbar-light bg-light p-3 ps-5 pe-5">
        <div class="container ps-5 pe-5">
            <a class="navbar-brand" href="dashboard.php">
                <img src="assets/icons8-vegetables-box-100.png" alt="" width="30" height="30"
                     class="img-fluid align-text-bottom" style="transform: translateY(-3px)">
                <span style="color:#689D6D ">Groceri</span><span style="color: gray"> Dashboard</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
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
                            <button type="submit" class="btn btn-danger"><i class="las la-sign-out-alt"></i> Sign Out
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</section>

<!-- view items section -->
<section id="viewitems">
    <div class="container p-5">
        <p><small><span><a href="dashboard.php" style="color: black; text-decoration: none">Dashboard</a></span><span style="color: gray">/View Stock</span></small></p>
        <a href="dashboard.php" class="btn btn-outline-dark"><i class="las la-arrow-left"></i> Back</a>
        <div class="input-group mt-5">
            <span class="input-group-text" id="basic-addon1"><i class="las la-search"></i></span>
            <input type="text" class="form-control" id="searchInput" placeholder="Search"
                   aria-describedby="basic-addon1">
        </div>
        <?php
        include 'conn.php';
        // display all rows from products table
        $sql = "SELECT * FROM products";
        $stmt = $conn->prepare("SELECT * FROM products");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        echo '<table class="table mt-5">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Stock</th>
      <th scope="col">Price</th>
    </tr>
  </thead>
  <tbody id="searchTable">';
        foreach ($stmt->fetchAll() as $k => $v) {
            echo '<tr>
      <th scope="row">' . $v['id'] . '</th>
      <td>' . $v['name'] . '</td>
      <td>' . $v['description'] . '</td>
      <td>' . $v['stock'] . '</td>
      <td>€' . $v['price'] . '</td>
    </tr>';
        }

        echo '  </tbody>
</table>';
        $conn = null;
        ?>
    </div>
</section>

<!-- footer -->
<section id="footer">
    <div class="container">
        <div class="d-flex justify-content-center m-auto mb-5" style="opacity: 0.25;">
            <img src="assets/icons8-cauliflower-64.png" width="40" height="40" alt="">
            <img src="assets/icons8-radish-64.png" width="40" height="40" alt="">
            <img src="assets/icons8-tomato-64.png" width="40" height="40" alt="">
            <img src="assets/icons8-eggplant-64.png" width="40" height="40" alt="">
        </div>
        <div class="text-center">
            <p class="text-black-50">Made with <span style="color: pink">&heartsuit;</span> by <span class="text-black">D21125387</span>
                | Assets by
                <a href="https://icons8.com" class="text-decoration-none text-black fw-bold">Icons8.com</a></p>
        </div>
    </div>
</section>
<!-- Table search script -->
<script src="js/tableSearch.js"></script>
<!-- Bootstrap Requirement -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>

