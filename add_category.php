<?php include 'menubar.php'; ?>

<?php

// session_start();
if ($_SESSION['level'] > 2) {
    header('Location: user.php');
}

?>

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

<br />

<form action="insert_category.php" method="post">
  <label for="name">Name:</label><br>
  <input type="text" id="name" name="name"><br>

  <label for="date">Date:</label><br>
  <input type="date" id="date" name="date"><br><br>

  <input type="submit" value="Submit">
</form>