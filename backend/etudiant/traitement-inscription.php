<?php
include "../includes/config.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: inscription.php");
    exit;
}

$email = $_POST["email"];
$mot_de_passe = $_POST["mot_de_passe"];
$confirmation = $_POST["confirmation"];

// on verifie que les 2 mdp sont pareils
if ($mot_de_passe != $confirmation) {
    header("Location: inscription.php?erreur=mdp");
    exit;
}

// on verifie si l'email existe deja
$sql = "SELECT email FROM etudiant WHERE email = ?";
$stmt = mysqli_prepare($connexion, $sql);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$resultat = mysqli_stmt_get_result($stmt);

if (mysqli_fetch_assoc($resultat)) {
    header("Location: inscription.php?erreur=email");
    exit;
}

// on ajoute le nouvel etudiant
$sql = "INSERT INTO etudiant (email, mot_de_passe) VALUES (?, ?)";
$stmt = mysqli_prepare($connexion, $sql);
mysqli_stmt_bind_param($stmt, "ss", $email, $mot_de_passe);
mysqli_stmt_execute($stmt);

header("Location: connexion.php?inscription=1");
exit;
