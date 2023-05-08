<?php
require_once('../model/database.php');
require_once('../model/user_db.php');

session_start();

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        if (isset($_SESSION['officer'])) {
            $action = 'view_menu';
        } elseif (isset($_SESSION['user'])) {
            $action = 'view_menu';
        } else {
            $action = 'view_login';
        }
    }
}

switch ($action) {
    case 'view_roster':
        $members = get_current_members();
        include 'member_roster.php';
        break;
    case 'view_login':
        include 'user_login.php';
        break;
    case 'view_officer':
        include '../officer/officer_menu.php';
        break;
    case 'view_menu':
        include 'user_menu.php';
        break;
    case 'login':
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        if (is_valid_login($username, $password)) {
            $_SESSION['user'] = $username;
        } else {
            $error_message = 'Login failed. Invalid user or password.';
        }
        include 'user_menu.php';
        break;
    case 'logout':
        unset($_SESSION['user']);
        header('Location: ..');
        break;
    default:
        echo 'Unknown action: ' . $action;
        break;
}
