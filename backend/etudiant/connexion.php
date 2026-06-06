<?php
include "../includes/config.php";
session_start();

if (isset($_SESSION["id_etudiant"])) {
    header("Location: accueil.php");
    exit;
}

$titre = "Connexion - MMI Meaux Stages";
$connecte = false;

include "../includes/debut.php";
include "../includes/header-etudiant.php";
?>

    <main class="flex-grow flex items-center justify-center px-4 py-12">
        <div class="bg-white p-8 rounded-2xl shadow-md border border-gray-100 max-w-md w-full relative">

            <div class="absolute top-4 right-4">
                <a href="../admin/connexion.php" class="inline-flex items-center gap-1 text-xs font-semibold text-red-600 bg-red-50 hover:bg-red-100 px-2.5 py-1.5 rounded-lg transition border border-red-100 shadow-xs">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                    Accès Admin
                </a>
            </div>

            <div class="text-center mb-8 mt-2">
                <h1 class="text-2xl font-bold text-gray-900">Connexion à votre espace</h1>
                <p class="text-gray-500 text-sm mt-2">Saisissez vos identifiants universitaires</p>
            </div>

            <?php if (isset($_GET["erreur"])) { ?>
                <div class="bg-red-50 border border-red-200 text-red-700 text-sm p-3 rounded-xl mb-5">
                    Email ou mot de passe incorrect.
                </div>
            <?php } ?>

            <form action="traitement-connexion.php" method="POST" class="space-y-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Adresse e-mail universitaire</label>
                    <input type="email" name="email" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm" placeholder="prenom.nom@edu.univ-eiffel.fr">
                </div>
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-sm font-semibold text-gray-700">Mot de passe</label>
                        <a href="../../frontend/etudiant/mot-de-passe-oublie.html" class="text-xs text-blue-600 hover:underline">Mot de passe oublié ?</a>
                    </div>
                    <input type="password" name="mot_de_passe" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm" placeholder="••••••••">
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition shadow-sm mt-2">
                    Se connecter
                </button>
            </form>

            <div class="text-center mt-6 text-sm text-gray-600">
                Nouveau sur la plateforme ? <a href="../../frontend/etudiant/inscription.html" class="text-blue-600 font-semibold hover:underline">Créer un compte</a>
            </div>
        </div>
    </main>

<?php include "../includes/footer.php"; ?>
