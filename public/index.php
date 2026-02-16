<?php
/**
 * Point d'entrée de l'application Flight MVC
 */

// Définir le chemin racine de l'application
define('APP_ROOT', dirname(__DIR__));

// Chargement de Flight
require_once APP_ROOT . '/vendor/core-master/flight/Flight.php';

// Chargement de la configuration
require_once APP_ROOT . '/app/config/database.php';

// Chargement des modèles
require_once APP_ROOT . '/app/models/User.php';

// Chargement des contrôleurs
require_once APP_ROOT . '/app/controllers/AuthController.php';
require_once APP_ROOT . '/app/controllers/HomeController.php';

// Configuration de Flight
Flight::set('flight.views.path', APP_ROOT . '/app/views');

// Routes
require_once APP_ROOT . '/app/config/routes.php';

// Démarrer l'application
Flight::start();