<?php 

/*
 * Manage Roles
 * 
 */

function get_page_access_roles($page_access_group) {

    $roles = array();

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        $results = $opr->sqlSelect('SELECT pags.id, pags.label, pags_roles.role_id
                                FROM `page_access_groups` as pags INNER JOIN `page_access_groups_roles` as pags_roles
                                ON pags.id = pags_roles.pag_id  
                                WHERE pags.label=?', 's', $page_access_group);

        if ($results && $results->num_rows > 0) {
            $page_access_roles = array();
            while ($row = $results->fetch_assoc()) {
                $page_access_roles[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        if (!empty($page_access_roles)) {
            foreach($page_access_roles as $role) {
                $roles[] = $role['role_id'];
            }
        }

        return $roles;
    }
    else {
        return -1;      // Failed to connect to database
    }  
};

function fetch_all_roles() {
    $roles = array();

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $results = $opr->sqlSelect('SELECT id, name, description, page_access_level FROM `roles`');

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $roles[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $roles;
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}

function getRolesByGroupId($groupId) {

    $roles = array();

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        $results = $opr->sqlSelect('SELECT groups.id, groups.name, groups_roles.role_id,
                                (SELECT name FROM `roles` WHERE `roles`.id = `groups_roles`.role_id) as role_name
                                FROM `groups` INNER JOIN `groups_roles`
                                ON groups.id = groups_roles.group_id  
                                WHERE groups.id=?', 'i', $groupId);

        if ($results && $results->num_rows > 0) {
            $group_roles = array();
            while ($row = $results->fetch_assoc()) {
                $group_roles[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        if (!empty($group_roles)) {
            foreach($group_roles as $role) {
                $roles[] = $role['role_id'];
            }
        }
        return $roles;
    }
    else {
        return -1;      // Failed to connect to database
    }  
}

function getGroupsRolesByGroupId($groupId) {

    $group_roles = array();

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        $results = $opr->sqlSelect('SELECT groups.id, groups.name, groups_roles.role_id,
                                (SELECT name FROM `roles` WHERE `roles`.id = `groups_roles`.role_id) as role_name
                                FROM `groups` INNER JOIN `groups_roles`
                                ON groups.id = groups_roles.group_id  
                                WHERE groups.id=?', 'i', $groupId);

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $group_roles[] = $row;
            }
            $results->free_result();
        }
        $opr->close();
        return $group_roles;
    }
    else {
        return -1;      // Failed to connect to database
    }  
}

function isRoleInGroup($roleName, $groupId) {
    $res = getGroupsRolesByGroupId($groupId);
    if (!($res <= 0) && !empty($res)) {
        // echo "<pre>";  print_r($res);
        foreach ($res as $key => $val) {
            if ($val['role_name'] === $roleName) {
                return true;
            }
        }
    }
    return false;
}


/*
 * Manage Groups
 * 
 */

function fetch_all_groups() {
    $groups = array();

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $results = $opr->sqlSelect('SELECT id, name, description FROM `groups`');

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $groups[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $groups;
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}

function fetch_group_by_id($groupId) {
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

function fetch_roles_by_group($groupId) {
    $roles = array();

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $results = $opr->sqlSelect('SELECT gr.group_id, gr.role_id, gr.label, roles.description, roles.page_access_level 
                                    FROM `groups_roles` as gr INNER JOIN `roles`
                                    ON gr.role_id = roles.id
                                    WHERE gr.group_id=?', 'i', $groupId);

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $roles[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $roles;
    }
}


/*
 * Manage PAGR
 * 
 */

function fetch_all_pagrs() {
    $pagrs = array();

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $results = $opr->sqlSelect('SELECT id, label, description FROM `page_access_groups`');

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $pagrs[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $pagrs;
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}

function fetch_pagr_by_id($pagrId) {
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

function fetch_roles_by_pagr($pagrId) {
    $roles = array();

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $results = $opr->sqlSelect('SELECT pagr.pag_id, pagr.role_id, pagr.label, roles.description, roles.page_access_level 
                                    FROM `page_access_groups_roles` as pagr INNER JOIN `roles`
                                    ON pagr.role_id = roles.id
                                    WHERE pagr.pag_id=?', 'i', $pagrId);

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $roles[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $roles;
    }
}


/*
 * Manage Users
 * 
 */

function fetch_all_users() {
    $users = array();

    $userDomain = isset($_SESSION['domain']) ? $_SESSION['domain'] : 'default';
    $userGroupId = isset($_SESSION['groupid']) ? $_SESSION['groupid'] : 1;

    // $userDomainName = isset($_SESSION['domain']) ? $_SESSION['domain'] : 'default';
    // $userGroupId = isset($_SESSION['groupid']) ? $_SESSION['groupid'] : 1;
    // $userId = $_SESSION['userid'];
    // $userDomain = getDomainByName($userDomainName);
    // $userSubDoms = getSubDomsByUserId($userId);

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        // $sql = "SELECT users.id, users.name, users.email, 
        //         users.domain, 
        //         groups.name as usergroup, 
        //         users.verified FROM users INNER JOIN groups ON users.groupid = groups.id";

        $sql = "SELECT users.id, users.name, users.email, domain_q.domain,
                groups.name as usergroup, users.verified FROM users 
                INNER JOIN groups
                INNER JOIN
                (SELECT subdomains_users.user_id,
                (SELECT name FROM `domains` WHERE subdomains.parent_domain_id = `domains`.`id`) as domain, 
                (SELECT name FROM `users` WHERE subdomains_users.user_id = `users`.id) as username 
                FROM `subdomains_users` INNER JOIN `subdomains` 
                ON `subdomains_users`.`sub_dom_id` = `subdomains`.id 
                GROUP BY domain, username) as domain_q
                ON users.groupid = groups.id 
                AND `users`.id = domain_q.user_id";

        // Restrict view of all users only to admins
        if (!isRoleInGroup('admin', $userGroupId)) {
            $sql .= " WHERE domain_q.domain='" . $userDomain ."'";
        }

        // // Restrict view of all users only to admins
        // if (!isRoleInGroup('admin', $userGroupId)) {
        //     // Restrict view only to user's provisioned subdomains
        //     $sql .= " WHERE `vp`.domain_id='" . $userDomain['id'] ."'";
        //     // $sql .= " AND `vp`.sub_dom_id IN ('". implode(',', $userSubDoms) ."')";
        // }

        $results = $opr->sqlSelect($sql);

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $users[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $users;
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}

function getUserById($userId) {
    $user = [];	

    $domain = getDomainByUserId($userId);

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        $res = $opr->sqlSelect('SELECT * FROM users WHERE id=?', 'i', $userId);

        if($res && $res->num_rows === 1) {
            $user = $res->fetch_assoc();
            $res->free_result();

            // Append the user's domain
            if ($domain > 0) {
                $user += array('domain' => $domain['domain']);
            }

            return $user;          
        }
        else {
            return -2;  // User not found
        }
        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }  
}


/*
 * Manage Organizations
 * 
 */

function fetch_all_organizations() {
    $orgs = array();

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $sql = "SELECT id, name, domain_id, (SELECT name FROM `domains` WHERE domain_id = `domains`.id) 
                as domain, type, address, contact_person, contact_email, contact_phone, description 
                FROM `organizations`";

        $results = $opr->sqlSelect($sql);


        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $orgs[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $orgs;
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}

/*
 * Manage Domains
 * 
 */

function fetch_all_domains() {
    $domains = array();

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $results = $opr->sqlSelect('SELECT id, name, description FROM `domains`');

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $domains[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $domains;
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}

function fetch_domain_by_id($domainId) {
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

function fetch_subdoms_by_domain($domainId) {
    $subdoms = array();

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $results = $opr->sqlSelect('SELECT id, name, parent_domain_id, description
                                    FROM `subdomains` 
                                    WHERE parent_domain_id=?', 'i', $domainId);

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $subdoms[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $subdoms;
    }
}

function getDomainByName($domainName) {
    $domain = [];

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $sql = "SELECT * FROM `domains` WHERE name=?";

        $results = $opr->sqlSelect($sql, 's', $domainName);

        if ($results && $results->num_rows === 1) {
            $domain = $results->fetch_assoc();
            $results->free_result();
            return $domain;  
        }
        else {
            return -2;              // Domain not found
        }
        $opr->close();
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}

function getDomainByUserId($userId) {
    $domain = array();

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $sql = "SELECT subdomains_users.user_id,
                (SELECT name FROM `domains` WHERE subdomains.parent_domain_id = `domains`.`id`) as domain, 
                (SELECT name FROM `users` WHERE subdomains_users.user_id = `users`.id) as username 
                FROM `subdomains_users` INNER JOIN `subdomains` 
                ON `subdomains_users`.`sub_dom_id` = `subdomains`.id 
                WHERE subdomains_users.user_id=?
                GROUP BY domain, username";

        $results = $opr->sqlSelect($sql, 'i', $userId);

        if ($results && $results->num_rows === 1) {
            $domain = $results->fetch_assoc();
            $results->free_result();
            return $domain;  
        }
        else {
            return -2;              // Domain not found
        }
        $opr->close();
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}

/*
 * Manage Subdomains
 * 
 */

function fetch_all_subdomains() {
    $subdomains = array();

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $results = $opr->sqlSelect('SELECT id, name, description, 
                                    parent_domain_id, 
                                    (SELECT name FROM `domains` WHERE parent_domain_id = `domains`.id) as domain_name
                                    FROM `subdomains`');

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $subdomains[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $subdomains;
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}

function getSubDomsByDomainId($domainId) {
    $subdoms = array();

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        $results = $opr->sqlSelect('SELECT id, name, parent_domain_id
                                    FROM `subdomains`
                                    WHERE subdomains.parent_domain_id=?', 'i', $domainId);

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $subdoms[] = $row;
            }
            $results->free_result();
        }
        $opr->close();
        return $subdoms;
    }
    else {
        return -1;      // Failed to connect to database
    }  
}

function getSubDomsByUserId($userId) {
    $subdom_ids = array();

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        $results = $opr->sqlSelect('SELECT id, user_id, sub_dom_id
                                    FROM `subdomains_users`
                                    WHERE user_id=?', 'i', $userId);
        $subdoms = array();
        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $subdoms[] = $row;
            }
            $results->free_result();

            foreach($subdoms as $subdom) {
                $subdom_id[] = $subdom['sub_dom_id'];
            }
        }
        $opr->close();
        return $subdom_id;
    }
    else {
        return -1;      // Failed to connect to database
    }  
}

// Untested!
function isUserInSubDom($userId, $subDomId) {
    $user_subdom_ids = getSubDomsByUserId($userId);

    if (!($user_subdom_ids <= 0) && !empty($user_subdom_ids)) {
        foreach ($user_subdom_ids as $subdom_id) {
            if ($subdom_id === $subDomId) {
                return true;
            }
        }
    }
    return false;
}

function fetch_all_storeunits() {
    $storeunits = array();

    $userDomainName = isset($_SESSION['domain']) ? $_SESSION['domain'] : 'default';
    $userGroupId = isset($_SESSION['groupid']) ? $_SESSION['groupid'] : 1;

    $userDomain = getDomainByName($userDomainName);

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $sql = "SELECT parent_domain_id, 
                (SELECT name FROM `organizations` WHERE `organizations`.domain_id = parent_domain_id) as org_name, 
                (SELECT name FROM `domains` WHERE `subdomains`.parent_domain_id = `domains`.id) as domain_name,
                subdomains.name as sub_dom, 
                subdomains.description as sub_dom_descr
                FROM `subdomains`";

        // Restrict view of all users only to admins
        if (!isRoleInGroup('admin', $userGroupId)) {
            $sql .= " WHERE `subdomains`.parent_domain_id='" . $userDomain['id'] ."'";
        }        

        $results = $opr->sqlSelect($sql);

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $storeunits[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $storeunits;
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}

/*
 * Manage Subdomain Users
 * 
 */

function fetch_all_subdom_users() {
    $subdom_users = array();

    // $userDomain = isset($_SESSION['domain']) ? $_SESSION['domain'] : 'default';
    // $userGroupId = isset($_SESSION['groupid']) ? $_SESSION['groupid'] : 1;

    $userId = $_SESSION['userid'];

    $userDomainName = isset($_SESSION['domain']) ? $_SESSION['domain'] : 'default';
    $userGroupId = isset($_SESSION['groupid']) ? $_SESSION['groupid'] : 1;

    $userDomain = getDomainByName($userDomainName);
    $userSubDoms = getSubDomsByUserId($userId);

    $opr = new DBOperation();       // Connect to database
    if ($opr->dbConnected()) {

        $sql = "SELECT su.id as sub_dom_user_id, su.user_id, 
                (SELECT name FROM users WHERE su.user_id = users.id) as username,
                su.sub_dom_id, 
                sd.id, sd.name as subdom_name, 
                sd.parent_domain_id,
                (SELECT name FROM domains WHERE sd.parent_domain_id = domains.id) as domain_name
                FROM subdomains_users as su INNER JOIN subdomains as sd
                ON su.sub_dom_id = sd.id";

        // Restrict view of all users only to admins
        if (!isRoleInGroup('admin', $userGroupId)) {
            // Restrict view only to user's provisioned subdomains
            $sql .= " WHERE `sd`.parent_domain_id='" . $userDomain['id'] ."'";
            // $sql .= " AND `vp`.sub_dom_id IN ('". implode(',', $userSubDoms) ."')";
        }

        $results = $opr->sqlSelect($sql);

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $subdom_users[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $subdom_users;
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}

function getSubDomUserById($subDomUserId) {
    $sub_dom_user = [];	

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        $res = $opr->sqlSelect('SELECT * FROM subdomains_users WHERE id=?', 'i', $subDomUserId);

        if($res && $res->num_rows === 1) {
            $sub_dom_user = $res->fetch_assoc();
            $res->free_result();

            return $sub_dom_user;          
        }
        else {
            return -2;  // User not found
        }
        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }  
}



/*
 * Manage Customers
 * 
 */

function fetch_all_customers() {
    $orgs = array();

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $sql = "SELECT id, name, domain_id, (SELECT name FROM `domains` WHERE domain_id = `domains`.id) 
                as domain, type, address, contact_person, contact_email, contact_phone, description 
                FROM `organizations` WHERE type='customer'";

        $results = $opr->sqlSelect($sql);

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $orgs[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $orgs;
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}

/*
 * Manage Vendors
 * 
 */

function fetch_all_vendors() {
    $vendors = array();

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $sql = "SELECT id, name, domain_id, (SELECT name FROM `domains` WHERE domain_id = `domains`.id) 
                as domain, type, address, contact_person, contact_email, contact_phone, description 
                FROM `organizations` WHERE type='vendor'";

        $results = $opr->sqlSelect($sql);

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $vendors[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $vendors;
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}

/*
 * Manage Staff
 * 
 */

function fetch_all_staff() {
    $staff = array();

    $userDomainName = isset($_SESSION['domain']) ? $_SESSION['domain'] : 'default';
    $userGroupId = isset($_SESSION['groupid']) ? $_SESSION['groupid'] : 1;

    $userDomain = getDomainByName($userDomainName);

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $sql = 'SELECT `staff`.id, 
                (SELECT name FROM `users` WHERE `users`.id = `staff`.user_id) AS username,
                `organizations`.domain_id, 
                (SELECT name FROM `domains` WHERE `organizations`.domain_id = `domains`.id) AS domain,
                `staff`.department, `staff`.functional_role
                FROM `staff` INNER JOIN `organizations`
                ON `staff`.org_id = `organizations`.id';

        // Restrict view of all users only to admins
        if (!isRoleInGroup('admin', $userGroupId)) {
            $sql .= " WHERE `organizations`.domain_id='" . $userDomain['id'] ."'";
        }

        $results = $opr->sqlSelect($sql);

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $staff[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $staff;
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}


/*
 * Manage Stock
 * 
 */

function fetch_all_stock() {
    $stock = array();

    $userDomainName = isset($_SESSION['domain']) ? $_SESSION['domain'] : 'default';
    $userGroupId = isset($_SESSION['groupid']) ? $_SESSION['groupid'] : 1;

    $userDomain = getDomainByName($userDomainName);

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $sql = "SELECT `stock`.item, 
                `stock`.domain_id, 
                (SELECT name FROM `domains` WHERE `stock`.domain_id = `domains`.id) AS domain,
                `stock`.sub_dom_id, 
                (SELECT name FROM `subdomains` WHERE `stock`.sub_dom_id = `subdomains`.id) AS sub_dom,
                `stock`.sku, `products`.product_name, 
                `products`.unit, `stock`.lot, `stock`.per_lot, `stock`.curr_stock_level 
                FROM stock INNER JOIN products ON `stock`.sku = `products`.sku";
        
        // Restrict view of all users only to admins
        if (!isRoleInGroup('admin', $userGroupId)) {
            $sql .= " WHERE `stock`.domain_id='" . $userDomain['id'] ."'";
        }

        $results = $opr->sqlSelect($sql);

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $stock[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $stock;
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}


/*
 * Manage Domain Operators
 * 
 */

function fetch_all_dom_operators() {
    $operators = array();

    $userDomainName = isset($_SESSION['domain']) ? $_SESSION['domain'] : 'default';
    $userGroupId = isset($_SESSION['groupid']) ? $_SESSION['groupid'] : 1;

    $userDomain = getDomainByName($userDomainName);

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $sql = "SELECT `do`.id, 
                `do`.domain_id, 
                (SELECT name FROM `domains` WHERE `do`.domain_id = `domains`.id) as domain,
                `do`.sub_dom_id, 
                (SELECT name FROM `subdomains` WHERE `do`.sub_dom_id = `subdomains`.id) as sub_dom,
                `do`.dom_function_id,  
                (SELECT sys_value FROM `sys_settings` WHERE `do`.dom_function_id = `sys_settings`.id) as dom_function,
                `do`.description, 
                `do`.assoc_role, 
                (SELECT name FROM `roles` WHERE `do`.assoc_role = `roles`.id) as assoc_rolename,
                `do`.user_id,
                (SELECT name FROM `users` WHERE `do`.user_id = `users`.id) as username
                FROM `domain_operators` as do";
        
        // Restrict view of all users only to admins
        if (!isRoleInGroup('admin', $userGroupId)) {
            $sql .= " WHERE `do`.domain_id='" . $userDomain['id'] ."'";
        }

        $results = $opr->sqlSelect($sql);

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $operators[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $operators;
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}


/*
 * Manage System Settings
 * 
 */

function fetch_all_sys_settings() {
    $settings = array();

    $userDomain = isset($_SESSION['domain']) ? $_SESSION['domain'] : 'default';
    $userGroupId = isset($_SESSION['groupid']) ? $_SESSION['groupid'] : 1;

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $sql = "SELECT * FROM sys_settings";

        // // Restrict view of all users only to admins
        // if (!isRoleInGroup('admin', $userGroupId)) {
        //     $sql .= " WHERE `stock`.domain='" . $userDomain ."'";
        // }

        $results = $opr->sqlSelect($sql);

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $settings[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $settings;
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}


/*
 * Manage Brands
 * 
 */

function fetch_all_brands() {
    $brands = array();

    $userDomain = isset($_SESSION['domain']) ? $_SESSION['domain'] : 'default';
    $userGroupId = isset($_SESSION['groupid']) ? $_SESSION['groupid'] : 1;

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $sql = "SELECT brands.name, brands.created_on, users.name as created_by, catalog_symbol
                FROM brands INNER JOIN users 
                ON brands.created_by = users.id";

        // // Restrict view of all users only to admins
        // if (!isRoleInGroup('admin', $userGroupId)) {
        //     $sql .= " WHERE `stock`.domain='" . $userDomain ."'";
        // }

        $results = $opr->sqlSelect($sql);

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $brands[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $brands;
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}


/*
 * Manage Categories
 * 
 */

function fetch_all_categories() {
    $categories = array();

    $userDomain = isset($_SESSION['domain']) ? $_SESSION['domain'] : 'default';
    $userGroupId = isset($_SESSION['groupid']) ? $_SESSION['groupid'] : 1;

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $sql = "SELECT categories.name, categories.parent_id, categories.description, catalog_symbol, 
                categories.created_on, users.name as created_by FROM categories INNER JOIN users 
                ON categories.created_by = users.id";

        // // Restrict view of all users only to admins
        // if (!isRoleInGroup('admin', $userGroupId)) {
        //     $sql .= " WHERE `stock`.domain='" . $userDomain ."'";
        // }

        $results = $opr->sqlSelect($sql);

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $categories[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $categories;
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}


/*
 * Manage Products
 * 
 */

function fetch_all_products() {
    $products = array();

    $userDomain = isset($_SESSION['domain']) ? $_SESSION['domain'] : 'default';
    $userGroupId = isset($_SESSION['groupid']) ? $_SESSION['groupid'] : 1;

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $sql = "SELECT products.product_name, products.sku, products.unit,
                products.weight, products.volume, products.color, products.size,
                products.short_descr, products.unit_price, products.keep_stock,
                products.created_on, users.name as created_by 
                FROM products INNER JOIN users 
                ON products.created_by = users.id";

        // // Restrict view of all users only to admins
        // if (!isRoleInGroup('admin', $userGroupId)) {
        //     $sql .= " WHERE `stock`.domain='" . $userDomain ."'";
        // }

        $results = $opr->sqlSelect($sql);

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $products[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $products;
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}



/*
 * Manage Store Requisitions
 * 
 */

function fetch_all_store_requisitions() {
    $storereqs = array();

    // $userDomainName = isset($_SESSION['domain']) ? $_SESSION['domain'] : 'default';
    // $userGroupId = isset($_SESSION['groupid']) ? $_SESSION['groupid'] : 1;

    // $userDomain = getDomainByName($userDomainName);

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $sql = "SELECT store_reqs.id, store_reqs.requisition_no, 
                store_reqs.domain_id, store_reqs.sub_dom_id,
                store_reqs.brief_description, 
                users.name as requester, 
                (SELECT users.name FROM users WHERE store_reqs.approver_id = users.id) as approver, 
                store_reqs.approver_notes, store_reqs.request_date, store_reqs.status 
                FROM store_reqs INNER JOIN users 
                ON store_reqs.requester_id = users.id";

        // // Restrict view of all users only to admins
        // if (!isRoleInGroup('admin', $userGroupId)) {
        //     $sql .= " WHERE `stock`.domain_id='" . $userDomain['id'] ."'";
        // }

        $results = $opr->sqlSelect($sql);

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $storereqs[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $storereqs;
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}

function fetch_storereq_by_id($storeRequisitionId) {
    $store_req = [];	

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        $sql = "SELECT requisition_no, brief_description, requester_id, approver_id, storekeeper_id, 
                domain_id, sub_dom_id,
                (SELECT users.name FROM users WHERE requester_id = users.id) as requester, 
                (SELECT users.name FROM users WHERE approver_id = users.id) as approver, 
                (SELECT users.name FROM users WHERE storekeeper_id = users.id) as storekeeper,
                approver_notes, storekeeper_notes, request_date, status 
                FROM store_reqs WHERE id=?";

        $res = $opr->sqlSelect($sql, 'i', $storeRequisitionId);

        if($res && $res->num_rows === 1) {
            $store_req = $res->fetch_assoc();
            $res->free_result();

            return $store_req;          
        }
        else {
            return -2;  // User not found
        }
        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }  
}

function fetch_storereq_lines_by_id($storeRequisitionId) {
    $store_req_lines = array();

    // $userDomainName = isset($_SESSION['domain']) ? $_SESSION['domain'] : 'default';
    // $userGroupId = isset($_SESSION['groupid']) ? $_SESSION['groupid'] : 1;
    // $userDomain = getDomainByName($userDomainName);

    $opr = new DBOperation();       // Connect to database
    if ($opr->dbConnected()) {

        $sql = "SELECT store_reqs.requisition_no, srli.description, srli.sku, srli.requested_qty, srli.issued_qty, 
                store_reqs.brief_description, store_reqs.request_date, store_reqs.status 
                FROM store_req_line_items as srli INNER JOIN store_reqs 
                ON srli.requisition_id = store_reqs.id WHERE store_reqs.id=?";

        // // Restrict view of all users only to admins
        // if (!isRoleInGroup('admin', $userGroupId)) {
        //     $sql .= " WHERE `stock`.domain_id='" . $userDomain['id'] ."'";
        // }

        $results = $opr->sqlSelect($sql, 'i', $storeRequisitionId);

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $store_req_lines[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $store_req_lines;
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}


/*
 * Manage Customer Purchase Requisitions
 * 
 */

function fetch_all_customer_preqs() {
    $customerpreqs = array();

    // $userDomainName = isset($_SESSION['domain']) ? $_SESSION['domain'] : 'default';
    // $userGroupId = isset($_SESSION['groupid']) ? $_SESSION['groupid'] : 1;

    // $userDomain = getDomainByName($userDomainName);

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $sql = "SELECT customer_preqs.id, customer_preqs.preq_no,  customer_preqs.preq_date, 
                customer_preqs.description,
                customer_preqs.domain_id, 
                (SELECT name FROM domains WHERE customer_preqs.domain_id = domains.id) as domain,
                customer_preqs.sub_dom_id,
                (SELECT name FROM subdomains WHERE customer_preqs.sub_dom_id = subdomains.id) as subdom,
                organizations.name as customer,
                customer_preqs.base_cost, customer_preqs.status
                FROM customer_preqs INNER JOIN organizations
                ON customer_preqs.customer_id = organizations.id 
                AND organizations.type = 'customer'";

        // // Restrict view of all users only to admins
        // if (!isRoleInGroup('admin', $userGroupId)) {
        //     $sql .= " WHERE `stock`.domain_id='" . $userDomain['id'] ."'";
        // }

        $results = $opr->sqlSelect($sql);

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $customerpreqs[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $customerpreqs;
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}

function getCustomerPreqById($preqId) {
    $customerpreq = array();

    // $userDomainName = isset($_SESSION['domain']) ? $_SESSION['domain'] : 'default';
    // $userGroupId = isset($_SESSION['groupid']) ? $_SESSION['groupid'] : 1;
    // $userDomain = getDomainByName($userDomainName);

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $sql = "SELECT id, preq_date, preq_no, description, 
                domain_id, 
                (SELECT name FROM domains WHERE domain_id = domains.id) as domain_name,
                sub_dom_id, 
                (SELECT name FROM subdomains WHERE sub_dom_id = subdomains.id) as subdom_name,
                originator_id, 
                (SELECT name FROM users WHERE id = originator_id) as originator, 
                approver_id, 
                (SELECT name FROM users WHERE id = approver_id) as approver,
                customer_id,
                (SELECT name FROM organizations WHERE id = customer_id) as customer,
                approver_notes, base_cost, status 
                FROM customer_preqs WHERE id=?";

        // // Restrict view of all users only to admins
        // if (!isRoleInGroup('admin', $userGroupId)) {
        //     $sql .= " WHERE `stock`.domain_id='" . $userDomain['id'] ."'";
        // }

        $results = $opr->sqlSelect($sql, 'i', $preqId);

        if ($results && $results->num_rows === 1) {
            $customerpreq = $results->fetch_assoc();
            $results->free_result();
            return $customerpreq;
        }

        $opr->close();
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}

function getCustomerPreqLinesById($preqId) {
    $customerpreq_lines = array();

    // $userDomainName = isset($_SESSION['domain']) ? $_SESSION['domain'] : 'default';
    // $userGroupId = isset($_SESSION['groupid']) ? $_SESSION['groupid'] : 1;
    // $userDomain = getDomainByName($userDomainName);

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $sql = "SELECT preq_id, 
                (SELECT product_name FROM products 
                    WHERE catalog_product_id = products.id) as product_name, 
                (SELECT unit FROM products 
                    WHERE catalog_product_id = products.id) as unit, 
                (SELECT name FROM brands WHERE 
                    (SELECT brand_id FROM products
                        WHERE catalog_product_id = products.id) = brands.id) as brand,
                (SELECT short_descr FROM products 
                    WHERE catalog_product_id = products.id) as product_descr,     
                (SELECT sku FROM products 
                    WHERE catalog_product_id = products.id) as sku, 
                unit_price, quantity, rx_quantity, total_cost, additional_info 
                FROM customer_preq_line_items 
                WHERE preq_id=?";

        // // Restrict view of all users only to admins
        // if (!isRoleInGroup('admin', $userGroupId)) {
        //     $sql .= " WHERE `stock`.domain_id='" . $userDomain['id'] ."'";
        // }

        $results = $opr->sqlSelect($sql, 'i', $preqId);

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $customerpreq_lines[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $customerpreq_lines;
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}



/*
 * Manage Customer Purchase Orders
 * 
 */

function fetch_all_customer_purchase_orders() {
    $customerpos = array();

    // $userDomainName = isset($_SESSION['domain']) ? $_SESSION['domain'] : 'default';
    // $userGroupId = isset($_SESSION['groupid']) ? $_SESSION['groupid'] : 1;

    // $userDomain = getDomainByName($userDomainName);

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $sql = "SELECT customer_porders.id, customer_porders.porder_no, customer_porders.porder_date, 
                customer_porders.preq_id, 
                (SELECT preq_no FROM customer_preqs WHERE customer_porders.preq_id = customer_preqs.id) as preq_no,
                customer_porders.description, customer_porders.originator_id, customer_porders.customer_id,
                customer_porders.domain_id, 
                (SELECT name FROM domains WHERE customer_porders.domain_id = domains.id) as domain,
                customer_porders.sub_dom_id,
                (SELECT name FROM subdomains WHERE customer_porders.sub_dom_id = subdomains.id) as subdom,
                organizations.name as customer,
                customer_porders.net_total, customer_porders.status
                FROM customer_porders INNER JOIN organizations
                ON customer_porders.customer_id = organizations.id 
                AND organizations.type = 'customer'";

        // // Restrict view of all users only to admins
        // if (!isRoleInGroup('admin', $userGroupId)) {
        //     $sql .= " WHERE `stock`.domain_id='" . $userDomain['id'] ."'";
        // }

        $results = $opr->sqlSelect($sql);

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $customerpos[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $customerpos;
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}


function fetch_customer_porder_by_id($id) {
    $customer_po = array();

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        $sql = "SELECT po.id, po.porder_no, po.porder_date, po.preq_id, po.customer_id, c.name as customer_name, 
                c.contact_person, c.contact_email, c.contact_phone, c.address, po.sub_total, po.vat, 
                po.discount, po.net_total, po.shipping_method, po.shipping_cost, po.payment_method, 
                po.paid, po.due, po.status, po.notes
                FROM `customer_porders` as po INNER JOIN `organizations` as c 
                ON po.customer_id = c.id AND c.type = 'customer'
                WHERE po.id=?";

        $res = $opr->sqlSelect($sql, 'i', $id);
        
        if ($res && $res->num_rows === 1) {
            $customer_po = $res->fetch_assoc();
            return $customer_po;
            $res->free_result();
        }
        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }
}

function fetch_customer_porder_line_items($porder_id) {
    $porder_lines = array();

    // $userDomainName = isset($_SESSION['domain']) ? $_SESSION['domain'] : 'default';
    // $userGroupId = isset($_SESSION['groupid']) ? $_SESSION['groupid'] : 1;

    // $userDomain = getDomainByName($userDomainName);

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $sql = "SELECT pli.id, pli.porder_id, pli.catalog_product_id, p.sku, p.brand_id, 
                p.category_id, p.unit, p.short_descr, pli.quantity, pli.unit_price, pli.total_cost 
                FROM `customer_porder_line_items` as pli INNER JOIN products as p 
                ON pli.catalog_product_id = p.id WHERE pli.porder_id=?";

        // // Restrict view of all users only to admins
        // if (!isRoleInGroup('admin', $userGroupId)) {
        //     $sql .= " WHERE `stock`.domain_id='" . $userDomain['id'] ."'";
        // }

        $results = $opr->sqlSelect($sql, 'i', $porder_id);

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $porder_lines[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $porder_lines;
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}

// Format for receive porder
function fetch_customer_porder_by_id2($id) {
    $customer_po = array();

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        $sql = "SELECT porder_no, description, porder_date,
                (SELECT users.name FROM users WHERE customer_porders.originator_id = users.id) as originator, 
                originator_id, domain_id, sub_dom_id,
                (SELECT name FROM organizations WHERE customer_porders.customer_id = organizations.id) as customer, 
                customer_id, sub_total, vat, discount, net_total, paid, due, payment_method, 
                shipping_method, status, rel_request_id, notes 
                FROM customer_porders WHERE customer_porders.id = ?";

        $res = $opr->sqlSelect($sql, 'i', $id);
        
        if ($res && $res->num_rows === 1) {
            $customer_po = $res->fetch_assoc();
            return $customer_po;
            $res->free_result();
        }
        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }
}

// Format for receive porder
function fetch_customer_porder_line_items2($porder_id) {
    $porder_lines = array();

    // $userDomainName = isset($_SESSION['domain']) ? $_SESSION['domain'] : 'default';
    // $userGroupId = isset($_SESSION['groupid']) ? $_SESSION['groupid'] : 1;

    // $userDomain = getDomainByName($userDomainName);

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $sql = "SELECT cpo.porder_no, poli.catalog_product_id, 
                (SELECT products.product_name FROM products WHERE poli.catalog_product_id = products.id) as product_name,
                (SELECT products.sku FROM products WHERE poli.catalog_product_id = products.id) as product_sku,
                (SELECT products.short_descr FROM products WHERE poli.catalog_product_id = products.id) as product_descr,
                (SELECT products.unit FROM products WHERE poli.catalog_product_id = products.id) as unit,
                poli.quantity, poli.rx_quantity, poli.unit_price, poli.total_cost 
                FROM customer_porder_line_items as poli INNER JOIN customer_porders as cpo 
                ON poli.porder_id = cpo.id WHERE cpo.id = ?";

        // // Restrict view of all users only to admins
        // if (!isRoleInGroup('admin', $userGroupId)) {
        //     $sql .= " WHERE `stock`.domain_id='" . $userDomain['id'] ."'";
        // }

        $results = $opr->sqlSelect($sql, 'i', $porder_id);

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $porder_lines[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $porder_lines;
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}


/*
 * Manage Vendor Products
 * 
 */

function fetch_all_vendor_products() {
    $vproducts = array();

    $userId = $_SESSION['userid'];

    $userDomainName = isset($_SESSION['domain']) ? $_SESSION['domain'] : 'default';
    $userGroupId = isset($_SESSION['groupid']) ? $_SESSION['groupid'] : 1;

    $userDomain = getDomainByName($userDomainName);
    $userSubDoms = getSubDomsByUserId($userId);

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $sql = "SELECT vp.id, vp.domain_id, vp.sub_dom_id, vp.vendor_id, 
                (SELECT name FROM organizations WHERE organizations.id = vp.vendor_id) as vendor,
                vp.brand, vp.category,
                vp.provisional_sku, vp.product_name_descr, vp.feature, vp.unit, vp.lot, 
                vp.qty_per_offer, vp.offer_price, vp.offer_date, vp.active,
                vp.created_on, vp.created_by,
                (SELECT name FROM users WHERE vp.created_by = users.id) as creator 
                FROM vendors_products as vp";

        // Restrict view of all users only to admins
        if (!isRoleInGroup('admin', $userGroupId)) {
            // Restrict view only to user's provisioned subdomains
            $sql .= " WHERE `vp`.domain_id='" . $userDomain['id'] ."'";
            $sql .= " AND `vp`.sub_dom_id IN ('". implode(',', $userSubDoms) ."')";
        }

        // echo $sql;

        $results = $opr->sqlSelect($sql);

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $vproducts[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $vproducts;
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}

function fetch_unknown_vendor_products() {
    $vproducts = array();

    $userId = $_SESSION['userid'];

    $userDomainName = isset($_SESSION['domain']) ? $_SESSION['domain'] : 'default';
    $userGroupId = isset($_SESSION['groupid']) ? $_SESSION['groupid'] : 1;

    $userDomain = getDomainByName($userDomainName);
    $userSubDoms = getSubDomsByUserId($userId);

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $sql = "SELECT vp.id, vp.domain_id, vp.sub_dom_id, vp.vendor_id, 
                (SELECT name FROM organizations WHERE organizations.id = vp.vendor_id) as vendor,
                vp.brand, vp.category,
                vp.provisional_sku, vp.product_name_descr, vp.feature, vp.unit, vp.lot, 
                vp.qty_per_offer, vp.offer_price, vp.offer_date, vp.active,
                vp.created_on, vp.created_by,
                (SELECT name FROM users WHERE vp.created_by = users.id) as creator 
                FROM vendors_products as vp
                WHERE vp.provisional_sku LIKE 'UKN%'";

        // Restrict view of all users only to admins
        if (!isRoleInGroup('admin', $userGroupId)) {
            // Restrict view only to user's provisioned subdomains
            $sql .= " AND `vp`.domain_id='" . $userDomain['id'] ."'";
            $sql .= " AND `vp`.sub_dom_id IN ('". implode(',', $userSubDoms) ."')";
        }

        // echo $sql;

        $results = $opr->sqlSelect($sql);

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $vproducts[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $vproducts;
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}

function fetch_all_vendor_products_join_products() {
    $vproducts = array();

    // $userId = $_SESSION['userid'];
    // $userDomainName = isset($_SESSION['domain']) ? $_SESSION['domain'] : 'default';
    // $userGroupId = isset($_SESSION['groupid']) ? $_SESSION['groupid'] : 1;
    // $userDomain = getDomainByName($userDomainName);
    // $userSubDoms = getSubDomsByUserId($userId);

    $opr = new DBOperation();       // Connect to database
    if ($opr->dbConnected()) {

        // From original SQL, the only differences are 'product_name', 'products.unit'
        // $sql = "SELECT vp.id, products.product_name, vp.short_descr, products.unit, vp.qty_per_offer, vp.offer_price, 
        //         (SELECT vendors.company_name FROM vendors WHERE vp.vendor_id = vendors.id) as vendor 
        //         FROM `vendors_products` as vp INNER JOIN products ON vp.sku = products.sku";

        $sql = "SELECT vp.id, products.product_name, products.unit as product_unit, 
                vp.domain_id, vp.sub_dom_id, vp.vendor_id, 
                (SELECT name FROM organizations WHERE organizations.id = vp.vendor_id) as vendor,
                vp.brand, vp.category, vp.provisional_sku, vp.product_name_descr, vp.feature, 
                vp.unit, vp.lot, vp.qty_per_offer, vp.offer_price, vp.offer_date, vp.active
                FROM vendors_products as vp INNER JOIN products
                ON vp.provisional_sku = products.sku";

        // // Restrict view of all users only to admins
        // if (!isRoleInGroup('admin', $userGroupId)) {
        //     // Restrict view only to user's provisioned subdomains
        //     $sql .= " WHERE `vp`.domain_id='" . $userDomain['id'] ."'";
        //     $sql .= " AND `vp`.sub_dom_id IN ('". implode(',', $userSubDoms) ."')";
        // }

        $results = $opr->sqlSelect($sql);

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $vproducts[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $vproducts;
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}

function fetch_all_pkg_unit_types() {
    $package_types = array();

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $sql = "SELECT id, type, label, catalog_symbol, description 
                FROM static_codes WHERE parent='products' AND type='packaging_unit'";

        $results = $opr->sqlSelect($sql);

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $package_types[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $package_types;
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}

function fetch_all_pkg_lot_types() {
    $package_types = array();

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $sql = "SELECT id, type, label, catalog_symbol, description 
                FROM static_codes WHERE parent='products' AND type='packaging_lot'";

        $results = $opr->sqlSelect($sql);

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $package_types[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $package_types;
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}


/*
 * Manage Vendor Purchase Requisitions
 * 
 */

function fetch_all_vendor_preqs() {
    $vendorpreqs = array();

    // $userDomainName = isset($_SESSION['domain']) ? $_SESSION['domain'] : 'default';
    // $userGroupId = isset($_SESSION['groupid']) ? $_SESSION['groupid'] : 1;

    // $userDomain = getDomainByName($userDomainName);

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        // $sql = "SELECT id, order_requisition_date, requisition_no, description, requester_id,
        //         (SELECT name FROM users WHERE id = requester_id) as requester,
        //         base_cost, status FROM order_requisitions";

        $sql = "SELECT vendor_preqs.id, vendor_preqs.preq_no, vendor_preqs.preq_date, 
                vendor_preqs.description,
                vendor_preqs.domain_id, 
                (SELECT name FROM domains WHERE vendor_preqs.domain_id = domains.id) as domain,
                vendor_preqs.sub_dom_id,
                (SELECT name FROM subdomains WHERE vendor_preqs.sub_dom_id = subdomains.id) as subdom,
                vendor_preqs.requester_id,
                (SELECT name FROM users WHERE users.id = vendor_preqs.requester_id) as requester,
                vendor_preqs.base_cost, vendor_preqs.status
                FROM vendor_preqs";

        // // Restrict view of all users only to admins
        // if (!isRoleInGroup('admin', $userGroupId)) {
        //     $sql .= " WHERE `stock`.domain_id='" . $userDomain['id'] ."'";
        // }

        $results = $opr->sqlSelect($sql);

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $vendorpreqs[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $vendorpreqs;
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}


function getVendorPreqById($preqId) {
    $vendorpreq = array();

    // $userDomainName = isset($_SESSION['domain']) ? $_SESSION['domain'] : 'default';
    // $userGroupId = isset($_SESSION['groupid']) ? $_SESSION['groupid'] : 1;
    // $userDomain = getDomainByName($userDomainName);

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $sql = "SELECT id, preq_date, preq_no, description, requester_id, 
                domain_id, 
                (SELECT name FROM domains WHERE domain_id = domains.id) as domain_name,
                sub_dom_id,
                (SELECT name FROM subdomains WHERE sub_dom_id = subdomains.id) as sub_dom_name, 
                approver_id, 
                (SELECT name FROM users WHERE id = approver_id) as approver,
                approver_notes, base_cost, status 
                FROM vendor_preqs WHERE id=?";

        // // Restrict view of all users only to admins
        // if (!isRoleInGroup('admin', $userGroupId)) {
        //     $sql .= " WHERE `stock`.domain_id='" . $userDomain['id'] ."'";
        // }

        $results = $opr->sqlSelect($sql, 'i', $preqId);

        if ($results && $results->num_rows === 1) {
            $vendorpreq = $results->fetch_assoc();
            $results->free_result();
            return $vendorpreq;
        }

        $opr->close();
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}

function getVendorPreqLinesById($preqId) {
    $vendorpreq_lines = array();

    // $userDomainName = isset($_SESSION['domain']) ? $_SESSION['domain'] : 'default';
    // $userGroupId = isset($_SESSION['groupid']) ? $_SESSION['groupid'] : 1;

    // $userDomain = getDomainByName($userDomainName);

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $sql = "SELECT preq_id, 
                (SELECT name FROM organizations WHERE vendor_id = organizations.id) as vendor,
                (SELECT product_name_descr FROM vendors_products 
                    WHERE vendor_product_id = vendors_products.id) as product_descr, 
                (SELECT provisional_sku FROM vendors_products 
                    WHERE vendor_product_id = vendors_products.id) as sku, 
                rate, quantity, total, additional_info 
                FROM vendor_preq_line_items 
                WHERE preq_id=?";

        // // Restrict view of all users only to admins
        // if (!isRoleInGroup('admin', $userGroupId)) {
        //     $sql .= " WHERE `stock`.domain_id='" . $userDomain['id'] ."'";
        // }

        $results = $opr->sqlSelect($sql, 'i', $preqId);

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $vendorpreqs[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $vendorpreqs;
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}

function getVendorsInfoFromPreqLineItemsByPreqId($preqId) {
    $related_vendors = array();

    // $userDomainName = isset($_SESSION['domain']) ? $_SESSION['domain'] : 'default';
    // $userGroupId = isset($_SESSION['groupid']) ? $_SESSION['groupid'] : 1;
    // $userDomain = getDomainByName($userDomainName);

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $sql = "SELECT vpli.vendor_id, vendor_preqs.preq_date, 
                (SELECT name FROM `organizations` WHERE vpli.vendor_id = `organizations`.id) as vendor
                FROM `vendor_preq_line_items` as vpli INNER JOIN vendor_preqs 
                ON vpli.preq_id = vendor_preqs.id 
                WHERE `vpli`.preq_id=?
                GROUP BY vpli.vendor_id, vendor_preqs.preq_date";

        // // Restrict view of all users only to admins
        // if (!isRoleInGroup('admin', $userGroupId)) {
        //     $sql .= " WHERE `stock`.domain_id='" . $userDomain['id'] ."'";
        // }

        $results = $opr->sqlSelect($sql, 'i', $preqId);

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $related_vendors[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $related_vendors;
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}

function getVendorPreqLinesByVendorId($preqId, $vendorId) {
    $vendorpreq_lines = array();

    // $userDomainName = isset($_SESSION['domain']) ? $_SESSION['domain'] : 'default';
    // $userGroupId = isset($_SESSION['groupid']) ? $_SESSION['groupid'] : 1;
    // $userDomain = getDomainByName($userDomainName);

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $sql = "SELECT vpli.preq_id, vpli.vendor_product_id, 
                (SELECT product_name FROM products WHERE products.sku = vp.provisional_sku) as product_name, 

                (SELECT name FROM brands WHERE id = (SELECT brand_id FROM products WHERE sku = vp.provisional_sku)) as brand, 
                (SELECT unit FROM products WHERE sku = vp.provisional_sku) as unit, 

                vp.product_name_descr, vp.qty_per_offer, vp.provisional_sku, vpli.rate, vpli.quantity, 
                vpli.total, vpli.additional_info 
                FROM `vendor_preq_line_items` as vpli INNER JOIN vendors_products as vp 
                ON vpli.vendor_id = vp.vendor_id AND vpli.vendor_product_id = vp.id 
                WHERE vpli.preq_id=? AND vpli.vendor_id=?";

        // // Restrict view of all users only to admins
        // if (!isRoleInGroup('admin', $userGroupId)) {
        //     $sql .= " WHERE `stock`.domain_id='" . $userDomain['id'] ."'";
        // }

        $results = $opr->sqlSelect($sql, 'ii', $preqId, $vendorId);

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $vendorpreq_lines[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $vendorpreq_lines;
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}



/*
 * Manage Vendor Purchase Orders
 * 
 */

function fetch_all_vendor_pos() {
    $vendorpos = array();

    // $userDomainName = isset($_SESSION['domain']) ? $_SESSION['domain'] : 'default';
    // $userGroupId = isset($_SESSION['groupid']) ? $_SESSION['groupid'] : 1;
    // $userDomain = getDomainByName($userDomainName);

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $sql = "SELECT id, porder_no, porder_date,
                (SELECT name FROM organizations WHERE vendor_porders.vendor_id = organizations.id) as vendor,
                (SELECT name FROM users WHERE vendor_porders.requester_id = users.id) as requester,
                (SELECT name FROM users WHERE vendor_porders.issuer_id = users.id) as issuer,
                net_total, status
                FROM vendor_porders";

        // // Restrict view of all users only to admins
        // if (!isRoleInGroup('admin', $userGroupId)) {
        //     $sql .= " WHERE `stock`.domain_id='" . $userDomain['id'] ."'";
        // }

        $results = $opr->sqlSelect($sql);

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $vendorpos[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $vendorpos;
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}

function getVendorPorderById($preqId) {
    $vendorporder = array();

    // $userDomainName = isset($_SESSION['domain']) ? $_SESSION['domain'] : 'default';
    // $userGroupId = isset($_SESSION['groupid']) ? $_SESSION['groupid'] : 1;
    // $userDomain = getDomainByName($userDomainName);

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $sql = "SELECT porder_no, porder_date, 
                (SELECT preq_no FROM vendor_preqs WHERE vendor_preqs.id = vendor_porders.src_requisition_id) as preq_no,
                (SELECT name FROM organizations WHERE vendor_porders.vendor_id = organizations.id) as vendor, 
                (SELECT contact_email FROM organizations WHERE vendor_porders.vendor_id = organizations.id) as vendor_email, 
                (SELECT address FROM organizations WHERE vendor_porders.vendor_id = organizations.id) as vendor_address,
                (SELECT name FROM users WHERE vendor_porders.requester_id = users.id) as requester, 
                status, sub_total, net_total, paid, payment_method, shipping_method, shipping_cost, 
                vat, due, discount,
                (SELECT name FROM users WHERE vendor_porders.issuer_id = users.id) as issuer, 
                issuer_id, issuer_notes
                FROM vendor_porders WHERE vendor_porders.id=?";

        // // Restrict view of all users only to admins
        // if (!isRoleInGroup('admin', $userGroupId)) {
        //     $sql .= " WHERE `stock`.domain_id='" . $userDomain['id'] ."'";
        // }

        $results = $opr->sqlSelect($sql, 'i', $preqId);

        if ($results && $results->num_rows === 1) {
            $vendorporder = $results->fetch_assoc();
            $results->free_result();
            return $vendorporder;
        }

        $opr->close();
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}

function getVendorPorderLinesById($preqId) {
    $vendorporder_lines = array();

    // $userDomainName = isset($_SESSION['domain']) ? $_SESSION['domain'] : 'default';
    // $userGroupId = isset($_SESSION['groupid']) ? $_SESSION['groupid'] : 1;
    // $userDomain = getDomainByName($userDomainName);

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $sql = "SELECT vendor_porders.porder_no, 
                (SELECT product_name_descr FROM vendors_products 
                    WHERE vpli.vendor_product_id = vendors_products.id) as product_descr, 
                (SELECT provisional_sku FROM vendors_products 
                    WHERE vpli.vendor_product_id = vendors_products.id) as sku, 
                vpli.quantity, vpli.unit_price, vpli.total_cost 
                FROM vendor_porder_line_items as vpli INNER JOIN vendor_porders 
                ON vpli.porder_id = vendor_porders.id 
                WHERE vendor_porders.id=?";

        // // Restrict view of all users only to admins
        // if (!isRoleInGroup('admin', $userGroupId)) {
        //     $sql .= " WHERE `stock`.domain_id='" . $userDomain['id'] ."'";
        // }

        $results = $opr->sqlSelect($sql, 'i', $preqId);

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $vendorporder_lines[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $vendorporder_lines;
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}



/*
 * Manage Customer Purchase Orders
 * 
 */

function fetch_all_inline_orders() {
    $inline_orders = array();

    // $userDomainName = isset($_SESSION['domain']) ? $_SESSION['domain'] : 'default';
    // $userGroupId = isset($_SESSION['groupid']) ? $_SESSION['groupid'] : 1;

    // $userDomain = getDomainByName($userDomainName);

    $opr = new DBOperation();       //Connect to database
    if ($opr->dbConnected()) {

        $sql = "SELECT iorder_no, iorder_date, description,
                attendant_id,
                (SELECT name FROM users WHERE attendant_id = users.id) as attendant_name,
                customer_id,
                (SELECT name FROM organizations WHERE customer_id = organizations.id) as customer_name,
                client_id,
                (SELECT name FROM users WHERE client_id = users.id) as client_name,
                domain_id,
                (SELECT name FROM domains WHERE domain_id = domains.id) as domain,
                sub_dom_id,
                (SELECT name FROM subdomains WHERE sub_dom_id = subdomains.id) as subdom,
                sub_total, vat, discount, net_total, paid, payment_method, shipping_method,
                shipping_cost, status, notes
                FROM inline_orders";

        // // Restrict view of all users only to admins
        // if (!isRoleInGroup('admin', $userGroupId)) {
        //     $sql .= " WHERE `stock`.domain_id='" . $userDomain['id'] ."'";
        // }

        $results = $opr->sqlSelect($sql);

        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $inline_orders[] = $row;
            }
            $results->free_result();
        }
        $opr->close();

        return $inline_orders;
    }
    else {
        return -1;                  // Failed to connect to database
    }  
}


?>