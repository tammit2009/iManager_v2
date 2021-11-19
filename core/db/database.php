<?php

class Database {

    private $cn;

    public function connect() {
        $this->cn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
        if ($this->cn) {
            //echo "Connected.";
            return $this->cn;
        }
        return "DATABASE_CONNECTION_FAIL";
    }

    public function checkConnectionOrExit() {
        if (mysqli_connect_errno()) {
           echo "Failed to connect to MySQL: " . mysqli_connect_error();
           exit;
        }
    }
}

// $db = new Database();
// $db->connect();

?>