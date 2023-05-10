<?php
require_once('../util/secure_conn.php');
?>
<?php include '../view/header.php'; ?>
<main>
    <div class="container">
        <h1>Meeting Kiosk</h1>
        <br>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col col-lg-5">
                    <?php if ($open_meetings) : ?>
                        <?php foreach ($open_meetings as $meeting) : ?>
                            <h1>User Sign-in for <?php echo htmlspecialchars($meeting['meetingDate']); ?></h1>
                            <form action="" method="post" id="aligned">
                                <input type="hidden" name="action" value="meeting_sign_in">
                                <input type="hidden" name="meetingID" value="<?php echo htmlspecialchars($meeting['meetingID']); ?>">

                                <br>


                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Username</span>
                                    <input type="text" class="form-control" placeholder="Username" aria-label="Member-user-name" aria-describedby="button-addon2" name="username">
                                    <input class="btn btn-success" type="submit" id="button-addon2" value="Sign-In">
                                </div>
                            </form>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p> No current meeting </p>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>