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
            if(empty($id)){
                $id = $opr->sqlInsert("INSERT INTO users SET $data");
            } else {
                //echo $data;
                $id = $opr->sqlUpdate("UPDATE users SET $data WHERE id = ?", 'i', $id);
            }
            if($id){
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
        // Create the domain
        $id = $opr->sqlInsert(  'INSERT INTO domains VALUES (NULL, ?, ?)', 'ss', $domain_name, $description);

        // If successful, create the default 'main' subdomain
        if ($id > 0) {
            $opr->sqlInsert( "INSERT INTO `subdomains` VALUES (NULL, 'main', ?, 'Default subdomain')", 'i', $id);
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

function getSubDomsByDomainId2($domainId) {
    $subdoms = array();

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        $res = $opr->sqlSelect('SELECT id, name, parent_domain_id FROM `subdomains` 
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

        $id = $opr->sqlInsert(  "INSERT INTO `subdomains` VALUES (NULL, ?, ?, ?)", 
                                'sis', $subDomName, $domainId, $subDomDescr);
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


function deleteSubdomain($domain_id, $subdom_id) {
    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        if ($opr->sqlDelete('DELETE FROM subdomains WHERE parent_domain_id=? AND id=?', 'ii', $domain_id, $subdom_id)) {
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

?>