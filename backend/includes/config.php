<?php
// connexion a la base
$host = "localhost";
$user = "root";
$password = "";
$database = "base_sae";

$connexion = mysqli_connect($host, $user, $password, $database);

if (!$connexion) {
    die("Erreur connexion : " . mysqli_connect_error());
}
