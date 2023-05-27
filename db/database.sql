-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2021 at 03:39 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


Pep
CREATE TABLE `database`.`pep` (
    `username` VARCHAR(50) NOT NULL ,
     `password` VARCHAR(50) NOT NULL ,
     `role` enum('Pepinieriste','Agent') NOT NULL,
      PRIMARY KEY (`username `))
_________________________________
Physique
CREATE TABLE `database`.`personne_physique` (
    `CIN` VARCHAR(50) NOT NULL ,
     `nom` VARCHAR(50) NOT NULL ,
      `adresse` VARCHAR(75) NOT NULL ,
       `tel` VARCHAR(10) NOT NULL ,
       `adresse_pep` VARCHAR(75) NOT NULL ,
       `nom_pep` VARCHAR(50) NOT NULL ,
       id_pep VARCHAR(50) REFERENCES pep(username), 
       PRIMARY KEY (`CIN`))
____________________________________________
Moral
CREATE TABLE `database`.`personne_morale` (`ICE` INT NOT NULL ,`RC` INT NOT NULL , `nom` VARCHAR(50) NOT NULL ,`adresse` VARCHAR(75) NOT NULL ,`tel` VARCHAR(10) NOT NULL ,id_pep VARCHAR(50) REFERENCES pep(username), PRIMARY KEY (`ICE`))
_______________________________
declaration
CREATE TABLE `database`.`declaration` (`N_enregistr` INT NOT NULL ,`date_decl` DATE NOT NULL , `prise` BOOLEAN NOT NULL ,id_pep VARCHAR(50) REFERENCES pep(username), PRIMARY KEY (`N_enregistr`))
___________________________________________
Plant
CREATE TABLE `database`.`plant` (`id_plant` INT NOT NULL ,`espece` VARCHAR(50) NOT NULL , `variete` VARCHAR(50) NOT NULL ,`porte_greffe` VARCHAR(50) NOT NULL ,`nb` INT NOT NULL ,id_decl VARCHAR(50) REFERENCES declaration(N_enregistr), PRIMARY KEY (`id_plant`))
_________________________________________
Ctrl doc
CREATE TABLE `database`.`ctrl_doc` (`id_ctrl_doc` INT NOT NULL ,`date` DATE NOT NULL , `conform` BOOLEAN NOT NULL ,id_decl VARCHAR(50) REFERENCES declaration(N_enregistr), PRIMARY KEY (`id_ctrl_doc`))
__________________________________________
Ctrl1
CREATE TABLE `database`.`ctrl1` (`id_ctrl1` INT NOT NULL ,`date` DATE NOT NULL , `conform` BOOLEAN NOT NULL ,id_ctrl_doc INT REFERENCES ctrl_doc(id_ctrl_doc), PRIMARY KEY (`id_ctrl1`))
________________________________________________
Ctrl2
CREATE TABLE `database`.`ctrl2` (`id_ctrl2` INT NOT NULL ,`date` DATE NOT NULL , `conform` BOOLEAN NOT NULL ,id_ctrl1 INT REFERENCES ctrl1(id_ctrl1), PRIMARY KEY (`id_ctrl2`))
___________________________________________
Courrier
CREATE TABLE `database`.`courrier` (`Num` INT NOT NULL ,`date` DATE NOT NULL ,id_ctrl1 INT REFERENCES ctrl1(id_ctrl1), PRIMARY KEY (`Num`))
________________________________________________
acp
CREATE TABLE `database`.`acp` (`id_acp` INT NOT NULL ,`date` DATE NOT NULL ,`destination` VARCHAR(100) NOT NULL ,id_DECL INT REFERENCES declaration(N_enregistr), PRIMARY KEY (`id_acp`))
______
acp
CREATE TABLE `database`.`affectation` (id_ag INT REFERENCES agent(CIN),id_dec INT REFERENCES declaration(N_enregistr), PRIMARY KEY (`id_ad` , `id_dec`))



INSERT INTO `pep` (  `username`, `password`, `role`) VALUES
(  'yuki', '81dc9bdb52d04dc20036dbd8313ed055', 'Agent'),
(  'nezuko', 'e2fc714c4727ee9395f324cd2e7f331f', 'Pepinieriste');
