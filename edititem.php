<?php
// check user's login legitimacy
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit(0);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Groceri Dashboard</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet"
          href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body class="poppins">

<!-- Nav bar section -->
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

<!-- View items section -->
<section id="viewitems">
    <div class="container p-5">
        <p><small><span><a href="dashboard.php" style="color: black; text-decoration: none">Dashboard</a></span><span
                        style="color: gray">/Edit Item</span></small></p>
        <a href="dashboard.php" class="btn btn-outline-dark"><i class="las la-arrow-left"></i> Back</a>
        <div class="text-center col-6 m-auto" id="editMessage">
            <?php
            // display existing log message
            if (isset($_SESSION['editMessage'])) {
                echo $_SESSION['editMessage'];
            }
            ?>
        </div>
        <div class="input-group mt-5" id="searchInputGroup">
            <span class="input-group-text" id="basic-addon1"><i class="las la-search"></i></span>
            <input type="text" class="form-control" id="searchInput" placeholder="Search"
                   aria-describedby="basic-addon1">
        </div>
        <?php
        // display all rows from the database of the products table
        include 'conn.php';

        $sql = "SELECT * FROM products";
        $stmt = $conn->prepare("SELECT * FROM products");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        echo '<table class="table mt-5" id="viewitemstable">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Stock</th>
      <th scope="col">Price</th>
      <th scope="col"></th>
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
      <td class="m-auto text-center"><button class="btn btn-edit"
      onclick="edititem(\'' . $v['id'] . '\',\'' . $v['name'] . '\')"
      ><i class="las la-edit"></i> Edit</button></td>
    </tr>';
        }

        echo '  </tbody>
</table>';
        // close connection
        $conn = null;
        ?>
    </div>
</section>

<section id="edititem" style="display: none;">
    <div class="container p-5 pt-0">
        <div class="row m-5">
            <form action="dbedit.php" method="post" class="col-6 m-auto">
                <div class="row mb-3">

                    <div class="text-center">
                        <h4><i class="las la-edit"></i> <span id="editName"></span></h4>
                        <br>
                    </div>
                    <input type="text" class="form-control form-control-sm" id="id" name="id" value="0" readonly
                           style="display: none">
                    <label for="name" class="col-sm-4 col-form-label col-form-label-sm">Product Name</label>
                    <div class="col">
                        <input type="text" class="form-control form-control-sm" id="name" name="name">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="description" class="col-sm-4 col-form-label col-form-label-sm">Product
                        Description</label>
                    <div class="col">
                        <input type="text" class="form-control form-control-sm" id="description" name="description">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="stock" class="col-sm-4 col-form-label col-form-label-sm">Product Stock</label>
                    <div class="col">
                        <input type="number" class="form-control form-control-sm" id="stock" min="0" step="1"
                               name="stock">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="price" class="col-sm-4 col-form-label col-form-label-sm">Product Price</label>
                    <div class="col">
                        <input type="number" class="form-control form-control-sm" id="price" min="0.00" step="0.01"
                               name="price">
                    </div>
                </div>
                <div class="m-auto text-center">
                    <a onclick="cancel()" class="btn btn-danger"><i class="lar la-times-circle"></i> Cancel</a>
                    <button type="submit" class="btn btn-primary"><i class="las la-edit"></i> Edit Item</button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Footer section -->
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

<!-- Editor Panel Toggle Function -->
<script>
    function edititem(id, name) {
        document.getElementById('id').value = id;
        console.log(id);
        document.getElementById('editName').innerText = name;
        document.getElementById('viewitemstable').style.display = "none";
        document.getElementById('searchInputGroup').style.display = "none";
        document.getElementById('edititem').style.display = "block";
        document.getElementById('editMessage').style.display = "none";
    }

    // Refresh page
    function cancel() {
        window.location = "edititem.php";
    }
</script>

<!-- Client Side Prevention for Duplicated Database Entry -->
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
<!-- Table Search with Bootstrap & jQuery -->
<script src="js/tableSearch.js"></script>

<!-- Bootstrap Requirement -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>
<?php
// remove existing log
unset($_SESSION['editMessage']);
?>

