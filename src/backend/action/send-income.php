<?php
include "../connect.php";

$detail = $_POST["detail"];
$currency = $_POST["currency"];

$query = "INSERT INTO income (detail, income) VALUES (?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("si", $detail, $currency);
$stmt->execute();

$stmt->close();
header("Location: ../../../index.php");
exit;
?>