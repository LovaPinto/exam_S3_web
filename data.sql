CREATE DATABASE IF NOT EXISTS gnbrc ;
USE gnbrc;

-- table region
CREATE TABLE regions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL UNIQUE
);
-- Table des villes
CREATE TABLE villes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL UNIQUE,
    idregion INT,
    FOREIGN KEY (idregion) REFERENCES regions(id) ON DELETE CASCADE
);

-- Table des besoins
CREATE TABLE besoins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ville_id INT NOT NULL,
    type ENUM('nature', 'matériaux', 'argent') NOT NULL,
    designation VARCHAR(255) NOT NULL,
    quantite DECIMAL(10,2) NOT NULL,
    prix_unitaire DECIMAL(10,2) NOT NULL,
    date_saisie DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ville_id) REFERENCES villes(id) ON DELETE CASCADE
);

-- Table des dons
CREATE TABLE dons (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type ENUM('nature', 'matériaux', 'argent') NOT NULL,
    designation VARCHAR(255) NOT NULL,
    quantite DECIMAL(10,2) NOT NULL,
    date_saisie DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Table du dispatch
CREATE TABLE dispatch (
    id INT AUTO_INCREMENT PRIMARY KEY,
    don_id INT NOT NULL,
    besoin_id INT NOT NULL,
    quantite_attribuee DECIMAL(10,2) NOT NULL,
    date_dispatch DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (don_id) REFERENCES dons(id) ON DELETE CASCADE,
    FOREIGN KEY (besoin_id) REFERENCES besoins(id) ON DELETE CASCADE
);

