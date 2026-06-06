<?php
include "../includes/config.php";
include "../includes/verif-session.php";

$titre = "Mes Stages - MMI Meaux Stages";
$connecte = true;

include "../includes/debut.php";
include "../includes/header-etudiant.php";
?>

    <main class="flex-grow">
        <section class="bg-white border-b border-gray-200 py-16 px-4">
            <div class="max-w-5xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-6">
                    Bienvenue <?php echo htmlspecialchars($_SESSION["prenom"] . " " . $_SESSION["nom"]); ?>
                </h1>
                <p class="text-lg text-gray-600 mb-10 max-w-2xl mx-auto">
                    Suivez l'avancement de votre stage et gérez toutes les étapes depuis cet espace.
                </p>
            </div>
        </section>
    </main>

<?php include "../includes/footer.php"; ?>
