<?php
require_once('../util/secure_conn.php');
require_once('../util/valid_officer.php');
?>
<?php include '../view/header.php'; ?>
<main>
    <h2>Officer Menu</h2>
    <nav>
        <ul>
            <li><a href="?action=view_roster">Manage Members</a></li>
            <li><a href="../#">Manage Hardware</a></li>
            <li><a href="?action=meeting_manage">Manage Meetings</a></li>

        </ul>
    </nav>

    <h2>Login Status</h2>
    <p>You are logged in as <?php echo $_SESSION['officer']; ?>.</p>
    <form action="" method="post">
        <input type="hidden" name="action" value="logout">
        <input type="submit" value="Logout">
    </form>

</main>
<?php include '../view/footer.php'; ?>