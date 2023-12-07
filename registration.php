<?php include "includes/header.php"; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmed_password = trim($_POST['confirmed_password']);

    $error = [
        'username' => '',
        'email' => '',
        'password' => '',
        'confirmed_password' => ''

    ];

    if (strlen($username) < 4 || empty($username)) {
        $error['username'] = 'Username need to be atleast 4 character';
    }

    if (username_exist($username)) {
        $error['username'] = 'Username is already taken';
    }

    if (empty($email)) {
        $error['email'] = 'Email cannot be empty';
    }

    if (email_exist($email)) {
        $error['email'] = 'Email is already in use, <a href="index.php">Please login</a>';
    }

    if (strlen($password) < 6 || empty($password)) {
        $error['password'] = 'Password must be atleast 6 character';
    }

    if ($confirmed_password !== $password) {
        $error['confirmed_password'] = "Passwords doesn't match";
    }

    foreach ($error as $key => $value) {
        if (empty($value)) {
            unset($error[$key]);
        }
    }
    if (empty($error)) {

        register_new_user($username, $password, $email, $confirmed_password);
        login_user($username, $password);
        redirect("./index.php");
    }
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
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Username" autocomplete="on" value="<?php echo isset($username) ? $username : '' ?>">
                                <?php if (!empty($error['username'])) : ?>
                                    <p class="alert alert-danger"><?php echo $error['username']; ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" autocomplete="on" value="<?php echo isset($email) ? $email : '' ?>">
                                <?php if (!empty($error['email'])) : ?>
                                    <p class="alert alert-danger"><?php echo $error['email']; ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                                <?php if (!empty($error['password'])) : ?>
                                    <p class="alert alert-danger"><?php echo $error['password']; ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <label for="confirmed_password" class="sr-only">Confirm password</label>
                                <input type="password" name="confirmed_password" id="key" class="form-control" placeholder="Confirm password">
                                <?php if (!empty($error['confirmed_password'])) : ?>
                                    <p class="alert alert-danger"><?php echo $error['confirmed_password']; ?></p>
                                <?php endif; ?>
                            </div>

                            <input type="submit" name="register" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "includes/footer.php"; ?>