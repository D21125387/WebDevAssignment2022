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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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

    <section id="viewitems">
        <div class="container p-5">
            <p><small><span>Dashboard</span><span style="color: gray">/Delete Item</span></small></p>
            <a href="dashboard.php" class="btn btn-outline-dark"><i class="las la-arrow-left"></i> Back</a>
            <div class="text-center col-6 m-auto" id="editMessage">
                <?php
                if(isset($_SESSION['deleteMessage'])){
                    echo $_SESSION['deleteMessage'];
                }
                ?>
            </div>
            <div class="input-group mt-5" id="searchInputGroup">
                <span class="input-group-text" id="basic-addon1"><i class="las la-search"></i></span>
                <input type="text" class="form-control" id="searchInput" placeholder="Search" aria-describedby="basic-addon1">
            </div>
            <?php
            include 'conn.php';

            $sql = "SELECT * FROM products";
            $stmt = $conn->prepare("SELECT * FROM products");
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            echo '<form action="dbdelete.php" method="post"><table class="table mt-5" id="viewitemstable">
<input type="text" name="id" id="id" readonly style="display: none" value="0">
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
            foreach($stmt->fetchAll() as $k=>$v) {
                echo '<tr>
      <th scope="row">'.$v['id'].'</th>
      <td>'.$v['name'].'</td>
      <td>'.$v['description'].'</td>
      <td>'.$v['stock'].'</td>
      <td>€'.$v['price'].'</td>
      <td class="m-auto text-center">
        <button class="btn btn-delete" onclick="deleteitem(\''.$v['id'].'\')" type="submit"><i class="las la-minus-circle"></i> Delete</button></td>
    </tr>';
            }

            echo '  </tbody>
</table></form>';
            $conn = null;
            ?>
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
        $(document).ready(function(){
            $("#searchInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#searchTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    <script>
        function deleteitem(id){
            document.getElementById('id').value = id;
            console.log(id);
        }
    </script>
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" crossorigin="anonymous"></script>
    </body>
    </html>
<?php
unset($_SESSION['deleteMessage']);
?>