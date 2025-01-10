<?php

declare(strict_types=1);

namespace PLEPHP\Web;

use RedBeanPHP\R;
use PLEPHP\Model\InspectionLock;

use function PLEPHP\requireAuth;

/**
 * Handle the main routing logic for the application
 */
function handleRoute(): void
{
    // Clean any existing buffers and start fresh
    while (true) {
        $level = ob_get_level();
        if ($level <= 0) {
            break;
        }
        @ob_end_clean();
    }

    // Start fresh output buffer for all operations
    @ob_start();

    // Wrap all database operations in a nested buffer
    @ob_start();

    $action = $_GET['action'] ?? 'home';
    $method = $_SERVER['REQUEST_METHOD'];

    try {
        switch ($action) {
            case 'home':
                requireAuth();
                // Show equipment list
                $equipment = R::findAll('equipment', ' ORDER BY ple_id');
                // Clear any SQL output before rendering
                ob_clean();
                echo $GLOBALS['twig']->render('home.twig', ['equipment' => $equipment]);
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

                echo $GLOBALS['twig']->render('add_equipment.twig');
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

                echo $GLOBALS['twig']->render('edit_equipment.twig', ['equipment' => $equipment]);
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
                // Start output buffering for database operations
                ob_start();

                // Get all equipment and checklists for inspection view
                $equipment = R::findAll('equipment', ' ORDER BY ple_id');
                $checklists = R::findAll('checklist', ' ORDER BY date_inspected DESC, time_inspected DESC LIMIT 50');

                // Clear any SQL output before rendering
                ob_clean();

                echo $GLOBALS['twig']->render('inspections.twig', [
                    'equipment' => $equipment,
                    'checklists' => $checklists
                ]);
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
                        ' ple_id = ? AND created > ? ',
                        [
                            $_POST['pleId'],
                            date('Y-m-d H:i:s', strtotime('-30 minutes'))
                        ]
                    );

                    if ($activeInspection) {
                        // Allow admin override or timeout-based takeover
                        $canTakeOver = $_SESSION['user']['role'] === 'admin' ||
                                     strtotime($activeInspection->created) < strtotime('-30 minutes');

                        if (!$canTakeOver) {
                            throw new \Exception(sprintf(
                                "This equipment is currently being inspected by %s since %s",
                                $activeInspection->inspector_id,
                                date('g:i A', strtotime($activeInspection->created))
                            ));
                        }

                        // Record takeover
                        $activeInspection->force_taken_by = $_SESSION['user']['id'];
                        $activeInspection->force_taken_at = date('Y-m-d H:i:s');
                        R::store($activeInspection);
                    }

                    // Create or update inspection lock
                    $lock = $activeInspection ?: R::dispense('inspection_lock');
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

                $equipment = R::findAll('equipment', ' ORDER BY ple_id');

                // Check for existing locks and notifications
                $currentLock = null;
                $previousLock = null;

                // Check for specific equipment lock
                if (isset($_GET['pleId'])) {
                    $currentLock = R::findOne(
                        'inspection_lock',
                        ' ple_id = ? AND created > ? ',
                        [
                            $_GET['pleId'],
                            date('Y-m-d H:i:s', strtotime('-30 minutes'))
                        ]
                    );
                }

                // Check for any locks that were taken from current user
                $previousLock = R::findOne(
                    'inspection_lock',
                    ' inspector_id = ? AND force_taken_by IS NOT NULL AND force_taken_at > ? ',
                    [
                        $_SESSION['user']['id'],
                        date('Y-m-d H:i:s', strtotime('-1 hour'))
                    ]
                );

                echo $GLOBALS['twig']->render('add_inspection.twig', [
                    'equipment' => $equipment,
                    'currentLock' => $currentLock,
                    'previousLock' => $previousLock,
                    'selectedPleId' => $_GET['pleId'] ?? null
                ]);
                break;

            case 'login':
                // Start output buffering for login operations
                ob_start();

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
                        ob_end_clean(); // Clear buffer before redirect
                        header('Location: index.php');
                        exit;
                    }

                    $error = "Invalid username or password";
                    ob_clean(); // Clear SQL output
                    echo $GLOBALS['twig']->render('login.twig', ['error' => $error]);
                    break;
                }

                ob_clean(); // Clear any SQL output
                echo $GLOBALS['twig']->render('login.twig');
                break;

            case 'takeOverInspection':
                requireAuth();

                $pleId = $_GET['pleId'] ?? '';
                if (!$pleId) {
                    throw new \Exception("Equipment ID required");
                }

                // Check for existing lock
                $existingLock = R::findOne(
                    'inspection_lock',
                    ' ple_id = ? AND created > ? ',
                    [
                        $pleId,
                        date('Y-m-d H:i:s', strtotime('-30 minutes'))
                    ]
                );

                if (!$existingLock) {
                    throw new \Exception("No active inspection found");
                }

                // Check if user is admin or lock is expired
                $isAdmin = ($_SESSION['user']['role'] ?? '') === 'admin';
                $isExpired = strtotime($existingLock->created) < strtotime('-30 minutes');

                if (!$isAdmin && !$isExpired) {
                    throw new \Exception("Cannot take control: inspection is still active");
                }

                // Take control of the inspection
                if ($isAdmin) {
                    $existingLock->force_taken_by = $_SESSION['user']['id'];
                    $existingLock->force_taken_at = date('Y-m-d H:i:s');
                }
                $existingLock->inspector_id = $_SESSION['user']['id'];
                $existingLock->created = date('Y-m-d H:i:s');

                R::store($existingLock);

                header('Location: index.php?action=addInspection&pleId=' . urlencode($pleId));
                exit;

            case 'logout':
                session_destroy();
                header('Location: index.php?action=login');
                exit;

            default:
                http_response_code(404);
                // Clear any SQL output before rendering
                ob_clean();
                echo $GLOBALS['twig']->render('404.twig');
                break;
        }
    } catch (\Exception $e) {
        error_log($e->getMessage());
        http_response_code(500);
        $errorMessage = $e->getMessage();

        // Clean all output buffers
        while (true) {
            $level = ob_get_level();
            if ($level <= 0) {
                break;
            }
            @ob_end_clean();
        }

        // Render error page directly
        echo $GLOBALS['twig']->render('error.twig', ['message' => $errorMessage]);
    }
}
