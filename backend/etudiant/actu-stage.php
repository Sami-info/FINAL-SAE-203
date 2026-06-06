<?php
include "../includes/config.php";
include "../includes/verif-session.php";

$titre = "Actu Stage - MMI Meaux Stages";
$connecte = true;
$id_etudiant = $_SESSION["id_etudiant"];

$sql = "SELECT historique.*, offre.titre_offre FROM historique 
        LEFT JOIN offre ON historique.id_offre = offre.id_offre 
        WHERE historique.`N°Etudiant` = ? 
        ORDER BY historique.date_consultation DESC";
$stmt = mysqli_prepare($connexion, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_etudiant);
mysqli_stmt_execute($stmt);
$resultat = mysqli_stmt_get_result($stmt);

include "../includes/debut.php";
include "../includes/header-etudiant.php";
?>

    <main class="flex-grow max-w-4xl w-full mx-auto px-4 py-10 space-y-6">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Actualités et Suivi des Démarches</h1>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Historique de mes démarches</h2>

            <?php if (mysqli_num_rows($resultat) == 0) { ?>
                <p class="text-sm text-gray-500">Aucune démarche enregistrée pour le moment.</p>
            <?php } ?>

            <div class="space-y-4">
                <?php while ($ligne = mysqli_fetch_assoc($resultat)) { ?>
                <div class="flex items-start space-x-4 border-l-2 border-blue-600 pl-4">
                    <div>
                        <span class="text-xs text-gray-400"><?php echo htmlspecialchars($ligne["date_consultation"]); ?></span>
                        <h3 class="font-bold text-sm text-gray-800"><?php echo htmlspecialchars($ligne["candidature"]); ?></h3>
                        <?php if ($ligne["titre_offre"]) { ?>
                            <p class="text-xs text-gray-600 mt-0.5"><?php echo htmlspecialchars($ligne["titre_offre"]); ?></p>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </main>

<?php include "../includes/footer.php"; ?>
