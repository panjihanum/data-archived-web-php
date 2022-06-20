<?php
include('../../controllers/register.php');
$TITLE = "Register";
include '../../templates/header.php';
?>

<div class="App">
    <div class="vertical-center">
        <div class="inner-block">
            <form action="" method="post">
                <h3>Register</h3>
                <?php echo $success_msg; ?>
                <?php echo $username_exist; ?>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" id="username" />
                    <?php echo $_usernameErr; ?>
                    <?php echo $usernameEmptyErr; ?>
                </div>
                <div class="form-group">
                    <label>Mobile</label>
                    <input type="text" class="form-control" name="mobilenumber" id="mobilenumber" />
                    <?php echo $_mobileErr; ?>
                    <?php echo $mobileEmptyErr; ?>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" id="password" />
                    <?php echo $_passwordErr; ?>
                    <?php echo $passwordEmptyErr; ?>
                </div>
                <button type="submit" name="submit" id="submit" class="btn btn-outline-primary btn-lg btn-block">Sign up
                </button>
            </form>
        </div>
    </div>
</div>

<?php
include '../../templates/footer.php';
?>