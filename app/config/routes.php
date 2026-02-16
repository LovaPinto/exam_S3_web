<?php
// Activer CORS pour toutes les routes
Flight::before('start', function() {
    header("Access-Control-Allow-Origin: http://localhost:3000");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
    header("Access-Control-Allow-Credentials: true");

    // Répondre aux requêtes préflight OPTIONS
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(200);
        exit;
    }
});

// Routes
Flight::route('GET /', 'HomeController::index');
Flight::route('GET /ping', 'HomeController::ping');
Flight::route('POST /register', 'AuthController::register');
Flight::route('POST /login', 'AuthController::login');

// Route 404
Flight::map('notFound', function() {
    header('Content-Type: application/json');
    http_response_code(404);
    echo json_encode(['error' => 'Route not found']);
});
