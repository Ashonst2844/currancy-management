<!DOCTYPE html>
<html lang="en">

<?php include "src/backend/connect.php"; ?>
<?php
$mainquery = "SELECT * FROM currencydb ORDER BY id DESC";
$mainresult = mysqli_query($conn, $mainquery);
$userdata = mysqli_fetch_assoc($mainresult);

$incomequery = "SELECT * FROM income ORDER BY id DESC";
$income = mysqli_query($conn, $incomequery);

$outcomequery = "SELECT * FROM outcome ORDER BY id DESC";
$outcome = mysqli_query($conn, $outcomequery);

$constquery = "SELECT * FROM const ORDER BY id DESC";
$const = mysqli_query($conn, $constquery);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency Management App</title>
    <link rel="stylesheet" href="src/style/dist/main.css">
</head>

<body>
    <div id="currency" class="cards">
        <span>Rp. <b id="currency__total"></b></span>
        <p>Your Current Money</p>
    </div>
    <div id="name" class="cards">
        <h1 id="username"></h1>
        <span>Wallets</span>
    </div>
    <div id="income" class="cards">
        <?php while ($income_log = mysqli_fetch_array($income)): ?>
            <div class="incomes" title="<?= $income_log['date'] ?>">
                <h2><?= htmlspecialchars($income_log['detail']) ?></h2>
                <span>+<?= number_format($income_log['income'], 0, ',', '.') ?></span>
            </div>
        <?php endwhile ?>
    </div>
    <div id="outcome" class="cards">
        <?php while ($outcome_log = mysqli_fetch_array($outcome)): ?>
            <div class="outcomes" title="<?= $outcome_log['date'] ?>">
                <h2><?= htmlspecialchars($outcome_log['detail']) ?></h2>
                <span>+<?= number_format($outcome_log['outcome'], 0, ',', '.') ?></span>
            </div>
        <?php endwhile ?>
    </div>

    <div id="calc" title="Calculator" onclick="goToApp('calc-app')" class="cards">
        <img src="src/img/calc.svg">
    </div>

    <div id="convert" title="Converter" onclick="goToApp('convert-app')" class="cards">
        <img src=" src/img/convert.svg">
    </div>

    <div id="estimate-control" class="cards"></div>

    <div id="estimate" class="cards"></div>

    <div id="add-income" class="cards">
        <img src="src/img/up.svg">
        <p>Add Income</p>
    </div>

    <div id="add-outcome" class="cards">
        <p>Add Outcome</p>
        <img src="src/img/down.svg">
    </div>

    <div id="const" class="cards"></div>

    <script src="src/script/main.js"></script>
</body>

</html>