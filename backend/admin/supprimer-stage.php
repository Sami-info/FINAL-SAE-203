<?php
include "../includes/config.php";
include "../includes/verif-session-admin.php";

$id = $_GET["id"];

$sql = "DELETE FROM stage WHERE id_stage = ?";
$stmt = mysqli_prepare($connexion, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

header("Location: voir-stage.php?suppr=1");
exit;
