<?php
require_once "models/role_model.php";
require_once "models/item_model.php";
require_once "models/user_model.php";

session_start();

// Cek apakah user ingin logout
if (isset($_GET['logout'])) {
    session_unset(); // Menghapus semua sesi
    session_destroy(); // Hancurkan sesi
    header("Location: login.php"); // Arahkan ke halaman login
    exit;
}

$obj_role = new modelRole();
$obj_item = new modelItem();
$obj_user = new modelUser();

if (isset($_GET['modul'])) {
  $model = $_GET['modul'];
} else {
  $model = "dashboard";
}


switch($model) {

    case "dashboard":
        include 'views/kosong.php';
        break;

    case "role":
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;
        $id = isset($_GET['id']) ? $_GET['id'] : 0;

        switch($fitur) {
            case 'add':
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $name = $_POST['role_name'];
                    $desc = $_POST['role_description'];
                    $status = $_POST['role_status'];
                    $obj_role->addRole($name, $desc, $status);
                    header('location: index.php?modul=role');
                    exit;
                } else {
                    include 'views/role_input.php';
                }
                break;

            case 'delete':
                $obj_role->deleteRole($id);
                header('location: index.php?modul=role');
                break;

            case 'update':
                $role = $obj_role->getRoleById($id);
                include 'views/role_edit.php';
                break;

            case 'edit':
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $name = $_POST['role_name'];
                    $desc = $_POST['role_description'];
                    $status = $_POST['role_status'];
                    $obj_role->updateRole($id, $name, $desc, $status);
                    header('location: index.php?modul=role');
                  } else {
                      include 'views/role_list.php';
                  }
                break;
            default:
                $roles = $obj_role->getAllRoles();
                include 'views/role_list.php';
                break;
        }
        break;

    case 'item':
        $insert = isset($_GET['insert']) ? $_GET['insert'] : null;
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        switch ($insert) {
            case 'addItem':
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $name = $_POST['item_name'];
                    $price = $_POST['item_price'];
                    $qty = $_POST['item_qty'];
                    $obj_item->addItem($name, $price, $qty);
                    header('location: index.php?modul=item');
                } else {
                    include 'views/item_input.php';
                }
                break;

            case 'delete':
                $obj_item->deleteItem($id);
                header('location: index.php?modul=item');
                break;

            case 'update':
                $item = $obj_item->getItemById($id);
                include 'views/item_edit.php';
                break;

            case 'edit':
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $name = $_POST['item_name'];
                    $price = $_POST['item_price'];
                    $qty = $_POST['item_qty'];
                    $obj_item->updateItem($id, $name, $price, $qty);
                    header('location: index.php?modul=item');
                } else {
                    include 'views/item_list.php';
                }
                break;

            default:
                $items = $obj_item->getAllItem();
                include 'views/item_list.php';
                break;
        }
        break;

    case 'user':
        $action = isset($_GET['action']) ? $_GET['action'] : null;
        $id = isset($_GET['id']) ? $_GET['id'] : null;

        switch ($action) {
            case 'add':
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $role_id = $_POST['role_id'];
                    $role = $obj_role->getRoleById($role_id);
                    $obj_user->addUser($username, $password, $role);
                    header('location: index.php?modul=user');
                } else {
                    include 'views/user_input.php';
                }
                break;

            case 'delete':
                $obj_user->deleteUser($id);
                header('location: index.php?modul=user');
                break;

            case 'update':
                $user = $obj_user->getUserById($id);
                include 'views/user_edit.php';
                break;

            case 'edit':
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $role_id = $_POST['role_id'];
                    $role = $obj_role->getRoleById($role_id);
                    $obj_user->updateUser($id, $username, $password, $role);
                    header('location: index.php?modul=user');
                } else {
                    include 'views/user_list.php';
                }
                break;

            default:
                $users = $obj_user->getAllUser();
                include 'views/user_list.php';
                break;
        }
        break;

    default:
        echo "Modul tidak ditemukan.";
        break;

        
}
?>