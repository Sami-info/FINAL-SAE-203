-- Données de test pour FINAL-SAE-203
-- IMPORTANT : exécuter TOUT ce fichier d'un coup dans phpMyAdmin (pas seulement la partie enseignant)
-- Ordre obligatoire : jury d'abord, puis enseignant (clé étrangère)

USE `base_sae`;

-- 1. Jurys (DOIT être inséré AVANT les enseignants)
INSERT IGNORE INTO `jury` (`id_jury`, `numero_jury`) VALUES
(1, 1),
(2, 2);

-- 2. Enseignants / admins (connexion : backend/admin/connexion.php)
INSERT IGNORE INTO `enseignant` (`id_enseignant`, `id_jury`, `nom`, `prenom`, `email`, `téléphone`, `mot_de_passe`) VALUES
(1, 1, 'Martin', 'Laurent', 'laurent.martin@univ-eiffel.fr', '0612345678', 'admin123'),
(2, 2, 'Dubois', 'Valerie', 'valerie.dubois@univ-eiffel.fr', '0698765432', 'admin456'),
(3, 1, 'Admin', 'Super', 'admin@admin.com', '0600000000', '123');

-- Met à jour le mot de passe si le compte existe déjà (INSERT IGNORE ne le modifie pas)
UPDATE `enseignant` SET `mot_de_passe` = '123' WHERE `email` = 'admin@admin.com';

-- 3. Étudiants (connexion : backend/etudiant/connexion.php)
INSERT IGNORE INTO `etudiant` (`N°Etudiant`, `nom`, `prenom`, `email`, `formation`, `téléphone`, `mot_de_passe`, `TD`, `TP`, `date_naissance`, `lieu_naissance`, `adresse`) VALUES
(1, 'Dupont', 'Jean', 'jean.dupont@edu.univ-eiffel.fr', 'BUT MMI', '0611223344', 'etudiant1', 'A', 'A1', '2004-05-15', 'Meaux', '12 rue des Lilas, Meaux'),
(2, 'Martin', 'Sophie', 'sophie.martin@edu.univ-eiffel.fr', 'BUT MMI', '0655667788', 'etudiant2', 'B', 'B2', '2004-08-22', 'Paris', '45 avenue de la Gare, Meaux'),
(3, 'Bernard', 'Lucas', 'lucas.bernard@edu.univ-eiffel.fr', 'BUT MMI', '0677889900', 'etudiant3', 'A', 'A2', '2003-12-03', 'Coulommiers', '8 place du Marché, Meaux');

-- Met à jour les étudiants si les comptes existent déjà (INSERT IGNORE ne les modifie pas)
UPDATE `etudiant` SET `nom`='Dupont', `prenom`='Jean', `email`='jean.dupont@edu.univ-eiffel.fr', `formation`='BUT MMI', `téléphone`='0611223344', `mot_de_passe`='etudiant1', `TD`='A', `TP`='A1', `date_naissance`='2004-05-15', `lieu_naissance`='Meaux', `adresse`='12 rue des Lilas, Meaux' WHERE `N°Etudiant`=1;
UPDATE `etudiant` SET `nom`='Martin', `prenom`='Sophie', `email`='sophie.martin@edu.univ-eiffel.fr', `formation`='BUT MMI', `téléphone`='0655667788', `mot_de_passe`='etudiant2', `TD`='B', `TP`='B2', `date_naissance`='2004-08-22', `lieu_naissance`='Paris', `adresse`='45 avenue de la Gare, Meaux' WHERE `N°Etudiant`=2;
UPDATE `etudiant` SET `nom`='Bernard', `prenom`='Lucas', `email`='lucas.bernard@edu.univ-eiffel.fr', `formation`='BUT MMI', `téléphone`='0677889900', `mot_de_passe`='etudiant3', `TD`='A', `TP`='A2', `date_naissance`='2003-12-03', `lieu_naissance`='Coulommiers', `adresse`='8 place du Marché, Meaux' WHERE `N°Etudiant`=3;

-- 4. Migration soutenance : exécuter sql/migration-soutenance.sql une fois si la table a encore la colonne "horaire"
