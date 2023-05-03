<?php include 'conn.php'; ?>
<?php

include 'menubar.php';

$user = $_SESSION['user_id'];
$branch = null;
$sql = "SELECT branches.id as branch_id, branches.name as branch_name FROM branches INNER JOIN users ON users.branch_id = branches.id WHERE users.id = '$user'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$branch = $row;

// Retrieve the product information from the database
$query = "SELECT products.*, c.id as cat_id, c.name as cat_name FROM products INNER JOIN categories as c ON products.category = c.id";
$result = mysqli_query($conn, $query);

// Retrieve the unique categories from the database
$categories_query = "SELECT * FROM categories";
$categories_result = mysqli_query($conn, $categories_query);
$categories = array();
while ($row = mysqli_fetch_assoc($categories_result)) {
  $categories[] = $row;
}

$total_cost = 0;
?>
<!DOCTYPE html>
<html>

<head>
  <title>POS</title>
</head>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
  }

  h1 {
    text-align: center;
    margin-top: 50px;
  }

  form {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 30px;
    gap: 5em;
  }

  label {
    margin-bottom: 10px;
  }

  /* select {
    width: 300px;
    height: 200px;
    margin-bottom: 20px;
  } */

  input[type='submit'] {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
  }

  input[type='submit']:hover {
    background-color: rgb(90, 182, 81);
  }

  .notification {
    background-color: #4CAF50;
    color: white;
    text-align: center;
    padding: 10px;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1;
  }

  table {
    margin-bottom: 10em;
  }

  @media only screen and (max-width: 600px) {
    select {
      width: 200px;
      height: 150px;
    }
  }

  .category-selector {

    margin-left: 10em !important;
  }

  /* Filter Category Section */
  .filter-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
  }

  .filter-select {
    font-size: 16px;
    padding: 10px;
    border-radius: 5px;
    border: none;
    background-color: #f0f0f0;
  }

  .filter-button {
    font-size: 16px;
    padding: 10px 15px;
    border-radius: 5px;
    border: none;
    background-color: #4CAF50;
    color: white;
    cursor: pointer;
  }

  .filter-button:hover {
    background-color: #3e8e41;
  }

  .filter-button:active {
    background-color: #3e8e41;
    transform: translateY(2px);
  }

  .category-type {
    display: inline-block;
    padding: 5px 10px;
    margin-right: 10px;
    cursor: pointer;
  }

  .category-type:hover {
    background-color: lightgray;
  }

  tr:hover {
    background-color: #ddd;
  }
</style>

<body>
<div class="container">
  <h1>SELECT PRODUCT</h1>
  <div class="category-selector">
    <h3>Your Branch: <?= $branch['branch_name'] ?></h3>
  </div>


  <form action="pos_calculate.php" method="post">
    <input type="hidden" name="branch" value="<?= $branch['branch_name'] ?>">
    <table>
      <thead>
        <tr>
          <th>Product</th>
          <th>Price</th>
          <th>Category</th>
          <th>Select</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
          <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['sale_price']; ?></td>
            <td><?php echo $row['cat_name']; ?></td>
            <td>
              <input type="checkbox" name="product_id[]" value="<?php echo $row['id']; ?>" onchange="updateSelectedProducts(event)" data-price="<?php echo $row['sale_price']; ?>">
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
    <div>

      <p>Total Cost: <span id="total_cost">0</span></p>
      <input type="submit" value="Calculate">
    </div>
  </form>
</div>
</body>

<script>
  function updateSelectedProducts(event) {
    var checkbox = event.target;
    var productRow = checkbox.parentNode.parentNode;
    var productPrice = parseFloat(checkbox.getAttribute("data-price"));
    var totalCostDisplay = document.querySelector("#total_cost");
    var totalCost = parseFloat(totalCostDisplay.textContent);
    if (checkbox.checked) {
      totalCost += productPrice;
      productRow.style.backgroundColor = "lightgray";
    } else {
      totalCost -= productPrice;
      productRow.style.backgroundColor = "";
    }
    totalCostDisplay.textContent = totalCost.toFixed(2);
  }
  var categoryTypes = document.querySelectorAll(".category-type");
  categoryTypes.forEach(function(categoryType) {
    categoryType.addEventListener("click", function() {
      var selectedCategory = this.getAttribute("data-category");
      var products = document.querySelectorAll("tbody tr");
      products.forEach(function(product) {
        var productCategory = product.querySelector("td:nth-child(3)").textContent;
        if (productCategory === selectedCategory) {
          product.style.display = "table-row";
        } else {
          product.style.display = "none";
        }
      });
    });
  });
</script>

</html>