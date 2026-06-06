<?php
include "../includes/config.php";
include "../includes/verif-session-admin.php";

$titre = "Nouveau Stage - Admin | MMI Meaux";
$connecte = true;

$resultat_etudiants = mysqli_query($connexion, "SELECT `N°Etudiant`, nom, prenom FROM etudiant ORDER BY nom");

include "../includes/debut.php";
include "../includes/header-admin.php";
?>

    <main class="flex-grow max-w-4xl mx-auto px-4 py-10 w-full">
        <div class="mb-8">
            <a href="voir-stage.php" class="text-sm text-blue-600 hover:underline">&larr; Retour aux stages</a>
            <h1 class="text-3xl font-bold text-gray-900 mt-2">Déclarer un nouveau stage</h1>
            <p class="text-gray-500 text-sm mt-1">Remplissez le formulaire pour enregistrer un stage. Il sera visible côté étudiant.</p>
        </div>

        <form action="traitement-nouveau-stage.php" method="POST" class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 space-y-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Étudiant concerné</label>
                <select name="id_etudiant" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm">
                    <option value="">Choisir un étudiant</option>
                    <?php while ($etu = mysqli_fetch_assoc($resultat_etudiants)) { ?>
                        <option value="<?php echo $etu["N°Etudiant"]; ?>"><?php echo htmlspecialchars($etu["prenom"] . " " . $etu["nom"]); ?></option>
                    <?php } ?>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nom de l'entreprise</label>
                <input type="text" name="nom_entreprise" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Adresse entreprise</label>
                <input type="text" name="adresse_entreprise" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Sujet / Intitulé du stage</label>
                <input type="text" name="sujet_stage" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm"></textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Compétences visées</label>
                <input type="text" name="competences" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Lieu du stage</label>
                <input type="text" name="lieu" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Date de début</label>
                    <input type="date" name="date_debut" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Date de fin</label>
                    <input type="date" name="date_fin" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm">
                </div>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">
                Enregistrer le stage
            </button>
        </form>
    </main>

<?php include "../includes/footer.php"; ?>
