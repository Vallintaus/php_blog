<?php

// default admin user
//  username: test
// password: test

$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "";
$db['db_name'] = "cms";

foreach ($db as $key => $value) {
    define(strtoupper($key), $value);
}


class DbConnectionPool
{
    private static $connections = [];

    public static function getConnection()
    {
        if (empty(self::$connections)) {
            $connection = mysqli_connect('p:' . DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if (!$connection) {
                die("Connection failed: " . mysqli_connect_error());
            }
            self::$connections[] = $connection;
        }

        return array_pop(self::$connections);
    }

    public static function releaseConnection($connection)
    {
        self::$connections[] = $connection;
    }
}

// To use the connection pool:
$connection = DbConnectionPool::getConnection();

// ... perform database operations ...

DbConnectionPool::releaseConnection($connection);

if (!$connection) {

    echo "connection failed!";
}
