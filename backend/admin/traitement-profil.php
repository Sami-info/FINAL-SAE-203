<?php
include "../includes/config.php";
include "../includes/verif-session-admin.php";

$id_enseignant = $_SESSION["id_enseignant"];
$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
$telephone = $_POST["telephone"];

$sql = "UPDATE enseignant SET nom = ?, prenom = ?, `téléphone` = ? WHERE id_enseignant = ?";
$stmt = mysqli_prepare($connexion, $sql);
mysqli_stmt_bind_param($stmt, "sssi", $nom, $prenom, $telephone, $id_enseignant);
mysqli_stmt_execute($stmt);

$_SESSION["nom_admin"] = $nom;
$_SESSION["prenom_admin"] = $prenom;

header("Location: profil.php?ok=1");
exit;
