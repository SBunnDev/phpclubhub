<?php
require_once('../util/secure_conn.php');
require_once('../util/valid_user.php');
?>
<?php include '../view/header.php'; ?>
<main>

    <h1>Member Roster</h1><a href="?action=view_add_member" type="button" class="btn btn-primary btn-lg">Add Member</a>

    <table>
        <tr>
            <th>Name</th>
            <th>Join Date</th>
            <th>Username</th>
            <th>Password</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach ($members as $member) : ?>
            <tr>
                <td><?php echo htmlspecialchars(
                        $member['firstName'] . ' ' .
                            $member['lastName']
                    ); ?></td>
                <td><?php echo htmlspecialchars($member['joinDate']); ?></td>
                <td><?php echo htmlspecialchars($member['username']); ?></td>
                <td><?php echo htmlspecialchars($member['password']); ?></td>
                <td>
                    <form action="." method="post">
                        <input type="hidden" name="action" value="update_member">
                        <input type="hidden" name="member_id" value="<?php echo htmlspecialchars($member['memberID']); ?>">
                        <input type="submit" class="btn btn-warning" value="Update">
                    </form>
                </td>
                <td>
                    <form action="." method="post">
                        <input type="hidden" name="action" value="delete_member">
                        <input type="hidden" name="member_id" value="<?php echo htmlspecialchars($member['memberID']); ?>">
                        <input type="submit" class="btn btn-danger" value="Delete">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</main>
<?php include '../view/footer.php'; ?>