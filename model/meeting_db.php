<?php
function meeting_start()
{
    global $db;
    $meeting_date = date('Y-m-d');
    $query = 'INSERT INTO meetings
            (meetingDate, meetingOpen)
            VALUES (
               :meetingDate, :meetingOpen)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':meetingDate', $meeting_date);
        $statement->bindValue(':meetingOpen', 1);
        $statement->execute();
        $statement->closeCursor();
        //gets last meeting ID
        $id = $db->lastInsertId();
        return $id;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}
function meeting_stop($meetingID)
{
    global $db;
    $query = 'UPDATE meetings
              SET meetingOpen = 0
              WHERE meetingID = :meetingID';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':meetingID', $meetingID);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}
function meeting_delete($meetingID) //address foreign key box with meeting_members bridge table
{
    global $db;
    $query = 'DELETE FROM meetings
              WHERE meetingID = :meetingID';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':meetingID', $meetingID);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}
function get_open_meetings()
{
    global $db;
    $query = 'SELECT *
              FROM meetings
              WHERE meetingOpen = 1';
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}
function join_open_meeting($meetingID, $memberID)
{
    global $db;
    $query = 'INSERT INTO meeting_members
                (meetingID, memberID)
              VALUES
                (:meetingID, :memberID)';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':meetingID', $meetingID);
        $statement->bindValue(':memberID', $memberID);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}
function display_meeting_attendees($meetingID)
{
    global $db;
    $query = 'SELECT m.firstName, m.lastName
                from members m
                join meeting_members mm
                    on m.memberID = mm.memberID
                where mm.meetingID = :meetingID
                order by m.lastName;';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':meetingID', $meetingID);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        return $results;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}
function get_current_meeting_id()
{
    global $db;
    $query = 'SELECT meetingID
              FROM meetings
              WHERE meetingOpen = 1';
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}
