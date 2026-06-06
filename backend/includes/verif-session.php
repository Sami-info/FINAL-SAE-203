<?php
session_start();

if (!isset($_SESSION["id_etudiant"])) {
    header("Location: connexion.php");
    exit;
}
