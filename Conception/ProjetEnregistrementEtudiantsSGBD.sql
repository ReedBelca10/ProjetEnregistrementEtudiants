/*
-----------------------------------------------------------------------------------------------------------------------------------
---FICHIER SQL POUR LA CREATION DE LA BASE DE DONNEES POUR LE PROJET D'ENREGISTREMENT DES ETUDIANTS---------------
------------------------------------------------------------------------------------------------------------------
---Création de la base de données------------------------------------------------------------
-----------------------------------------------------------------------------------------------------------------------------------
*/
DROP DATABASE IF EXISTS `enregistrement_etudiant`;
CREATE DATABASE IF NOT EXISTS `enregistrement_etudiant`;
USE `enregistrement_etudiant`;

/*
------------------------------------------------------------------------------------------------------------------------------------
---------------------------------------------------------------------------------------------
---Création des utilisateurs de la BD--------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------
*/
CREATE USER 'SupUsrEnregisEtu'@'localhost' IDENTIFIED BY '';

GRANT ALL PRIVILEGES
ON `enregistrement_etudiant`.*
TO 'SupUsrEnregisEtu'@'localhost';

/*
------------------------------------------------------------------------------------------------------------------------------------
---------------------------------------------------------------------------------------------
---Création des tables-----------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------------------
*/
DROP TABLE IF EXISTS `photos_profils`;
CREATE TABLE IF NOT EXISTS `photos_profils`
(
    `nom_photo` VARCHAR(255) PRIMARY KEY,
    `typeMIME_photo` VARCHAR(30) NOT NULL,
    `taille_photo` INT
);

DROP TABLE IF EXISTS `internautes`;
CREATE TABLE IF NOT EXISTS `internautes`
(
    `id_internaute` INT AUTO_INCREMENT PRIMARY KEY,
    `nom_internaute` VARCHAR(30) NOT NULL,
    `prenoms_internaute` VARCHAR(40),
    `sexe_internaute` VARCHAR(10),
    `email_internaute` VARCHAR(40) NOT NULL,
    `mdp_internaute` VARCHAR(255) NOT NULL,
    `admin_internaute` BOOLEAN DEFAULT 0
); 

DROP TABLE IF EXISTS `etudiants`;
CREATE TABLE IF NOT EXISTS `etudiants`
(
    `mat_etu` INT(5) PRIMARY KEY,
    `nom_etu` VARCHAR(30) NOT NULL,
    `prenoms_etu` VARCHAR(40),
    `date_nais_etu` DATE,
    `sexe_etu` VARCHAR(10),
    `tel_etu` VARCHAR(15),
    `email_etu` VARCHAR(40) NOT NULL,
    `filiere_etu` VARCHAR(100) NOT NULL,
    `nom_photo` VARCHAR(255),
    FOREIGN KEY (`nom_photo`) REFERENCES `photos_profils`(`nom_photo`) ON DELETE CASCADE
);

/*Attribution de l'administrateur*/
UPDATE `internautes` SET 
