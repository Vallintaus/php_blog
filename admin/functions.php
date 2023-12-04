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


// REDIRECT
function redirect($location)
{
    return header("Location: ", $location);
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
