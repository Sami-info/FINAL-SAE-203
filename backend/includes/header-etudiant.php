    <nav class="bg-blue-900 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <span class="text-xl font-bold tracking-wide">MMI Meaux</span>
                <span class="bg-blue-700 text-xs px-2 py-1 rounded-sm uppercase font-semibold text-blue-200">Stages</span>
            </div>
            <div class="flex items-center space-x-6 text-sm font-medium">
                <?php if (isset($connecte) && $connecte == true) { ?>
                    <a href="accueil.php" class="hover:text-blue-200 transition">Accueil</a>
                    <a href="voir-stage.php" class="hover:text-blue-200 transition">Mes Stages</a>
                    <a href="soutenance.php" class="hover:text-blue-200 transition">Soutenance</a>
                    <a href="actu-stage.php" class="hover:text-blue-200 transition">Actu Stage</a>
                    <a href="profil.php" class="hover:text-blue-200 transition">Mon Profil</a>
                    <a href="deconnexion.php" class="hover:text-blue-200 transition">Déconnexion</a>
                <?php } else { ?>
                    <a href="inscription.php" class="hover:text-blue-200 transition">inscription</a>
                <?php } ?>
            </div>
        </div>
    </nav>
