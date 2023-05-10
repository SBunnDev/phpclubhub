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
function is_valid_officer_secure($username, $password) //IMPLEMENT!!! 
{
    global $db;
    $query = 'SELECT m.password 
    from members m
    join member_roles mr
      on m.memberID = mr.memberID
    join roles r
      on r.roleID = mr.roleID
    where m.username = :username AND mr.toDate IS NULL AND (r.roleID BETWEEN 1 AND 5)';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();
        $hash = $row['password'];
        return password_verify($password, $hash);
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
function is_valid_login_secure($username, $password) //IMPLEMENT!!! 
{
    global $db;
    $query = 'SELECT password FROM members
              WHERE username = :username';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();
        $hash = $row['password'];
        return password_verify($password, $hash);
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}
function update_password($username, $password)
{
    global $db;
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $query = 'UPDATE members
              SET password = :password
              WHERE username = :username';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $hash);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}

function update_user($memberID, $firstName, $lastName, $joinDate)
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
        $statement->execute();
        $statement->closeCursor();
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
function add_new_member_role($memberID, $roleID)
{
    $date = date('Y-m-d');
    global $db;
    $query = 'INSERT INTO member_roles (memberID,roleID,fromDate)
              VALUES (:memberID, :roleID, :fromDate)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':memberID', $memberID);
        $statement->bindValue(':roleID', $roleID);
        $statement->bindValue(':fromDate', $date);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}
function password_admin_reset($memberID)
{
    global $db;
    $query = 'UPDATE members
                  SET password = "changeme"
                  WHERE memberID = :memberID';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':memberID', $memberID);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}
function role_retire($memberID)
{

    global $db;
    $role_end_date = date('Y-m-d');
    $query = 'UPDATE member_roles
              SET toDate = :toDate
              WHERE memberID = :memberId
              ORDER BY memberID DESC LIMIT 1';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':memberID', $memberID);
        $statement->bindValue(':toDate', $role_end_date);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}
function delete_member($memberID)
{
    global $db;
    $query = 'DELETE FROM members
              WHERE memberID = :memberID';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':memberID', $memberID);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}
function delete_member_role($memberID) //addresses foreign key issues in member role when deleting from members
{
    global $db;
    $query = 'DELETE FROM member_roles
              WHERE memberID = :memberID';

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':memberID', $memberID);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}
