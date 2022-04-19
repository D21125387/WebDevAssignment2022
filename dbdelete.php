<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: index.php");
    exit(0);
}

include 'conn.php';
$id = intval($_POST['id']);
$sql = "DELETE FROM products WHERE id=$id";
// use exec() because no results are returned
$conn->exec($sql);
$_SESSION['deleteMessage'] = "<div class='alert alert-success'><i class='lar la-check-circle'></i> Successfully deleted item with the id: ".$id."</div>";
header("Location: deleteitem.php");
exit(0);