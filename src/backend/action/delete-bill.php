<?php
include "../connect.php";

$id = $_POST["id"];

$query = "DELETE FROM bills WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();

$stmt->close();
header("Location: ../../../index.php");
exit;
?>