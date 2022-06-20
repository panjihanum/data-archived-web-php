<?php
$TITLE = "Login";
include '../../templates/header.php';
?>
<div class="App">
    <div class="vertical-center">
        <div class="inner-block">
            <form action="" method="post">
                <h3>Login</h3>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email_signin" id="email_signin" />
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password_signin" id="password_signin" />
                </div>
                <button type="submit" name="login" id="sign_in" class="btn btn-outline-primary btn-lg btn-block">Sign
                    in</button>
            </form>
        </div>
    </div>
</div>

<?php
include '../../templates/footer.php';
?>