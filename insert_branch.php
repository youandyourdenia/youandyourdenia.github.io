<?php

// Retrieve form data
$name = $_POST['name'];

$conn = mysqli_connect("localhost", "root", "", "inventory_sys");

// Insert data into the database
$sql = "INSERT INTO branches (name)
VALUES ('$name')";
mysqli_query($conn, $sql);

header("Location: branches.php");
