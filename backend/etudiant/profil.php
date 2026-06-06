<?php
include "../includes/config.php";
include "../includes/verif-session.php";

$titre = "Mon Profil - MMI Meaux Stages";
$connecte = true;
$id_etudiant = $_SESSION["id_etudiant"];

$sql = "SELECT * FROM etudiant WHERE `N°Etudiant` = ?";
$stmt = mysqli_prepare($connexion, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_etudiant);
mysqli_stmt_execute($stmt);
$resultat = mysqli_stmt_get_result($stmt);
$etudiant = mysqli_fetch_assoc($resultat);

include "../includes/debut.php";
include "../includes/header-etudiant.php";
?>

    <main class="flex-grow max-w-4xl w-full mx-auto px-4 py-10 space-y-6">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-blue-900 text-white px-6 py-6">
                <h1 class="text-2xl font-bold">Fiche Informations Étudiant</h1>
                <p class="text-sm text-blue-200 mt-1">Modifiez vos informations et votre mot de passe.</p>
            </div>

            <?php if (isset($_GET["ok"])) { ?>
                <div class="mx-6 mt-4 bg-green-50 border border-green-200 text-green-700 text-sm p-3 rounded-xl">
                    Modifications enregistrées.
                </div>
            <?php } ?>

            <?php if (isset($_GET["erreur"]) && $_GET["erreur"] == "mdp") { ?>
                <div class="mx-6 mt-4 bg-red-50 border border-red-200 text-red-700 text-sm p-3 rounded-xl">
                    Mot de passe actuel incorrect ou confirmation différente.
                </div>
            <?php } ?>

            <form action="traitement-profil.php" method="POST" class="p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Nom</label>
                        <input type="text" name="nom" value="<?php echo htmlspecialchars($etudiant["nom"]); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Prénom</label>
                        <input type="text" name="prenom" value="<?php echo htmlspecialchars($etudiant["prenom"]); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Téléphone</label>
                        <input type="text" name="telephone" value="<?php echo htmlspecialchars($etudiant["téléphone"]); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Formation</label>
                        <input type="text" name="formation" value="<?php echo htmlspecialchars($etudiant["formation"]); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Email</label>
                        <input type="email" value="<?php echo htmlspecialchars($etudiant["email"]); ?>" class="w-full px-3 py-2 border border-gray-300 bg-gray-50 rounded-lg text-sm" readonly>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Adresse</label>
                    <input type="text" name="adresse" value="<?php echo htmlspecialchars($etudiant["adresse"]); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2.5 rounded-xl font-semibold text-sm hover:bg-blue-700 transition">
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Changer le mot de passe</h2>
            <form action="traitement-mdp.php" method="POST" class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Mot de passe actuel</label>
                    <input type="password" name="mdp_actuel" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Nouveau mot de passe</label>
                        <input type="password" name="mdp_nouveau" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Confirmation</label>
                        <input type="password" name="mdp_confirm" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm">
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2.5 rounded-xl font-semibold text-sm hover:bg-blue-700 transition">
                        Mettre à jour le mot de passe
                    </button>
                </div>
            </form>
        </div>
    </main>

<?php include "../includes/footer.php"; ?>
