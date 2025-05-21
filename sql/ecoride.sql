/Applications/XAMPP/xamppfiles/htdocs/ecoride-- Fichier SQL de création de la base EcoRide
-- Date de génération : 2025-05-21 12:30:31
-- Version corrigée et nettoyée

DROP DATABASE IF EXISTS ecoride;
CREATE DATABASE ecoride CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE ecoride;

-- Table des utilisateurs
CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    date_naissance DATE,
    email VARCHAR(255) UNIQUE,
    mot_de_passe VARCHAR(255),
    date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    credits INT DEFAULT 20,
    vehicule_actif INT DEFAULT NULL,
    photo_profil VARCHAR(255),
    FOREIGN KEY (vehicule_actif) REFERENCES vehicules(id) ON DELETE SET NULL
);

-- Table des véhicules
CREATE TABLE vehicules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    modele VARCHAR(100),
    couleur VARCHAR(50),
    plaque VARCHAR(20),
    date_achat DATE,
    places INT,
    electrique ENUM('oui','non'),
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id) ON DELETE CASCADE
);

-- Table des trajets (rides)
CREATE TABLE rides (
    id INT AUTO_INCREMENT PRIMARY KEY,
    conducteur_id INT,
    vehicule_id INT,
    ville_depart VARCHAR(100),
    ville_arrivee VARCHAR(100),
    date_depart DATE,
    heure_depart TIME,
    places_disponibles INT,
    prix DECIMAL(10,2),
    animaux ENUM('avec','sans') DEFAULT 'sans',
    fumeur ENUM('fumeur','non-fumeur') DEFAULT 'non-fumeur',
    electrique ENUM('oui','non'),
    statut ENUM('prévu','en cours','terminé') DEFAULT 'prévu',
    date_statut TIMESTAMP NULL DEFAULT NULL,
    FOREIGN KEY (conducteur_id) REFERENCES utilisateurs(id),
    FOREIGN KEY (vehicule_id) REFERENCES vehicules(id)
);

-- Table des réservations
CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    trajet_id INT NOT NULL,
    date_reservation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE(utilisateur_id, trajet_id),
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id) ON DELETE CASCADE,
    FOREIGN KEY (trajet_id) REFERENCES rides(id) ON DELETE CASCADE
);

-- Table des avis
CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    date_avis DATE,
    contenu TEXT,
    note INT CHECK (note BETWEEN 1 AND 5),
    FOREIGN KEY (user_id) REFERENCES utilisateurs(id)
);

-- Table des trajets annulés
CREATE TABLE cancelled_rides (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ride_id INT,
    raison TEXT,
    date_annulation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ride_id) REFERENCES rides(id)
);

-- Table des employés
CREATE TABLE employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    email VARCHAR(255) UNIQUE,
    mot_de_passe VARCHAR(255),
    role ENUM('admin','support') DEFAULT 'support'
);

-- Table pour la validation des avis par les employés
CREATE TABLE avis_a_valider (
    id INT AUTO_INCREMENT PRIMARY KEY,
    review_id INT,
    employee_id INT,
    date_validation TIMESTAMP NULL,
    statut ENUM('en attente','validé','refusé') DEFAULT 'en attente',
    FOREIGN KEY (review_id) REFERENCES reviews(id),
    FOREIGN KEY (employee_id) REFERENCES employees(id)
);

-- Table des activités administratives
CREATE TABLE activites_admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    admin_id INT,
    type_action VARCHAR(255),
    description TEXT,
    date_action TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (admin_id) REFERENCES employees(id)
);

-- Table des transactions de crédits (recharges / retraits)
CREATE TABLE transactions_credits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT,
    type ENUM('recharge','retrait'),
    montant INT,
    date_transaction TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id)
);
