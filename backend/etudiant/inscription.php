<?php
include "../includes/config.php";
session_start();

if (isset($_SESSION["id_etudiant"])) {
    header("Location: accueil.php");
    exit;
}

$titre = "Inscription - MMI Meaux Stages";
$connecte = false;

include "../includes/debut.php";
include "../includes/header-etudiant.php";
?>

    <main class="flex-grow flex items-center justify-center px-4 py-12">
        <div class="bg-white p-8 rounded-2xl shadow-md border border-gray-100 max-w-lg w-full">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-gray-900">Créer un compte étudiant</h1>
                <p class="text-gray-500 text-sm mt-2">Votre compte devra être validé par le responsable des stages.</p>
            </div>

            <?php if (isset($_GET["erreur"]) && $_GET["erreur"] == "mdp") { ?>
                <div class="bg-red-50 border border-red-200 text-red-700 text-sm p-3 rounded-xl mb-5">
                    Les mots de passe ne sont pas identiques.
                </div>
            <?php } ?>

            <?php if (isset($_GET["erreur"]) && $_GET["erreur"] == "email") { ?>
                <div class="bg-red-50 border border-red-200 text-red-700 text-sm p-3 rounded-xl mb-5">
                    Cet email est déjà utilisé.
                </div>
            <?php } ?>

            <form action="traitement-inscription.php" method="POST" class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Adresse e-mail universitaire</label>
                    <input type="email" name="email" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 text-sm" placeholder="prenom.nom@edu.univ-eiffel.fr">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Mot de passe</label>
                        <input type="password" name="mot_de_passe" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 text-sm" placeholder="••••••••">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Confirmation</label>
                        <input type="password" name="confirmation" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 text-sm" placeholder="••••••••">
                    </div>
                </div>

                <div class="bg-amber-50 border border-amber-200 p-3 rounded-xl text-xs text-amber-800">
                    Après validation de l'inscription, vous devrez compléter votre fiche profil lors de votre première connexion.
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition mt-2">
                    Demander l'inscription
                </button>
            </form>

            <div class="text-center mt-6 text-sm text-gray-600">
                Déjà inscrit ? <a href="connexion.php" class="text-blue-600 font-semibold hover:underline">Se connecter</a>
            </div>
        </div>
    </main>

<?php include "../includes/footer.php"; ?>
