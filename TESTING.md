# Scénarios de Test - Application BNGRC

## Vue d'ensemble
Cette application gère la distribution de dons aux sinistrés par ville selon le principe FIFO (First In First Out).

## Prérequis
- Base de données `gnbrc` créée avec les tables et données de base
- Serveur PHP lancé : `php -S localhost:8000 -t public`
- Accès via : http://localhost:8000

---

## Scénario 1 : Gestion des Régions

### 1.1 Ajouter une nouvelle région
1. Aller sur `/regions`
2. Dans "Ajouter une région" :
   - Nom : "Amoron'i Mania"
   - Cliquer "Ajouter"
3. Vérifier que la région apparaît dans la liste

### 1.2 Ajouter plusieurs régions
1. Ajouter les régions suivantes :
   - "Vakinankaratra"
   - "Atsinanana"
   - "Menabe"
2. Vérifier leur apparition dans la liste

### 1.3 Supprimer une région
1. Sur `/regions`, cliquer "Supprimer" sur une région sans villes
2. Confirmer la suppression
3. Vérifier que la région disparaît de la liste

### 1.4 Tentative de suppression avec villes associées
1. Ajouter une ville à une région (voir Scénario 2.1)
2. Tenter de supprimer cette région
3. Vérifier que la suppression supprime aussi les villes associées (cascade)

---

## Scénario 2 : Gestion des Villes (avec régions)

### 2.1 Ajouter une nouvelle ville avec région
1. Aller sur `/villes`
2. Dans "Ajouter une ville" :
   - Nom : "Antsirabe"
   - Région : "Vakinankaratra"
   - Cliquer "Ajouter"
3. Vérifier que la ville apparaît dans la liste avec sa région affichée

### 2.2 Ajouter une ville sans région
1. Sur `/villes` :
   - Nom : "Fianarantsoa"
   - Région : "-- Sélectionner une région --" (laisser vide)
   - Cliquer "Ajouter"
2. Vérifier que la ville s'ajoute avec un tiret "-" pour la région

### 2.3 Ajouter plusieurs villes avec régions différentes
1. Ajouter les villes suivantes :
   - "Toamasina" → "Atsinanana"
   - "Mahajanga" → "Menabe"
   - "Toliara" → "Atsimo-Andrefana" (créer la région d'abord)
2. Vérifier l'affichage complet de chaque ville avec sa région

### 2.4 Supprimer une ville
1. Sur `/villes`, cliquer "Supprimer" sur une ville sans besoins
2. Confirmer la suppression
3. Vérifier que la ville disparaît de la liste

### 2.5 Tentative de suppression avec besoins
1. Ajouter un besoin à une ville
2. Tenter de supprimer cette ville
3. Vérifier que la suppression échoue ou supprime aussi les besoins associés

---

## Scénario 3 : Saisie des Besoins

### 3.1 Ajouter un besoin en nature
1. Aller sur `/besoins`
2. Remplir :
   - Ville : "Antsirabe"
   - Type : "En nature"
   - Désignation : "Huile de cuisson"
   - Quantité : 300
   - Prix unitaire : 6.50
   - Date : laisser vide (auto)
3. Cliquer "Ajouter le besoin"
4. Vérifier l'apparition dans la liste

### 3.2 Ajouter un besoin en matériaux
1. Sur `/besoins` :
   - Ville : "Toamasina"
   - Type : "En matériaux"
   - Désignation : "Ciment"
   - Quantité : 500
   - Prix unitaire : 15.00
2. Ajouter et vérifier

### 3.3 Ajouter un besoin en argent
1. Sur `/besoins` :
   - Ville : "Mahajanga"
   - Type : "En argent"
   - Désignation : "Argent liquide"
   - Quantité : 20000
   - Prix unitaire : 1.00
2. Ajouter et vérifier

### 3.4 Supprimer un besoin
1. Cliquer "Supprimer" sur un besoin
2. Confirmer
3. Vérifier la disparition

---

## Scénario 4 : Saisie des Dons

### 4.1 Ajouter un don en nature
1. Aller sur `/dons`
2. Remplir :
   - Type : "En nature"
   - Désignation : "Huile de cuisson"
   - Quantité : 250
   - Date : laisser vide
3. Ajouter et vérifier

### 4.2 Ajouter un don en matériaux
1. Sur `/dons` :
   - Type : "En matériaux"
   - Désignation : "Ciment"
   - Quantité : 400
2. Ajouter et vérifier

### 4.3 Ajouter un don en argent
1. Sur `/dons` :
   - Type : "En argent"
   - Désignation : "Argent liquide"
   - Quantité : 15000
2. Ajouter et vérifier

### 3.4 Supprimer un don
1. Cliquer "Supprimer" sur un don
2. Confirmer
3. Vérifier la disparition

---

## Scénario 4 : Simulation du Dispatch

### 4.1 Premier dispatch - Attribution partielle
1. S'assurer d'avoir des besoins et dons correspondants
2. Aller sur `/dispatch`
3. Cliquer "Lancer le Dispatch"
4. Vérifier :
   - Attributions créées dans le tableau
   - État des dons mis à jour (partiellement distribué)

### 5.2 Dispatch avec correspondance parfaite
1. Ajouter un don qui correspond exactement à un besoin restant
2. Relancer le dispatch
3. Vérifier l'attribution complète

### 5.3 Dispatch avec surplus
1. Ajouter un don plus grand que le besoin restant
2. Dispatch : vérifier que seul le nécessaire est attribué
3. Vérifier que le don a encore du reste

### 5.4 Reset du dispatch
1. Cliquer "Réinitialiser"
2. Confirmer
3. Vérifier que toutes les attributions disparaissent

---

## Scénario 6 : Consultation du Dashboard

### 6.1 Vue d'ensemble
1. Aller sur `/` (dashboard)
2. Vérifier :
   - Statistiques globales (nb villes, total besoins/dons, taux couverture)
   - Tableaux par ville avec besoins et couverture

### 6.2 Détails par ville
1. Pour chaque ville :
   - Vérifier la liste des besoins
   - Vérifier les barres de progression
   - Vérifier les calculs (attribué, reste, couverture %)

### 6.3 Récapitulatif des dons
1. En bas du dashboard :
   - Vérifier l'état de chaque don (distribué/partiellement/non distribué)
   - Vérifier les quantités distribuées vs total

---

## Scénario 7 : Cas d'erreur et validation

### 7.1 Formulaire vide
1. Sur n'importe quel formulaire d'ajout
2. Laisser tous les champs vides
3. Cliquer "Ajouter"
4. Vérifier le message d'erreur

### 7.2 Région inexistante pour ville
1. Ajouter une ville sans région
2. Ajouter une ville avec une région existante
3. Comparer les deux affichages

### 7.3 Ville inexistante pour besoin
1. Supprimer une ville
2. Tenter d'ajouter un besoin à cette ville supprimée
3. Vérifier l'erreur

### 7.4 Don sans correspondance
1. Ajouter un don avec type/désignation qui ne correspond à aucun besoin
2. Lancer dispatch
3. Vérifier que ce don reste non distribué

### 7.5 Quantités négatives ou nulles
1. Tenter d'ajouter besoin/don avec quantité = 0
2. Vérifier le rejet

---

## Scénario 8 : Test de l'algorithme FIFO

### 8.1 Ordre chronologique des besoins
1. Ajouter 3 besoins à la même ville (même type/désignation) à des dates différentes
2. Ajouter un don qui couvre partiellement
3. Dispatch : vérifier que le besoin le plus ancien est servi en premier

### 8.2 Ordre chronologique des dons
1. Ajouter 2 dons identiques à des dates différentes
2. Dispatch : vérifier que le don le plus ancien est utilisé en premier

### 8.3 Distribution équitable
1. Besoins : A (100), B (200), C (150) - même type
2. Don : 250 unités
3. Dispatch : A reçoit 100, B reçoit 150, C reçoit 0
4. Vérifier la logique FIFO

---

## Scénario 9 : Navigation et Interface

### 9.1 Navigation sidebar
1. Tester tous les liens du menu latéral (Régions, Villes, Besoins, Dons, Dispatch)
2. Vérifier l'activation visuelle (highlight) de l'onglet actif

### 9.2 Responsive design
1. Redimensionner la fenêtre
2. Vérifier l'adaptation sur mobile (sidebar se réduit)

### 9.3 Messages de feedback
1. Effectuer des actions réussies
2. Vérifier les messages verts de succès
3. Effectuer des actions avec erreur
4. Vérifier les messages rouges d'erreur

---

## Scénario 10 : Données de test complètes

Pour un test complet, créer cette séquence :

### Étape 1 : Régions
- Amoron'i Mania
- Vakinankaratra
- Atsinanana
- Menabe
- Atsimo-Andrefana

### Étape 2 : Villes avec régions
- Antsirabe → Vakinankaratra
- Toamasina → Atsinanana
- Mahajanga → Menabe
- Toliara → Atsimo-Andrefana
- Fianarantsoa (sans région)

### Étape 3 : Besoins chronologiques
1. Antsirabe - Riz - 1000 kg - 2.50€ - 01/01/2023
2. Toamasina - Tôle - 500 unités - 12€ - 02/01/2023
3. Mahajanga - Argent - 50000€ - 1€ - 03/01/2023
4. Antsirabe - Huile - 300L - 6€ - 04/01/2023
5. Toamasina - Riz - 800 kg - 2.50€ - 05/01/2023

### Étape 4 : Dons chronologiques
1. Riz - 1200 kg - 01/02/2023
2. Tôle - 400 unités - 02/02/2023
3. Argent - 30000€ - 03/02/2023
4. Huile - 250L - 04/02/2023

### Étape 5 : Dispatch et vérifications
1. Lancer dispatch
2. Vérifier attributions :
   - Riz 1000kg → Antsirabe (besoin 1)
   - Riz 200kg → Toamasina (besoin 5)
   - Tôle 400u → Toamasina (besoin 2)
   - Argent 30000€ → Mahajanga (besoin 3)
   - Huile 250L → Antsirabe (besoin 4)
3. Vérifier dashboard et couverture

---

## Points de vérification finaux

- [ ] Toutes les pages s'affichent sans erreur PHP
- [ ] Base de données accessible et cohérente avec la table regions
- [ ] Les régions s'affichent correctement dans les villes
- [ ] Algorithme FIFO fonctionne correctement
- [ ] Interface responsive et ergonomique
- [ ] Messages d'erreur appropriés
- [ ] Calculs de couverture exacts
- [ ] Suppression en cascade fonctionne (région → villes)
- [ ] Données persistent après refresh
- [ ] Navigation sidebar comprend Régions et Villes

---

## Commandes utiles

```bash
# Lancer le serveur
php -S localhost:8000 -t public

# Accéder à l'app
http://localhost:8000

# Reset base de données
mysql -u root gnbrc < data.sql
```

---

## Notes importantes

- Le dispatch respecte strictement l'ordre chronologique (date_saisie)
- Les correspondances se font sur type + désignation (case insensitive)
- Les quantités peuvent être partielles
- Les régions sont optionnelles pour les villes (s'affichent comme "-" si non définie)
- Le dashboard se met à jour automatiquement après chaque action
- Toutes les suppressions sont confirmées par l'utilisateur
- Les villes sont en cascade avec les régions (suppression région → suppression villes)