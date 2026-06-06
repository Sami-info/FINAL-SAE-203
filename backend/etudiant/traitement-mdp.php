<?php
include "../includes/config.php";
include "../includes/verif-session.php";

$id_etudiant = $_SESSION["id_etudiant"];
$mdp_actuel = $_POST["mdp_actuel"];
$mdp_nouveau = $_POST["mdp_nouveau"];
$mdp_confirm = $_POST["mdp_confirm"];

if ($mdp_nouveau != $mdp_confirm) {
    header("Location: profil.php?erreur=mdp");
    exit;
}

$sql = "SELECT mot_de_passe FROM etudiant WHERE `N°Etudiant` = ?";
$stmt = mysqli_prepare($connexion, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_etudiant);
mysqli_stmt_execute($stmt);
$resultat = mysqli_stmt_get_result($stmt);
$ligne = mysqli_fetch_assoc($resultat);

if ($ligne["mot_de_passe"] != $mdp_actuel) {
    header("Location: profil.php?erreur=mdp");
    exit;
}

$sql = "UPDATE etudiant SET mot_de_passe = ? WHERE `N°Etudiant` = ?";
$stmt = mysqli_prepare($connexion, $sql);
mysqli_stmt_bind_param($stmt, "si", $mdp_nouveau, $id_etudiant);
mysqli_stmt_execute($stmt);

header("Location: profil.php?ok=1");
exit;
