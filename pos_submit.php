<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'inventory_sys');

if (!isset($_POST['branch'])) {

    echo 'NO BRANCH SELECTED';
    return;
}
$branch = $_POST['branch'];
$name = $branch;
$user_id = $_SESSION['user_id'];
$quantity = array_sum($_POST['quantity']);
date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d');
$time = date('H:i:s');
$total_cost = floatval($_POST['total_cost']);

$i = 0;
foreach ($_POST['products'] as $product) {
    $prod_quantity = $_POST['quantity'][$i];
    $price = $_POST['price'][$i];
    $line_price = $price * $prod_quantity;
    echo $line_price;
    echo "</br>";

    $stmt2 = mysqli_prepare($conn, 'INSERT INTO sales (name,product_name, quantity, product_price, sales_made, user_id, date, time) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt2->bind_param('ssiddiss', $name, $product, $prod_quantity, $price, $line_price, $user_id, $date, $time);
    mysqli_stmt_execute($stmt2);
    mysqli_stmt_close($stmt2);

    $prod_id = $_POST['product_ids'][$i];
    $stmt3 = mysqli_prepare($conn, "UPDATE products SET quantity = quantity - $prod_quantity WHERE id = '$prod_id'");
    mysqli_stmt_execute($stmt3);
    mysqli_stmt_close($stmt3);

    $stmt4 = mysqli_prepare($conn, "DELETE FROM products WHERE id = '$prod_id' AND quantity = '0'");
    mysqli_stmt_execute($stmt4);
    mysqli_stmt_close($stmt4);

    $i++;
}

// $prod_quantity = $_POST['quantity'][$i];

//     $stmt2 = mysqli_prepare($conn, 'INSERT INTO sales_lines (sales_id, product_id, quantity) VALUES (?, ?, ?)');
//     $stmt2->bind_param('iii', $sales_id, $product, $prod_quantity);
//     mysqli_stmt_execute($stmt2);
//     mysqli_stmt_close($stmt2);

mysqli_close($conn);


echo "<script>alert('Sales added');</script>";
echo "<script>window.location.href = 'pos.php';</script>";
