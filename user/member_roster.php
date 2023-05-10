<?php
require_once('../util/secure_conn.php');
require_once('../util/valid_user.php');
?>
<?php include '../view/header.php'; ?>
<main>
    <div class="container">
        <div class="row">
            <div class="col">


                <h1>Member Roster</h1>

                <table class="table table-striped table-hover">
                    <tr>
                        <th>Role</th>
                        <th>Name</th>
                        <th>Join Date</th>
                    </tr>
                    <?php foreach ($members as $member) : ?>

                        <tr>
                            <td><?php echo htmlspecialchars($member['roleName']); ?></td>
                            <td><?php echo htmlspecialchars(
                                    $member['firstName'] . ' ' . $member['lastName']
                                ); ?></td>

                            <td><?php echo htmlspecialchars($member['joinDate']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>

            </div>
        </div>
    </div>
</main>
<?php include '../view/footer.php'; ?>