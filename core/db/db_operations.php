<?php

class DBOperation {

    private $cn;

    function __construct() {
        include_once("database.php");
        $db = new Database();
        $this->cn = $db->connect();
    }

    function dbConnected() {
        if ($this->cn->connect_error) {
            return false;
        }
        return true;
    }

    function getConnection() {
        return $this->cn;
    }

    function die_error() {
        die(mysqli_error($this->con)); // Diagnostic
    }

    function createTable($name, $recreate, $queryParams) {
        if ($this->tableExists($name)) {
            if ($recreate) {
                $this->sqlSelect("DROP TABLE $name");
                $this->sqlSelect("CREATE TABLE $name($queryParams)");
                echo "Table '$name' dropped and re-created<br />";	
            }
            else {
                echo "Table '$name' already exists<br />";	
            }
        }
        else {
            $this->sqlSelect("CREATE TABLE $name($queryParams)");
            echo "Table '$name' created<br />";	
        }
    }

    function tableExists($name) {
        $result = $this->sqlSelect("SHOW TABLES LIKE '$name'");
        return mysqli_num_rows($result);
    }

    function sqlSelect($query, $format = false, ...$vars) { // variable number of variables
        $stmt = $this->cn->prepare($query);
        if($format) {
            $stmt->bind_param($format, ...$vars);
        }
        if($stmt->execute()) {
            $res = $stmt->get_result();
            $stmt->close();
            return $res;
        }
        $stmt->close();
        return false;
    }
    
    function sqlInsert($query, $format = false, ...$vars) {
        $stmt = $this->cn->prepare($query);
        if($format) {
            $stmt->bind_param($format, ...$vars);
        }
        if($stmt->execute()) {
            $id = $stmt->insert_id;
            $stmt->close();
            return $id;
        }
        $stmt->close();
        return -1;
    }
    
    function sqlUpdate($query, $format = false, ...$vars) {
        $stmt = $this->cn->prepare($query);
        if($format) {
            $stmt->bind_param($format, ...$vars);
        }
        if($stmt->execute() && $stmt->affected_rows > 0) {
            $stmt->close();
            return true;
        }
        $stmt->close();
        return false;
    }

    function sqlDelete($query, $format = false, ...$vars) { // same as update, created for completeness
        $stmt = $this->cn->prepare($query);
        if($format) {
            $stmt->bind_param($format, ...$vars);
        }
        if($stmt->execute()) {
            $stmt->close();
            return true;
        }
        $stmt->close();
        return false;
    }

    function sqlExecute($query, $format = false, ...$vars) {
        $stmt = $this->cn->prepare($query);
        if($format) {
            $stmt->bind_param($format, ...$vars);
        }
        if($stmt->execute() && $stmt->affected_rows > 0) {
            $stmt->close();
            return true;
        }
        $stmt->close();
        return false;
    }

    function close() {
        $this->cn->close();
    }
}

//$opr = new DBOperation();
// echo $opr->addCategory(1, "Mobiles");
// echo "<pre>";
// print_r($opr->getAllRecords("categories"));

?>