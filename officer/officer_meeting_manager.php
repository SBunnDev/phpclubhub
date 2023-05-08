<?php
require_once('../util/secure_conn.php');
require_once('../util/valid_officer.php');
?>
<?php include '../view/header.php'; ?>
<main>
    <h2>Meeting Start Launch Pad</h2>
    <?php
    $now = new DateTime();
    $date = $now->format('Y-m-d');
    echo $date;
    ?>
    <form action="" method="post">
        <input type="hidden" name="action" value="meeting_start">
        <input type="submit" value="Start Meeting">
    </form>


    <h1>Open Meetings</h1>

    <table>
        <tr>
            <th>Meeting ID</th>
            <th>Date</th>
            <th>Status</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach ($open_meetings as $meeting) : ?>
            <tr>
                <td><?php echo htmlspecialchars($meeting['meetingID']); ?></td>
                <td><?php echo htmlspecialchars($meeting['meetingDate']); ?></td>
                <td><?php echo htmlspecialchars($meeting['meetingOpen']); ?></td>
                <td>
                    <form action="." method="post">
                        <input type="hidden" name="action" value="meeting_close">
                        <input type="hidden" name="meetingID" value="<?php echo htmlspecialchars($meeting['meetingID']); ?>">
                        <input type="submit" value="Close">
                    </form>
                </td>
                <td>
                    <form action="." method="post">
                        <input type="hidden" name="action" value="meeting_delete">
                        <input type="hidden" name="meetingID" value="<?php echo htmlspecialchars($meeting['meetingID']); ?>">
                        <input type="submit" value="Delete">
                    </form>
                </td>
            </tr>
            <table>
                <tr>
                    <th>Attendee Name</th>
                </tr>
                <?php foreach ($attendees as $attendee) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($attendee['lastName'] . ', ' . $attendee['firstName']); ?></td>
                    </tr>

                <?php endforeach; ?>
            </table>
        <?php endforeach; ?>

    </table>



</main>
<?php include '../view/footer.php'; ?>