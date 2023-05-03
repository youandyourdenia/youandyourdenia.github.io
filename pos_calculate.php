<!DOCTYPE html>
<html>

<head>
  <title>POS - Calculate</title>
</head>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
  }

  h1 {
    font-size: 24px;
    font-weight: bold;
    margin-top: 0;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
  }

  th {
    background-color: #ddd;
    text-align: left;
    padding: 8px;
  }

  td {
    border: 1px solid #ddd;
    padding: 8px;
  }

  input[type="number"] {
    width: 50px;
    text-align: right;
  }

  .btn {
    padding: 10px;
    font-size: 18px;
    font-weight: bold;
    background-color: #4CAF50;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  .btn:hover {
    background-color: #45a049;
  }

  p {
    font-size: 18px;
    font-weight: bold;
    margin: 0;
  }

  h1 {
    text-align: center;
  }

  .bottom {
    margin-top: 5em;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    flex-direction: column;
  }
</style>


<body>

  <?php include 'menubar.php'; ?>
  <form method="POST" action="pos_submit.php">
    <input type="hidden" name="branch" value="<?php echo $_POST['branch'] ?>">
    <h1>SELECTED PRODUCTS</h1>
    <table>
      <thead>
        <tr>
          <th>Product ID</th>
          <th>Product</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <?php
        require "./conn.php";

        $total_cost = 0;
        foreach ($_POST['product_id'] as $product_id) {
          $product_query = "SELECT * FROM products WHERE id = $product_id";
          $product_result = mysqli_query($conn, $product_query);
          $product = mysqli_fetch_assoc($product_result);
          $total_cost += $product['sale_price'];

          echo "<input type='hidden' name='product_ids[]' value='" . $product['id'] . "'>";
          echo "<input type='hidden' name='products[]' value='" . $product['name'] . "'>";
          echo "<input type='hidden' name='price[]' value='" . $product['sale_price'] . "'>";
        ?>
          <tr>
            <td><?php echo $product['id']; ?></td>
            <td><?php echo $product['name']; ?></td>
            <td><?php echo $product['sale_price']; ?></td>
            <td>
            <input type="number" name="quantity[]" value="1" min="1" max="<?= $product['quantity'] ?>" 
            onchange="updateTotal(event, <?php echo $product['sale_price']; ?>); 
            updateCostPerItem(event, <?php echo $product['sale_price']; ?>);">
            </td>
        <td class="cost-per-item"  ><?php echo $product['sale_price']; ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
    <div class="bottom">

      <p>Total Cost: <?php echo $total_cost; ?></p>
      </br>
      <hr>
      <div>

        <input type="hidden" name="total_cost" id="total_cost_input" value="<?php echo $total_cost; ?>">
        <input class="btn" type="submit" value="Submit">
        <input type="button" class="btn" onclick="printReceipt()" value="Get Receipt"></input>
      </div>
    </div>
  </form>
</body>
<script>
  function updateTotal(event, productSalePrice) {
    var quantityInput = event.target;
    var rowIndex = quantityInput.parentNode.parentNode.rowIndex;
    var oldQuantity = parseInt(quantityInput.defaultValue);
    var newQuantity = parseInt(quantityInput.value);
    var totalCost = parseFloat(document.querySelector("p").textContent.slice(12));

    totalCost -= oldQuantity * productSalePrice;
    totalCost += newQuantity * productSalePrice;
    document.querySelector("p").textContent = "Total Cost: " + totalCost.toFixed(2);
    quantityInput.defaultValue = newQuantity;

    // Update the hidden input field with the updated total cost
    document.getElementById("total_cost_input").value = totalCost.toFixed(2);
  }

  function updateCostPerItem(event, salePrice) {
    const quantity = event.target.value;
    const costPerItemCell = event.target.parentElement.nextElementSibling;
    const costPerItem = quantity * salePrice;
    costPerItemCell.textContent = costPerItem;
}


  function editQuantity(event) {
    var button = event.target;
    var quantityInput = button.parentNode.parentNode.querySelector("input[type='number']");
    var newQuantity = prompt("Enter the new quantity:", quantityInput.value);
    if (newQuantity != null) {
      quantityInput.value = newQuantity;
      var total_cost = 0;
      var rows = document.querySelectorAll("tbody tr");
      for (var i = 0; i < rows.length; i++) {
        var price = parseFloat(rows[i].querySelector("td:nth-child(2)").textContent);
        var quantity = parseFloat(rows[i].querySelector("input[type='number']").value);
        total_cost += price * quantity;
      }
      document.querySelector("p").textContent = "Total Cost: " + total_cost.toFixed(2);
    }
  }

  function printReceipt() {
    // Open a new window
    var receiptWindow = window.open('', '', 'width=600,height=400');
    var todayDate = new Date().toLocaleString("en-US", {
      timeZone: "Asia/Manila"
    })

    // Write the receipt HTML to the new window
    receiptWindow.document.write('<html><head><title>Receipt</title></head><body>');
    receiptWindow.document.write('<h1>Receipt</h1>');
    receiptWindow.document.write(`<p>Date: ${todayDate}</p>`);
    receiptWindow.document.write(`<table style='width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;'`);
    receiptWindow.document.write(`<thead><tr><th style='background-color: #ddd;
    text-align: left;
    padding: 8px;'>Product</th><th style='background-color: #ddd;
    text-align: left;
    padding: 8px;'>Price</th><th style='background-color: #ddd;
    text-align: left;
    padding: 8px;'>Quantity</th></tr></thead>`);
    receiptWindow.document.write('<tbody>');
    var total_cost = 0;
    var rows = document.querySelectorAll("tbody tr");
    for (var i = 0; i < rows.length; i++) {
      var name = rows[i].querySelector("td:nth-child(2)").textContent;
      var price = rows[i].querySelector("td:nth-child(3)").textContent;
      var quantity = rows[i].querySelector("input[type='number']").value;
      var cost = price * quantity;
      receiptWindow.document.write(`<tr><td style='border: 1px solid #ddd;
    padding: 8px;'> ${name} </td><td style='border: 1px solid #ddd;
    padding: 8px;'> ${price} </td><td style='border: 1px solid #ddd;
    padding: 8px;'> ${quantity} </td></tr>`);
      total_cost += cost;
    }
    receiptWindow.document.write('</tbody>');
    receiptWindow.document.write('</table>');
    receiptWindow.document.write('<p>Total Cost: ' + total_cost.toFixed(2) + '</p>');
    receiptWindow.document.write('</body></html>');

    // Print the receipt
    receiptWindow.print();
  }
</script>

</html>