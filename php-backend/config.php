<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/vendor/autoload.php';

use RedBeanPHP\R as R;
use RedBeanPHP\Logger as Logger;

// Create a null logger to suppress query output
class NullLogger implements Logger {
    public function log() {
        // Do nothing
    }
}

// Ensure data directory exists with proper permissions
$dataDir = __DIR__ . '/data';
if (!is_dir($dataDir)) {
    if (!@mkdir($dataDir, 0777, true)) {
        throw new \Exception("Failed to create data directory");
    }
    chmod($dataDir, 0777);
}

// Database configuration
$dbfile = $dataDir . '/ple.db';

try {
    // Ensure database file exists and is writable
    if (!file_exists($dbfile)) {
        if (!@touch($dbfile)) {
            throw new \Exception("Failed to create database file");
        }
        chmod($dbfile, 0666);
    }

    if (!is_writable($dbfile)) {
        throw new \Exception("Database file is not writable");
    }

    // Verify database directory and file
    if (!is_dir(dirname($dbfile))) {
        if (!@mkdir(dirname($dbfile), 0777, true)) {
            throw new \Exception("Failed to create database directory");
        }
    }

    // Ensure database file exists and is writable
    if (!file_exists($dbfile)) {
        if (!@touch($dbfile)) {
            throw new \Exception("Failed to create database file");
        }
        chmod($dbfile, 0666);
    }

    // Setup RedBean with SQLite using PDO format with disabled logging
    $dsn = 'sqlite:' . $dbfile;
    
    // Create PDO instance with logging disabled
    $pdo = new \PDO($dsn, null, null, [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::ATTR_EMULATE_PREPARES => false,
        \PDO::ATTR_STATEMENT_CLASS => ['PDOStatement'],
        \PDO::ATTR_STRINGIFY_FETCHES => false
    ]);
    
    // Disable all RedBean debug features
    define('REDBEAN_DISABLE_QUERY_COUNTER', true);
    define('REDBEAN_INSPECT', false);
    
    // Setup RedBean with configured PDO instance and no debug features
    R::setup($pdo);
    R::debug(false);
    R::getDatabaseAdapter()->getDatabase()->setEnableLogging(false);
    
    // Set null logger to prevent query output
    R::getDatabaseAdapter()->getDatabase()->setLogger(new NullLogger());

    // Buffer all database operations
    ob_start();
    
    // Test connection immediately
    if (!R::testConnection()) {
        ob_end_clean();
        throw new \Exception("Failed to connect to database");
    }

    // Debug mode is disabled by default
    R::debug(false);
    
    // Clear any buffered output
    ob_end_clean();
    
    // Initialize admin user if not exists
    if (!R::count('user')) {
        $admin = R::dispense('user');
        $admin->username = 'admin';
        $admin->password = password_hash('admin', PASSWORD_DEFAULT);
        $admin->role = 'admin';
        R::store($admin);
    }

    // Test connection
    R::testConnection();
} catch (\Exception $e) {
    error_log('Database setup failed: ' . $e->getMessage());
    throw new \Exception('Database setup failed: ' . $e->getMessage());
}
