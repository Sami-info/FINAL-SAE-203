<?php
include "../includes/config.php";
include "../includes/verif-session-admin.php";

$titre = "Soutenances - Admin | MMI Meaux";
$connecte = true;

$resultat = mysqli_query($connexion, "SELECT soutenance.*, etudiant.nom, etudiant.prenom 
    FROM soutenance 
    LEFT JOIN etudiant ON soutenance.`N°Etudiant` = etudiant.`N°Etudiant`");

include "../includes/debut.php";
include "../includes/header-admin.php";
?>

    <main class="flex-grow max-w-7xl mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Soutenances</h1>

        <?php if (mysqli_num_rows($resultat) == 0) { ?>
            <div class="bg-white p-8 rounded-2xl border border-gray-200 text-gray-500 text-sm">
                Aucune soutenance enregistrée.
            </div>
        <?php } else { ?>
        <div class="bg-white rounded-2xl shadow overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700">Étudiant</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700">Date</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700">Horaire</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700">Note</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    <?php while ($ligne = mysqli_fetch_assoc($resultat)) { ?>
                    <tr>
                        <td class="px-6 py-4"><?php echo htmlspecialchars($ligne["prenom"] . " " . $ligne["nom"]); ?></td>
                        <td class="px-6 py-4"><?php echo htmlspecialchars($ligne["date_soutenance"]); ?></td>
                        <td class="px-6 py-4"><?php echo htmlspecialchars($ligne["horaire"]); ?></td>
                        <td class="px-6 py-4"><?php echo htmlspecialchars($ligne["note"]); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php } ?>
    </main>

<?php include "../includes/footer.php"; ?>
