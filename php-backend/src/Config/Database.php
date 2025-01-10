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

        // Start output buffering for all database operations
        ob_start();

        error_log('Registering model extensions...');

        // Register model extensions first
        R::ext('equipment', function ($bean) {
            $model = new \PLEPHP\Model\Equipment();
            $model->loadBean($bean);
            return $model;
        });

        R::ext('checklist', function ($bean) {
            $model = new \PLEPHP\Model\Checklist();
            $model->loadBean($bean);
            return $model;
        });

        R::ext('inspection_lock', function ($bean) {
            $model = new \PLEPHP\Model\InspectionLock();
            $model->loadBean($bean);
            return $model;
        });

        error_log('Model extensions registered');

        // Setup RedBean with configured PDO instance
        R::setup($pdo);
        R::debug(false);
        R::freeze(false); // Allow schema modifications

        // Create base tables first
        try {
            error_log('Starting table initialization...');

            // Register model extensions first
            R::ext('equipment', function ($bean) {
                $model = new \PLEPHP\Model\Equipment();
                $model->loadBean($bean);
                return $model;
            });

            R::ext('checklist', function ($bean) {
                $model = new \PLEPHP\Model\Checklist();
                $model->loadBean($bean);
                return $model;
            });

            R::ext('inspection_lock', function ($bean) {
                $model = new \PLEPHP\Model\InspectionLock();
                $model->loadBean($bean);
                return $model;
            });

            error_log('Model extensions registered');

            // Initialize core tables in dependency order
            foreach (['user', 'equipment', 'checklist', 'inspection_lock'] as $table) {
                error_log("Creating table: $table");

                // Create and verify table
                $bean = R::dispense($table);
                if (!$bean) {
                    throw new \Exception("Failed to create $table model");
                }

                // Add test data
                switch ($table) {
                    case 'inspection_lock':
                        $bean->import([
                            'ple_id' => 'TEST1',
                            'inspector_id' => 1,
                            'created' => date('Y-m-d H:i:s'),
                            'force_taken_by' => null,
                            'force_taken_at' => null
                        ]);
                        break;
                    case 'equipment':
                        $bean->import([
                            'ple_id' => 'TEST1',
                            'ple_id_normalized' => 'TEST1',
                            'type' => 'test',
                            'make' => 'test',
                            'model' => 'test',
                            'serial_number' => 'test',
                            'department' => 'test'
                        ]);
                        break;
                    case 'checklist':
                        $bean->import([
                            'ple_id' => 'TEST1',
                            'date_inspected' => date('Y-m-d'),
                            'time_inspected' => date('H:i:s'),
                            'inspector_initials' => 'TST'
                        ]);
                        break;
                }

                // Store and verify
                $id = R::store($bean);
                if (!$id) {
                    throw new \Exception("Failed to store $table bean");
                }

                // Verify table exists
                if (!R::inspect($table)) {
                    throw new \Exception("Failed to create table: $table");
                }

                // Clean up test bean
                R::trash($bean);
                error_log("Successfully created table: $table");
            }

            // Initialize admin user if needed
            if (!R::count('user')) {
                error_log('Creating admin user...');
                $admin = R::dispense('user');
                $admin->username = 'admin';
                $admin->password = password_hash('admin', PASSWORD_DEFAULT);
                $admin->role = 'admin';
                R::store($admin);
                error_log('Admin user created');
            }

            // Final connection test
            if (!R::testConnection()) {
                throw new \Exception('Database connection test failed');
            }
            error_log('All tables initialized successfully');
        } catch (\Exception $e) {
            error_log('Table initialization failed: ' . $e->getMessage());
            throw $e;
        } finally {
            // Clear any SQL output
            ob_end_clean();
        }
    } catch (\Exception $e) {
        error_log('Database setup failed: ' . $e->getMessage());
        throw new \Exception('Database setup failed: ' . $e->getMessage());
    }
}
