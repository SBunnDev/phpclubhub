<?php
require_once('../util/secure_conn.php');
?>
<?php include '../view/header.php'; ?>
<main>
    <h1>Meeting Kiosk</h1>


    <?php foreach ($open_meetings as $meeting) : ?>
        <h1>User Sign-in for <?php echo htmlspecialchars($meeting['meetingDate']); ?></h1>
        <form action="" method="post" id="aligned">
            <input type="hidden" name="action" value="meeting_sign_in">
            <input type="hidden" name="meetingID" value="<?php echo htmlspecialchars($meeting['meetingID']); ?>">
            <label>Type/Scan Username:</label>
            <input type="text" name="username" size="30">
            <br>

            <label>&nbsp;</label>
            <input type="submit" value="Sign-In">
        </form>


    <?php endforeach; ?>