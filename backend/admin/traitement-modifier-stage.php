<?php
include "../includes/config.php";
include "../includes/verif-session-admin.php";

$id_stage = $_POST["id_stage"];
$competence = $_POST["competence"];
$lieu = $_POST["lieu"];
$date_debut = $_POST["date_debut"];
$date_fin = $_POST["date_fin"];

$sql = "UPDATE stage SET competence = ?, lieu = ?, date_debut = ?, date_fin = ? WHERE id_stage = ?";
$stmt = mysqli_prepare($connexion, $sql);
mysqli_stmt_bind_param($stmt, "ssssi", $competence, $lieu, $date_debut, $date_fin, $id_stage);
mysqli_stmt_execute($stmt);

header("Location: voir-stage.php?ok=1");
exit;
