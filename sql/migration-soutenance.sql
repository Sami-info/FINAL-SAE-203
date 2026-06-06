-- Migration : aligner la table soutenance avec base_sae.sql (pull juin 2026)
-- Exécuter une seule fois dans phpMyAdmin si vous avez encore la colonne "horaire"

USE `base_sae`;

ALTER TABLE `soutenance` CHANGE `horaire` `heure_debut` time DEFAULT NULL;
ALTER TABLE `soutenance` ADD `heure_fin` time DEFAULT NULL AFTER `heure_debut`;
ALTER TABLE `soutenance` ADD `Salle` int(11) DEFAULT NULL AFTER `heure_fin`;
