<?php

function escape($string)
{
    global $connection;
    return mysqli_real_escape_string($connection, trim($string));
}



function checkQuery($result)
{

    global $connection;

    if (!$result) {

        die("Query failed ." . mysqli_error($connection));
    }
}

// REDIRECT
function redirect($location)
{
    return header("Location: ", $location);
}


function create_new_category()
{
    global $connection;

    if (isset($_POST['submit'])) {
        $cat_title = escape($_POST['cat_title']);

        if ($cat_title == "" || empty($cat_title)) {
            echo "This field must contain something";
        } else {
            $query = "INSERT INTO categories(cat_title) ";
            $query .= "VALUE('{$cat_title}')";

            $create_category_query = mysqli_query($connection, $query);

            if (!$create_category_query) {
                die("Something went wrong" . mysqli_error($connection));
            }
            if ($create_category_query) {
                header("Location: categories.php");
                exit;
            }
        }
    }
}



function find_all_categories()
{

    global $connection;

    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);


    while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";
        echo "<td> {$cat_id} </td>";
        echo "<td> {$cat_title} </td>";
        echo "<td> <a href='categories.php?delete={$cat_id}'>Delete</td>";
        echo "<td> <a href='categories.php?edit={$cat_id}'>Edit</td>";
        echo "</tr>";
    }
}

// DELETE CATEGORY
function delete_category()
{
    global $connection;

    if (isset($_GET['delete'])) {
        $delete_cat_id = $_GET['delete'];

        $query = "DELETE FROM categories WHERE cat_id = {$delete_cat_id}";

        $delete_category = mysqli_query($connection, $query);
        header("Location: categories.php");
        exit;
    }
}



function users_online()
{


    if (isset($_GET['onlineusers'])) {

        global $connection;

        if (!$connection) {
            session_start();

            include("../includes/db.php");


            $session = session_id();
            $time = time();
            $time_out_in_seconds = 10;
            $time_out = $time - $time_out_in_seconds;

            $delete_users_online_query = "DELETE FROM users_online WHERE session = '{$session}'";
            $delete_query = mysqli_query($connection, $delete_users_online_query);

            $query = "SELECT * FROM users_online WHERE session = '{$session}' ";
            $send_query = mysqli_query($connection, $query);
            $count = mysqli_num_rows($send_query);

            if ($count == 0) {
                mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('{$session}', '{$time}') ");
            } else {
                mysqli_query($connection, "UPDATE users_online SET time = '{$time}' WHERE session = '{$session}' ");
            }
            $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '{$time_out}' ");
            echo $count_user = mysqli_num_rows($users_online_query);
        }
    } // get request
}

users_online();



// COUNT ROWS ON TABLE

function recordCount($table)
{
    global $connection;

    $query = "SELECT * FROM " . $table;
    $select_all_from_table = mysqli_query($connection, $query);

    $result = mysqli_num_rows($select_all_from_table);

    checkQuery($result);

    return $result;
}



// SELECT ALL FROM TABLE WHERE COLUMN = STATUS

function checkStatus($table, $column, $status)
{
    global $connection;

    $query = "SELECT * FROM $table WHERE $column = '$status' ";
    $result = mysqli_query($connection, $query);
    checkQuery($result);

    return mysqli_num_rows($result);
}




function is_admin($username = "")
{
    global $connection;

    $query = "SELECT user_role FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $query);

    checkQuery($result);

    $row = mysqli_fetch_array($result);

    if ($row['user_role'] == 'admin') {
        return true;
    } else {
        return false;
    }
}



// CHECK FOR DUPLICATE usernames

function username_exist($username)
{
    global $connection;

    $query = "SELECT username FROM users WHERE username = '$username' ";
    $result = mysqli_query($connection, $query);
    checkQuery($result);

    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

// CHECK FOR DUPLICATE emails

function email_exist($email)
{
    global $connection;

    $query = "SELECT user_email FROM users WHERE user_email = '$email' ";
    $result = mysqli_query($connection, $query);
    checkQuery($result);

    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}


function register_new_user($username, $password, $email, $confirmed_password)
{
    global $connection;

    $username = escape($_POST['username']);
    $email = escape($_POST['email']);
    $password = escape($_POST['password']);
    $confirmed_password = escape($_POST['confirmed_password']);


    $username = escape($username);
    $email = escape($email);
    $password = escape($password);


    $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));



    $query = "INSERT INTO users (username, user_email, user_password, user_role, user_firstname, user_lastname, user_image) ";
    $query .= "VALUES('{$username}', '{$email}', '{$password}', 'user', '', '', '')";
    $register_user_query = mysqli_query($connection, $query);

    checkQuery($register_user_query);
}


function login_user($username, $password)
{
    global $connection;

    $username = trim($username);
    $password = trim($password);

    $username = escape($username);
    $password = escape($password);


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

        redirect("./index.php");
    } else {
        $_SESSION['login_message'] =  "<h5 class='alert alert-danger'>Wrong username or password. Try again</h5>";
        redirect("./index.php");
    }
}
