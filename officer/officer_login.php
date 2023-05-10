<?php
require_once('../util/secure_conn.php');
?>
<?php include '../view/header.php'; ?>
<main>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Officer Login</h1>
                <form action="" method="post" id="aligned">
                    <input type="hidden" name="action" value="login">

                    <label>Username:</label>
                    <input type="text" name="username" size="30">
                    <br>

                    <label>Password:</label>
                    <input type="password" name="password" size="30">
                    <br>

                    <label>&nbsp;</label>
                    <input type="submit" value="Login">
                </form>
            </div>
        </div>
    </div>
</main>
<?php include '../view/footer.php'; ?>