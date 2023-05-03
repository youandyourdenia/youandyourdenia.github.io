<?php

// Retrieve form data
$name = $_POST['name'];
$date = $_POST['date'];

$conn = mysqli_connect("localhost", "root", "", "inventory_sys");

// Insert data into the database
$sql = "INSERT INTO categories (name, date)
VALUES ('$name', '$date')";
mysqli_query($conn, $sql);

header("Location: categories.php");
  ?>
