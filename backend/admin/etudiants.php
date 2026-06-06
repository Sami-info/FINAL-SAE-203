<?php
include "../includes/config.php";
include "../includes/verif-session-admin.php";

$titre = "Étudiants - Admin | MMI Meaux";
$connecte = true;

$resultat = mysqli_query($connexion, "SELECT `N°Etudiant`, nom, prenom, email, formation, TD, TP FROM etudiant ORDER BY nom");

include "../includes/debut.php";
include "../includes/header-admin.php";
?>

    <main class="flex-grow max-w-7xl mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Liste des étudiants</h1>

        <?php if (mysqli_num_rows($resultat) == 0) { ?>
            <div class="bg-white p-8 rounded-2xl border border-gray-200 text-gray-500 text-sm">
                Aucun étudiant inscrit.
            </div>
        <?php } else { ?>
        <div class="bg-white rounded-2xl shadow overflow-hidden border border-gray-100">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700">N° Étudiant</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700">Nom</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700">Prénom</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700">Email</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700">Formation</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700">TD / TP</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    <?php while ($etu = mysqli_fetch_assoc($resultat)) { ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4"><?php echo htmlspecialchars($etu["N°Etudiant"]); ?></td>
                        <td class="px-6 py-4"><?php echo htmlspecialchars($etu["nom"]); ?></td>
                        <td class="px-6 py-4"><?php echo htmlspecialchars($etu["prenom"]); ?></td>
                        <td class="px-6 py-4"><?php echo htmlspecialchars($etu["email"]); ?></td>
                        <td class="px-6 py-4"><?php echo htmlspecialchars($etu["formation"]); ?></td>
                        <td class="px-6 py-4"><?php echo htmlspecialchars($etu["TD"] . " / " . $etu["TP"]); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php } ?>
    </main>

<?php include "../includes/footer.php"; ?>
