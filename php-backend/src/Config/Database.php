<?php

declare(strict_types=1);

namespace PLEPHP\Config;

use RedBeanPHP\R;

/**
 * Initialize database connection and configuration
 */
function initializeDatabase(): void
{
    // Initialize error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    // Ensure data directory exists with proper permissions
    $dataDir = __DIR__ . '/../../data';
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

        // Setup RedBean with configured PDO instance and no debug features
        R::setup($pdo);
        R::debug(false);
        R::getDatabaseAdapter()->getDatabase()->setEnableLogging(false);

        // Set null logger to prevent query output
        R::getDatabaseAdapter()->getDatabase()->setLogger(new NullLogger());

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
}
