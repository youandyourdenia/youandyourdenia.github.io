<?php include 'menubar.php'; ?>

<?php

// session_start();
if ($_SESSION['level'] > 2) {
  header('Location: user.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <!-- Boxicons CDN link -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
  <title>Inventory</title>
</head>

<style>
  /* styles.css */

  form {
    margin: 3px auto;
    padding: 20px;
    border: 1px solid #ccc;
    width: 400px;
    font-family: Arial, sans-serif;
  }

  label {
    display: block;
    margin-bottom: 10px;
  }

  input[type="text"],
  input[type="date"],
  select {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    width: 100%;
    box-sizing: border-box;
    margin-bottom: 20px;
  }

  input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 20px;
  }

  input[type="submit"]:hover {
    background-color: #45a049;
  }
</style>

<body>
  <br />
  <?php

  $conn1 = mysqli_connect("localhost", "root", "", "inventory_sys");

  $sql = "SELECT * FROM categories";
  $result = mysqli_query($conn1, $sql);
  ?>

  <form action="insert_product.php" method="post" class="my-form">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name"><br>

    <label for="quantity">Quantity:</label><br>
    <input type="text" id="quantity" name="quantity"><br>

    <label for="buy_price">Buy Price:</label><br>
    <input type="text" id="buy_price" name="buy_price"><br>

    <label for="sale_price">Sale Price:</label><br>
    <input type="text" id="sale_price" name="sale_price"><br>

    <label for="date">Date:</label><br>
    <input type="date" id="date" name="date"><br><br>

    <select name="category">
      <?php
      while ($row = mysqli_fetch_array($result)) {
        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
      }
      ?>
    </select>

    <input type="submit" value="Submit">
  </form>

</body>

</html>