<?php
/**
 * Database Configuration Module
 *
 * This file handles database setup, RedBeanPHP initialization,
 * and initial user creation for the PLE system.
 *
 * PHP version 7.4
 *
 * @category  Configuration
 * @package   PLEPHP
 * @author    Devin AI <devin@logbie.com>
 * @copyright 2024 Logbie LLC
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/LogbieLLC/PLE
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/vendor/autoload.php';

use RedBeanPHP\R as R;

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

    // Setup RedBean with SQLite
    R::setup('sqlite:' . $dbfile);

    // Enable debug mode in non-production
    if (!getenv('APP_ENV') || getenv('APP_ENV') !== 'production') {
        R::debug(true);
    }

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
