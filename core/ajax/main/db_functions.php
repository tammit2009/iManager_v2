<?php 

/*
 * Manage Roles
 *
 */

function getRoleById($roleId) {
    $role = array();

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        $res = $opr->sqlSelect('SELECT * FROM roles WHERE id=?', 'i', $roleId);
        if ($res && $res->num_rows === 1) {
            $role = $res->fetch_assoc();
            return $role;
            $res->free_result();
        }
        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }
}

function createNewRole($role_name, $description, $page_access_level) {

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        $id = $opr->sqlInsert(  'INSERT INTO roles VALUES (NULL, ?, ?, ?)', 
                                'ssi', $role_name, $description, $page_access_level);
        return $id;
        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }     
}

function updateRole($role_id, $role_name, $role_description, $page_access_level) {
    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        if ($opr->sqlUpdate('UPDATE roles SET name=?,description=?,page_access_level=? 
                            WHERE id=?', 'ssii', $role_name, $role_description, $page_access_level, $role_id)) {
            return 0;
        }
        else {
            return -2;      // unable to update role
        }
        $opr->close();
    }
    else {
        return -1;          // Failed to connect to database
    }       
}

function deleteRole($role_id) {
    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        if ($opr->sqlDelete('DELETE FROM roles WHERE id=?', 'i', $role_id)) {
            return 0;
        }
        else {
            return -2;      // unable to update role
        }
        $opr->close();
    }
    else {
        return -1;          // Failed to connect to database
    }  
}


/*
 * Manage Groups
 *
 */

function getGroupById($groupId) {
    $group = array();

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        $res = $opr->sqlSelect('SELECT * FROM groups WHERE id=?', 'i', $groupId);
        if ($res && $res->num_rows === 1) {
            $group = $res->fetch_assoc();
            return $group;
            $res->free_result();
        }
        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }
}

function createNewGroup($group_name, $description) {

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        $id = $opr->sqlInsert(  'INSERT INTO groups VALUES (NULL, ?, ?)', 
                                'ss', $group_name, $description);
        return $id;
        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }     
}

function updateGroup($group_id, $group_name, $group_description) {
    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        if ($opr->sqlUpdate('UPDATE groups SET name=?,description=? 
                            WHERE id=?', 'ssi', $group_name, $group_description, $group_id)) {
            return 0;
        }
        else {
            return -2;      // unable to update group
        }
        $opr->close();
    }
    else {
        return -1;          // Failed to connect to database
    }       
}

function deleteGroup($group_id) {
    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        if ($opr->sqlDelete('DELETE FROM groups WHERE id=?', 'i', $group_id)) {
            return 0;
        }
        else {
            return -2;      // unable to delete group
        }
        $opr->close();
    }
    else {
        return -1;          // Failed to connect to database
    }  
}


/*
 * Manage Group / Role
 *
 */

function getGroupRoleById($groupId, $roleId) {
    $groupRole = array();

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        $res = $opr->sqlSelect('SELECT * FROM groups_roles WHERE group_id=? AND role_id=?', 'ii', $groupId, $roleId);
        if ($res && $res->num_rows === 1) {
            $groupRole = $res->fetch_assoc();
            return $groupRole;
            $res->free_result();
        }
        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }
}

function addRoleToGroup($groupId, $roleId, $groupRoleLabel, $groupRoleDescr) {

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        $id = $opr->sqlInsert(  'INSERT INTO groups_roles VALUES (?, ?, ?, ?)', 
                                'iiss', $groupId, $roleId, $groupRoleLabel, $groupRoleDescr);
        return $id;
        $opr->close();
    }
    else {
        return -2;      // Failed to connect to database
    }     
}

function updateGroupRole($group_id, $role_id, $group_role_label, $group_role_descr) {

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        if ($opr->sqlUpdate('UPDATE groups_roles SET label=?,description=? 
                            WHERE group_id=? AND role_id=?', 'ssii', 
                            $group_role_label, $group_role_descr, $group_id, $role_id)) {
            return 0;
        }
        else {
            return -2;      // unable to update group role
        }
        $opr->close();
    }
    else {
        return -1;          // Failed to connect to database
    }     
}

function deleteGroupRole($group_id, $role_id) {
    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        if ($opr->sqlDelete('DELETE FROM groups_roles WHERE group_id=? AND role_id=?', 'ii', $group_id, $role_id)) {
            return 0;
        }
        else {
            return -2;      // unable to delete group role
        }
        $opr->close();
    }
    else {
        return -1;          // Failed to connect to database
    }  
}


/*
 * Manage Page Access Groups
 *
 */

function getPagrById($pagrId) {
    $pagr = array();

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        $res = $opr->sqlSelect('SELECT * FROM page_access_groups WHERE id=?', 'i', $pagrId);
        if ($res && $res->num_rows === 1) {
            $pagr = $res->fetch_assoc();
            return $pagr;
            $res->free_result();
        }
        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }
}

function createNewPagr($pagr_label, $description) {

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        $id = $opr->sqlInsert(  'INSERT INTO page_access_groups VALUES (NULL, ?, ?)', 
                                'ss', $pagr_label, $description);
        return $id;
        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }     
}

function updatePagr($pagr_id, $pagr_label, $pagr_description) {
    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        if ($opr->sqlUpdate('UPDATE page_access_groups SET label=?,description=? 
                            WHERE id=?', 'ssi', $pagr_label, $pagr_description, $pagr_id)) {
            return 0;
        }
        else {
            return -2;      // unable to update pagr
        }
        $opr->close();
    }
    else {
        return -1;          // Failed to connect to database
    }       
}

function deletePagr($pagr_id) {
    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        if ($opr->sqlDelete('DELETE FROM page_access_groups WHERE id=?', 'i', $pagr_id)) {
            return 0;
        }
        else {
            return -2;      // unable to delete pagr
        }
        $opr->close();
    }
    else {
        return -1;          // Failed to connect to database
    }  
}


/*
 * Manage Pagr / Role
 *
 */

function getPagrRoleById($pagrId, $roleId) {
    $pagrRole = array();

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        $res = $opr->sqlSelect('SELECT * FROM page_access_groups_roles WHERE pag_id=? AND role_id=?', 'ii', $pagrId, $roleId);
        if ($res && $res->num_rows === 1) {
            $pagrRole = $res->fetch_assoc();
            return $pagrRole;
            $res->free_result();
        }
        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }
}

function addRoleToPagr($pagrId, $roleId, $pagrRoleLabel, $pagrRoleDescr) {

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        $id = $opr->sqlInsert(  'INSERT INTO page_access_groups_roles VALUES (?, ?, ?, ?)', 
                                'iiss', $pagrId, $roleId, $pagrRoleLabel, $pagrRoleDescr);
        return $id;
        $opr->close();
    }
    else {
        return -2;      // Failed to connect to database
    }     
}

function updatePagrRole($pagr_id, $role_id, $pagr_role_label, $pagr_role_descr) {
    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        if ($opr->sqlUpdate('UPDATE page_access_groups_roles SET label=?,description=? 
                            WHERE pag_id=? AND role_id=?', 'ssii', 
                            $pagr_role_label, $pagr_role_descr, $pagr_id, $role_id)) {
            return 0;
        }
        else {
            return -2;      // unable to update group role
        }
        $opr->close();
    }
    else {
        return -1;          // Failed to connect to database
    }         
}

function deletePagrRole($pagr_id, $role_id) {
    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        if ($opr->sqlDelete('DELETE FROM page_access_groups_roles WHERE pag_id=? AND role_id=?', 'ii', $pagr_id, $role_id)) {
            return 0;
        }
        else {
            return -2;      // unable to delete pagr role
        }
        $opr->close();
    }
    else {
        return -1;          // Failed to connect to database
    }  
}


/*
 * Manage Users
 *
 */

function getAllUsers() {
    $users = array();

    $userId = $_SESSION['userid'];

    $userDomainName = isset($_SESSION['domain']) ? $_SESSION['domain'] : 'default';
    $userGroupId = isset($_SESSION['groupid']) ? $_SESSION['groupid'] : 1;

    $userDomain = getDomainByName($userDomainName);
    $userSubDoms = getSubDomsByUserId($userId);

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        $sql = "SELECT id, name, email, password, domain, groupid, verified FROM users";
        
        // Restrict view of all users only to admins
        if (!isRoleInGroup('admin', $userGroupId)) {
            // Restrict view only to user's provisioned subdomains
            $sql .= " WHERE domain='" . $userDomain['id'] ."'";
            // $sql .= " AND sub_dom_id IN ('". implode(',', $userSubDoms) ."')";
        }

        $res = $opr->sqlSelect($sql);

        if ($res && $res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $users[] = $row;
            }
            $res->free_result();
        }
        $opr->close();

        return $users;
    }
    else {
        return -1;      // Failed to connect to database
    }
}

function getUserDomain($userId) {
    $domain = array();

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        $res = $opr->sqlSelect('SELECT name, domain FROM `users` 
                                WHERE id=?', 'i', $userId);

        if ($res && $res->num_rows === 1) {
            while ($row = $res->fetch_assoc()) {
                $domain[] = $row;
            }
            return $domain;
            $res->free_result();
        }
        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }
}

function saveUser($post, $files) {

    // Enable trapping exception in try...catch..
    // mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    extract($post);

    // TODO: further validate the POST data

    $data = "";
    
    foreach($post as $k => $v) {
        // $$k = $v;  echo "\n$$k : $v";
        if(!in_array($k, array('id','cpass','password', 'manageUser', 'verified')) && !is_numeric($k)){
            if(empty($data)){
                $data .= " $k='$v' ";
            }else{
                $data .= ", $k='$v' ";
            }
        }
    }

    // If password field is not empty, hash it
    if(!empty($password)){
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $data .= ", password='" . $hash ."'";
    }

    // If verified field is not empty, format it for db
    if(!empty($verified) && $verified == 'on'){
        $data .= ", verified=1";
    }
    else {
        $data .= ", verified=0";
    }

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        
        $sql = "SELECT * FROM users WHERE email =?";
        if (empty($id)) {
            $check = $opr->sqlSelect($sql, 's', $email)->num_rows;
        }
        else {
            $sql .= " AND id != ?";
            $check = $opr->sqlSelect($sql, 'si', $email, $id)->num_rows;
        }
    
        if($check > 0){
            return -2;   // email already exists
            exit;
        }

        // Handle the uploaded image file
        if(isset($files['imgFile']) && $files['imgFile']['tmp_name'] != '') {
            // foreach($files as $k => $v) { $$k = $v; echo "\n$$k:\n"; print_r($v); }
            $fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['imgFile']['name'];
            move_uploaded_file($_FILES['imgFile']['tmp_name'], PROFILE_PIX_PATH.$fname);
            $data .= ", avatar = '$fname' ";
        } // else { echo "No files found"; }

        // echo "INSERT INTO users SET ".$data;
        // echo "UPDATE users SET ".$data . " WHERE id = " . $id;

        try {
            // Prepare event
            $timestamp = date('Y-m-d H:i:s', time());
            $category = "user_access";
            $table_str = "user";
            $xinfo = "";
            $route = "";
            $status = "complete";

            // Get the selected domain's default subdomain
            $default_subdom = getDefaultSubDomById($domain);
            $subdom_id = $default_subdom['id'];

            if(empty($id)){
                $id = $opr->sqlInsert("INSERT INTO users SET $data");

                // TODO: handle cases of success and failure

                // insert user into selected domain's default subdomain
                $opr->sqlInsert('INSERT INTO subdomains_users VALUES (NULL, ?, ?, "")', 'ii', $id, $subdom_id);

                // Event
                $creator = $id;
                $type = "account_create";                    // request type 3
                $action = "account_created";

            } else {
                $opr->sqlUpdate("UPDATE users SET $data WHERE id = ?", 'i', $id);

                // TODO: handle cases of success and failure

                // delete the user from any old subdomain
                $opr->sqlDelete("DELETE FROM subdomains_users WHERE user_id = ?", 'i', $id);
                // insert user into selected domain's default subdomain
                $opr->sqlInsert('INSERT INTO subdomains_users VALUES (NULL, ?, ?, "")', 'ii', $id, $subdom_id);

                // Event
                $creator = $id;
                $type = "account_update";                    // request type ?
                $action = "account_updated";
            }

            if($id) {

                // Emit an account created or update event using the controller
                addEvent($creator, $timestamp, $type, $category, $table_str, $id, $action, $status, $route, $xinfo); // true on success  

                return $id;       // saved user successfully
            }    
        }
        catch (Exception $e) {
            return -4;
        }

        return -3;           // unable to insert user in db

        $opr->close();
    }
    else {
        return -1;          // Failed to connect to database
    } 
}

function deleteUser($id) {
    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        // TODO: delete any ties to page_access_level
        
        if ($opr->sqlDelete('DELETE FROM users WHERE id=?', 'i', $id)) {

            // TODO: delete any associated files

            return 0;
        }
        else {
            return -2;      // unable to delete user
        }
        $opr->close();
    }
    else {
        return -1;          // Failed to connect to database
    }  
}


/*
 * Manage Domains
 *
 */

function getAllDomains() {
    $domains = array();

    $userId = $_SESSION['userid'];
    $userDomainName = isset($_SESSION['domain']) ? $_SESSION['domain'] : 'default';
    $userGroupId = isset($_SESSION['groupid']) ? $_SESSION['groupid'] : 1;
    $userDomain = getDomainByName($userDomainName);
    $userSubDoms = getSubDomsByUserId($userId);

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        $sql = "SELECT id, name, description FROM domains";
        
        // Restrict view of all users only to admins
        if (!isRoleInGroup('admin', $userGroupId)) {
            // Restrict view only to user's provisioned subdomains
            $sql .= " WHERE id='" . $userDomain['id'] ."'";
            // $sql .= " AND sub_dom_id IN ('". implode(',', $userSubDoms) ."')";
        }

        $res = $opr->sqlSelect($sql);

        if ($res && $res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $domains[] = $row;
            }
            $res->free_result();
        }
        $opr->close();

        return $domains;
    }
    else {
        return -1;      // Failed to connect to database
    }
}

function getDomainById($domainId) {
    $domain = array();

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        $res = $opr->sqlSelect('SELECT * FROM domains WHERE id=?', 'i', $domainId);
        if ($res && $res->num_rows === 1) {
            $domain = $res->fetch_assoc();
            return $domain;
            $res->free_result();
        }
        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }
}

function createNewDomain($domain_name, $description) {

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        // Ensure the domain name has not been used elsewhere
        $sql = "SELECT * FROM domains WHERE name=?";
        $check = $opr->sqlSelect($sql, 's', $domain_name)->num_rows;
        if($check > 0){
            // echo "Domain name already used";
            return -3;   //  Domain name already used.
        }

        // Create the domain
        $id = $opr->sqlInsert(  'INSERT INTO domains VALUES (NULL, ?, ?)', 'ss', $domain_name, $description);

        // If successful, create the default 'main' subdomain
        if ($id > 0) {
            $opr->sqlInsert( "INSERT INTO `subdomains` VALUES (NULL, 'main', '', ?, 'default', 'Default sub-domain')", 'i', $id);
        }
        else {
            return -2;  // Unable to create default subdomain
        }

        return $id;
        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }     
}

function updateDomain($domain_id, $domain_name, $domain_description) {
    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        if ($opr->sqlUpdate('UPDATE domains SET name=?,description=? 
                            WHERE id=?', 'ssi', $domain_name, $domain_description, $domain_id)) {
            return 0;
        }
        else {
            return -2;      // unable to update group
        }
        $opr->close();
    }
    else {
        return -1;          // Failed to connect to database
    }       
}

function deleteDomain($domain_id) {
    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        // First, delete all subdomains
        if ($opr->sqlDelete('DELETE FROM subdomains WHERE parent_domain_id=?', 'i', $domain_id)) {
            // Now delete the domain
            if ($opr->sqlDelete('DELETE FROM domains WHERE id=?', 'i', $domain_id)) {
                return 0;
            }
            else {
                return -2;      // unable to delete domain
            }
        }
        else {
            return -3;      // unable to delete subdomain(s)
        }

        $opr->close();
    }
    else {
        return -1;          // Failed to connect to database
    }  
}


/*
 * Manage Subdomains
 *
 */

function getSubDomById($domainId, $subdomid) {
    $subdomain = array();

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        $res = $opr->sqlSelect('SELECT * FROM subdomains WHERE parent_domain_id=? AND id=?', 'ii', $domainId, $subdomid);
        if ($res && $res->num_rows === 1) {
            $subdomain = $res->fetch_assoc();
            return $subdomain;
            $res->free_result();
        }
        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }
}

function getDefaultSubDomById($domainId) {
    $subdomain = array();

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        $res = $opr->sqlSelect('SELECT * FROM subdomains WHERE parent_domain_id=? AND type=?', 'is', $domainId, 'default');
        if ($res && $res->num_rows > 0) {
            $subdomain = $res->fetch_assoc();   // Fetch only the first default (if by mistake there are multiple)
            return $subdomain;
            $res->free_result();
        }
        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }
}

function getSubDomsByDomainId2($domainId) {
    $subdoms = array();

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        $res = $opr->sqlSelect('SELECT id, name, 
                                parent_domain_id, 
                                (SELECT name FROM organizations WHERE parent_domain_id = organizations.domain_id) as org_name,
                                (SELECT id FROM organizations WHERE parent_domain_id = organizations.domain_id) as org_id
                                FROM `subdomains` 
                                WHERE subdomains.parent_domain_id=?', 'i', $domainId);

        if ($res && $res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $subdoms[] = $row;
            }
            return $subdoms;
            $res->free_result();
        }
        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }
}

function addSubDomToDomain($domainId, $subDomName, $subDomDescr) {

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        $id = $opr->sqlInsert(  "INSERT INTO `subdomains` VALUES (NULL, ?, '', ?, ?, ?)", 
                                'siss', $subDomName, $domainId, 'extension', $subDomDescr);
        return $id;
        $opr->close();
    }
    else {
        return -2;      // Failed to connect to database
    }     
}

function createStoreUnit($storeunit_name, $domainId, $subDomName, $subDomType, $subDomDescr) {
    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        // Ensure the subdomain name has not been used in the same domain
        $sql = "SELECT * FROM subdomains WHERE name=? AND parent_domain_id=?";
        $check = $opr->sqlSelect($sql, 'si', $subDomName, $domainId)->num_rows;
        if($check > 0){
            // echo "Subdomain name already exists.";
            return -3;   //  Subdomain name already exists.
        }    

        // Ensure the store unit name has not been used in the same domain
        $sql = "SELECT * FROM subdomains WHERE storeunit=? AND parent_domain_id=?";
        $check = $opr->sqlSelect($sql, 'si', $storeunit_name, $domainId)->num_rows;
        if($check > 0){
            // echo "StoreUnit already exists.";
            return -4;   //  StoreUnit name already exists.
        }    

        $id = $opr->sqlInsert(  "INSERT INTO `subdomains` VALUES (NULL, ?, ?, ?, ?, ?)", 
                                'ssiss', $subDomName, $storeunit_name, $domainId, $subDomType, $subDomDescr);
        return $id;

        $opr->close();
    }
    else {
        return -2;      // Failed to connect to database
    }     
}

function addDefaultSubDomToDomain($domainId) {

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        $id = $opr->sqlInsert(  "INSERT INTO `subdomains` VALUES (NULL, ?, ?, ?, ?)", 
                                'siss', 'main', $domainId, 'default', 'Default sub-domain');
        return $id;
        $opr->close();
    }
    else {
        return -2;      // Failed to connect to database
    }     
}

function updateSubdomain($domain_id, $subdom_id, $subdom_name, $subdom_descr) {
    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        if ($opr->sqlUpdate('UPDATE subdomains SET name=?,description=? 
                            WHERE parent_domain_id=? AND id=?', 'ssii', 
                            $subdom_name, $subdom_descr, $domain_id, $subdom_id)) {
            return 0;
        }
        else {
            return -2;      // unable to update subdomain
        }
        $opr->close();
    }
    else {
        return -1;          // Failed to connect to database
    }         
}


function deleteSubdomain($subdom_id) {
    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        $sql = "DELETE FROM subdomains WHERE id=? AND type != 'default'";
        if ($opr->sqlDelete2($sql, 'i', $subdom_id)) {
            return 0;
        }
        else {
            return -2;      // unable to delete subdomain
        }
        $opr->close();
    }
    else {
        return -1;          // Failed to connect to database
    }  
}


/*
 * Manage Products
 *
 */

function getAllSkusMatchingPattern($pattern) {
    $skus = [];

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        $pattern = $pattern.'%';

        $sql = "SELECT provisional_sku FROM vendors_products WHERE provisional_sku LIKE '". $pattern ."'";

        $res = $opr->sqlSelect($sql);

        $sku_rows = array();
        if ($res && $res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $sku_rows[] = $row;
            }
            $res->free_result();
        }

        foreach($sku_rows as $sku_row) {
            $skus[] = $sku_row['provisional_sku'];
        }
        return $skus;

        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }   
}

function getNextFreeSkuMatchingPattern(&$sku_arr, $pattern) { // pass by reference

    // $skus = getAllSkusMatchingPattern($pattern);
    // print_r($skus);

    // Get the max value
    $max_sku = max($sku_arr);

    // Strip the 'UKN' prefix
    $max_sku = substr($max_sku, strlen($pattern));

    // Cast to integer value
    $max_sku = (int)$max_sku;

    // Add 1
    $max_sku += 1;

    // Prepend Prefix
    $max_sku = $pattern . strval($max_sku);

    array_push($sku_arr, $max_sku);

    return $max_sku;
}

function batchAddVProducts($vendor_id, $subdom_id, $domain_id, $brand, $category, $product_name_descr, 
                            $feature, $unit, $lot, $qty_per_offer, $offer_price) {

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        // TODO: some form of validation on the field inputs

        // TODO: break this into batches of a hundred

        // Get all skus matching a pattern
        $skus = getAllSkusMatchingPattern('UKN');

        // Start generate provisional SKU for each item 
        $prov_sku = getNextFreeSkuMatchingPattern($skus, 'UKN');

        $sql = "INSERT INTO vendors_products(domain_id, sub_dom_id, vendor_id, brand, category,
                provisional_sku, product_name_descr, feature, unit, lot, qty_per_offer, offer_price, created_by)";

        $values = "";
        for ($i = 0; $i < count($brand); $i++) {

            if ($values !== "") {
                $values .= ", ";
            }
            $values .= "(". 
                $domain_id.", ".
                $subdom_id.", ".
                $vendor_id.", '".
                $brand[$i]."', '".
                $category[$i]."', '".
                $prov_sku."', '".
                $product_name_descr[$i]."', '".
                $feature[$i]."', '".
                $unit[$i]."', '".
                $lot[$i]."', ".
                $qty_per_offer[$i].", ".
                $offer_price[$i].", ".
                $_SESSION['userid'].
            ")";

            $prov_sku = getNextFreeSkuMatchingPattern($skus, 'UKN');
        }

        $sql .= " VALUES " . $values;

        // echo $sql;

        // Insert the products
        $id = $opr->sqlInsert($sql);    // returns id of the first field entered
        return $id;

        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }       

}


/*
 * Manage Stock
 *
 */

function createSKU($brand, $category, $package, $number) {

    $sku = "";
    $brand_data = array();
    $category_data = array();
    $package_data = array();

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        // Get the catalog symbol for brand
        $res = $opr->sqlSelect('SELECT * FROM brands WHERE name=?', 's', $brand);
        if ($res && $res->num_rows === 1) {
            $brand_data = $res->fetch_assoc();
            $res->free_result();
        }

        // Get the catalog symbol for category
        $res = $opr->sqlSelect('SELECT * FROM categories WHERE name=?', 's', $category);
        if ($res && $res->num_rows === 1) {
            $category_data = $res->fetch_assoc();
            $res->free_result();
        }

        // Get the catalog symbol for packaging
        $res = $opr->sqlSelect('SELECT * FROM static_codes WHERE parent="products" 
                                AND type="packaging_unit" AND label=?', 's', $package);
        if ($res && $res->num_rows === 1) {
            $package_data = $res->fetch_assoc();
            $res->free_result();
        }

        $sku = $brand_data['catalog_symbol'].$category_data['catalog_symbol'].$package_data['catalog_symbol'];
        $sku .= $number;

        return $sku;
        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }       

}

function getNextSKU($productName, $brandName, $categoryName, $pkgunitName, $pkglotName) {

    // echo "$productName: "   . $productName ."\n";
    // echo "$brandName: "     . $brandName ."\n";
    // echo "$categoryName: "  . $categoryName ."\n";
    // echo "$pkgunitName: "   . $pkgunitName ."\n";
    // echo "$pkglotName: "    . $pkglotName ."\n";

    $sku = "";
    $brand_data = array();
    $category_data = array();
    $pkgunit_data = array();
    $pkglot_data = array();

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        // Get the catalog symbol for brand
        $res = $opr->sqlSelect('SELECT * FROM brands WHERE name=?', 's', $brandName);
        if ($res && $res->num_rows === 1) {
            $brand_data = $res->fetch_assoc();
            $res->free_result();
        }

        // Get the catalog symbol for category
        $res = $opr->sqlSelect('SELECT * FROM categories WHERE name=?', 's', $categoryName);
        if ($res && $res->num_rows === 1) {
            $category_data = $res->fetch_assoc();
            $res->free_result();
        }

        // Get the catalog symbol for packaging unit
        $res = $opr->sqlSelect('SELECT * FROM static_codes WHERE parent="products" 
                                AND type="packaging_unit" AND label=?', 's', $pkgunitName);
        if ($res && $res->num_rows === 1) {
            $pkgunit_data = $res->fetch_assoc();
            $res->free_result();
        }

        // Get the catalog symbol for packaging lot
        $res = $opr->sqlSelect('SELECT * FROM static_codes WHERE parent="products" 
                AND type="packaging_lot" AND label=?', 's', $pkglotName);
        if ($res && $res->num_rows === 1) {
            $pkglot_data = $res->fetch_assoc();
            $res->free_result();
        }

        $sku = $brand_data['catalog_symbol'];
        $sku .= $category_data['catalog_symbol'];
        $sku .= $pkgunit_data['catalog_symbol'];
        $sku .= $pkglot_data['catalog_symbol'];

        $pattern = $sku;

        $skus = getAllSkusMatchingPattern($pattern);
        if (!empty($skus)) {
            // print_r($skus);
            // Get the max value
            $max_sku = max($skus);
            // Strip the pattern prefix
            $max_sku = substr($max_sku, strlen($pattern));
            // Cast to integer value
            $max_sku = (int)$max_sku;
            // Add 1
            $max_sku += 1;
            // Prepend Prefix
            $max_sku = $pattern . strval($max_sku);
            $sku .= $max_sku;
        }
        else {
            $sku .= '001';
        }

        return $sku;
        $opr->close();
    }
    else {
        return 'NULL';      // Failed to connect to database
    }       

    // return "KNOWN6789";
}

/*
 * Manage Vendors
 *
 */

function getAllVendors() {
    $vendors = array();

    $userDomainName = isset($_SESSION['domain']) ? $_SESSION['domain'] : 'default';
    $userGroupId = isset($_SESSION['groupid']) ? $_SESSION['groupid'] : 1;

    $userId = $_SESSION['userid'];

    $userDomain = getDomainByName($userDomainName);
    $userSubDoms = getSubDomsByUserId($userId);

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        $sql = "SELECT id, name, domain_id, (SELECT name FROM `domains` WHERE domain_id = `domains`.id) 
                as domain, type, address, contact_person, contact_email, contact_phone, description 
                FROM `organizations` WHERE type='vendor'";
        
        // Restrict view of all users only to admins
        if (!isRoleInGroup('admin', $userGroupId)) {
            // Restrict view only to user's provisioned subdomains
            $sql .= " AND domain_id='" . $userDomain['id'] ."'";
            // $sql .= " AND sub_dom_id IN ('". implode(',', $userSubDoms) ."')";
        }

        $res = $opr->sqlSelect($sql);

        if ($res && $res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $vendors[] = $row;
            }
            $res->free_result();
        }
        $opr->close();

        return $vendors;
    }
    else {
        return -1;      // Failed to connect to database
    }

}

function getVendorById($vendorId) {
    $vendor = array();

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        $res = $opr->sqlSelect('SELECT name, domain_id FROM `organizations` 
                                WHERE id=?', 'i', $vendorId);

        if ($res && $res->num_rows === 1) {
            while ($row = $res->fetch_assoc()) {
                $vendor = $row;
            }
            return $vendor;
            $res->free_result();
        }
        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }
}

function getVendorDomain($vendorId) {
    $domain = array();

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        $res = $opr->sqlSelect('SELECT name, domain_id FROM `organizations` 
                                WHERE id=?', 'i', $vendorId);

        if ($res && $res->num_rows === 1) {
            while ($row = $res->fetch_assoc()) {
                $domain[] = $row;
            }
            return $domain;
            $res->free_result();
        }
        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }
}


/*
 * Manage Subdomain Users
 *
 */

function saveSubDomUser($post) {

    // Enable trapping exception in try...catch..
    // mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    extract($post);

    // TODO: further validate the POST data

    $data = "";
    
    foreach($post as $k => $v) {
        // $$k = $v;  echo "\n$$k : $v";
        if(!in_array($k, array('id', 'domainid', 'manageSubDomUser', 'edit_subdom_userid', 
            'edit_subdomid', 'edit_userid')) && !is_numeric($k)) {

            // Adapt fields to the database
            if ($k === 'subdomid') $k = 'sub_dom_id';
            if ($k === 'userid') $k = 'user_id';

            if(empty($data)){
                $data .= " $k='$v'";
            }else{
                $data .= ", $k='$v'";
            }
        }
    }

    // Handle disabled select functionality which does not send userid
    if(!empty($edit_userid) && !isset($userid)){
        $user_id = $edit_userid;
    }
    else {
        $user_id = $userid;
    }

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        // Ensure the subdomain has not already been associated
        $sql = "SELECT * FROM subdomains_users WHERE user_id=? AND sub_dom_id=?";
        if (empty($id)) {
            $check = $opr->sqlSelect($sql, 'ii', $user_id, $subdomid)->num_rows;
        }
        else {
            $sql .= " AND id != ?";
            $check = $opr->sqlSelect($sql, 'iii', $user_id, $subdomid, $id)->num_rows;
        }
    
        if($check > 0){
            // echo "already associated";
            return -2;   //  subdomain has already been associated
        }

        // echo "INSERT INTO subdomains_users SET ".$data;
        // echo "UPDATE users SET ".$data . " WHERE id = " . $id;

        try {
            if(empty($id)){
                $id = $opr->sqlInsert("INSERT INTO subdomains_users SET $data");
            } else {
                //echo $data;
                $id = $opr->sqlUpdate("UPDATE subdomains_users SET $data WHERE id = ?", 'i', $id);
            }
            if($id){
                return $id;       // saved user successfully
            } 
            else {
                return -3;        // unable to insert user in db
            }   
        }
        catch (Exception $e) {
            return -4;              // exception
        }

        $opr->close();
    }
    else {
        return -1;          // Failed to connect to database
    } 
}

function deleteSubDomUser($id) {
    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        // TODO: delete any ties to page_access_level
        
        if ($opr->sqlDelete('DELETE FROM subdomains_users WHERE id=?', 'i', $id)) {
            return 0;
        }
        else {
            return -2;      // unable to delete subdomain user
        }
        $opr->close();
    }
    else {
        return -1;          // Failed to connect to database
    }  
}



/*
 * Manage Vendor Products
 *
 */

function getVendorProductById($vprodId) {
    $vproduct = array();

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        $res = $opr->sqlSelect('SELECT * FROM vendors_products WHERE id=?', 'i', $vprodId);
        if ($res && $res->num_rows === 1) {
            $vproduct = $res->fetch_assoc();
            return $vproduct;
            $res->free_result();
        }
        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }
}

function isProductNameValid($productName) {
    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        $res = $opr->sqlSelect('SELECT * FROM products WHERE product_name=?', 's', $productName);
        if ($res && $res->num_rows > 0) {
            //$vproduct = $res->fetch_assoc();
            return 1;
            $res->free_result();
        }
        $opr->close();
    }
    return 0;
}

// function isProductShortDescrValid($descr) {
//     //Connect to database
//     $opr = new DBOperation();
//     if ($opr->dbConnected()) {
//         $res = $opr->sqlSelect('SELECT * FROM products WHERE short_descr=?', 's', $descr);
//         if ($res && $res->num_rows > 0) {
//             //$vproduct = $res->fetch_assoc();
//             return 1;
//             $res->free_result();
//         }
//         $opr->close();
//     }
//     return 0;
// }

function isBrandNameValid($brandName) {
    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        $res = $opr->sqlSelect('SELECT * FROM brands WHERE name=?', 's', $brandName);
        if ($res && $res->num_rows > 0) {
            //$vproduct = $res->fetch_assoc();
            return 1;
            $res->free_result();
        }
        $opr->close();
    }
    return 0;
}

function isCategoryNameValid($categoryName) {
    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        $res = $opr->sqlSelect('SELECT * FROM categories WHERE name=?', 's', $categoryName);
        if ($res && $res->num_rows > 0) {
            //$vproduct = $res->fetch_assoc();
            return 1;
            $res->free_result();
        }
        $opr->close();
    }
    return 0;
}

function isPackageUnitValid($pkgunit) {
    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        $res = $opr->sqlSelect('SELECT * FROM static_codes WHERE parent="products" AND type="packaging_unit"
                                AND label=?', 's', $pkgunit);
        if ($res && $res->num_rows > 0) {
            //$vproduct = $res->fetch_assoc();
            return 1;
            $res->free_result();
        }
        $opr->close();
    }
    return 0;
}

function isPackageLotValid($pkglot) {
    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        $res = $opr->sqlSelect('SELECT * FROM static_codes WHERE parent="products" AND type="packaging_lot"
                                AND label=?', 's', $pkglot);
        if ($res && $res->num_rows > 0) {
            //$vproduct = $res->fetch_assoc();
            return 1;
            $res->free_result();
        }
        $opr->close();
    }
    return 0;
}

function isSkuFormatValid($sku) {

    $valid = true;

    // Split the SKU into its parts
    $brand_symbol = substr($sku, 0, 3);         // echo "brand_symbol: ". $brand_symbol;
    $category_symbol = substr($sku, 3, 2);      // echo "category_symbol: ". $category_symbol;
    $pkgunit_symbol = substr($sku, 5, 1);       // echo "pkgunit_symbol: ". $pkgunit_symbol;
    $pkglot_symbol = substr($sku, 6, 1);        // echo "pkglot_symbol: ". $pkglot_symbol;

    // Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        // Get the catalog symbol for brand
        $res = $opr->sqlSelect('SELECT catalog_symbol FROM brands WHERE catalog_symbol=?', 's', $brand_symbol);
        if ($res && $res->num_rows !== 1) {
            $valid = $valid & false;
            $res->free_result();
        }

        // Get the catalog symbol for category
        $res = $opr->sqlSelect('SELECT catalog_symbol FROM categories WHERE catalog_symbol=?', 's', $category_symbol);
        if ($res && $res->num_rows !== 1) {
            $valid = $valid & false;
            $res->free_result();
        }

        // Get the catalog symbol for packaging unit
        $res = $opr->sqlSelect('SELECT catalog_symbol FROM static_codes WHERE parent="products" 
                                AND type="packaging_unit" AND catalog_symbol=?', 's', $pkgunit_symbol);
        if ($res && $res->num_rows !== 1) {
            $valid = $valid & false;
            $res->free_result();
        }

        // Get the catalog symbol for packaging lot
        $res = $opr->sqlSelect('SELECT catalog_symbol FROM static_codes WHERE parent="products" 
                                AND type="packaging_lot" AND catalog_symbol=?', 's', $pkglot_symbol);
        if ($res && $res->num_rows !== 1) {
            $valid = $valid & false;
            $res->free_result();
        }

        $opr->close();
    }

    return $valid ? 1 : 0;
}

function isSkuValid($sku) {
    // Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        $res = $opr->sqlSelect('SELECT sku FROM products WHERE sku=?', 's', $sku);
        if ($res && $res->num_rows > 0) {
            //$vproduct = $res->fetch_assoc();
            return 1;
            $res->free_result();
        }
        $opr->close();
    }
    return 0;
}

function isVendorProductValid($productName, $brandName, $categoryName, $pkgunitName, $pkglotName) {

    $valid = true;

    $valid = $valid & isProductNameValid($productName);
    $valid = $valid & isBrandNameValid($brandName);
    $valid = $valid & isCategoryNameValid($categoryName);
    $valid = $valid & isPackageUnitValid($pkgunitName);
    $valid = $valid & isPackageLotValid($pkglotName);

    return $valid;
}



/*
 * Manage Customers
 *
 */

function saveCustomer($post) {

    // Enable trapping exception in try...catch..
    // mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    extract($post);

    // TODO: further validate the POST data

    $data = "";
    
    foreach($post as $k => $v) {
        // $$k = $v;  echo "\n$$k : $v";
        if(!in_array($k, array('id', 'manageCustomer')) && !is_numeric($k)) {

            // Adapt fields to the database
            if ($k === 'customer_name') $k = 'name';
            if ($k === 'customer_address') $k = 'address';
            if ($k === 'customer_contact_person') $k = 'contact_person';
            if ($k === 'customer_contact_email') $k = 'contact_email';
            if ($k === 'customer_contact_phone') $k = 'contact_phone';
            if ($k === 'domain') $k = 'domain_id';
            if ($k === 'customer_description') $k = 'description';

            if(empty($data)){
                $data .= " $k='$v'";
            }else{
                $data .= ", $k='$v'";
            }
        }
    }

    // Set the type
    if(empty($data)) {
        $data .= " type='customer'";
    }
    else {
        $data .= ", type='customer'";
    }

    // echo $data;

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        // Ensure the customer name has not already been used
        $sql = "SELECT * FROM organizations WHERE name=?";
        if (empty($id)) {
            $check = $opr->sqlSelect($sql, 's', $customer_name)->num_rows;
        }
        else {
            $sql .= " AND id != ?";
            $check = $opr->sqlSelect($sql, 'si', $customer_name, $id)->num_rows;
        }
    
        if($check > 0){
            echo "Customer name already used.";
            return -2;   //  customer name has already been used
        }

        // echo "INSERT INTO organizations SET ".$data;
        // echo "UPDATE organizations SET ".$data . " WHERE id = " . $id;

        try {
            if(empty($id)){
                $id = $opr->sqlInsert("INSERT INTO organizations SET $data");
            } else {
                $id = $opr->sqlUpdate("UPDATE organizations SET $data WHERE id = ?", 'i', $id);
            }
            if($id){
                return $id;         // saved customer successfully
            } 
            else {
                return -3;          // unable to insert customer in db
            }   
        }
        catch (Exception $e) {
            return -4;              // exception
        }

        $opr->close();
    }
    else {
        return -1;                  // Failed to connect to database
    } 
}

function deleteCustomer($id) {
    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        // TODO: delete any ties to customer
        
        if ($opr->sqlDelete('DELETE FROM organizations WHERE id=?', 'i', $id)) {
            return 0;
        }
        else {
            return -2;      // unable to delete user
        }
        $opr->close();
    }
    else {
        return -1;          // Failed to connect to database
    }  
}


/*
 * Manage Organizations
 *
 */

function getAllOrganizations() {
    $organizations = array();

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        $sql = "SELECT id, name, domain_id, (SELECT name FROM `domains` WHERE domain_id = `domains`.id) 
                as domain, type, address, contact_person, contact_email, contact_phone, description 
                FROM `organizations`";

        $res = $opr->sqlSelect($sql);

        if ($res && $res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $organizations[] = $row;
            }
            $res->free_result();
        }
        $opr->close();

        return $organizations;
    }
    else {
        return -1;      // Failed to connect to database
    }
}

function getOrganizationByIdV2($organizationId) {
    $organization = array();

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        $res = $opr->sqlSelect('SELECT * FROM organizations WHERE id=?', 'i', $organizationId);
        if ($res && $res->num_rows === 1) {
            $organization = $res->fetch_assoc();
            return $organization;
            $res->free_result();
        }
        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }
}

function getDomainByOrganizationId($organizationId) {
    $domains = array();

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        $sql = "SELECT `domains`.id, `domains`.name, `organizations`.domain_id, `domains`.description 
                FROM `organizations` INNER JOIN `domains` 
                ON `organizations`.domain_id = `domains`.id
                WHERE `organizations`.id=?";

        $res = $opr->sqlSelect($sql, 'i', $organizationId);

        if ($res && $res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $domains[] = $row;
            }
            $res->free_result();
        }
        $opr->close();

        return $domains;
    }
    else {
        return -1;      // Failed to connect to database
    }
}

function saveOrganization($post) {

    // Enable trapping exception in try...catch..
    // mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    extract($post);

    // TODO: further validate the POST data

    $data = "";
    
    foreach($post as $k => $v) {
        // $$k = $v;  echo "\n$$k : $v";
        if(!in_array($k, array('id', 'manageOrganization')) && !is_numeric($k)) {

            // Adapt fields to the database
            if ($k === 'organization_name') $k = 'name';
            if ($k === 'organization_address') $k = 'address';
            if ($k === 'organization_type') $k = 'type';
            if ($k === 'organization_contact_person') $k = 'contact_person';
            if ($k === 'organization_contact_email') $k = 'contact_email';
            if ($k === 'organization_contact_phone') $k = 'contact_phone';
            if ($k === 'domain') $k = 'domain_id';
            if ($k === 'organization_description') $k = 'description';

            if(empty($data)){
                $data .= " $k='$v'";
            }else{
                $data .= ", $k='$v'";
            }
        }
    }

    // echo $data;

    // Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        // Ensure the entity name has not already been used
        $sql = "SELECT * FROM organizations WHERE name=?";
        if (empty($id)) {
            $check = $opr->sqlSelect($sql, 's', $organization_name)->num_rows;
        }
        else {
            $sql .= " AND id != ?";
            $check = $opr->sqlSelect($sql, 'si', $organization_name, $id)->num_rows;
        }
    
        if($check > 0){
            // echo "Organization name already used.";
            return -2;   //  organization name has already been used
        }

        // echo "INSERT INTO organizations SET ".$data;
        // echo "UPDATE organizations SET ".$data . " WHERE id = " . $id;

        try {
            if(empty($id)){
                $id = $opr->sqlInsert("INSERT INTO organizations SET $data");
            } else {
                $id = $opr->sqlUpdate("UPDATE organizations SET $data WHERE id = ?", 'i', $id);
            }
            if($id){
                return $id;         // saved organization successfully
            } 
            else {
                return -3;          // unable to insert organization in db
            }   
        }
        catch (Exception $e) {
            return -4;              // exception
        }

        $opr->close();
    }
    else {
        return -1;                  // Failed to connect to database
    } 
}

function deleteOrganization($id) {
    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        // TODO: delete any ties to customer
        
        if ($opr->sqlDelete('DELETE FROM organizations WHERE id=?', 'i', $id)) {
            return 0;
        }
        else {
            return -2;      // unable to delete user
        }
        $opr->close();
    }
    else {
        return -1;          // Failed to connect to database
    }  
}


/*
 * Manage Members
 *
 */

function saveMember($post) {

    // Enable trapping exception in try...catch..
    // mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    extract($post);

    // TODO: further validate the POST data

    $data = "";
    
    foreach($post as $k => $v) {
        // $$k = $v;  echo "\n$$k : $v";
        if(!in_array($k, array('id', 'manageMember', 'member_user')) && !is_numeric($k)) {

            // Adapt fields to the database
            if ($k === 'member_user_id') $k = 'user_id';
            if ($k === 'member_org_id') $k = 'org_id';
            if ($k === 'member_department') $k = 'department';
            if ($k === 'member_role') $k = 'functional_role';

            if(empty($data)){
                $data .= " $k='$v'";
            }else{
                $data .= ", $k='$v'";
            }
        }
    }

    // echo $data;

    // Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        // Ensure the same user not created multiple times
        $sql = "SELECT * FROM members WHERE user_id=?";
        if (empty($id)) {
            $check = $opr->sqlSelect($sql, 's', $member_user_id)->num_rows;
        }
        else {
            $sql .= " AND id != ?";
            $check = $opr->sqlSelect($sql, 'si', $member_user_id, $id)->num_rows;
        }

        if($check > 0){
            echo "Organization name already used.";
            return -2;   //  organization name has already been used
        }

        // Get the target oOrganization's domain
        $domain_id = 0;
        $domain_query = "SELECT domain_id FROM organizations WHERE id=?";
        $res = $opr->sqlSelect($domain_query, 'i', $member_org_id);
        if ($res && $res->num_rows === 1) {
            $domain_id = $res->fetch_assoc()['domain_id'];
            $res->free_result();
        }
        else {
            return -4;      // Organization has no associated domain
        }    

        // Add the organization domain to the fields
        if(empty($data)){
            $data .= " domain_id='$domain_id'";
        }else{
            $data .= ", domain_id='$domain_id'";
        }

        // echo "INSERT INTO members SET ".$data;
        // echo "UPDATE members SET ".$data . " WHERE id = " . $id;

        try {
            if(empty($id)){
                $id = $opr->sqlInsert("INSERT INTO members SET $data");
            } else {
                $id = $opr->sqlUpdate("UPDATE members SET $data WHERE id = ?", 'i', $id);
            }
            if($id){
                // Migrate the user into the organization's domain.
                $opr->sqlUpdate("UPDATE users SET domain=? WHERE id=?", 'ii', $domain_id, $member_user_id);

                // Get the default subdomain
                $def_subdom_id = 0;
                $subdom_query = "SELECT * FROM subdomains WHERE parent_domain_id=? AND type='default'";
                $res = $opr->sqlSelect($subdom_query, 'i', $domain_id);
                if ($res && $res->num_rows > 0) {
                    $def_subdom_id = $res->fetch_assoc()['id'];  // just get the first one
                    $res->free_result();
                }
                else {
                    return -5;      // Domain has no default subdomain
                }  

                // echo "def_subdom_id: ". $def_subdom_id;

                // Delete all previous subdomains associated with the user
                $opr->sqlDelete('DELETE FROM subdomains_users WHERE user_id=?', 'i', $member_user_id);

                // Ensure to associate the new member with the default subdomain of the organization 
                $opr->sqlInsert("INSERT INTO subdomains_users VALUES (NULL, ?, ?, '')", "ii", 
                                                            $member_user_id, $def_subdom_id);
                        
                return $id;         // saved organization successfully
            } 
            else {
                return -3;          // unable to insert organization in db
            }   
        }
        catch (Exception $e) {
            return -6;              // exception
        }

        $opr->close();
    }
    else {
        return -1;                  // Failed to connect to database
    } 
}

function deleteMember($id) {
    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        // TODO: delete any ties to customer
        
        if ($opr->sqlDelete('DELETE FROM members WHERE id=?', 'i', $id)) {
            return 0;
        }
        else {
            return -2;      // unable to delete user
        }
        $opr->close();
    }
    else {
        return -1;          // Failed to connect to database
    }  
}


/*
 * Manage Vendors
 *
 */

function saveVendor($post) {

    // Enable trapping exception in try...catch..
    // mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    extract($post);

    // TODO: further validate the POST data

    $data = "";
    
    foreach($post as $k => $v) {
        // $$k = $v;  echo "\n$$k : $v";
        if(!in_array($k, array('id', 'manageVendor')) && !is_numeric($k)) {

            // Adapt fields to the database
            if ($k === 'vendor_name') $k = 'name';
            if ($k === 'vendor_address') $k = 'address';
            if ($k === 'vendor_contact_person') $k = 'contact_person';
            if ($k === 'vendor_contact_email') $k = 'contact_email';
            if ($k === 'vendor_contact_phone') $k = 'contact_phone';
            if ($k === 'domain') $k = 'domain_id';
            if ($k === 'vendor_description') $k = 'description';

            if(empty($data)){
                $data .= " $k='$v'";
            }else{
                $data .= ", $k='$v'";
            }
        }
    }

    // Set the type
    if(empty($data)) {
        $data .= " type='vendor'";
    }
    else {
        $data .= ", type='vendor'";
    }

    // echo $data;

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        // Ensure the vendor name has not already been used
        $sql = "SELECT * FROM organizations WHERE name=?";
        if (empty($id)) {
            $check = $opr->sqlSelect($sql, 's', $vendor_name)->num_rows;
        }
        else {
            $sql .= " AND id != ?";
            $check = $opr->sqlSelect($sql, 'si', $vendor_name, $id)->num_rows;
        }
    
        if($check > 0){
            // echo "Vendor name already used.";
            return -2;   //  customer name has already been used
        }

        // echo "INSERT INTO organizations SET ".$data;
        // echo "UPDATE organizations SET ".$data . " WHERE id = " . $id;

        try {
            if(empty($id)){
                $id = $opr->sqlInsert("INSERT INTO organizations SET $data");
            } else {
                $id = $opr->sqlUpdate("UPDATE organizations SET $data WHERE id = ?", 'i', $id);
            }
            if($id){
                return $id;         // saved vendor successfully
            } 
            else {
                return -3;          // unable to insert vendor in db
            }   
        }
        catch (Exception $e) {
            return -4;              // exception
        }

        $opr->close();
    }
    else {
        return -1;                  // Failed to connect to database
    } 
}

function deleteVendor($id) {
    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        // TODO: delete any ties to customer
        
        if ($opr->sqlDelete('DELETE FROM organizations WHERE id=?', 'i', $id)) {
            return 0;
        }
        else {
            return -2;      // unable to delete user
        }
        $opr->close();
    }
    else {
        return -1;          // Failed to connect to database
    }  
}


/*
 * Manage Domain Operators
 *
 */

function saveDoperator($post) {

    // Enable trapping exception in try...catch..
    // mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    extract($post);

    // TODO: further validate the POST data

    $data = "";
    
    foreach($post as $k => $v) {
        // $$k = $v;  echo "\n$$k : $v";
        if(!in_array($k, array('id', 'manageDoperator', 'edit_userid', 'edit_subdomid', 'type')) && !is_numeric($k)) {

            // Adapt fields to the database
            if ($k === 'domainid') $k = 'domain_id';
            if ($k === 'subdomid') $k = 'sub_dom_id';
            if ($k === 'doperator_function') $k = 'dom_function_key';
            if ($k === 'doperator_description') $k = 'description';
            if ($k === 'doperator_role') $k = 'assoc_role';
            if ($k === 'userid') $k = 'user_id';

            if(empty($data)){
                $data .= " $k='$v'";
            }else{
                $data .= ", $k='$v'";
            }
        }
    }

    // echo $data;

    // Handle disabled select functionality which does not send userid
    if(!empty($edit_userid) && !isset($userid)){
        $user_id = $edit_userid;
    }
    else {
        $user_id = $userid;
    }

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        // Ensure the parameter combination has not already been used
        $sql = "SELECT * FROM domain_operators 
                WHERE domain_id=? AND sub_dom_id=? AND dom_function_key=? AND assoc_role=? AND user_id=?";
        if (empty($id)) {
            $check = $opr->sqlSelect($sql, 'iisii', 
                $domainid,
                $subdomid,
                $doperator_function,
                $doperator_role,
                $user_id
            )->num_rows;
        }
        else {
            $sql .= " AND id != ?";
            $check = $opr->sqlSelect($sql, 'iisiii', 
                $domainid,
                $subdomid,
                $doperator_function,
                $doperator_role,
                $user_id,
                $id
            )->num_rows;
        }
    
        if($check > 0){
            // echo "Domain Operator paramaters already exist.";
            return -2;   //  Domain Operator paramaters already exist.
        }

        // echo "INSERT INTO domain_operators SET ".$data;
        // echo "UPDATE domain_operators SET ".$data . " WHERE id = " . $id;

        try {
            if(empty($id)){
                $id = $opr->sqlInsert("INSERT INTO domain_operators SET $data");
            } else {
                $id = $opr->sqlUpdate("UPDATE domain_operators SET $data WHERE id = ?", 'i', $id);
            }
            if($id){
                return $id;         // saved domain operator successfully
            } 
            else {
                return -3;          // unable to insert domain operator in db
            }   
        }
        catch (Exception $e) {
            return -4;              // exception
        }

        $opr->close();
    }
    else {
        return -1;                  // Failed to connect to database
    } 
}

function deleteDoperator($id) {
    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        // TODO: delete any ties to customer
        
        if ($opr->sqlDelete('DELETE FROM domain_operators WHERE id=?', 'i', $id)) {
            return 0;
        }
        else {
            return -2;      // unable to delete user
        }
        $opr->close();
    }
    else {
        return -1;          // Failed to connect to database
    }  
}


/*
 * Manage Brands
 *
 */

function getBrandById($brandId) {
    $brand = array();

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        $res = $opr->sqlSelect('SELECT * FROM brands WHERE id=?', 'i', $brandId);
        if ($res && $res->num_rows === 1) {
            $brand = $res->fetch_assoc();
            return $brand;
            $res->free_result();
        }
        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }
}

function createNewBrand($brand_name, $catalog_symbol) {

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        // Ensure the brand has not been used
        $sql = "SELECT * FROM brands WHERE name=?";
        $check = $opr->sqlSelect($sql, 's', $brand_name)->num_rows;
        if($check > 0){
            // echo "Brand name already exists.";
            return -2;   //  Brand name already exists.
        }

        // Ensure the catalog_symbol has not been used
        $sql = "SELECT * FROM brands WHERE catalog_symbol=?";
        $check = $opr->sqlSelect($sql, 's', $catalog_symbol)->num_rows;
        if($check > 0){
            // echo "Catalog symbol already exists.";
            return -3;   //  Catalog symbol already exists.
        }

        $id = $opr->sqlInsert(  'INSERT INTO brands VALUES (NULL, ?, CURRENT_TIMESTAMP, ?, ?)', 
                                'sss', $brand_name, $_SESSION["userid"], $catalog_symbol);
        return $id;
        $opr->close();
    }
    else {
        return -1;          // Failed to connect to database
    }     
}

function updateBrand($brand_id, $brand_name, $catalog_symbol) {
    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        // Ensure the catalog_symbol has not been used
        $sql = "SELECT * FROM brands WHERE catalog_symbol=?";
        $check = $opr->sqlSelect($sql, 's', $catalog_symbol)->num_rows;
        if($check > 0){
            return -3;   //  Catalog symbol already exists.
        }

        if ($opr->sqlUpdate('UPDATE brands SET name=?,catalog_symbol=? 
                            WHERE id=?', 'ssi', $brand_name, $catalog_symbol, $brand_id)) {
            return 0;
        }
        else {
            return -4;      // unable to update brand
        }
        $opr->close();
    }
    else {
        return -1;          // Failed to connect to database
    }       
}

function deleteBrand($brand_id) {
    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        if ($opr->sqlDelete('DELETE FROM brands WHERE id=?', 'i', $brand_id)) {
            return 0;
        }
        else {
            return -2;      // unable to update brand
        }
        $opr->close();
    }
    else {
        return -1;          // Failed to connect to database
    }  
}


/*
 * Manage Categories
 *
 */

function getCategoryById($categoryId) {
    $category = array();

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        $res = $opr->sqlSelect('SELECT * FROM categories WHERE id=?', 'i', $categoryId);
        if ($res && $res->num_rows === 1) {
            $category = $res->fetch_assoc();
            return $category;
            $res->free_result();
        }
        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }
}

function saveCategory($post, $files) {

    // Enable trapping exception in try...catch..
    // mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    extract($post);

    // TODO: further validate the POST data

    $data = "";
    
    foreach($post as $k => $v) {
        // $$k = $v;  echo "\n$$k : $v";
        if(!in_array($k, array('category_id', 'createNewCategory', 'category_parentid')) && !is_numeric($k)) {

            // Adapt fields to the database
            if ($k === 'category_name') $k = 'name';
            if ($k === 'category_abbrv') $k = 'abbrv';
            if ($k === 'category_description') $k = 'description';
            if ($k === 'category_catalog_symbol') $k = 'catalog_symbol';

            if(empty($data)){
                $data .= " $k='$v'";
            }else{
                $data .= ", $k='$v'";
            }
        }
    }

    // Test 'category_parentid' and include if not null
    if(!empty($category_parentid) && $category_parentid !== 'NULL') {
        $data .= ", parent_id='" . $category_parentid .".'";
    }

    // echo $data;

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        
        if(empty($category_id)) {

            // Handle the uploaded image file
            if(isset($files['category_img_file']) && $files['category_img_file']['tmp_name'] != '') {
                // foreach($files as $k => $v) { $$k = $v; echo "\n$$k:\n"; print_r($v); }
                $fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['category_img_file']['name'];
                move_uploaded_file($_FILES['category_img_file']['tmp_name'], CATEGORIES_PIX_PATH.$fname);
                $data .= ", cat_image = '$fname' ";
            } 

            // Ensure the category name has not been used
            $sql = "SELECT * FROM categories WHERE name=?";
            $check = $opr->sqlSelect($sql, 's', $category_name)->num_rows;
            if($check > 0){
                // echo "Category name already exists.";
                return -2;   //  Category name already exists.
            }

            // Ensure the catalog_symbol has not been used
            $sql = "SELECT * FROM categories WHERE abbrv=?";
            $check = $opr->sqlSelect($sql, 's', $category_abbrv)->num_rows;
            if($check > 0){
                // echo "Abbreviation already exists.";
                return -3;   //  Abbreviation already exists.
            }

            // Ensure the catalog_symbol has not been used
            $sql = "SELECT * FROM categories WHERE catalog_symbol=?";
            $check = $opr->sqlSelect($sql, 's', $category_catalog_symbol)->num_rows;
            if($check > 0){
                // echo "Catalog symbol already exists.";
                return -4;   //  Catalog symbol already exists.
            }

            // Add current date and userid if a new category
            $data .= ", created_on=CURRENT_TIMESTAMP";
            $data .= ", created_by=" . $_SESSION['userid'];
        }
        else {

            // Handle the uploaded image file
            if(isset($files['edit_category_img_file']) && $files['edit_category_img_file']['tmp_name'] != '') {
                // foreach($files as $k => $v) { $$k = $v; echo "\n$$k:\n"; print_r($v); }
                $fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['edit_category_img_file']['name'];
                move_uploaded_file($_FILES['edit_category_img_file']['tmp_name'], CATEGORIES_PIX_PATH.$fname);
                $data .= ", cat_image = '$fname' ";
            } 

            // Ensure the category name has not been used elsewhere except for this instance
            $sql = "SELECT * FROM categories WHERE name=? AND id != ?";
            $check = $opr->sqlSelect($sql, 'si', $category_name, $category_id)->num_rows;
            if($check > 0){
                // echo "Category name already exists.";
                return -2;   //  Category name already exists.
            }

            // Ensure the catalog_symbol has not been used elsewhere except for this instance
            $sql = "SELECT * FROM categories WHERE abbrv=? AND id != ?";
            $check = $opr->sqlSelect($sql, 'si', $category_abbrv, $category_id)->num_rows;
            if($check > 0){
                // echo "Abbreviation already exists.";
                return -3;   //  Abbreviation already exists.
            }

            // Ensure the catalog_symbol has not been used elsewhere except for this instance
            $sql = "SELECT * FROM categories WHERE catalog_symbol=? AND id != ?";
            $check = $opr->sqlSelect($sql, 'si', $category_catalog_symbol, $category_id)->num_rows;
            if($check > 0){
                // echo "Catalog symbol already exists.";
                return -4;   //  Catalog symbol already exists.
            }
        }

        // echo $data;

        // echo "INSERT INTO categories SET ".$data;
        // echo "UPDATE categories SET ".$data . " WHERE id = " . $category_id;

        try {
            if(empty($category_id)){
                $id = $opr->sqlInsert("INSERT INTO categories SET $data");
            } else {
                $id = $opr->sqlUpdate("UPDATE categories SET $data WHERE id = ?", 'i', $category_id);
            }

            if($id){
                return $id;         // saved domain operator successfully
            } 
            else {
                return -5;          // unable to insert domain operator in db
            }   
        }
        catch (Exception $e) {
            return -6;              // exception
        }

        $opr->close();
    }
    else {
        return -7;                  // Failed to connect to database
    } 
}


function deleteCategory($category_id) {
    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        if ($opr->sqlDelete2('DELETE FROM categories WHERE id=?', 'i', $category_id)) {

            // TODO: also delete any associated image file for this copy

            return 0;
        }
        else {
            return -2;      // unable to delete category
        }
        $opr->close();
    }
    else {
        return -1;          // Failed to connect to database
    }  
}


?>