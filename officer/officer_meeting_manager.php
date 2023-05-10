<?php
require_once('../util/secure_conn.php');
require_once('../util/valid_officer.php');
$count = 0;
?>
<?php include '../view/header.php'; ?>
<main>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Meeting Manager</h1>
            </div>
        </div>
    </div>
    </br>
    <div class="container">
        <div class="row">
            <div class="col">
                <?php if (!$open_meetings) : ?>
                    <?php
                    $now = new DateTime();
                    $date = $now->format('Y-m-d');
                    ?>
                    <form action="" method="post">
                        <input type="hidden" name="action" value="meeting_start">
                        <input type="submit" class="btn btn-primary btn-lg" value="Start <?php echo $date; ?> Meeting">
                    </form>
                <?php endif; ?>
            </div>

            <?php if ($open_meetings) : ?>
                <div class="col">
                    <h2>Open Meetings</h2>

                    <table class="table table-striped">
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
                                        <input type="submit" class="btn btn-warning" value="Close">
                                    </form>
                                </td>
                                <td>
                                    <form action="." method="post">
                                        <input type="hidden" name="action" value="meeting_delete">
                                        <input type="hidden" name="meetingID" value="<?php echo htmlspecialchars($meeting['meetingID']); ?>">
                                        <input type="submit" class="btn btn-danger" value="Delete">
                                    </form>
                                </td>
                            </tr>
                            <table class="table table-hover">
                                <tr>
                                    <th>Attendee Name</th>
                                    <th>Attendee Count: <?php echo count($attendees); ?></th>
                                </tr>
                                <?php foreach ($attendees as $attendee) : ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($attendee['lastName'] . ', ' . $attendee['firstName']); ?></td>
                                        <?php $count = $count + 1; ?>
                                    </tr>

                                <?php endforeach; ?>
                            </table>
                        <?php endforeach; ?>

                    </table>
                </div>
            <?php endif; ?>

        </div>
    </div>
</main>
<?php include '../view/footer.php'; ?>