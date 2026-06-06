<?php
include "../includes/config.php";
include "../includes/verif-session-admin.php";

$titre = "Tableau de Bord - Admin | MMI Meaux";
$connecte = true;

$nb_etudiants = 0;
$nb_stages = 0;
$nb_soutenances = 0;
$nb_entreprises = 0;

$resultat = mysqli_query($connexion, "SELECT COUNT(*) AS total FROM etudiant");
$ligne = mysqli_fetch_assoc($resultat);
$nb_etudiants = $ligne["total"];

$resultat = mysqli_query($connexion, "SELECT COUNT(*) AS total FROM stage");
$ligne = mysqli_fetch_assoc($resultat);
$nb_stages = $ligne["total"];

$resultat = mysqli_query($connexion, "SELECT COUNT(*) AS total FROM soutenance");
$ligne = mysqli_fetch_assoc($resultat);
$nb_soutenances = $ligne["total"];

$resultat = mysqli_query($connexion, "SELECT COUNT(*) AS total FROM entreprise");
$ligne = mysqli_fetch_assoc($resultat);
$nb_entreprises = $ligne["total"];

include "../includes/debut.php";
include "../includes/header-admin.php";
?>

    <main class="flex-grow max-w-7xl mx-auto px-4 py-10">
        <div class="mb-10">
            <h1 class="text-4xl font-bold text-gray-900">Tableau de Bord</h1>
            <p class="text-gray-600 mt-2">
                Bienvenue, <?php echo htmlspecialchars($_SESSION["prenom_admin"] . " " . $_SESSION["nom_admin"]); ?> • Année 2025-2026
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="bg-white p-6 rounded-2xl shadow">
                <div class="text-sm text-gray-500">Étudiants inscrits</div>
                <div class="text-4xl font-bold text-gray-900 mt-2"><?php echo $nb_etudiants; ?></div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow">
                <div class="text-sm text-gray-500">Stages enregistrés</div>
                <div class="text-4xl font-bold text-gray-900 mt-2"><?php echo $nb_stages; ?></div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow">
                <div class="text-sm text-gray-500">Soutenances</div>
                <div class="text-4xl font-bold text-gray-900 mt-2"><?php echo $nb_soutenances; ?></div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow">
                <div class="text-sm text-gray-500">Entreprises partenaires</div>
                <div class="text-4xl font-bold text-gray-900 mt-2"><?php echo $nb_entreprises; ?></div>
            </div>
        </div>
    </main>

<?php include "../includes/footer.php"; ?>
