<!DOCTYPE html>
<html lang="en">

<?php include 'menubar.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <form method="post" action="./phpspreadsheet/import_sales.php" enctype="multipart/form-data">
        <h1>Import Sales</h1>
        <hr>
        <br>
        <div class="form-group">

            <label for="from_date">Sales from </label>
            <input type="date" name="in_from_date" class="form-control" id="in_from_date" onchange="from_change()">
        </div>
        <div class="form-group">

            <label for="to_date">Sales to </label>
            <input type="date" name="in_to_date" class="form-control" onchange="to_change()" id="in_to_date">
        </div>

        <hr>

        <div class="form-group">

            <label for="exampleInputFile">Import excel file: </label>
            <input type="file" name="file" class="form-control" id="exampleInputFile" onchange="fileChange()">
        </div>
        <br>
        <div>
            <button type="submit" name="submit" class="btn btn-primary" id="import_sales" disabled>Import</button>

        </div>
    </form>
</body>


<script>
    const from_date = document.getElementById('in_from_date')
    const to_date = document.getElementById('in_to_date')
    const import_sales = document.getElementById('import_sales')
    const file = document.getElementById('exampleInputFile')

    if (!from_date.value) {
        to_date.setAttribute('disabled', 'true')
    }

    const from_change = () => {

        to_date.removeAttribute('disabled')
        to_date.setAttribute('min', from_date.value)

        if ((!from_date.value) && (!to_date.value)) {
            import_sales.removeAttribute('disabled')
        }
    }

    const to_change = () => {
        // if (from_date.value && to_date.value) {
        //     import_sales.removeAttribute('disabled')
        // }
    }

    const fileChange = () => {
        if (from_date.value && to_date.value && file.value) {
            import_sales.removeAttribute('disabled')
        }
    }
</script>

</html>