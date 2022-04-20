<?php

session_start();
// check user's login
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit(0);
}

// establish connection
include 'conn.php';

// retrieve product value from form through POST
$prod_id = $_POST['id'];
$prod_name = $_POST['name'];
$prod_desc = $_POST['description'];
$prod_stock = $_POST['stock'];
$prod_price = $_POST['price'];

$prepare = array();

// if statements for concatenation of parameters
if (empty($prod_id)) {
    exit("Product ID Empty");
}

if (!empty($prod_name)) {
    array_push($prepare, "name='$prod_name'");
}

if (!empty($prod_desc)) {
    array_push($prepare, "description='$prod_desc'");
}

if (!empty($prod_stock)) {
    array_push($prepare, "stock='$prod_stock'");
}

if (!empty($prod_price)) {
    array_push($prepare, "price='$prod_price'");
}

// if nothing to change run this
if (empty($prepare)) {
    // set log message
    $_SESSION['editMessage'] = "<div class='alert alert-warning'><i class='las la-exclamation-circle'></i> No new value(s) for the item</div>";
    // return to edititem.php
    header("Location: edititem.php");
    // exit script
    exit(0);
}

// split array
$prepared = implode(",", $prepare);

// set sql statement
$sql = "UPDATE products SET $prepared WHERE id = $prod_id";

// Prepare statement
$stmt = $conn->prepare($sql);

// execute the query
$stmt->execute();

// echo a message to say the UPDATE succeeded
if ($stmt->rowCount() == 0) {
    $_SESSION['editMessage'] = "<div class='alert alert-danger'><i class='las la-exclamation-circle'></i> Failed to update item: " . $prod_name . "</div>";
    header("Location: edititem.php");
    exit(0);
} else {
    $_SESSION['editMessage'] = "<div class='alert alert-success'><i class='lar la-check-circle'></i> Successfully updated item: " . $prod_name . "</div>";
    header("Location: edititem.php");
    exit(0);
}