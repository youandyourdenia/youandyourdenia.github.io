<?php
require 'conn.php';

session_start();


$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = '$username' and password = '$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['user_id'] = $row['ID'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['level'] = $row['level'];
        unset($_SESSION["error"]);
        header("Location: welcome.php");
    }
} else {
    $_SESSION["error"] =  "Incorrect username or password.";
    header('Location: index.php');
    echo "Incorrect username or password.";
}

mysqli_close($conn);
