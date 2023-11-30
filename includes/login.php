<?php include "db.php"; ?>
<?php include "../admin/functions.php"; ?>

<?php session_start(); ?>

<?php

if (isset($_POST['login'])) {
    $username = escape($_POST['username']);
    $password = escape($_POST['password']);



    $query = "SELECT * FROM users WHERE username = '{$username}' ";

    $select_user_query = mysqli_query($connection, $query);

    if (!$select_user_query) {
        die("QUERY FAILED" . mysqli_error($connection));
    }

    while ($row = mysqli_fetch_array($select_user_query)) {
        $db_user_id = $row['user_id'];
        $db_username = $row['username'];
        $db_password = $row['user_password'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];
        $db_user_email = $row['user_email'];
    }

    // hashed password
    if (password_verify($password, $db_password)) {

        $_SESSION['username'] = $db_username;
        $_SESSION['user_firstname'] = $db_user_firstname;
        $_SESSION['user_lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;
        $_SESSION['user_email'] = $db_user_email;

        header("Location: ../admin/index.php");
    } else {
        $_SESSION['login_message'] =  "<h5 class='alert alert-danger'>Wrong username or password. Try again</h5>";
        header("Location: ../index.php");
    }
}

?>
