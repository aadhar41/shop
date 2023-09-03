<?php

require_once "./vendor/autoload.php";
// require_once "../vendor/autoload.php";

use Doctrine\DBAL\DriverManager;

class Doctrine
{
    // A variable that is used to store the server name.
    protected $serverName = 'localhost';
    // A variable that is used to store the username.
    protected $username = 'root';
    // A variable that is used to store the password.
    protected $password = '';
    // A variable that is used to store the database name.
    protected $dbname = 'shop';
    // A variable that is used to store the connection to the database.
    protected $connection;
    // A variable that is used to store the query.
    protected $query;
    // Setting the value of the show_errors property to true.
    protected $show_errors = TRUE;
    // Setting the value of the query_closed property to true.
    protected $query_closed = TRUE;
    // A variable that is used to store the number of queries that have been executed.
    public $query_count = 0;

    // For methods fetching records.
    // D:\wamp64_2\www\doctrine-project\shop\vendor\doctrine\dbal\src\Connection.php
    

    /**
     * It creates a new connection to the database
     * 
     * @param serverName The name of the server you want to connect to.
     * @param username The username of the MySQL user you created.
     * @param password The password for the user.
     * @param dbname The name of the database you want to connect to.
     * @param charset The character set to use.
     */
    public function __construct($serverName = 'localhost', $username = 'root', $password = '', $dbname = 'shop', $charset = 'utf8')
    {
        // Connection parameters for doctrine.
        $connectionParams = [
            'dbname' => $dbname,
            'user' => $username,
            'password' => $password,
            'host' => $serverName,
            'driver' => 'pdo_mysql',
        ];

        $this->connection = $conn = DriverManager::getConnection($connectionParams);
    }

    /**
     * The function returns the connection object.
     * 
     * @return object the value of the variable ->connection.
     */
    public function connection() {
        return $this->connection;
    }

    /**
     * The queryBuilder function returns a query builder object for executing database queries in PHP.
     * 
     * @return object an instance of the query builder class.
     */
    public function queryBuilder() {
        return $this->connection()->createQueryBuilder();
    }

    /**
     * The close() function closes the connection to the database.
     * 
     * @return object The close() function is returning the result of the close() method called on the
     * connection object.
     */
    public function close() {
        return $this->connection()->close();
    }


}
