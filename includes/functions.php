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
