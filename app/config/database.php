<?php
/**
 * Configuration de la base de données
 */

// Configuration DB
define('DB_HOST', 'localhost');
define('DB_NAME', 'gndrc');
define('DB_USER', 'lovapinto');
define('DB_PASS', 'lovapinto');

/**
 * Connexion à la base de données
 */
function getDatabase() {
    static $pdo = null;
    
    if ($pdo === null) {
        $host = DB_HOST;
        $database = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;
        $charset = 'utf8mb4';
        $dsn = "mysql:host={$host};dbname={$database};charset={$charset}";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $pdo = new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            http_response_code(500);
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Database connection failed', 'message' => $e->getMessage()]);
            exit;
        }
    }
    
    return $pdo;
}