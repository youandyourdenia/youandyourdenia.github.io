<?php
// Retrieve form data
$name = $_POST['name'];
$quantity = $_POST['quantity'];
$buy_price = $_POST['buy_price'];
$sale_price = $_POST['sale_price'];
$date = $_POST['date'];
$category = $_POST['category'];

$conn = mysqli_connect("localhost", "root", "", "inventory_sys");

// Insert data into the database
$sql = "INSERT INTO products (name, quantity, buy_price, sale_price, date, category)
VALUES ('$name', '$quantity', '$buy_price', '$sale_price', '$date', '$category')";

mysqli_query($conn, $sql);

header("Location: products.php");
?>
