<?php
//include_once('../../core/initialize.php');

class User {

    // db stuff
    private $opr;
    private $table = 'users';

    // list user properties
    public $id;
    public $name;
    public $email;
    public $password;
    public $groupid;
    public $verified;
    public $avatar;
    public $createdOn;

    // constructor
    public function __construct($db_opr) {
        $this->opr = $db_opr;
    }

    // get posts from our database
    public function read() {
        $query = 'SELECT * FROM '. $this->table;
        $res = $this->opr->sqlSelect($query);
        return $res;
    }

    public function read_single($id) {  // can also use '$this->id' if set from the calling function

        // TODO: ensure input have been validated by the caller

        // create query
        $query = 'SELECT * FROM '. $this->table .' WHERE id = ? LIMIT 1';
        $res = $this->opr->sqlSelect($query, 'i', $id);
        return $res;
    }

    public function read_single_by_email($email) {  

        // TODO: ensure input have been validated by the caller

        // create query
        $query = 'SELECT * FROM '. $this->table .' WHERE email = ? LIMIT 1';
        $res = $this->opr->sqlSelect($query, 's', $email);

        // in any case, return result
        return $res;
    }

    public function create($name, $email, $password, $avatar='') {

        // TODO: ensure inputs have been validated by the caller

        // Check if the user alreay exists
        $q = 'SELECT * FROM '. $this->table .' WHERE email = ?';
        $res = $this->opr->sqlSelect($q, 's', $email);
        if ($res && $res->num_rows > 0) {
            return -2;
        }

        // First hash the password
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // create query
        if (empty($avatar)) {
            $query = 'INSERT INTO '. $this->table .' VALUES (NULL, ?, ?, ?, 1, 0, NULL, CURRENT_TIMESTAMP)';
            $id = $this->opr->sqlInsert($query, 'sss', $name, $email, $hash);             // -1 if failed
        }
        else {
            $query = 'INSERT INTO '. $this->table .' VALUES (NULL, ?, ?, ?, 1, 0, ?, CURRENT_TIMESTAMP';
            $id = $this->opr->sqlInsert($query, 'ssss', $name, $email, $hash, $avatar);   // -1 if failed
        }
        
        return $id;
    }

    // Update post function
    public function update($id, $props) {  

        // TODO: ensure inputs have been validated by the caller

        $prop_arr = array();
        $format_str = '';
        $var_str = '';

        // All this to allow variable property enty
        foreach($props as $k => $v) {
            $$k = $v;
            switch ($k) {
                case 'name': 
                    if ($var_str == '') $var_str .= 'name=?'; else $var_str .= ',name=?';
                    $prop_arr[] = $$k;
                    $format_str .= 's';
                    break;
                case 'email': 
                    if ($var_str == '') $var_str .= 'email=?'; else $var_str .= ',email=?';
                    $prop_arr[] = $$k;
                    $format_str .= 's';
                    break;
                case 'password': 
                    if ($var_str == '') $var_str .= 'password=?'; else $var_str .= ',password=?';
                    // Hash the password
                    $hash = password_hash($$k, PASSWORD_DEFAULT);
                    $prop_arr[] = $hash;
                    $format_str .= 's';
                    break;
                case 'groupid': 
                    if ($var_str == '') $var_str .= 'groupid=?'; else $var_str .= ',groupid=?';
                    $prop_arr[] = $$k;
                    $format_str .= 'i';
                    break;
                case 'verified':
                    if ($var_str == '') $var_str .= 'verified=?'; else $var_str .= ',verified=?';
                    $prop_arr[] = $$k; 
                    $format_str .= 'i';
                    break;
                case 'avatar': 
                    if ($var_str == '') $var_str .= 'avatar=?'; else $var_str .= ',avatar=?';
                    $prop_arr[] = $$k;
                    $format_str .= 's';
                    break;
                default: 
                    break;
            }
        }

        // Update with the $id placeholders
        $format_str .= 'i';     //echo $format_str;
        $prop_arr[] = $id;      //print_r($prop_arr);

        $query = 'UPDATE '. $this->table .' SET ' . $var_str . ' WHERE id=?';   // echo $var_str;
        return $this->opr->sqlUpdate($query, $format_str, ...$prop_arr);  // true on success
    }

    // delete function
    public function delete($id) {

        // TODO: ensure inputs have been validated by the caller

        // Is there a need to check if the user alreay exists?
        $q = 'SELECT * FROM '. $this->table .' WHERE id = ?';
        $res = $this->opr->sqlSelect($q, 's', $id);

        if ($res && $res->num_rows == 0) {
            return -2;
        }
        
        // create query
        $query = 'DELETE FROM '. $this->table .' WHERE id = ?';
        $success = $this->opr->sqlDelete($query, "i", $id);

        if ($success) {
            return $id;
        }
        else {
            return -1;
        }
    }
  
}

?>