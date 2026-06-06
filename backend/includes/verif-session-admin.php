<?php
session_start();

if (!isset($_SESSION["id_enseignant"])) {
    header("Location: connexion.php");
    exit;
}
