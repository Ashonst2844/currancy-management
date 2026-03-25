<?php
include "../connect.php";

$detail = $_POST["detail"];
$price = $_POST["currency"];

$query = "INSERT INTO wishlist (detail, price) VALUES (?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("si", $detail, $price);
$stmt->execute();

$stmt->close();
header("Location: ../../../index.php");
exit;
?>