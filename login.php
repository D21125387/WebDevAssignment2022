<?php
error_reporting(0);
session_start();

if(isset($_SESSION['username'])){
    header("Location: dashboard.php");
} else {
    include 'config.php';

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $formusername = $_POST['loginUsername'];
        $formpassword = $_POST['loginPassword'];
        $stmt = $conn->prepare("SELECT * FROM users WHERE username='$formusername' AND password='$formpassword'");
        $stmt->execute();

        if ($stmt->rowCount() > 0){
            $check = $stmt->fetch(PDO::FETCH_ASSOC);
            $row_id = $check['id'];
            // do something
            $_SESSION['username'] = $formusername;
            header("Location: dashboard.php");
        } else {
            $_SESSION['loginError'] = 'Invalid Credentials!';
            header("Location: index.php");
        }
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
}
?>