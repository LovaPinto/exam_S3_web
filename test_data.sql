-- Données de test pour l'application BNGRC
-- Scénario 10 : Données de test complètes

-- Insertion des régions
INSERT INTO regions (nom) VALUES
('Amoron\'i Mania'),
('Vakinankaratra'),
('Atsinanana'),
('Menabe'),
('Atsimo-Andrefana');

-- Insertion des villes avec régions
INSERT INTO villes (nom, idregion) VALUES
('Antsirabe', 2),
('Toamasina', 3),
('Mahajanga', 4),
('Toliara', 5),
('Fianarantsoa', NULL);

-- Insertion des besoins (chronologiques)
INSERT INTO besoins (ville_id, type, designation, quantite, prix_unitaire, date_saisie) VALUES
(1, 'nature', 'Riz', 1000.00, 2.50, '2023-01-01 10:00:00'),
(2, 'matériaux', 'Tôle', 500.00, 12.00, '2023-01-02 11:00:00'),
(3, 'argent', 'Argent', 50000.00, 1.00, '2023-01-03 13:00:00'),
(1, 'nature', 'Huile', 300.00, 6.00, '2023-01-04 14:00:00'),
(2, 'nature', 'Riz', 800.00, 2.50, '2023-01-05 15:00:00');

-- Insertion des dons (chronologiques)
INSERT INTO dons (type, designation, quantite, date_saisie) VALUES
('nature', 'Riz', 1200.00, '2023-02-01 14:00:00'),
('matériaux', 'Tôle', 400.00, '2023-02-02 15:00:00'),
('argent', 'Argent', 30000.00, '2023-02-03 16:00:00'),
('nature', 'Huile', 250.00, '2023-02-04 17:00:00');
