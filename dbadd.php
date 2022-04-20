<?php
session_start();
// check user's login
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit(0);
}

// retrieve form's value
$name = $_POST['name'];
$desc = $_POST['description'];
$stock = intval($_POST['stock']);
$price = doubleval($_POST['price']);

// check if value is set, not empty, is the correct type
if (isset($name) && isset($desc) && isset($stock) && isset($price)) {
    if (is_string($name) && is_string($desc) && is_int($stock) && is_double($price)) {
        if (!empty($name) || !empty($desc) || $stock > 0 || $price > 0) {
            try {
                include 'conn.php';
                // insert table
                $sql = "INSERT INTO `products` (`id`, `name`, `description`, `stock`, `price`) VALUES (NULL, '$name', '$desc', $stock, $price);";
                $conn->exec($sql);
            } catch (PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
            }
            $conn = null;
            // set log message
            $_SESSION['addMessage'] = "<div class='alert alert-success'><i class='lar la-check-circle'></i> Successfully added new product: $name</div>";
            // return to additem.php
            header("Location: additem.php");
            // stop script
            exit(0);
        }
    }
}
// stop script
exit(0);