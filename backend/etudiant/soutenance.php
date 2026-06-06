<?php
include "../includes/config.php";
include "../includes/verif-session.php";

$titre = "Soutenances - MMI Meaux Stages";
$connecte = true;
$id_etudiant = $_SESSION["id_etudiant"];

$sql = "SELECT soutenance.*, enseignant.nom AS nom_enseignant, enseignant.prenom AS prenom_enseignant 
        FROM soutenance 
        LEFT JOIN enseignant ON soutenance.id_enseignant = enseignant.id_enseignant 
        WHERE soutenance.`N°Etudiant` = ?";
$stmt = mysqli_prepare($connexion, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_etudiant);
mysqli_stmt_execute($stmt);
$resultat = mysqli_stmt_get_result($stmt);
$soutenance = mysqli_fetch_assoc($resultat);

$verif_col = mysqli_query($connexion, "SHOW COLUMNS FROM soutenance LIKE 'heure_debut'");
$nouveau_schema = mysqli_num_rows($verif_col) > 0;

include "../includes/debut.php";
include "../includes/header-etudiant.php";
?>

    <main class="flex-grow max-w-4xl w-full mx-auto px-4 py-10 space-y-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Évaluation & Soutenance</h1>
            <p class="text-gray-500 mt-1">Consultez votre planning de fin d'année et vos résultats.</p>
        </div>

        <?php if (!$soutenance) { ?>
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 text-gray-500 text-sm">
                Aucune soutenance planifiée pour le moment.
            </div>
        <?php } else { ?>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <span class="text-xs font-bold text-gray-400 uppercase">Date & Horaire</span>
                <p class="text-lg font-bold text-gray-900 mt-1"><?php echo htmlspecialchars($soutenance["date_soutenance"]); ?></p>
                <?php if ($nouveau_schema) { ?>
                    <p class="text-sm text-blue-600 font-medium"><?php echo htmlspecialchars($soutenance["heure_debut"]); ?> - <?php echo htmlspecialchars($soutenance["heure_fin"]); ?></p>
                <?php } else { ?>
                    <p class="text-sm text-blue-600 font-medium"><?php echo htmlspecialchars($soutenance["horaire"]); ?></p>
                <?php } ?>
            </div>
            <?php if ($nouveau_schema) { ?>
            <div>
                <span class="text-xs font-bold text-gray-400 uppercase">Salle / Emplacement</span>
                <p class="text-lg font-bold text-gray-900 mt-1"><?php echo $soutenance["Salle"] ? "Salle A" . htmlspecialchars($soutenance["Salle"]) : "Non définie"; ?></p>
            </div>
            <?php } ?>
            <div>
                <span class="text-xs font-bold text-gray-400 uppercase">Encadrant</span>
                <p class="text-sm font-semibold text-gray-800 mt-1"><?php echo htmlspecialchars($soutenance["prenom_enseignant"] . " " . $soutenance["nom_enseignant"]); ?></p>
            </div>
        </div>

        <?php if ($soutenance["note"]) { ?>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gray-900 text-white p-4 font-semibold text-lg">Mes Résultats</div>
            <div class="p-6 text-center">
                <span class="text-xs font-bold text-gray-500 uppercase">Note</span>
                <p class="text-3xl font-extrabold text-gray-900 mt-2"><?php echo htmlspecialchars($soutenance["note"]); ?> <span class="text-sm font-normal text-gray-400">/20</span></p>
            </div>
        </div>
        <?php } ?>
        <?php } ?>
    </main>

<?php include "../includes/footer.php"; ?>
