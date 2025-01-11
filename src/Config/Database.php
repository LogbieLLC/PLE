<?php

declare(strict_types=1);

namespace PLEPHP\Config;

use RedBeanPHP\R;
use PLEPHP\Model\Equipment;
use PLEPHP\Model\Checklist;
use PLEPHP\Model\InspectionLock;
use PLEPHP\Model\Settings;

/**
 * Initialize database connection and configuration
 *
 * @throws \Exception When database setup fails
 * @throws \PDOException When database connection fails
 */
function initializeDatabase(): void
{
    // Initialize error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    // Get database path from environment or use default
    $dataDir = getenv('PLE_DATA_DIR') ?: __DIR__ . '/../../data';
    $dbName = getenv('PLE_DB_NAME') ?: 'ple.db';
    
    error_log("Database configuration:");
    error_log("- Data directory: $dataDir");
    error_log("- Database name: $dbName");

    // Ensure data directory exists
    if (!is_dir($dataDir)) {
        error_log("Creating data directory at: $dataDir");
        if (!@mkdir($dataDir, 0775, true)) {
            throw new \Exception("Failed to create data directory: $dataDir");
        }
    } else {
        error_log("Using existing data directory at: $dataDir");
    }

    // Database configuration
    $dbfile = $dataDir . '/' . $dbName;

    try {
        // Check database file status
        if (!file_exists($dbfile)) {
            error_log("Database file does not exist at: $dbfile");
            // Let RedBean handle file creation with proper permissions
            $dirPath = dirname($dbfile);
            if (!is_dir($dirPath)) {
                if (!@mkdir($dirPath, 0775, true)) {
                    throw new \Exception("Failed to create database directory: $dirPath");
                }
            }
        } else {
            error_log("Using existing database file at: $dbfile");
            // Verify file is accessible
            if (!is_readable($dbfile)) {
                throw new \Exception("Database file is not readable: $dbfile");
            }
            if (!is_writable($dbfile)) {
                throw new \Exception("Database file is not writable: $dbfile. Current permissions: " . 
                    substr(sprintf('%o', fileperms($dbfile)), -4));
            }
        }

        // Create PDO instance with logging disabled
        $dsn = 'sqlite:' . $dbfile;
        $pdo = new \PDO($dsn, null, null, [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES => false,
            \PDO::ATTR_STATEMENT_CLASS => ['PDOStatement'],
            \PDO::ATTR_STRINGIFY_FETCHES => false,
        ]);

        // Disable all RedBean debug features
        if (!defined('REDBEAN_DISABLE_QUERY_COUNTER')) {
            define('REDBEAN_DISABLE_QUERY_COUNTER', true);
        }
        if (!defined('REDBEAN_INSPECT')) {
            define('REDBEAN_INSPECT', false);
        }

        // Start output buffering for database operations
        ob_start();

        error_log('Setting up database connection...');

        // Setup RedBean with configured PDO instance
        R::setup($pdo);
        R::debug(false); // Disable debug mode for production
        R::freeze(false); // Allow schema modifications

        error_log('Database connection established successfully');

        // Final connection test
        if (!R::testConnection()) {
            throw new \Exception('Database connection test failed');
        }
        error_log('Database connection verified');
    } catch (\Exception $e) {
        error_log('Database setup failed: ' . $e->getMessage());
        throw new \Exception('Database setup failed: ' . $e->getMessage());
    } finally {
        // Clear any SQL output
        ob_end_clean();
    }
}
