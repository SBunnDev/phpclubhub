<?php
require_once('../util/secure_conn.php');
require_once('../util/valid_user.php');
?>
<?php include '../view/header.php'; ?>
<main>
    <div class="container">
        <div class="row">
            <div class="col col-lg-6">
                <h1>User Secure Password Update</h1>
                <form action="" method="post" id="aligned">
                    <input type="hidden" name="action" value="update_password">

                    <input type="hidden" name="username" value="<?php echo $_SESSION['user'] ?>">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Old Password</span>
                        <input type="password" class="form-control" name="old_password" aria-describedby="basic-addon1">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">New Password</span>
                        <input type="password" class="form-control" name="new_password" aria-describedby="basic-addon1">
                    </div>


                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Retype New Password</span>
                        <input type="password" class="form-control" name="new_password_conf" aria-describedby="basic-addon1">
                    </div>



                    <label>&nbsp;</label>
                    <input type="submit" class="btn btn-warning" value="Update Password">
                </form>
            </div>
        </div>
    </div>
</main>
<?php include '../view/footer.php'; ?>