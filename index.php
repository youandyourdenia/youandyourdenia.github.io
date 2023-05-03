<?php


session_start();

if (isset($_SESSION['user_id'])) {

    header("Location: welcome.php");
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Your+Font+Name&display=swap" rel="stylesheet">
    <title>Login</title>
</head>

<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="login.php" method="post">
                    <h2>login</h2>
                    <?php if (isset($_SESSION['error'])) : ?>
                        <div class="error-box">
                            <p><?= $_SESSION['error'] ?></p>
                        </div>
                    <?php endif ?>
                    <div class="inputbox">
                        <ion-icon name="person-outline"></ion-icon>
                        <input type="text" name="username" required>
                        <label for="username">USERNAME</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="password" required>
                        <label for="password">PASSWORD</label>
                    </div>
                    <div class="forget">
                        <label for=""><input type="checkbox">Remember Me</label>
                    </div>
                    <button type="submit" value="Submit">Sign In</button>
                </form>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>