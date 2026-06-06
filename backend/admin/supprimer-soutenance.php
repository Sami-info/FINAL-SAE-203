<?php
include "../includes/config.php";
include "../includes/verif-session-admin.php";

$id = $_GET["id"];

$sql = "DELETE FROM soutenance WHERE id_soutenance = ?";
$stmt = mysqli_prepare($connexion, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

header("Location: soutenance.php?suppr=1");
exit;
