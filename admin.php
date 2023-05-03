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
    <title>Welcome</title>
</head>

<body>


</body>

</html>