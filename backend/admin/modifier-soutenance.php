<?php
include "../includes/config.php";
include "../includes/verif-session-admin.php";

$titre = "Modifier Soutenance - Admin | MMI Meaux";
$connecte = true;
$id = $_GET["id"];

$sql = "SELECT * FROM soutenance WHERE id_soutenance = ?";
$stmt = mysqli_prepare($connexion, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$resultat = mysqli_stmt_get_result($stmt);
$soutenance = mysqli_fetch_assoc($resultat);

if (!$soutenance) {
    header("Location: soutenance.php");
    exit;
}

$verif_col = mysqli_query($connexion, "SHOW COLUMNS FROM soutenance LIKE 'heure_debut'");
$nouveau_schema = mysqli_num_rows($verif_col) > 0;

$resultat_jury = mysqli_query($connexion, "SELECT id_jury, numero_jury FROM jury ORDER BY numero_jury");
$resultat_enseignants = mysqli_query($connexion, "SELECT id_enseignant, nom, prenom FROM enseignant ORDER BY nom");

include "../includes/debut.php";
include "../includes/header-admin.php";
?>

    <main class="flex-grow max-w-3xl w-full mx-auto px-4 py-10">
        <div class="mb-8">
            <a href="soutenance.php" class="text-sm text-blue-600 hover:underline">&larr; Retour</a>
            <h1 class="text-3xl font-bold text-gray-900 mt-2">Modifier la soutenance</h1>
        </div>

        <form action="traitement-modifier-soutenance.php" method="POST" class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 space-y-6">
            <input type="hidden" name="id_soutenance" value="<?php echo $soutenance["id_soutenance"]; ?>">

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Date</label>
                    <input type="date" name="date_soutenance" value="<?php echo htmlspecialchars($soutenance["date_soutenance"]); ?>" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Heure de début</label>
                    <input type="time" name="heure_debut" value="<?php echo htmlspecialchars($nouveau_schema ? $soutenance["heure_debut"] : $soutenance["horaire"]); ?>" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Heure de fin</label>
                    <input type="time" name="heure_fin" value="<?php echo htmlspecialchars($soutenance["heure_fin"] ?? ""); ?>" <?php if ($nouveau_schema) echo "required"; ?> class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm">
                </div>
            </div>

            <?php if ($nouveau_schema) { ?>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Salle d'examen (numéro)</label>
                <input type="number" name="Salle" value="<?php echo htmlspecialchars($soutenance["Salle"] ?? ""); ?>" required min="1" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm">
            </div>
            <?php } else { ?>
            <input type="hidden" name="Salle" value="0">
            <?php } ?>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Jury</label>
                    <select name="id_jury" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm">
                        <?php while ($jury = mysqli_fetch_assoc($resultat_jury)) { ?>
                            <option value="<?php echo $jury["id_jury"]; ?>" <?php if ($jury["id_jury"] == $soutenance["id_jury"]) echo "selected"; ?>>
                                Jury n°<?php echo htmlspecialchars($jury["numero_jury"]); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Encadrant</label>
                    <select name="id_enseignant" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm">
                        <?php while ($ens = mysqli_fetch_assoc($resultat_enseignants)) { ?>
                            <option value="<?php echo $ens["id_enseignant"]; ?>" <?php if ($ens["id_enseignant"] == $soutenance["id_enseignant"]) echo "selected"; ?>>
                                <?php echo htmlspecialchars($ens["prenom"] . " " . $ens["nom"]); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Note (/20)</label>
                <input type="number" name="note" min="0" max="20" value="<?php echo htmlspecialchars($soutenance["note"]); ?>" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">
                Enregistrer les modifications
            </button>
        </form>
    </main>

<?php include "../includes/footer.php"; ?>
