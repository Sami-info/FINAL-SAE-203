<?php
include "../includes/config.php";
include "../includes/verif-session-admin.php";

$titre = "Gestion des Stages - Admin | MMI Meaux";
$connecte = true;

$sql = "SELECT stage.*, etudiant.nom, etudiant.prenom, offre.titre_offre, entreprise.nom AS nom_entreprise 
        FROM stage 
        LEFT JOIN etudiant ON stage.`N°Etudiant` = etudiant.`N°Etudiant` 
        LEFT JOIN offre ON stage.id_offre = offre.id_offre 
        LEFT JOIN entreprise ON offre.id_entreprise = entreprise.id_entreprise 
        ORDER BY stage.date_debut DESC";
$resultat = mysqli_query($connexion, $sql);

include "../includes/debut.php";
include "../includes/header-admin.php";
?>

    <main class="flex-grow max-w-7xl mx-auto px-4 py-10 w-full">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Gestion des Stages</h1>
                <p class="text-gray-600 mt-1">Tous les stages enregistrés • Année 2025-2026</p>
            </div>
            <a href="nouveau-stage.php" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold flex items-center gap-2">
                <span>+</span>
                Nouveau Stage
            </a>
        </div>

        <?php if (isset($_GET["ok"])) { ?>
            <div class="bg-green-50 border border-green-200 text-green-700 text-sm p-3 rounded-xl mb-6">
                Stage enregistré avec succès. Visible côté étudiant.
            </div>
        <?php } ?>

        <?php if (isset($_GET["suppr"])) { ?>
            <div class="bg-green-50 border border-green-200 text-green-700 text-sm p-3 rounded-xl mb-6">
                Stage supprimé.
            </div>
        <?php } ?>

        <?php if (mysqli_num_rows($resultat) == 0) { ?>
            <div class="bg-white rounded-2xl border border-dashed border-gray-300 p-16 text-center">
                <h3 class="text-lg font-semibold text-gray-900">Aucun stage enregistré</h3>
                <p class="mt-1 text-sm text-gray-500">Cliquez sur Nouveau Stage pour en ajouter un.</p>
            </div>
        <?php } else { ?>
        <div class="bg-white rounded-2xl shadow overflow-hidden border border-gray-100">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700">Étudiant</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700">Entreprise</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700">Sujet / Mission</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700">Période</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700">Lieu</th>
                        <th class="px-6 py-4 text-center font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php while ($stage = mysqli_fetch_assoc($resultat)) { ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium"><?php echo htmlspecialchars($stage["prenom"] . " " . $stage["nom"]); ?></td>
                        <td class="px-6 py-4"><?php echo htmlspecialchars($stage["nom_entreprise"]); ?></td>
                        <td class="px-6 py-4"><?php echo htmlspecialchars($stage["titre_offre"]); ?></td>
                        <td class="px-6 py-4"><?php echo htmlspecialchars($stage["date_debut"] . " - " . $stage["date_fin"]); ?></td>
                        <td class="px-6 py-4"><?php echo htmlspecialchars($stage["lieu"]); ?></td>
                        <td class="px-6 py-4 text-center space-x-2">
                            <a href="modifier-stage.php?id=<?php echo $stage["id_stage"]; ?>" class="text-blue-600 hover:underline">Modifier</a>
                            <a href="supprimer-stage.php?id=<?php echo $stage["id_stage"]; ?>" class="text-red-600 hover:underline" onclick="return confirm('Supprimer ce stage ?');">Supprimer</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php } ?>
    </main>

<?php include "../includes/footer.php"; ?>
