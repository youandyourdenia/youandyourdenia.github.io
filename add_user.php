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

<form action="insert_user.php" method="post">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username"><br>

    <label for="pass">Password:</label><br>
    <input type="text" id="pass" name="pass"><br><br>

    <label for="branch">Branch:</label><br>
    <select name="branch" id="">

        <?php

        $conn = mysqli_connect("localhost", "root", "", "inventory_sys");

        // Insert data into the database
        $sql = "SELECT * FROM branches WHERE id != 0";
        $result = mysqli_query($conn, $sql);


        ?>

        <?php while ($row = mysqli_fetch_array($result)) : ?>
            <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>

        <?php endwhile ?>
    </select>

    <input type="submit" value="Submit">
</form>