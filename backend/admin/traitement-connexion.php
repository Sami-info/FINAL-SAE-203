<?php
include "../includes/config.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: connexion.php");
    exit;
}

$email = $_POST["email"] ?? "";
$mot_de_passe = $_POST["mot_de_passe"] ?? "";

if ($email == "" || $mot_de_passe == "") {
    header("Location: connexion.php?erreur=1");
    exit;
}

$sql = "SELECT id_enseignant, nom, prenom FROM enseignant WHERE email = ? AND mot_de_passe = ?";
$stmt = mysqli_prepare($connexion, $sql);
mysqli_stmt_bind_param($stmt, "ss", $email, $mot_de_passe);
mysqli_stmt_execute($stmt);
$resultat = mysqli_stmt_get_result($stmt);
$enseignant = mysqli_fetch_assoc($resultat);

if ($enseignant) {
    $_SESSION = array();
    $_SESSION["id_enseignant"] = $enseignant["id_enseignant"];
    $_SESSION["nom_admin"] = $enseignant["nom"];
    $_SESSION["prenom_admin"] = $enseignant["prenom"];
    header("Location: accueil.php");
    exit;
}

header("Location: connexion.php?erreur=1");
exit;
