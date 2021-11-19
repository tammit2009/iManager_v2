<?php 

// include_once(CORE_PATH.DS.'security.php');

// function getRolesByGroupId($groupId) {

//     $roles = array();

//     //Connect to database
//     $opr = new DBOperation();
//     if ($opr->dbConnected()) {

//         $results = $opr->sqlSelect('SELECT groups.id, groups.name, groups_roles.role_id,
//                                 (SELECT name FROM `roles` WHERE `roles`.id = `groups_roles`.role_id) as role_name
//                                 FROM `groups` INNER JOIN `groups_roles`
//                                 ON groups.id = groups_roles.group_id  
//                                 WHERE groups.id=?', 'i', $groupId);

//         if ($results && $results->num_rows > 0) {
//             $group_roles = array();
//             while ($row = $results->fetch_assoc()) {
//                 $group_roles[] = $row;
//             }
//             $results->free_result();
//         }
//         $opr->close();

//         if (!empty($group_roles)) {
//             foreach($group_roles as $role) {
//                 $roles[] = $role['role_id'];
//             }
//         }
//         return $roles;
//     }
//     else {
//         return -1;      // Failed to connect to database
//     }  
// }

// function getGroupsRolesByGroupId($groupId) {

//     $group_roles = array();

//     //Connect to database
//     $opr = new DBOperation();
//     if ($opr->dbConnected()) {

//         $results = $opr->sqlSelect('SELECT groups.id, groups.name, groups_roles.role_id,
//                                 (SELECT name FROM `roles` WHERE `roles`.id = `groups_roles`.role_id) as role_name
//                                 FROM `groups` INNER JOIN `groups_roles`
//                                 ON groups.id = groups_roles.group_id  
//                                 WHERE groups.id=?', 'i', $groupId);

//         if ($results && $results->num_rows > 0) {
//             while ($row = $results->fetch_assoc()) {
//                 $group_roles[] = $row;
//             }
//             $results->free_result();
//         }
//         $opr->close();
//         return $group_roles;
//     }
//     else {
//         return -1;      // Failed to connect to database
//     }  
// }

// function isRoleInGroup($roleName, $groupId) {
//     $res = getGroupsRolesByGroupId($groupId);
//     if (!($res <= 0) && !empty($res)) {
//         // echo "<pre>";  print_r($res);
//         foreach ($res as $key => $val) {
//             if ($val['role_name'] === $roleName) {
//                 return true;
//             }
//         }
//     }
//     return false;
// }

// function getUserById($userId) {
//     $user = [];	

//     //Connect to database
//     $opr = new DBOperation();
//     if ($opr->dbConnected()) {
//         $res = $opr->sqlSelect('SELECT * FROM users WHERE id=?', 'i', $userId);
//         if($res && $res->num_rows === 1) {
//             $user = $res->fetch_assoc();
//             $res->free_result();
//             return $user;          
//         }
//         else {
//             return -2;  // User not found
//         }
//         $opr->close();
//     }
//     else {
//         return -1;      // Failed to connect to database
//     }  
// }

// function saveUser() {
//     // extract($_POST);

//     // // TODO: validate the POST data

//     // // TODO: check for dbconnect success

//     // $data = "";
//     // foreach($_POST as $k => $v) {
//     //     //$$k = $v;  echo "\n$$k : $v";
//     //     if(!in_array($k, array('id','cpass','password')) && !is_numeric($k)){
//     //         if(empty($data)){
//     //             $data .= " $k='$v' ";
//     //         }else{
//     //             $data .= ", $k='$v' ";
//     //         }
//     //     }
//     // }
//     // if(!empty($password)){
//     //     $hash = password_hash($password, PASSWORD_DEFAULT);
//     //     $data .= ", password='" . $hash ."'";
//     // }

//     // $sql = "SELECT * FROM users WHERE email =?";
//     // if (empty($id)) {
//     //     $check = $this->opr->sqlSelect($sql, 's', $email)->num_rows;
//     // }
//     // else {
//     //     $sql .= " AND id != ?";
//     //     $check = $this->opr->sqlSelect($sql, 'si', $email, $id)->num_rows;
//     // }

//     // if($check > 0){
//     //     return 2;   // email already exists
//     //     exit;
//     // }

//     // if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != '') {
//     //     // foreach($_FILES as $k => $v) { $$k = $v; echo "\n$$k:\n"; print_r($v); }
//     //     $fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
//     //     move_uploaded_file($_FILES['img']['tmp_name'], PROFILE_PIX_PATH.$fname);
//     //     $data .= ", avatar = '$fname' ";
//     // }
    
//     // if(empty($id)){
//     //     $save = $this->opr->sqlInsert("INSERT INTO users set $data");
//     // } else {
//     //     //echo $data;
//     //     $save = $this->opr->sqlUpdate("UPDATE users SET $data WHERE id = ?", 'i', $id);
//     // }

//     // if($save){
//     //     return 1;       // saved user successfully
//     // }

//     // return 3;           // unable to insert user in db
// }

// function deleteUser() {
//     // extract($_POST);

//     // // TODO: validate the POST data

//     // // TODO: check for dbconnect success

//     // $delete = $this->opr->sqlDelete("DELETE FROM users where id = ?", "i", $id);
//     // if($delete)
//     //     return 1;
//     // else 
//     //     return -1;
// }


?>