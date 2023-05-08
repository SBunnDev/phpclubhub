<?php
require_once('../model/database.php');
require_once('../model/meeting_db.php');
require_once('../model/user_db.php');

session_start();

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'view_kiosk';
    }
}


switch ($action) {
    case 'view_roster':
        $members = get_members();
        include 'member_roster.php';
        break;
    case 'view_kiosk':
        $open_meetings = get_open_meetings();
        include 'meeting_kiosk.php';
        break;
    case 'meeting_sign_in':
        $meetingID = filter_input(INPUT_POST, "meetingID");
        $username = filter_input(INPUT_POST, "username");
        $userID = username_member_id_lookup($username);
        join_open_meeting($meetingID, $userID['memberID']);
        header('Location: .');
        include 'meeting_kiosk.php';
        break;
    default:
        echo 'Unknown action: ' . $action;
        break;
}
