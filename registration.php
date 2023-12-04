<?php include "includes/header.php"; ?>

<?php
if (isset($_POST['submit'])) {

    $username = escape($_POST['username']);
    $email = escape($_POST['email']);
    $password = escape($_POST['password']);
    $confirmed_password = escape($_POST['confirmed_password']);

    if (!username_exist($username)) {

        if (!empty($username) && !empty($email) && !empty($password)) {
            if ($password === $confirmed_password) {

                $username = mysqli_real_escape_string($connection, $username);
                $email = mysqli_real_escape_string($connection, $email);
                $password = mysqli_real_escape_string($connection, $password);


                $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));



                $query = "INSERT INTO users (username, user_email, user_password, user_role, user_firstname, user_lastname, user_image) ";
                $query .= "VALUES('{$username}', '{$email}', '{$password}', 'user', '', '', '')";
                $register_user_query = mysqli_query($connection, $query);

                $message = "<h4 class='alert alert-success'><strong>User created</strong></a></h4>";

                if (!$register_user_query) {
                    die("QUERY FAILED" . mysqli_error($connection) . ' ' . mysqli_errno($connection));
                }
            } else {
                $message = "<h5 class='alert alert-danger'>Passwords doesn't match</h5>";
            }
        } else {
            $message = "<h5 class='alert alert-danger'>Fields cannot be empty</h5>";
        }
    } else {
        $message = "<h5 class='alert alert-danger'>Username already exist</h5>";
    }
} else {
    $message = "";
}

?>

<!-- Navigation -->

<?php include "includes/navigation.php"; ?>


<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Register</h1>
                        <?php echo $message; ?>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Username">
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Confirm password</label>
                                <input type="password" name="confirmed_password" id="key" class="form-control" placeholder="Confirm password">
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "includes/footer.php"; ?>