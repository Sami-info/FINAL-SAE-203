<?php
include "../includes/config.php";
include "../includes/verif-session-admin.php";

$titre = "Gestion des Stages - Admin | MMI Meaux";
$connecte = true;

$sql = "SELECT offre.*, entreprise.nom AS nom_entreprise FROM offre 
        LEFT JOIN entreprise ON offre.id_entreprise = entreprise.id_entreprise 
        ORDER BY offre.date_de_publication DESC";
$resultat = mysqli_query($connexion, $sql);

include "../includes/debut.php";
include "../includes/header-admin.php";
?>

    <main class="flex-grow max-w-7xl mx-auto px-4 py-10 w-full">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Offres de Stages</h1>
                <p class="text-gray-600 mt-1">Dépôts et validations des fiches de postes entreprises</p>
            </div>
            <a href="nouveau-stage.php" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold flex items-center gap-2">
                <span>+</span>
                Nouveau Stage
            </a>
        </div>

        <?php if (isset($_GET["ok"])) { ?>
            <div class="bg-green-50 border border-green-200 text-green-700 text-sm p-3 rounded-xl mb-6">
                Stage ajouté avec succès. L'étudiant peut le voir dans Mes Stages.
            </div>
        <?php } ?>

        <?php if (mysqli_num_rows($resultat) == 0) { ?>
            <div class="bg-white rounded-2xl border border-dashed border-gray-300 p-16 text-center">
                <h3 class="text-lg font-semibold text-gray-900">Aucune offre enregistrée</h3>
                <p class="mt-1 text-sm text-gray-500">Cliquez sur Nouveau Stage pour en ajouter une.</p>
            </div>
        <?php } else { ?>
        <div class="bg-white rounded-2xl shadow overflow-hidden border border-gray-100">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Poste / Rôle</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Entreprise</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Localisation</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    <?php while ($offre = mysqli_fetch_assoc($resultat)) { ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-5 font-bold text-gray-950"><?php echo htmlspecialchars($offre["titre_offre"]); ?></td>
                        <td class="px-6 py-5 text-gray-700"><?php echo htmlspecialchars($offre["nom_entreprise"]); ?></td>
                        <td class="px-6 py-5 text-gray-500"><?php echo htmlspecialchars($offre["lieu"]); ?></td>
                        <td class="px-6 py-5 text-gray-500"><?php echo htmlspecialchars($offre["date_de_publication"]); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php } ?>
    </main>

<?php include "../includes/footer.php"; ?>
