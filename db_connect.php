<?php
    function connect_to_db()
    {
        define("USER", "administrator");
        define("PASS", "cs372DBLogin");
        define("DB", "docdashDB");
    
        // connect to database
        $connection = new mysqli('rds-mysql-docdash.cza6uneofziy.us-west-2.rds.amazonaws.com:3306', USER, PASS, DB);
    
        if ($connection->connect_error) {
            die('Connect Error (' . $connection->connect_errno . ') '
                . $connection->connect_error);
        }
        
        return $connection;   
    }
?>
