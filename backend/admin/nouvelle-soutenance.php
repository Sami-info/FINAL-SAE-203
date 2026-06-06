<?php
include "../includes/config.php";
include "../includes/verif-session-admin.php";

$titre = "Nouvelle Soutenance - Admin | MMI Meaux";
$connecte = true;

$resultat_etudiants = mysqli_query($connexion, "SELECT `N°Etudiant`, nom, prenom FROM etudiant ORDER BY nom");
$resultat_jury = mysqli_query($connexion, "SELECT id_jury, numero_jury FROM jury ORDER BY numero_jury");
$resultat_enseignants = mysqli_query($connexion, "SELECT id_enseignant, nom, prenom FROM enseignant ORDER BY nom");

$verif_col = mysqli_query($connexion, "SHOW COLUMNS FROM soutenance LIKE 'heure_debut'");
$nouveau_schema = mysqli_num_rows($verif_col) > 0;

include "../includes/debut.php";
include "../includes/header-admin.php";
?>

    <main class="flex-grow max-w-3xl w-full mx-auto px-4 py-10">
        <div class="mb-8">
            <a href="soutenance.php" class="text-sm text-blue-600 hover:underline">&larr; Retour à la gestion des soutenances</a>
            <h1 class="text-3xl font-bold text-gray-900 mt-2">Planifier une nouvelle soutenance</h1>
            <p class="text-gray-500 text-sm mt-1">Attribuez un créneau horaire, une salle et un jury à un étudiant.</p>
        </div>

        <form action="traitement-nouvelle-soutenance.php" method="POST" class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 space-y-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Étudiant</label>
                <select name="id_etudiant" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm">
                    <option value="">Choisir un étudiant</option>
                    <?php while ($etu = mysqli_fetch_assoc($resultat_etudiants)) { ?>
                        <option value="<?php echo $etu["N°Etudiant"]; ?>"><?php echo htmlspecialchars($etu["prenom"] . " " . $etu["nom"]); ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Date de passage</label>
                    <input type="date" name="date_soutenance" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Heure de début</label>
                    <input type="time" name="heure_debut" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Heure de fin</label>
                    <input type="time" name="heure_fin" <?php if ($nouveau_schema) echo "required"; ?> class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm">
                </div>
            </div>

            <?php if ($nouveau_schema) { ?>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Salle d'examen (numéro)</label>
                <input type="number" name="Salle" required min="1" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm" placeholder="Ex: 102 pour Salle A102">
            </div>
            <?php } else { ?>
            <input type="hidden" name="Salle" value="0">
            <?php } ?>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Jury</label>
                    <select name="id_jury" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm">
                        <option value="">Choisir un jury</option>
                        <?php while ($jury = mysqli_fetch_assoc($resultat_jury)) { ?>
                            <option value="<?php echo $jury["id_jury"]; ?>">Jury n°<?php echo htmlspecialchars($jury["numero_jury"]); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Encadrant</label>
                    <select name="id_enseignant" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm">
                        <option value="">Choisir un enseignant</option>
                        <?php while ($ens = mysqli_fetch_assoc($resultat_enseignants)) { ?>
                            <option value="<?php echo $ens["id_enseignant"]; ?>" <?php if ($ens["id_enseignant"] == $_SESSION["id_enseignant"]) echo "selected"; ?>>
                                <?php echo htmlspecialchars($ens["prenom"] . " " . $ens["nom"]); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Note (optionnel)</label>
                <input type="number" name="note" min="0" max="20" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm" placeholder="Sur 20">
            </div>

            <div class="flex justify-end gap-3">
                <a href="soutenance.php" class="px-5 py-2.5 border border-gray-300 rounded-xl text-sm font-semibold text-gray-600 hover:bg-gray-50">Annuler</a>
                <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl text-sm">
                    Planifier la soutenance
                </button>
            </div>
        </form>
    </main>

<?php include "../includes/footer.php"; ?>
