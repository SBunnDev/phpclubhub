<?php
require_once('../util/secure_conn.php');
require_once('../util/valid_user.php');
?>
<?php include '../view/header.php'; ?>
<main>
    <h2>User Menu</h2>
    <nav>
        <ul>
            <li><a href="?action=view_roster">View Members</a></li>
            <li><a href="../#">Request Hardware</a></li>
            <li><a href="../#">Join Meeting</a></li>

        </ul>
    </nav>

    <h2>Login Status</h2>
    <p>You are logged in as <?php echo $_SESSION['user']; ?>.</p>
    <form action="" method="post">
        <input type="hidden" name="action" value="logout">
        <input type="submit" value="Logout">
    </form>

</main>
<?php include '../view/footer.php'; ?>