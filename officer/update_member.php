<?php
require_once('../util/secure_conn.php');
require_once('../util/valid_officer.php');
?>
<?php include '../view/header.php'; ?>
<main>
    <div class="container">
        <div class="row">
            <div class="col">
                <h2>Add Member</h2>
                <form action="" method="post" id="aligned">
                    <input type="hidden" name="action" value="update_member">

                    <label>First Name:</label>
                    <input type="text" name="fName" size="30">
                    <br>

                    <label>Last Name:</label>
                    <input type="text" name="lName" size="30">
                    <br>

                    <label>Join Date:</label>
                    <input type="text" name="joinDate" size="30">
                    <br>

                    <label>Role:</label>

                    <select name="role">
                        <option value="">Select...</option>
                        <option value="1">Advisor</option>
                        <option value="2">President</option>
                        <option value="3">Vice-President</option>
                        <option value="4">Secretary</option>
                        <option value="5">Treasurer</option>
                        <option value="6">Member</option>
                        <option value="7">Associate Member</option>
                    </select>
                    </br>
                    </br>

                    <label>&nbsp;</label>
                    <input type="submit" class="btn btn-primary btn-lg" value="Update Member">
                </form>
            </div>
        </div>
    </div>
</main>
<?php include '../view/footer.php'; ?>