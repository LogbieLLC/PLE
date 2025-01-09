<?php

declare(strict_types=1);

namespace PLEPHP\Web;

use RedBeanPHP\R;
use function PLEPHP\requireAuth;

require_once __DIR__ . '/bootstrap.php';

// Initialize users table if needed
if (!R::testConnection()) {
    die('Database connection failed');
}

if (!R::count('user')) {
    // Create default admin user
    $admin = R::dispense('user');
    $admin->username = 'admin';
    $admin->password = password_hash('admin', PASSWORD_DEFAULT); // Change in production
    $admin->role = 'admin';
    R::store($admin);
}

// Basic routing
$action = $_GET['action'] ?? 'home';
$method = $_SERVER['REQUEST_METHOD'];

try {
    switch ($action) {
        case 'home':
            requireAuth();
            // Show equipment list
            $equipment = R::findAll('equipment', ' ORDER BY ple_id');
            echo $twig->render('home.twig', ['equipment' => $equipment]);
            break;

        case 'addEquipment':
            requireAuth();
            if ($method === 'POST') {
                // Validate PLE ID format based on type
                $pleId = $_POST['pleId'] ?? '';
                $type = $_POST['type'] ?? '';

                // Validate PLE ID prefix matches type
                $prefix = substr($pleId, 0, 1);
                $validPrefix = match ($type) {
                    'Walkie-stacker' => 'R',
                    'Electric Jack' => 'E',
                    'Fork-lift' => 'F',
                    'Scissor lift' => 'S',
                    default => null
                };

                if (!$validPrefix || $prefix !== $validPrefix) {
                    throw new \Exception("Invalid PLE ID prefix for equipment type");
                }

                // Create new equipment
                $equipment = R::dispense('equipment');
                $equipment->ple_id = $pleId;
                $equipment->ple_id_normalized = strtoupper($pleId);
                $equipment->type = $type;
                $equipment->make = $_POST['make'] ?? '';
                $equipment->model = $_POST['model'] ?? '';
                $equipment->serial_number = $_POST['serialNumber'] ?? '';
                $equipment->department = $_POST['department'] ?? '';

                R::store($equipment);
                header('Location: index.php');
                exit;
            }

            echo $twig->render('add_equipment.twig');
            break;

        case 'editEquipment':
            requireAuth();
            $id = $_GET['id'] ?? null;
            if (!$id) {
                throw new \Exception("Equipment ID required");
            }

            $equipment = R::load('equipment', $id);
            if (!$equipment->id) {
                throw new \Exception("Equipment not found");
            }

            if ($method === 'POST') {
                $equipment->make = $_POST['make'] ?? $equipment->make;
                $equipment->model = $_POST['model'] ?? $equipment->model;
                $equipment->serial_number = $_POST['serialNumber'] ?? $equipment->serial_number;
                $equipment->department = $_POST['department'] ?? $equipment->department;

                R::store($equipment);
                header('Location: index.php');
                exit;
            }

            echo $twig->render('edit_equipment.twig', ['equipment' => $equipment]);
            break;

        case 'deleteEquipment':
            requireAuth();
            if ($method === 'POST') {
                $id = $_POST['id'] ?? null;
                if (!$id) {
                    throw new \Exception("Equipment ID required");
                }

                $equipment = R::load('equipment', $id);
                if ($equipment->id) {
                    R::trash($equipment);
                }

                header('Location: index.php');
                exit;
            }
            break;

        case 'inspections':
            requireAuth();
            // Get all equipment for inspection selection
            $equipment = R::findAll('equipment', ' ORDER BY pleId');
            echo $twig->render('inspections.twig', ['equipment' => $equipment]);
            break;

        case 'addInspection':
            requireAuth();
            if ($method === 'POST') {
                // Validate inspection time (12:00 AM - 7:00 AM)
                $currentHour = (int)date('G');
                if ($currentHour >= 7) {
                    throw new \Exception("Inspections can only be performed between 12:00 AM and 7:00 AM");
                }

                // Check for concurrent inspections
                $activeInspection = R::findOne(
                    'inspection_lock',
                    ' ple_id = ? AND inspector_id = ? AND created > ? ',
                    [
                        $_POST['pleId'],
                        $_SESSION['user']['id'],
                        date('Y-m-d H:i:s', strtotime('-30 minutes'))
                    ]
                );

                if ($activeInspection) {
                    throw new \Exception("This equipment is currently being inspected by another user");
                }

                // Create inspection lock
                $lock = R::dispense('inspection_lock');
                $lock->ple_id = $_POST['pleId'];
                $lock->inspector_id = $_SESSION['user']['id'];
                $lock->created = date('Y-m-d H:i:s');
                R::store($lock);

                // Validate required fields
                $pleId = $_POST['pleId'] ?? '';
                $inspectorInitials = $_POST['inspectorInitials'] ?? '';

                if (!$pleId || !$inspectorInitials) {
                    throw new \Exception("PLE ID and inspector initials are required");
                }

                // Create new checklist
                $checklist = R::dispense('checklist');
                $checklist->ple_id = $pleId;
                $checklist->date_inspected = date('Y-m-d');
                $checklist->time_inspected = date('H:i:s');
                $checklist->inspector_initials = $inspectorInitials;

                // Inspection categories
                $checklist->damage = isset($_POST['damage']);
                $checklist->leaks = isset($_POST['leaks']);
                $checklist->safety_devices = isset($_POST['safetyDevices']);
                $checklist->operation = isset($_POST['operation']);

                // Additional fields
                $checklist->repair_required = isset($_POST['repairRequired']);
                $checklist->tagged_out_of_service = isset($_POST['taggedOutOfService']);
                $checklist->work_order_number = $_POST['workOrderNumber'] ?? '';
                $checklist->comments = $_POST['comments'] ?? '';

                // Update equipment status if tagged out of service
                if ($checklist->tagged_out_of_service) {
                    $equipment = R::findOne('equipment', ' ple_id = ? ', [$checklist->ple_id]);
                    if ($equipment) {
                        $equipment->status = 'out_of_service';
                        $equipment->last_work_order = $checklist->work_order_number;
                        R::store($equipment);
                    }
                }

                R::store($checklist);
                header('Location: index.php?action=inspections');
                exit;
            }

            $equipment = R::findAll('equipment', ' ORDER BY pleId');
            echo $twig->render('add_inspection.twig', ['equipment' => $equipment]);
            break;

        case 'login':
            if ($method === 'POST') {
                $username = $_POST['username'] ?? '';
                $password = $_POST['password'] ?? '';

                $user = R::findOne('user', ' username = ? ', [$username]);

                if ($user && password_verify($password, $user->password)) {
                    $_SESSION['user'] = [
                        'id' => $user->id,
                        'username' => $user->username,
                        'role' => $user->role
                    ];
                    header('Location: index.php');
                    exit;
                }

                $error = "Invalid username or password";
                echo $twig->render('login.twig', ['error' => $error]);
                break;
            }

            echo $twig->render('login.twig');
            break;

        case 'logout':
            session_destroy();
            header('Location: index.php?action=login');
            exit;

        default:
            http_response_code(404);
            echo $twig->render('404.twig');
            break;
    }
} catch (\Exception $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo $twig->render('error.twig', ['message' => $e->getMessage()]);
}
