<!DOCTYPE html>
<html lang="en">

<?php include "src/backend/connect.php"; ?>
<?php
$mainquery = "SELECT * FROM currencydb ORDER BY id DESC";
$mainresult = mysqli_query($conn, $mainquery);
$userdata = mysqli_fetch_assoc($mainresult);

$incomequery = "SELECT * FROM income ORDER BY id DESC";
$incomeresult = mysqli_query($conn, $incomequery);
$income = mysqli_fetch_assoc($incomeresult);

$outcomequery = "SELECT * FROM outcome ORDER BY id DESC";
$outcomeresult = mysqli_query($conn, $outcomequery);
$outcome = mysqli_fetch_assoc($outcomeresult);

$constquery = "SELECT * FROM const ORDER BY id DESC";
$constresult = mysqli_query($conn, $constquery);
$const = mysqli_fetch_assoc($constresult);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency Management App</title>
    <link rel="stylesheet" href="src/style/dist/main.css">
</head>

<body>
    <div id="currency">
        <span>Rp. <b id="currency__total">
                <?= number_format($userdata['currency'], 0, ',', '.'), ",00" ?>
            </b></span>
        <p>Your Current Money</p>
    </div>
    <div id="name">
        <h1>
            <?= htmlspecialchars($userdata['name']) ?>`s
        </h1>
        <span>Wallet</span>
    </div>
    <div id="income">

    </div>
    <div id="outcome"></div>

    <div id="calc" title="Calculator" onclick="goToApp('calc-app')">
        <img src="src/img/calc.svg">
    </div>

    <div id="convert" title="Converter" onclick="goToApp('convert-app')">
        <img src=" src/img/convert.svg">
    </div>

    <script src="src/script/main.js"></script>
</body>

</html>