<?php

/* It takes a query and an array of arguments, and binds the arguments to the query. */
class Db
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
        $this->connection = new mysqli($serverName, $username, $password, $dbname);
        if ($this->connection->connect_error) {
            $this->error('Failed to connect to MySQL - ' . $this->connection->connect_error);
        }
        $this->connection->set_charset($charset);
    }

    /**
     * It takes a query and an array of arguments, and binds the arguments to the query.
     * 
     * @param query The query to be executed.
     * 
     * @return The query object.
     */
    public function query($query)
    {
        if (!$this->query_closed) {
            $this->query->close();
        }
        if ($this->query = $this->connection->prepare($query)) {
            if (func_num_args() > 1) {
                $x = func_get_args();
                $args = array_slice($x, 1);
                $types = '';
                $args_ref = array();
                foreach ($args as $k => &$arg) {
                    if (is_array($args[$k])) {
                        foreach ($args[$k] as $j => &$a) {
                            $types .= $this->_gettype($args[$k][$j]);
                            $args_ref[] = &$a;
                        }
                    } else {
                        $types .= $this->_gettype($args[$k]);
                        $args_ref[] = &$arg;
                    }
                }
                array_unshift($args_ref, $types);
                call_user_func_array(array($this->query, 'bind_param'), $args_ref);
            }
            $this->query->execute();
            if ($this->query->errno) {
                $this->error('Unable to process MySQL query (check your params) - ' . $this->query->error);
            }
            $this->query_closed = FALSE;
            $this->query_count++;
        } else {
            $this->error('Unable to prepare MySQL statement (check your syntax) - ' . $this->connection->error);
        }
        return $this;
    }

    /**
     * It takes the results of a query and returns an array of the results
     * 
     * @param callback A callback function to be applied to each row.
     * 
     * @return An array of arrays.
     */
    public function fetchAll($callback = null)
    {
        $params = array();
        $row = array();
        $meta = $this->query->result_metadata();
        while ($field = $meta->fetch_field()) {
            $params[] = &$row[$field->name];
        }
        call_user_func_array(array($this->query, 'bind_result'), $params);
        $result = array();
        while ($this->query->fetch()) {
            $r = array();
            foreach ($row as $key => $val) {
                $r[$key] = $val;
            }
            if ($callback != null && is_callable($callback)) {
                $value = call_user_func($callback, $r);
                if ($value == 'break') break;
            } else {
                $result[] = $r;
            }
        }
        $this->query->close();
        $this->query_closed = TRUE;
        return $result;
    }

    /**
     * It takes the result of a query and returns an array of the results
     * 
     * @return An array of the results of the query.
     */
    public function fetchArray()
    {
        $params = array();
        $row = array();
        $meta = $this->query->result_metadata();
        while ($field = $meta->fetch_field()) {
            $params[] = &$row[$field->name];
        }
        call_user_func_array(array($this->query, 'bind_result'), $params);
        $result = array();
        while ($this->query->fetch()) {
            foreach ($row as $key => $val) {
                $result[$key] = $val;
            }
        }
        $this->query->close();
        $this->query_closed = TRUE;
        return $result;
    }

    /**
     * It closes the connection to the database.
     * 
     * @return The connection is being closed.
     */
    public function close()
    {
        return $this->connection->close();
    }

    /**
     * It returns the number of rows affected by the last query
     * 
     * @return The number of rows affected by the last query.
     */
    public function affectedRows()
    {
        return $this->query->affected_rows;
    }

    /**
     * It returns the last insert ID
     * 
     * @return The last inserted ID.
     */
    public function lastInsertID()
    {
        return $this->connection->insert_id;
    }

    /**
     * It returns the last query executed by the database
     * 
     * @return The last query executed.
     */
    public function lastQuery()
    {
        return $this->connection->info;
    }

    /**
     * If the show_errors property is set to true, then exit the script and display the error message.
     * 
     * @param error The error message to display.
     */
    public function error($error)
    {
        if ($this->show_errors) {
            exit($error);
        }
    }

    /**
     * If the variable is a string, return 's'. If the variable is a float, return 'd'. If the variable
     * is an integer, return 'i'. Otherwise, return 'b'.
     * 
     * @param var The variable to be bound.
     * 
     * @return The type of the variable.
     */
    private function _gettype($var)
    {
        if (is_string($var)) return 's';
        if (is_float($var)) return 'd';
        if (is_int($var)) return 'i';
        return 'b';
    }

    /**
     * It takes a query as a parameter, runs it, and returns the result as an array.
     * 
     * @param query The query you want to run.
     * 
     * @return An array of associative arrays.
     */
    public function runQueryAssocSet($query)
    {
        $result = $this->connection->query($query);
        while ($row = $result->fetch_assoc()) {
            $resultset[] = $row;
        }

        $this->connection->query($query)->close();
        $this->connection->query_closed = TRUE;
        
        if (!empty($resultset))
            return $resultset;
    }

    /**
     * Run a query and return the results as an associative array.
     * 
     * @param query The query to run.
     * 
     * @return An array of associative arrays.
     */
    function runQueryAssoc($query)
    {
        $result = $this->connection->query($query);
        $row = $result->fetch_assoc();

        $this->connection->query($query)->close();
        $this->connection->query_closed = TRUE;

        if (!empty($row))
            return $row;
    }

    /**
     * If the query is successful, return the result as an object.
     * 
     * @param query The query to be executed.
     * 
     * @return An object.
     */
    public function runQueryObj($query)
    {
        if ($result = $this->connection->query($query)) {
            
            $this->connection->query($query)->close();
            $this->connection->query_closed = TRUE;

            return $result->fetch_object();
        }
    }

    /**
     * It returns the number of rows in a result set.
     * 
     * @param query The query you want to run
     * 
     * @return The number of rows in the result set.
     */
    function numRows($query)
    {
        $result = $this->connection->query($query);
        $rowcount = $result->num_rows;
        
        $this->connection->query($query)->close();
        $this->connection->query_closed = TRUE;

        return $rowcount;
    }
}
