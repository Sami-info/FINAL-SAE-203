<?php
include "../includes/config.php";
session_start();

if (isset($_SESSION["id_etudiant"])) {
    header("Location: profil.php");
    exit;
}

$titre = "Mot de passe oublié - MMI Meaux Stages";
$connecte = false;

include "../includes/debut.php";
include "../includes/header-etudiant.php";
?>

    <main class="flex-grow flex items-center justify-center px-4 py-12">
        <div class="bg-white p-8 rounded-2xl shadow-md border border-gray-100 max-w-md w-full">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Mot de passe oublié ?</h1>
                <p class="text-gray-500 text-sm mt-2">Contactez le secrétariat MMI ou modifiez votre mot de passe depuis votre profil après connexion.</p>
            </div>

            <div class="bg-blue-50 border border-blue-200 p-4 rounded-xl text-sm text-blue-800 mb-6">
                Si vous vous souvenez de votre mot de passe, connectez-vous puis allez dans <strong>Mon Profil</strong> pour le changer.
            </div>

            <a href="connexion.php" class="block w-full text-center bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">
                Retour à la connexion
            </a>
        </div>
    </main>

<?php include "../includes/footer.php"; ?>
