<?php
include "../includes/config.php";
include "../includes/verif-session.php";

$titre = "Mes Stages - MMI Meaux Stages";
$connecte = true;
$id_etudiant = $_SESSION["id_etudiant"];

// liste des offres
$sql = "SELECT offre.*, entreprise.nom AS nom_entreprise FROM offre 
        LEFT JOIN entreprise ON offre.id_entreprise = entreprise.id_entreprise 
        ORDER BY offre.date_de_publication DESC";
$resultat_offres = mysqli_query($connexion, $sql);

// stages de l'etudiant connecte
$sql = "SELECT stage.*, offre.titre_offre, entreprise.nom AS nom_entreprise 
        FROM stage 
        LEFT JOIN offre ON stage.id_offre = offre.id_offre 
        LEFT JOIN entreprise ON offre.id_entreprise = entreprise.id_entreprise 
        WHERE stage.`N°Etudiant` = ?";
$stmt = mysqli_prepare($connexion, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_etudiant);
mysqli_stmt_execute($stmt);
$resultat_stages = mysqli_stmt_get_result($stmt);

include "../includes/debut.php";
include "../includes/header-etudiant.php";
?>

    <main class="flex-grow max-w-7xl w-full mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                <h2 class="text-2xl font-bold text-gray-900">Offres de stages disponibles</h2>

                <?php if (mysqli_num_rows($resultat_offres) == 0) { ?>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 text-gray-500 text-sm">
                        Aucune offre pour le moment.
                    </div>
                <?php } ?>

                <?php while ($offre = mysqli_fetch_assoc($resultat_offres)) { ?>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 space-y-4">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900"><?php echo htmlspecialchars($offre["titre_offre"]); ?></h3>
                        <p class="text-sm text-gray-500"><?php echo htmlspecialchars($offre["nom_entreprise"]); ?> — <?php echo htmlspecialchars($offre["lieu"]); ?></p>
                    </div>
                    <p class="text-sm text-gray-600 leading-relaxed"><?php echo htmlspecialchars($offre["description_offre"]); ?></p>
                </div>
                <?php } ?>

                <h2 class="text-2xl font-bold text-gray-900 mt-8">Mes stages enregistrés</h2>

                <?php if (mysqli_num_rows($resultat_stages) == 0) { ?>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 text-gray-500 text-sm">
                        Vous n'avez pas encore de stage enregistré.
                    </div>
                <?php } ?>

                <?php while ($stage = mysqli_fetch_assoc($resultat_stages)) { ?>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-green-200 space-y-2">
                    <h3 class="text-lg font-bold text-gray-900"><?php echo htmlspecialchars($stage["titre_offre"]); ?></h3>
                    <p class="text-sm text-gray-500"><?php echo htmlspecialchars($stage["nom_entreprise"]); ?></p>
                    <p class="text-sm text-gray-600"><?php echo htmlspecialchars($stage["competence"]); ?></p>
                    <p class="text-xs text-gray-400">Du <?php echo htmlspecialchars($stage["date_debut"]); ?> au <?php echo htmlspecialchars($stage["date_fin"]); ?></p>
                </div>
                <?php } ?>
            </div>
        </div>
    </main>

<?php include "../includes/footer.php"; ?>
