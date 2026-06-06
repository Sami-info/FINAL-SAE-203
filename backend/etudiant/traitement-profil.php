<?php
include "../includes/config.php";
include "../includes/verif-session.php";

$id_etudiant = $_SESSION["id_etudiant"];
$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
$telephone = $_POST["telephone"];
$formation = $_POST["formation"];
$adresse = $_POST["adresse"];

$sql = "UPDATE etudiant SET nom = ?, prenom = ?, `téléphone` = ?, formation = ?, adresse = ? WHERE `N°Etudiant` = ?";
$stmt = mysqli_prepare($connexion, $sql);
mysqli_stmt_bind_param($stmt, "sssssi", $nom, $prenom, $telephone, $formation, $adresse, $id_etudiant);
mysqli_stmt_execute($stmt);

$_SESSION["nom"] = $nom;
$_SESSION["prenom"] = $prenom;

header("Location: profil.php?ok=1");
exit;
