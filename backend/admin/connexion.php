<?php
include "../includes/config.php";
session_start();

if (isset($_SESSION["id_enseignant"])) {
    header("Location: accueil.php");
    exit;
}

$titre = "Connexion Admin - MMI Meaux Stages";
$connecte = false;

include "../includes/debut.php";
include "../includes/header-admin.php";
?>

    <main class="flex-grow flex items-center justify-center px-4 py-12">
        <div class="bg-white p-8 rounded-2xl shadow-md border border-gray-100 max-w-md w-full">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-red-50 text-red-600 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-900">Espace Personnel Administration</h1>
                <p class="text-gray-500 text-sm mt-2">Réservé au corps enseignant et secrétariat</p>
            </div>

            <?php if (isset($_GET["erreur"])) { ?>
                <div class="bg-red-50 border border-red-200 text-red-700 text-sm p-3 rounded-xl mb-5">
                    Email ou mot de passe incorrect.
                </div>
            <?php } ?>

            <form action="traitement-connexion.php" method="POST" class="space-y-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Identifiant ou Email Académique</label>
                    <input type="email" name="email" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:outline-none text-sm" placeholder="nom.prenom@univ-eiffel.fr">
                </div>
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-sm font-semibold text-gray-700">Mot de passe</label>
                        <a href="../etudiant/mot-de-passe-oublie.php" class="text-xs text-red-600 hover:underline">Identifiants perdus ?</a>
                    </div>
                    <input type="password" name="mot_de_passe" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-red-500 focus:outline-none text-sm" placeholder="••••••••">
                </div>

                <button type="submit" class="w-full bg-red-600 text-white py-3 rounded-xl font-semibold hover:bg-red-700 transition shadow-sm mt-2">
                    Accéder au tableau de bord
                </button>
            </form>

            <div class="text-center mt-6 text-sm">
                <a href="../etudiant/connexion.php" class="text-gray-600 hover:text-gray-900 font-medium inline-flex items-center gap-1">
                    ← Retour à l'accueil étudiant
                </a>
            </div>
        </div>
    </main>

<?php include "../includes/footer.php"; ?>
