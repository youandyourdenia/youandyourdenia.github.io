<?php include 'menubar.php'; ?>
<?php include 'conn.php'; ?>

<?php

// session_start();
if ($_SESSION['level'] > 2) {
    header('Location: user.php');
}

?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link rel="stylesheet" href="layouts/styles.css">
<link href="https://fonts.googleapis.com/css2?family=Your+Font+Name&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<h1 style="text-align: center">Products</h1>
<div class="    d-flex justify-content-center mb-3">
    <a href="add_product.php" class="btn btn-primary">Add New</a>
</div>

<table class="table table-bordered table-striped">
    <?php
    $sql = "SELECT products.*, c.name as cat_name FROM products INNER JOIN categories as c ON c.id = products.category";
    $result = mysqli_query($conn, $sql);

    echo "<table border='1'>
<tr>
<th>ID</th>
<th>Category</th>
<th>Nname</th>
<th>Quantity</th>
<th>Buy_price</th>
<th>Sale_price</th>
<th>Date</th>
<th>Tools</th>
</tr>";

    // Populate the table with data from the database
    if (mysqli_num_rows($result) > 0) {
        // Output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['cat_name'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['quantity'] . "</td>";
            echo "<td>" . $row['buy_price'] . "</td>";
            echo "<td>" . $row['sale_price'] . "</td>";
            echo "<td>" . $row['date'] . "</td>";
            echo "<td><a href='delete_product.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this product?\");'><i class='fa fa-trash'></i></a></td>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "0 results";
    }

    echo "</table>";
    ?>