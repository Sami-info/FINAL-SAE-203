<?php
include "../includes/config.php";
include "../includes/verif-session-admin.php";

$titre = "Entreprises - Admin | MMI Meaux";
$connecte = true;

$resultat = mysqli_query($connexion, "SELECT * FROM entreprise ORDER BY nom");

include "../includes/debut.php";
include "../includes/header-admin.php";
?>

    <main class="flex-grow max-w-7xl mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Entreprises Partenaires</h1>

        <?php if (mysqli_num_rows($resultat) == 0) { ?>
            <div class="bg-white p-8 rounded-2xl border border-gray-200 text-gray-500 text-sm">
                Aucune entreprise enregistrée. Ajoutez un stage pour en créer une.
            </div>
        <?php } else { ?>
        <div class="bg-white rounded-2xl shadow overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700">Nom</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700">Adresse</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700">Secteur</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    <?php while ($ligne = mysqli_fetch_assoc($resultat)) { ?>
                    <tr>
                        <td class="px-6 py-4 font-medium"><?php echo htmlspecialchars($ligne["nom"]); ?></td>
                        <td class="px-6 py-4"><?php echo htmlspecialchars($ligne["adresse"]); ?></td>
                        <td class="px-6 py-4"><?php echo htmlspecialchars($ligne["secteur"]); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php } ?>
    </main>

<?php include "../includes/footer.php"; ?>
