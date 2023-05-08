<?php
require_once('../util/secure_conn.php');
require_once('../util/valid_user.php');
?>
<?php include '../view/header.php'; ?>
<main>

    <h1>Member Roster</h1>

    <table>
        <tr>
            <th>Role</th>
            <th>Name</th>
            <th>Join Date</th>
            <th>&nbsp;</th>
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


</main>
<?php include '../view/footer.php'; ?>