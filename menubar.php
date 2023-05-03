<?php

session_start();

if (!isset($_SESSION['user_id'])) {
  header('Location: index.php');
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

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
  <title>Inventory</title>
</head>

<body>

  <div class="sidebar active">
    <div class="logo_content">
      <div class="logo">
        <i class='bx bxs-data'></i>
        <div class="logo_name">Inventory</div>
      </div>
      <i class='bx bx-menu' id="btn"></i>
    </div>
    <ul class="nav_list">
      <!-- <li>
        <a href="#">
          <i class='bx bxs-home-alt-2'></i>
          <span class="links_name">Home</span>
        </a>
        <span class="tooltip">Home</span>
      </li> -->

      <li>
        <a href="pos.php">
          <i class='bx bxs-basket'></i>
          <span class="links_name">Point-of-Sale</span>
        </a>
        <span class="tooltip">Point-of-Sale</span>
      </li>
      <!-- <h5 style="color: #fff">Admin</h5> -->
      <?php if ($_SESSION['level'] == '1' || $_SESSION['level'] == '2') : ?>
        <hr class="hr border-white">
        <li>
          <a href="users.php">
            <i class='bx bxs-user'></i>
            <span class="links_name">User</span>
          </a>
          <span class="tooltip">Manage User</span>
        </li>
        <li>
          <a href="products.php">
            <i class='bx bxs-category'></i>
            <span class="links_name">Products</span>
          </a>
          <span class="tooltip">Manage Products</span>
        </li>
        <li>
          <a href="categories.php">
            <i class='bx bx-list-ul'></i>
            <span class="links_name">Categories</span>
          </a>
          <span class="tooltip">Categories</span>
        </li>

        <li>
          <a href="sales.php">
            <i class='bx bxs-store'></i>
            <span class="links_name">Sales</span>
          </a>
          <span class="tooltip">Sales</span>
        </li>
        <?php if ($_SESSION['level'] == '1') : ?>
          <li>
            <a href="branches.php">
              <i class='bx bx-git-branch'></i>
              <span class="links_name">Branches</span>
            </a>
            <span class="tooltip">Branches</span>
          </li>
        <?php endif ?>

      <?php endif ?>
      <!-- <li>
          <a href="pos.php">
          <i class='bx bx-cart'></i>
          <span class="links_name">Order</span>
          </a>
          <span class="tooltip">New Order</span>
        </li> -->
    </ul>
    <div class="profile_content">
      <div class="profile">
        <div class="profile_details">
          <img src="image/2d472de827743d5631d838f9d59f197e.jpg" alt="">
          <div class="name_job">
            <div class="name">Aldryn</div>
            <div class="job">Pogi</div>
          </div>
        </div>
        <a href="logout.php">
          <i class='bx bx-log-out' id="log_out"></i>
        </a>
      </div>
    </div>
  </div>

  <script>
    let btn = document.querySelector("#btn")
    let sidebar = document.querySelector(".sidebar")

    btn.onclick = function() {
      sidebar.classList.toggle("active")
    }
  </script>

</body>

</html>