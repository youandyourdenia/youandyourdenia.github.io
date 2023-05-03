<?php
  session_start();

  if (!isset($_SESSION['order'])) {
    $_SESSION['order'] = array();
  }

  $product = array(
    "product_category" => $_POST['product_category'],
    "product_name" => $_POST['product_name'],
    "quantity" => $_POST['quantity'],
    "price" => $_POST['price']
  );

  array_push($_SESSION['order'], $product);

  header('Location: pos_calculate.php');
