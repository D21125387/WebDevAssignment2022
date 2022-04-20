<?php
// create database and populate data
include 'config.php';

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE $dbname";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Database created successfully<br>";
} catch (PDOException $e) {
    echo "<br><br>" . $sql . "<br>" . $e->getMessage();
}

try {
    // sql to create table
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE TABLE users (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(30) NOT NULL,
  password VARCHAR(30) NOT NULL
  )";

    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Table Groceri created successfully";
} catch (PDOException $e) {
    echo "<br><br>" . $sql . "<br>" . $e->getMessage();
}

try {
    // sql to create table
    $sql = "CREATE TABLE products (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(30) NOT NULL,
  description VARCHAR(30) NOT NULL,
  stock INT NOT NULL,
  price DOUBLE NOT NULL
  )";

    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Table Groceri created successfully";
} catch (PDOException $e) {
    echo "<br><br>" . $sql . "<br>" . $e->getMessage();
}

try {
    $sql = "INSERT INTO `users` (`id`, `username`, `password`) VALUES (1, 'admin', 'admin');";
    $conn->exec($sql);
    echo "Inserted into 'users' successfully";
} catch (PDOException $e) {
    echo "<br><br>" . $sql . "<br>" . $e->getMessage();
}

try {
    $sql = "INSERT INTO `products` (`id`, `name`, `description`, `stock`, `price`) VALUES (1, 'Apple', 'Delicious Organic Red Apple', 100, 1.50);";
    $conn->exec($sql);
    $sql = "INSERT INTO `products` (`id`, `name`, `description`, `stock`, `price`) VALUES (2, 'Banana', 'Yummy Banana', 100, 1.00);";
    $conn->exec($sql);
    $sql = "INSERT INTO `products` (`id`, `name`, `description`, `stock`, `price`) VALUES (3, 'Orange', 'Vitamin C Rich Orange', 100, 1.25);";
    $conn->exec($sql);
    $sql = "INSERT INTO `products` (`id`, `name`, `description`, `stock`, `price`) VALUES (4, 'Eggplant', 'Purpur Eggplant', 100, 1.00);";
    $conn->exec($sql);
    $sql = "INSERT INTO `products` (`id`, `name`, `description`, `stock`, `price`) VALUES (5, 'Basil', 'Sweet n Spice Aroma', 100, 1.50);";
    $conn->exec($sql);
    echo "Inserted into 'products' successfully";
} catch (PDOException $e) {
    echo "<br><br>" . $sql . "<br>" . $e->getMessage();
}

$conn = null;

