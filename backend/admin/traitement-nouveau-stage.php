<?php
include "../includes/config.php";
include "../includes/verif-session-admin.php";

$id_etudiant = $_POST["id_etudiant"];
$nom_entreprise = $_POST["nom_entreprise"];
$adresse_entreprise = $_POST["adresse_entreprise"];
$sujet_stage = $_POST["sujet_stage"];
$description = $_POST["description"];
$competences = $_POST["competences"];
$lieu = $_POST["lieu"];
$date_debut = $_POST["date_debut"];
$date_fin = $_POST["date_fin"];

// on ajoute l'entreprise
$sql = "INSERT INTO entreprise (nom, adresse) VALUES (?, ?)";
$stmt = mysqli_prepare($connexion, $sql);
mysqli_stmt_bind_param($stmt, "ss", $nom_entreprise, $adresse_entreprise);
mysqli_stmt_execute($stmt);
$id_entreprise = mysqli_insert_id($connexion);

// on ajoute l'offre
$sql = "INSERT INTO offre (id_entreprise, titre_offre, description_offre, lieu, date_de_publication) VALUES (?, ?, ?, ?, CURDATE())";
$stmt = mysqli_prepare($connexion, $sql);
mysqli_stmt_bind_param($stmt, "isss", $id_entreprise, $sujet_stage, $description, $lieu);
mysqli_stmt_execute($stmt);
$id_offre = mysqli_insert_id($connexion);

// on ajoute le stage pour l'etudiant
$sql = "INSERT INTO stage (`N°Etudiant`, id_offre, lieu, competence, date_debut, date_fin) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($connexion, $sql);
mysqli_stmt_bind_param($stmt, "iissss", $id_etudiant, $id_offre, $lieu, $competences, $date_debut, $date_fin);
mysqli_stmt_execute($stmt);

header("Location: voir-stage.php?ok=1");
exit;
