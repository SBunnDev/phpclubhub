<?php
require_once('../model/database.php');
require_once('../model/meeting_db.php');
require_once('../model/user_db.php');

session_start();

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        if (isset($_SESSION['officer'])) {
            $action = 'view_menu';
        } else {
            $action = 'view_login';
        }
    }
}

switch ($action) {
    case 'view_add_member':
        include 'add_member.php';
        break;
    case 'add_member':
        $firstName = filter_input(INPUT_POST, 'fName');
        $lastName = filter_input(INPUT_POST, 'lName');
        $username = filter_input(INPUT_POST, 'username');
        $role = filter_input(INPUT_POST, 'role');
        add_member($firstName, $lastName, $username);
        $memberID = username_member_id_lookup($username);
        add_new_member_role($memberID['memberID'], $role);
        header('Location: .');
        include 'member_roster.php';
        break;
    case 'delete_member':
        $memberID = filter_input(INPUT_POST, 'member_id');
        delete_member_role($memberID);
        delete_member($memberID);
        header('Location: .');
        break;
    case 'update_member':
        $memberID = filter_input(INPUT_POST, 'member_id');
        $firstName = filter_input(INPUT_POST, 'fName');
        $lastName = filter_input(INPUT_POST, 'lName');
        $username = filter_input(INPUT_POST, 'username');
        $joinDate = filter_input(INPUT_POST, 'joinDate');
        $role = filter_input(INPUT_POST, 'role');
        role_retire($memberID);
        add_new_member_role($memberID, $role);
        update_user($memberID, $firstName, $lastName, $joinDate);
        header('Location: .');
        include 'member_roster.php';
        break;
    case 'password_admin_reset':
        $memberID = filter_input(INPUT_POST, 'member_id');
        password_admin_reset($memberID);
        header('Location: .');
        break;
    case 'view_roster':
        $members = get_members();
        include 'member_roster.php';
        break;
    case 'login':
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        if ($password == 'changeme') {
            if (is_valid_officer($username, $password)) {
                $_SESSION['officer'] = $username;
            } else {
                $error_message = 'Login failed. Invalid user or password.';
            }
        } else {
            if (is_valid_officer_secure($username, $password)) {
                $_SESSION['officer'] = $username;
            } else {
                $error_message = 'Secure Login failed. Please consult an administrator';
            }
        }
        include 'officer_menu.php';
        break;
    case 'view_login':
        include 'officer_login.php';
        break;
    case 'view_menu':
        include 'officer_menu.php';
        break;
    case 'meeting_manage':
        $open_meetings = get_open_meetings();
        $meeting_id = get_current_meeting_id();
        if ($meeting_id) {
            $attendees = display_meeting_attendees($meeting_id['meetingID']);
        }

        include 'officer_meeting_manager.php';
        break;
    case 'meeting_start':
        meeting_start();
        header("Location: .");
        include 'officer_meeting_manager.php';
        break;
    case 'meeting_close':
        $meetingID = filter_input(INPUT_POST, 'meetingID');
        meeting_stop($meetingID);
        header("Location: .");
        break;
    case 'meeting_delete':
        $meetingID = filter_input(INPUT_POST, 'meetingID');
        meeting_delete($meetingID);
        header("Location: .");
        break;
    case 'logout':
        unset($_SESSION['officer']);
        header('Location: ..');
        break;
    default:
        echo 'Unknown action: ' . $action;
        break;
}
