<?php
require_once('../util/secure_conn.php');
require_once('../util/valid_officer.php');
?>
<?php include '../view/header.php'; ?>
<main>

    <h2>Add Member</h2>
    <form action="" method="post" id="aligned">
        <input type="hidden" name="action" value="add_member">

        <label>First Name:</label>
        <input type="text" name="fName" size="30">
        <br>

        <label>Last Name:</label>
        <input type="text" name="lName" size="30">
        <br>

        <label>Username:</label>
        <input type="text" name="username" size="30">
        <br>

        <label>&nbsp;</label>
        <input type="submit" class="btn btn-primary btn-lg" value="Add">
    </form>

</main>
<?php include '../view/footer.php'; ?>