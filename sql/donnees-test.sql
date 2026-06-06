-- Données de test pour FINAL-SAE-203
-- Importer après base_sae.sql dans phpMyAdmin

USE `base_sae`;

-- Jury (nécessaire pour les enseignants)
INSERT INTO `jury` (`id_jury`, `numero_jury`) VALUES
(1, 1),
(2, 2);

-- Enseignants (connexion admin)
INSERT INTO `enseignant` (`id_enseignant`, `id_jury`, `nom`, `prenom`, `email`, `téléphone`, `mot_de_passe`) VALUES
(1, 1, 'Martin', 'Laurent', 'laurent.martin@univ-eiffel.fr', '0612345678', 'admin123'),
(2, 2, 'Dubois', 'Valerie', 'valerie.dubois@univ-eiffel.fr', '0698765432', 'admin456');

-- Étudiants (connexion étudiant)
INSERT INTO `etudiant` (`N°Etudiant`, `nom`, `prenom`, `email`, `formation`, `téléphone`, `mot_de_passe`, `TD`, `TP`, `date_naissance`, `lieu_naissance`, `adresse`) VALUES
(1, 'Dupont', 'Jean', 'jean.dupont@edu.univ-eiffel.fr', 'BUT MMI', '0611223344', 'etudiant1', 'A', 'A1', '2004-05-15', 'Meaux', '12 rue des Lilas, Meaux'),
(2, 'Martin', 'Sophie', 'sophie.martin@edu.univ-eiffel.fr', 'BUT MMI', '0655667788', 'etudiant2', 'B', 'B2', '2004-08-22', 'Paris', '45 avenue de la Gare, Meaux'),
(3, 'Bernard', 'Lucas', 'lucas.bernard@edu.univ-eiffel.fr', 'BUT MMI', '0677889900', 'etudiant3', 'A', 'A2', '2003-12-03', 'Coulommiers', '8 place du Marché, Meaux');
