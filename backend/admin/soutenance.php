<?php
include "../includes/config.php";
include "../includes/verif-session-admin.php";

$titre = "Gestion des Soutenances - Admin | MMI Meaux";
$connecte = true;

$sql = "SELECT soutenance.*, etudiant.nom, etudiant.prenom, enseignant.nom AS nom_enseignant, enseignant.prenom AS prenom_enseignant, jury.numero_jury 
        FROM soutenance 
        LEFT JOIN etudiant ON soutenance.`N°Etudiant` = etudiant.`N°Etudiant` 
        LEFT JOIN enseignant ON soutenance.id_enseignant = enseignant.id_enseignant 
        LEFT JOIN jury ON soutenance.id_jury = jury.id_jury 
        ORDER BY soutenance.date_soutenance DESC";
$resultat = mysqli_query($connexion, $sql);

$verif_col = mysqli_query($connexion, "SHOW COLUMNS FROM soutenance LIKE 'heure_debut'");
$nouveau_schema = mysqli_num_rows($verif_col) > 0;

include "../includes/debut.php";
include "../includes/header-admin.php";
?>

    <main class="flex-grow max-w-7xl mx-auto px-4 py-10 w-full">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Gestion des Soutenances</h1>
                <p class="text-gray-600 mt-1">Année 2025-2026 • BUT MMI</p>
            </div>
            <a href="nouvelle-soutenance.php" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold flex items-center gap-2">
                <span>+</span>
                Nouvelle Soutenance
            </a>
        </div>

        <?php if (isset($_GET["ok"])) { ?>
            <div class="bg-green-50 border border-green-200 text-green-700 text-sm p-3 rounded-xl mb-6">
                Soutenance enregistrée avec succès.
            </div>
        <?php } ?>

        <?php if (isset($_GET["suppr"])) { ?>
            <div class="bg-green-50 border border-green-200 text-green-700 text-sm p-3 rounded-xl mb-6">
                Soutenance supprimée.
            </div>
        <?php } ?>

        <?php if (mysqli_num_rows($resultat) == 0) { ?>
            <div class="bg-white rounded-2xl border border-dashed border-gray-300 p-16 text-center">
                <h3 class="text-lg font-semibold text-gray-900">Aucune soutenance planifiée</h3>
                <p class="mt-1 text-sm text-gray-500">Cliquez sur Nouvelle Soutenance pour en ajouter une.</p>
            </div>
        <?php } else { ?>
        <div class="bg-white rounded-2xl shadow overflow-hidden border border-gray-100">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700">Étudiant</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700">Date</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700">Date & Heure</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700">Salle</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700">Jury</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700">Encadrant</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700">Note</th>
                        <th class="px-6 py-4 text-center font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php while ($ligne = mysqli_fetch_assoc($resultat)) { ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium"><?php echo htmlspecialchars($ligne["prenom"] . " " . $ligne["nom"]); ?></td>
                        <td class="px-6 py-4">
                            <div><?php echo htmlspecialchars($ligne["date_soutenance"]); ?></div>
                            <?php if ($nouveau_schema) { ?>
                                <div class="text-xs text-gray-500"><?php echo htmlspecialchars($ligne["heure_debut"]); ?> - <?php echo htmlspecialchars($ligne["heure_fin"]); ?></div>
                            <?php } else { ?>
                                <div class="text-xs text-gray-500"><?php echo htmlspecialchars($ligne["horaire"]); ?></div>
                            <?php } ?>
                        </td>
                        <td class="px-6 py-4"><?php echo ($nouveau_schema && $ligne["Salle"]) ? "Salle A" . htmlspecialchars($ligne["Salle"]) : "-"; ?></td>
                        <td class="px-6 py-4">Jury <?php echo htmlspecialchars($ligne["numero_jury"]); ?></td>
                        <td class="px-6 py-4"><?php echo htmlspecialchars($ligne["prenom_enseignant"] . " " . $ligne["nom_enseignant"]); ?></td>
                        <td class="px-6 py-4"><?php echo $ligne["note"] ? htmlspecialchars($ligne["note"]) . "/20" : "-"; ?></td>
                        <td class="px-6 py-4 text-center space-x-2">
                            <a href="modifier-soutenance.php?id=<?php echo $ligne["id_soutenance"]; ?>" class="text-blue-600 hover:underline">Modifier</a>
                            <a href="supprimer-soutenance.php?id=<?php echo $ligne["id_soutenance"]; ?>" class="text-red-600 hover:underline" onclick="return confirm('Supprimer cette soutenance ?');">Supprimer</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php } ?>
    </main>

<?php include "../includes/footer.php"; ?>
