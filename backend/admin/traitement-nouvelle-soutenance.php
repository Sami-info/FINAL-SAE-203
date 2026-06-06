<?php
include "../includes/config.php";
include "../includes/verif-session-admin.php";

$id_etudiant = $_POST["id_etudiant"];
$id_jury = $_POST["id_jury"];
$id_enseignant = $_POST["id_enseignant"];
$date_soutenance = $_POST["date_soutenance"];
$heure_debut = $_POST["heure_debut"];
$heure_fin = $_POST["heure_fin"];
$salle = $_POST["Salle"];
$note = $_POST["note"];

$verif_col = mysqli_query($connexion, "SHOW COLUMNS FROM soutenance LIKE 'heure_debut'");
$nouveau_schema = mysqli_num_rows($verif_col) > 0;

if ($nouveau_schema) {
    if ($note == "") {
        $sql = "INSERT INTO soutenance (id_jury, id_enseignant, `N°Etudiant`, date_soutenance, heure_debut, heure_fin, `Salle`) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($connexion, $sql);
        mysqli_stmt_bind_param($stmt, "iiisssi", $id_jury, $id_enseignant, $id_etudiant, $date_soutenance, $heure_debut, $heure_fin, $salle);
    } else {
        $sql = "INSERT INTO soutenance (id_jury, id_enseignant, `N°Etudiant`, date_soutenance, heure_debut, heure_fin, `Salle`, note) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($connexion, $sql);
        mysqli_stmt_bind_param($stmt, "iiisssii", $id_jury, $id_enseignant, $id_etudiant, $date_soutenance, $heure_debut, $heure_fin, $salle, $note);
    }
} else {
    if ($note == "") {
        $sql = "INSERT INTO soutenance (id_jury, id_enseignant, `N°Etudiant`, date_soutenance, horaire) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($connexion, $sql);
        mysqli_stmt_bind_param($stmt, "iiiss", $id_jury, $id_enseignant, $id_etudiant, $date_soutenance, $heure_debut);
    } else {
        $sql = "INSERT INTO soutenance (id_jury, id_enseignant, `N°Etudiant`, date_soutenance, horaire, note) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($connexion, $sql);
        mysqli_stmt_bind_param($stmt, "iiissi", $id_jury, $id_enseignant, $id_etudiant, $date_soutenance, $heure_debut, $note);
    }
}

mysqli_stmt_execute($stmt);

header("Location: soutenance.php?ok=1");
exit;
