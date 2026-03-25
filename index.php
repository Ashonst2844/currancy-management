<!-- 
git add .
git commit -m "create Bils, Forms, Delete Convert, Fix Income/Outcome, Add some animation use GSAP"
git push origin master 
-->

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

$billquery = "SELECT * FROM bills ORDER BY id DESC";
$bill = mysqli_query($conn, $billquery);

$wishquery = "SELECT * FROM wishlist ORDER BY id DESC";
$wish = mysqli_query($conn, $wishquery);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency Management App</title>
    <link rel="stylesheet" href="src/style/dist/main.css">
</head>

<body>
    <div id="currency" class="cards">
        <span>Rp. <b id="currency__total">0</b></span>
        <p>Your Current Money</p>
    </div>
    <div id="name" class="cards">
        <h1 id="username"></h1>
    </div>
    <div id="income" class="cards">
        <h1 class="header">My Income</h1>
        <?php while ($income_log = mysqli_fetch_array($income)): ?>
            <div class="incomes" title="<?= $income_log['date'] ?>">
                <h2><?= htmlspecialchars($income_log['detail']) ?></h2>
                <span>+<?= number_format($income_log['income'], 0, ',', '.') ?></span>
            </div>
        <?php endwhile ?>
    </div>
    <div id="outcome" class="cards">
        <h1 class="header">My Outcome</h1>
        <?php while ($outcome_log = mysqli_fetch_array($outcome)): ?>
            <div class="outcomes" title="<?= $outcome_log['date'] ?>">
                <h2><?= htmlspecialchars($outcome_log['detail']) ?></h2>
                <span>-<?= number_format($outcome_log['outcome'], 0, ',', '.') ?></span>
            </div>
        <?php endwhile ?>
    </div>

    <div id="calc" title="Calculator" onclick="goToApp('calc-app')" class="cards">
        <img src="src/img/calc.svg">
    </div>

    <div id="wishlist" class="cards">
        <h1 class="header">My Wishlist</h1>
        <?php while ($wishlist = mysqli_fetch_array($wish)): ?>
            <div class="wishlists">
                <h2><?= htmlspecialchars($wishlist['detail']) ?></h2>
                <span class="wallet">
                    <i></i>/
                    <b><?= number_format($wishlist['price'], 0, ',', '.') ?></b>
                </span>
            </div>
        <?php endwhile ?>
        <button class="button-1" title="New Wishlist" id="wishlist__button" onclick="open_form('send-wishlist')">
            <img src="src/img/cross.svg">
        </button>
    </div>

    <div id="add-income" class="cards" onclick="open_form('send-income')">
        <img src="src/img/up.svg">
        <p>Add Income</p>
    </div>

    <div id="add-outcome" class="cards" onclick="open_form('send-outcome')">
        <p>Add Outcome</p>
        <img src="src/img/down.svg">
    </div>

    <div id="bill" class="cards">
        <h1 class="header">My Bills</h1>
        <?php while ($bill_log = mysqli_fetch_array($bill)): ?>
            <div class="bills">
                <h2><?= htmlspecialchars($bill_log['detail']) ?></h2>
                <span>Rp.<?= number_format($bill_log['currency'], 0, ',', '.') ?></span>
                <form action="src/backend/action/delete-bill.php" method="post" class="bills__delete">
                    <input type="hidden" name="id" value="<?php echo $bill_log['id']; ?>">
                    <input type="submit" value="X">
                </form>
            </div>
        <?php endwhile ?>
        <button class="button-1" title="New Bills" id="bill__button" onclick="open_form('send-bill')">
            <img src="src/img/cross.svg">
        </button>
    </div>

    <div id="form">
        <h1 id="form-title"></h1>
        <form method="post">
            <input type="text" name="detail" id="__detail" placeholder="Input Detail (max.50)" required>
            <input type="number" name="currency" id="__currency" placeholder="Input Currency (ex.20000)" min="0"
                step="500" required>
            <input type="submit" value="Submit">
        </form>
        <button class="button-1" title="Close" onclick="close_form()">
            <img src="src/img/cross.svg">
        </button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.2/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.14.2/dist/TextPlugin.min.js"></script>
    <script src="src/script/main.js"></script>
</body>

</html>