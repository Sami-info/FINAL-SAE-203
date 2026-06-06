    <nav class="bg-blue-900 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <span class="text-xl font-bold tracking-wide">MMI Meaux</span>
                <span class="bg-blue-700 text-xs px-2 py-1 rounded-sm uppercase font-semibold text-blue-200">Stages</span>
                <span class="bg-red-600 text-xs px-2 py-1 rounded-sm uppercase font-semibold">ADMIN</span>
            </div>
            <?php if (isset($connecte) && $connecte == true) { ?>
            <div class="flex items-center space-x-6 text-sm font-medium">
                <a href="accueil.php" class="hover:text-blue-200 transition">Accueil</a>
                <a href="voir-stage.php" class="hover:text-blue-200 transition">Stages</a>
                <a href="soutenance.php" class="hover:text-blue-200 transition">Soutenances</a>
                <a href="#" class="hover:text-blue-200 transition">Étudiants</a>
                <a href="entreprise.php" class="hover:text-blue-200 transition">Entreprises</a>
                <a href="profil.php" class="hover:text-blue-200 transition">Profil</a>
                <a href="deconnexion.php" class="hover:text-blue-200 transition">Déconnexion</a>
            </div>
            <?php } ?>
        </div>
    </nav>
