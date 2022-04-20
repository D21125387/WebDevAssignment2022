<?php
// suppress warnings
error_reporting(0);
// init session
session_start();

// check if user is already logged in
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
} else {
    include 'config.php';

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // retrieve value from login form
        $formusername = $_POST['loginUsername'];
        $formpassword = $_POST['loginPassword'];
        // prepare sql statement
        $stmt = $conn->prepare("SELECT * FROM users WHERE username='$formusername' AND password='$formpassword'");
        $stmt->execute();

        // if exists and equal in database
        if ($stmt->rowCount() > 0) {
            $check = $stmt->fetch(PDO::FETCH_ASSOC);
            $row_id = $check['id'];
            // set session username
            $_SESSION['username'] = $formusername;
            // return to dashboard.php
            header("Location: dashboard.php");
        } else {
            // set log message
            $_SESSION['loginError'] = 'Invalid Credentials!';
            // return to index.php
            header("Location: index.php");
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
}
?>