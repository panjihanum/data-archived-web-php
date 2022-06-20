<?php

// Database connection
include('../../config/db.php');

// Error & success messages
global $success_msg, $username_exist, $_usernameErr, $_passwordErr;
global $usernameEmptyErr, $passwordEmptyErr, $username_verify_err, $username_verify_success;

// Set empty form vars for validation mapping
$_username = $_password = "";
if (isset($_POST["submit"])) {
    $username      = $_POST["username"];
    $password      = $_POST["password"];
    // check if username already exist
    $username_check_query = mysqli_query($connection, "SELECT * FROM users WHERE username = '{$username}' ");
    $rowCount = mysqli_num_rows($username_check_query);

    // PHP validation
    // Verify if form values are not empty
    if (!empty($username) && !empty($password)) {

        // check if user username already exist
        if ($rowCount > 0) {
            $username_exist = '
                    <div class="alert alert-danger" role="alert">
                        User with username already exist!
                    </div>
                ';
        } else {
            // clean the form data before sending to database
            $_username = mysqli_real_escape_string($connection, $username);
            $_password = mysqli_real_escape_string($connection, $password);
            // perform validation
            if (!preg_match("/^[a-zA-Z ]*$/", $_first_name)) {
                $f_NameErr = '<div class="alert alert-danger">
                            Only letters and white space allowed.
                        </div>';
            }
            if (!preg_match("/^[a-zA-Z ]*$/", $_last_name)) {
                $l_NameErr = '<div class="alert alert-danger">
                            Only letters and white space allowed.
                        </div>';
            }
            if (!filter_var($_username, FILTER_VALIDATE_username)) {
                $_usernameErr = '<div class="alert alert-danger">
                            username format is invalid.
                        </div>';
            }
            if (!preg_match("/^[0-9]{10}+$/", $_mobile_number)) {
                $_mobileErr = '<div class="alert alert-danger">
                            Only 10-digit mobile numbers allowed.
                        </div>';
            }
            if (!preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{6,20}$/", $_password)) {
                $_passwordErr = '<div class="alert alert-danger">
                             Password should be between 6 to 20 charcters long, contains atleast one special chacter, lowercase, uppercase and a digit.
                        </div>';
            }

            // Store the data in db, if all the preg_match condition met
            if ((preg_match("/^[a-zA-Z ]*$/", $_first_name)) && (preg_match("/^[a-zA-Z ]*$/", $_last_name)) &&
                (filter_var($_username)) && (preg_match("/^[0-9]{10}+$/", $_mobile_number)) &&
                (preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/", $_password))
            ) {
                // Generate random activation token
                $token = md5(rand() . time());
                // Password hash
                $password_hash = password_hash($password, PASSWORD_BCRYPT);
                // Query
                $sql = "INSERT INTO users (firstname, lastname, username, mobilenumber, password, token, is_active,
                    date_time) VALUES ('{$firstname}', '{$lastname}', '{$username}', '{$mobilenumber}', '{$password_hash}', 
                    '{$token}', '0', now())";

                // Create mysql query
                $sqlQuery = mysqli_query($connection, $sql);

                if (!$sqlQuery) {
                    die("MySQL query failed!" . mysqli_error($connection));
                }
            }
        }
    } else {
        if (empty($firstname)) {
            $fNameEmptyErr = '<div class="alert alert-danger">
                    First name can not be blank.
                </div>';
        }
        if (empty($lastname)) {
            $lNameEmptyErr = '<div class="alert alert-danger">
                    Last name can not be blank.
                </div>';
        }
        if (empty($username)) {
            $usernameEmptyErr = '<div class="alert alert-danger">
                    username can not be blank.
                </div>';
        }
        if (empty($mobilenumber)) {
            $mobileEmptyErr = '<div class="alert alert-danger">
                    Mobile number can not be blank.
                </div>';
        }
        if (empty($password)) {
            $passwordEmptyErr = '<div class="alert alert-danger">
                    Password can not be blank.
                </div>';
        }
    }
};