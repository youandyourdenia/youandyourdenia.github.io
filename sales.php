<?php include 'menubar.php'; ?>
<?php include 'conn.php'; ?>
<?php

// session_start();
if ($_SESSION['level'] > 2) {
    header('Location: user.php');
}

?>
<?php

// session_start();
$branch = $_GET['branch'] ?? null;

if ($_SESSION['level'] == 2) {
    $user_branch = array();
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT (name) FROM branches INNER JOIN users ON branches.id = users.branch_id WHERE users.ID = '$user_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $user_branch = $row['name'];

    if ($branch !== $user_branch) {
        header('Location: sales.php?branch=' . $user_branch);
    }
}
$branches = array();;
$sql = "SELECT DISTINCT(name) FROM branches";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $branches[] = $row;
}


if (!isset($branch)) {

    $sales = array();;

    $sql = "SELECT * FROM sales";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $sales[] = $row;
    }


    $sql = "SELECT SUM(sales_made) as total_sales_made FROM sales";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $total_sales_made = $row['total_sales_made'];
} else {
    $sales = array();

    $sql = "SELECT * FROM sales WHERE name = '$branch'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $sales[] = $row;
    }


    $sql = "SELECT SUM(sales_made) as total_sales_made FROM sales WHERE name = '$branch'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $total_sales_made = $row['total_sales_made'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
</head>

<style>
    .heading {
        width: 60%;
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: space-between;

        position: relative;
        left: 50px;
        top: 50px;
    }

    .actions {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 2em;
    }

    .actions a {
        text-decoration: none;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: .4em;
    }
</style>

<body>
    <div class="heading">
        <div>
            <h1>Sales</h1>
            <p>Total Sales Made: <span>₱<?= $total_sales_made ?></span></p>

            <?php if ($_SESSION['level'] == '1') : ?>
                <label for="branch">Select Branch</label>
                <select name="branch" id="branch" onchange="change_branch()">
                    <option value="" <?php echo (!isset($_GET['branch'])) ? "selected" : "" ?>>All Branches</option>
                    <?php foreach ($branches as $b) : ?>

                        <option value="<?= $b['name'] ?>" <?php echo $b['name'] == $branch ? "selected" : "" ?>> <?= $b['name'] ?> </option>

                    <?php endforeach ?>
                </select>
            <?php endif ?>
            <?php if (($_SESSION['level'] == '2') && ($user_branch)) : ?>
                <p>Your branch is <strong><?= $user_branch ?></strong></p>
            <?php endif ?>

        </div>
        <div class="actions">
            <?php if ($_SESSION['level'] == '1') : ?>
                <a class="btn-primary" href="./import_sales_form.php"><i class='bx bx-import'></i>Import Sales</a>
            <?php endif ?>
            <a class="btn-primary" href="./export_sales_form.php<?php if (isset($_GET['branch'])) {
                                                                    echo "?branch=$branch";
                                                                } ?>"><i class='bx bx-export'></i>Export Sales</a>
        </div>

    </div>

    <?php
    if (count($sales) > 0) :
    ?>
        <table>
            <thead>
                <tr>
                    <th>Branch</th>
                    <th>UserID</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Quantity</th>
                    <th>Sales Made</th>
                    <th>Date</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($sales as $sale) {
                    echo '<tr>';
                    echo "<td>" . $sale['name'] . "</td>";
                    echo "<td>" . $sale['user_id'] . "</td>";
                    echo "<td>" . $sale['product_name'] . "</td>";
                    echo "<td>" . $sale['product_price'] . "</td>";
                    echo "<td>" . $sale['quantity'] . "</td>";
                    echo "<td>" . $sale['sales_made'] . "</td>";
                    echo "<td>" . $sale['date'] . "</td>";
                    echo "<td>" . $sale['time'] . "</td>";
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    <?php else : ?>
        <p style="margin-top: 5em;text-align: center">No sales to display</p>
    <?php endif; ?>
</body>

<script>
    const branch = document.getElementById("branch")

    const change_branch = () => {
        if (!branch.value == '') {

            window.location.href = `sales.php?branch=${branch.value}`
        } else {
            window.location.href = `sales.php`
        }
    }
</script>

</html>