<?php

// Retrieve form data
$user = $_POST['username'];
$pass = $_POST['pass'];
$branch = $_POST['branch'];

$conn = mysqli_connect("localhost", "root", "", "inventory_sys");

// Insert data into the database
$sql = "INSERT INTO users (username, password, level, branch_id)
VALUES ('$user', '$pass', 3, '$branch')";
mysqli_query($conn, $sql);

header("Location: users.php");
