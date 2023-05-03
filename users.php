<?php include 'menubar.php'; ?>
<?php include 'conn.php'; ?>
<?php

// session_start();
if ($_SESSION['level'] > 2) {
  header('Location: user.php');
}

?>

<link rel="stylesheet" href="layouts/styles.css">

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <title></title>
</head>

<style>
  /* Add this to your styles.css file or in the head section of your HTML document */

  .container {
    max-width: 800px;
    margin: 0 auto;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin: 0 auto;
  }

  th,
  td {
    padding: 10px;
    text-align: center;
    border: 1px solid #ffff;
  }

  th {
    background-color: #698af0;
    color: #333;
    font-weight: bold;
    text-transform: uppercase;
  }

  tr:hover {
    background-color: #ddd;
  }
</style>

<body>

  <div class="container mt-5 text-center ">
    <h1 style="text-align: center">List of Users</h1>
    <a href="add_user.php" class=" btn btn-primary">Add New</a>
    <table class="table table-bordered">
      <thead class="thead">
        <tr>
          <th>ID</th>
          <th>Username</th>
          <th>Password</th>
          <th>User Level</th>
          <th>Branch</th>
          <th>Tools</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT users.*, branches.name as branch_name FROM users INNER JOIN branches ON users.branch_id = branches.id";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['ID'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['password'] . "</td>";
            echo "<td>" . $row['level'] . "</td>";
            echo "<td>" . $row['branch_name'] . "</td>";
            echo "<td><a href='delete_users.php?id=" . $row['ID'] . "' onclick='return confirm(\"Are you sure you want to delete this User?\");'><i class='fa fa-trash'></i></a></td>";
            echo "</tr>";
          }
        } else {
          echo "0 results";
        }
        ?>
      </tbody>
    </table>
  </div>
</body>

</html>