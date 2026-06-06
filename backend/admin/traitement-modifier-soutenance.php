<?php
include "../includes/config.php";
include "../includes/verif-session-admin.php";

$id_soutenance = $_POST["id_soutenance"];
$date_soutenance = $_POST["date_soutenance"];
$heure_debut = $_POST["heure_debut"];
$heure_fin = $_POST["heure_fin"];
$salle = $_POST["Salle"];
$id_jury = $_POST["id_jury"];
$id_enseignant = $_POST["id_enseignant"];
$note = $_POST["note"];

$verif_col = mysqli_query($connexion, "SHOW COLUMNS FROM soutenance LIKE 'heure_debut'");
$nouveau_schema = mysqli_num_rows($verif_col) > 0;

if ($nouveau_schema) {
    if ($note == "") {
        $sql = "UPDATE soutenance SET date_soutenance = ?, heure_debut = ?, heure_fin = ?, `Salle` = ?, id_jury = ?, id_enseignant = ?, note = NULL WHERE id_soutenance = ?";
        $stmt = mysqli_prepare($connexion, $sql);
        mysqli_stmt_bind_param($stmt, "sssiiii", $date_soutenance, $heure_debut, $heure_fin, $salle, $id_jury, $id_enseignant, $id_soutenance);
    } else {
        $sql = "UPDATE soutenance SET date_soutenance = ?, heure_debut = ?, heure_fin = ?, `Salle` = ?, id_jury = ?, id_enseignant = ?, note = ? WHERE id_soutenance = ?";
        $stmt = mysqli_prepare($connexion, $sql);
        mysqli_stmt_bind_param($stmt, "sssiiiii", $date_soutenance, $heure_debut, $heure_fin, $salle, $id_jury, $id_enseignant, $note, $id_soutenance);
    }
} else {
    if ($note == "") {
        $sql = "UPDATE soutenance SET date_soutenance = ?, horaire = ?, id_jury = ?, id_enseignant = ?, note = NULL WHERE id_soutenance = ?";
        $stmt = mysqli_prepare($connexion, $sql);
        mysqli_stmt_bind_param($stmt, "ssiii", $date_soutenance, $heure_debut, $id_jury, $id_enseignant, $id_soutenance);
    } else {
        $sql = "UPDATE soutenance SET date_soutenance = ?, horaire = ?, id_jury = ?, id_enseignant = ?, note = ? WHERE id_soutenance = ?";
        $stmt = mysqli_prepare($connexion, $sql);
        mysqli_stmt_bind_param($stmt, "ssiiii", $date_soutenance, $heure_debut, $id_jury, $id_enseignant, $note, $id_soutenance);
    }
}

mysqli_stmt_execute($stmt);

header("Location: soutenance.php?ok=1");
exit;
