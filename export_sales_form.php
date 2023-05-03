<!DOCTYPE html>
<html lang="en">

<?php include 'menubar.php'; ?>
<?php
$branch = $_GET['branch'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Sales</title>
</head>

<style>
    form {

        width: 60%;
        margin: auto;
        /* display: flex;
        align-items: flex-start;
        flex-direction: column;

        position: relative;
        left: 50px;
        top: 50px; */
    }

    form>* {
        /* border: 1px solid red; */
    }
</style>

<body>
    <form method="post" action="./phpspreadsheet/export_sales.php">
        <input type="hidden" name="branch" value="<?php if ($branch) {
                                                        echo $branch;
                                                    } else {
                                                        echo "";
                                                    } ?>">
        <h1>Export Sales</h1>
        <hr>
        <br>
        <div class="form-group">

            <label for="from_date">Sales from </label>
            <input type="date" name="from_date" class="form-control" id="from_date" onchange="from_change()">
        </div>
        <div class="form-group">

            <label for="to_date">Sales to </label>
            <input type="date" name="to_date" class="form-control" onchange="to_change()" id="to_date">
        </div>
        <br>
        <div>
            <button id='export_sales' type="submit" name="submit" class="btn btn-primary" disabled>Export Sales</button>

        </div>
    </form>
</body>

<script>
    const from_date = document.getElementById('from_date')
    const to_date = document.getElementById('to_date')
    const export_sales = document.getElementById('export_sales')

    if (!from_date.value) {
        to_date.setAttribute('disabled', 'true')
    }

    const from_change = () => {

        to_date.removeAttribute('disabled')
        to_date.setAttribute('min', from_date.value)

        if ((!from_date.value) && (!to_date.value)) {
            export_sales.removeAttribute('disabled')
        }
    }

    const to_change = () => {
        if (from_date.value && to_date.value) {
            export_sales.removeAttribute('disabled')
        }
    }
</script>

</html>