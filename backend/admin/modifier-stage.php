<?php
include "../includes/config.php";
include "../includes/verif-session-admin.php";

$titre = "Modifier Stage - Admin | MMI Meaux";
$connecte = true;
$id = $_GET["id"];

$sql = "SELECT stage.*, offre.titre_offre, offre.description_offre FROM stage 
        LEFT JOIN offre ON stage.id_offre = offre.id_offre 
        WHERE stage.id_stage = ?";
$stmt = mysqli_prepare($connexion, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$resultat = mysqli_stmt_get_result($stmt);
$stage = mysqli_fetch_assoc($resultat);

if (!$stage) {
    header("Location: voir-stage.php");
    exit;
}

include "../includes/debut.php";
include "../includes/header-admin.php";
?>

    <main class="flex-grow max-w-3xl w-full mx-auto px-4 py-10">
        <div class="mb-8">
            <a href="voir-stage.php" class="text-sm text-blue-600 hover:underline">&larr; Retour</a>
            <h1 class="text-3xl font-bold text-gray-900 mt-2">Modifier le stage</h1>
            <p class="text-gray-500 text-sm"><?php echo htmlspecialchars($stage["titre_offre"]); ?></p>
        </div>

        <form action="traitement-modifier-stage.php" method="POST" class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 space-y-6">
            <input type="hidden" name="id_stage" value="<?php echo $stage["id_stage"]; ?>">

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Compétences visées</label>
                <input type="text" name="competence" value="<?php echo htmlspecialchars($stage["competence"]); ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Lieu</label>
                <input type="text" name="lieu" value="<?php echo htmlspecialchars($stage["lieu"]); ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Date de début</label>
                    <input type="date" name="date_debut" value="<?php echo htmlspecialchars($stage["date_debut"]); ?>" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Date de fin</label>
                    <input type="date" name="date_fin" value="<?php echo htmlspecialchars($stage["date_fin"]); ?>" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm">
                </div>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">
                Enregistrer les modifications
            </button>
        </form>
    </main>

<?php include "../includes/footer.php"; ?>
