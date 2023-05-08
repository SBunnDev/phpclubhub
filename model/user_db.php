<?php
function is_valid_officer($username, $password) //due to EBoone having a temp appointment of 2 positions... he crashes this
{
    global $db;
    $query = 'SELECT m.username, m.password, r.roleID 
              from members m
              join member_roles mr
                on m.memberID = mr.memberID
              join roles r
                on r.roleID = mr.roleID
              where m.username = :username AND m.password = :password AND mr.toDate IS NULL AND (r.roleID BETWEEN 1 AND 5)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);
        $statement->execute();
        $row_count = $statement->rowCount();
        $statement->closeCursor();

        if ($row_count === 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}

function is_valid_login($username, $password)
{
    global $db;
    $query = 'SELECT * FROM members
              WHERE username = :username 
              AND password = :password';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);
        $statement->execute();
        $row_count = $statement->rowCount();
        $statement->closeCursor();

        if ($row_count === 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}

function update_user($memberID, $firstName, $lastName, $joinDate) //build execute and get returns
{
    global $db;
    $query = 'UPDATE members
              SET firstName = :firstName,
                  lastName = :lastName,
                  joinDate = :joinDate,
              WHERE memberID = :memberID';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':memberID', $memberID);
        $statement->bindValue(':firstName', $firstName);
        $statement->bindValue(':lastName', $lastName);
        $statement->bindValue(':joinDate', $joinDate);
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}
function get_members()
{
    global $db;
    $query =    'SELECT * FROM members
                ORDER BY memberID';
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}
function get_current_members()
{
    global $db;
    $query =    'SELECT r.roleName, m.firstName, m.lastName, m.joinDate
                 from members m
                 join member_roles mr
                    on m.memberID = mr.memberID
                 join roles r
                    on r.roleID = mr.roleID
                 where mr.toDate is NULL
                 order by r.roleID;
                ';
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}
function id_member_lookup($memberID)
{
    global $db;
    $query = 'SELECT * FROM members
              WHERE memberID = :memberID';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':memberID', $memberID);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}
function username_member_lookup($username)
{
    global $db;
    $query = 'SELECT * FROM members
              WHERE username = :username';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}
function username_member_id_lookup($username)
{
    global $db;
    $query = 'SELECT memberID FROM members
              WHERE username = :username';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}
function add_member($firstName, $lastName, $username)
{
    $join_date = date('Y-m-d');
    $default_password = 'changeme';
    global $db;
    $query = 'INSERT INTO members (firstName,lastName,joinDate,username,password)
              VALUES (:firstName, :lastName, :joinDate, :username, :password)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':firstName', $firstName);
        $statement->bindValue(':lastName', $lastName);
        $statement->bindValue(':joinDate', $join_date);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $default_password);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}
