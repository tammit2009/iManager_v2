<?php
// error_reporting(E_ALL);
// ini_set('display_errors',1);

class UserManager {
    private DBOperation $opr;

    function __construct() {
        $this->opr = new DBOperation();
    }

    public function getAllRecords($table) {
        if ($this->opr->dbConnected()) {
            $result = $this->opr->sqlSelect('SELECT * FROM '. $table);  
            if($result && $result->num_rows > 0) {
                $rows = array();
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $rows[] = $row;
                    }
                }
                return $rows;
            }
            else {
                return 'NO_DATA';
            }
        }
        else {
            return 'UNABLE_TO_CONNECT';
        }
    }

    public function getRolesFromGroupId($groupId) {
        $sql = "SELECT groups_roles.groupid, groups_roles.roleid, roles.name 
                FROM `groups_roles` INNER JOIN `roles` ON groups_roles.roleid = roles.id 
                WHERE groups_roles.groupid = ?";
        if ($this->opr->dbConnected()) {
            $result = $this->opr->sqlSelect($sql, 'i', $groupId);  
            if($result && $result->num_rows > 0) {
                $rows = array();
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $rows[] = $row;
                    }
                }
                return $rows;
            }
            else {
                return 'NO_DATA';
            }
            //$this->opr->close();
        }
        else {
            return 'UNABLE_TO_CONNECT';
        }
    }

    public function isRoleInGroup($roleName, $groupId) {
        $res = $this->getRolesFromGroupId($groupId);
        if ($res !== 'NO_DATA' && $res !== 'UNABLE_TO_CONNECT') {
            // echo "<pre>"; // print_r($res);
            foreach ($res as $key => $val) {
                if ($val['name'] === $roleName) {
                    return true;
                }
            }
        }
        return false;
    }

    public function getUser($userId) {
        $user = [];	
        if($this->opr->dbConnected()) {
            $res = $this->opr->sqlSelect('SELECT * FROM users WHERE id=?', 'i', $userId);
            if($res && $res->num_rows === 1) {
                $user = $res->fetch_assoc();
                //$this->opr->close();
                return $user;
            }
            else {
                return 'NO_DATA';
            }
        }
        else {
            return 'UNABLE_TO_CONNECT';
        }
    }

    function close() {
        if ($this->opr->dbConnected()) {
            $this->opr->close();
        }
    }

    function saveUser() {
        extract($_POST);

        // TODO: validate the POST data

        // TODO: check for dbconnect success

        $data = "";
        foreach($_POST as $k => $v) {
            //$$k = $v;  echo "\n$$k : $v";
            if(!in_array($k, array('id','cpass','password')) && !is_numeric($k)){
                if(empty($data)){
                    $data .= " $k='$v' ";
                }else{
                    $data .= ", $k='$v' ";
                }
            }
        }
        if(!empty($password)){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $data .= ", password='" . $hash ."'";
        }

        $sql = "SELECT * FROM users WHERE email =?";
        if (empty($id)) {
            $check = $this->opr->sqlSelect($sql, 's', $email)->num_rows;
        }
        else {
            $sql .= " AND id != ?";
            $check = $this->opr->sqlSelect($sql, 'si', $email, $id)->num_rows;
        }

        if($check > 0){
			return 2;   // email already exists
			exit;
		}

        if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != '') {
            // foreach($_FILES as $k => $v) { $$k = $v; echo "\n$$k:\n"; print_r($v); }
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			move_uploaded_file($_FILES['img']['tmp_name'], PROFILE_PIX_PATH.$fname);
			$data .= ", avatar = '$fname' ";
		}
        
        if(empty($id)){
			$save = $this->opr->sqlInsert("INSERT INTO users set $data");
		} else {
            //echo $data;
			$save = $this->opr->sqlUpdate("UPDATE users SET $data WHERE id = ?", 'i', $id);
		}

		if($save){
			return 1;       // saved user successfully
		}

        return 3;           // unable to insert user in db
    }

    function deleteUser() {
        extract($_POST);

        // TODO: validate the POST data

        // TODO: check for dbconnect success

		$delete = $this->opr->sqlDelete("DELETE FROM users where id = ?", "i", $id);
		if($delete)
			return 1;
        else 
            return -1;
    }

};

// Tests:
// $mgr = new DbManager();
// echo "<pre>";
// print_r($mgr->getRolesFromGroupId(2));
// echo $mgr->isRoleInGroup("admin", 2);

// old stuff

    // public function addCategory($parent, $cat) {
    //     $pre_stmt = $this->con->prepare("INSERT INTO `categories`(`parent_category`, `category_name`, `status`) 
    //         VALUES (?,?,?)");
    //     $status = 1;
    //     $pre_stmt->bind_param("isi", $parent, $cat, $status);
    //     $result = $pre_stmt->execute() or die($this->con->error);
    //     if ($result) {
    //         return "CATEGORY_ADDED";
    //     }
    //     else {
    //         return 0;
    //     }
    // }

    // public function addBrand($brand_name) {
    //     $pre_stmt = $this->con->prepare("INSERT INTO `brands`(`brand_name`, `status`) 
    //         VALUES (?,?)");
    //     $status = 1;
    //     $pre_stmt->bind_param("si", $brand_name, $status);
    //     $result = $pre_stmt->execute() or die($this->con->error);
    //     if ($result) {
    //         return "BRAND_ADDED";
    //     }
    //     else {
    //         return 0;
    //     }
    // }

    // public function addProduct($cid, $bid, $prod_name, $price, $stock, $date) {
    //     $pre_stmt = $this->con->prepare("INSERT INTO `products`
    //             (`cid`, `bid`, `product_name`, `product_price`, `product_stock`, `added_date`, `p_status`) 
    //             VALUES (?,?,?,?,?,?,?)");
    //     $status = 1;
    //     $pre_stmt->bind_param("iisdisi", $cid, $bid, $prod_name, $price, $stock, $date, $status);
    //     $result = $pre_stmt->execute() or die($this->con->error);
    //     if ($result) {
    //         return "NEW_PRODUCT_ADDED";
    //     }
    //     else {
    //         return 0;
    //     }
    // }

?>