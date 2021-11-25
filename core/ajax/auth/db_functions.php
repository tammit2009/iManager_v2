<?php 

function checkEmailExists($email) {
    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        //Check if user with same email already exists
        $res = $opr->sqlSelect('SELECT id FROM users WHERE email=?', 's', $email);
        if($res) { 
            return $res->num_rows;      // returns 0 if not existing, 1... if 1 or more occurences fount
        }
        else {
            return -2;  // Database error
        }
        $res->free_result();
        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }
}

function createAccount($name, $email, $password) {
    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        // First hash the password
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // Insert the new user with the 'default' domain (1)
        $id = $opr->sqlInsert('INSERT INTO users VALUES (NULL, ?, ?, ?, 1, 1, 0, "no-image-available.svg", CURRENT_TIMESTAMP)', 
                                'sss', 
                                $name, $email, $hash);

        // Prepare event
        $creator = $id;
        $timestamp = date('Y-m-d H:i:s', time());
        $type = "info";                    // request type 3 (account_create)
        $category = "user_access";
        $table_str = "users";
        $xinfo = "";
        $action = "create_account";
        $route = "account_created";

        if ($id > 0) {
            // Insert the new user into 'default' domain's default subdomain (1) as well
            $iid = $opr->sqlInsert('INSERT INTO subdomains_users VALUES (NULL, ?, 1, "")', 'i', $id);
            if ($iid > 0) {
                $status = "complete";
                // Emit an account created event using the controller
                addEvent($creator, $timestamp, $type, $category, $table_str, $id, $action, $status, $route, $xinfo); // true on success  
                return $id;
            }
            else {
                $status = "incomplete";
                addEvent($creator, $timestamp, $type, $category, $table_str, $id, $action, $status, $route, $xinfo); // true on success  
                return -3;  // Failed to insert user into default subdomain
            }
        }
        else {
            return -2;  // Unable to create new user
        }

        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }        
}

function createGroupRequest($id, $group_name) {

    // Assemble data for Business Logic using the controller
    $creator = $id;
    $target_to = 0;                             // for now
    $timestamp = date('Y-m-d H:i:s', time());
    $type = "group_request";                    // request type 3
    $category = "user_access";
    $table_str = "user";
    $xinfo = "";
    $action = "join_" . $group_name;
    $status = "processing";
    $route = "Add user to group";

    // Create a request for group
    $requestId = addRequest($creator, $target_to, $timestamp, 3, $category, $table_str, $action, $id, $route, 0);
    
    // Fire Group Request Event!
    $eventId = addEvent($creator, $timestamp, $type, $category, $table_str, $id, $action, $status, $route, $xinfo); // true on success  
    
    if ($requestId < 0 || $eventId < 0) {
        return -1;          // unable to create request or event
    }
}

function getAccountValidationRequestAttemptsForUser($validation_window, $email) {
    $user = array();

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        $res = $opr->sqlSelect('SELECT users.id, name, verified, COUNT(validation_requests.id) 
                                FROM users LEFT JOIN validation_requests
                                ON users.id = validation_requests.userid AND type = 0 AND timestamp > ?   
                                WHERE email = ? GROUP BY users.id', 'is', $validation_window, $email);

        if ($res && $res->num_rows === 1) {
            $user = $res->fetch_assoc();
            return $user;
            $res->free_result();
        }
        
        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }    
}

function logAccountValidationRequest($user_id, $verifyCode) {

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        
        // Hash the verify code
        $hash = password_hash($verifyCode, PASSWORD_DEFAULT);   // prevents theft directly from database

        // insert verification/validation request 
        $requestID = $opr->sqlInsert('INSERT INTO validation_requests VALUES (NULL, ?, ?, ?, 0)', 'isi', $user_id, $hash, time());

        // // Emit an account created event using the controller
        // $creator = $id;
        // $timestamp = date('Y-m-d H:i:s', time());
        // $type = "account_create";                    // request type 3
        // $category = "user_access";
        // $table_str = "user";
        // $xinfo = "";
        // $action = "account_created";
        // $status = "complete";
        // $route = "";
        // addEvent($creator, $timestamp, $type, $category, $table_str, $id, $action, $status, $route, $xinfo); // true on success  

        return $requestID;
        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }        
}

function getPendingValidationRequest($request_id) {
    $request = array();

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        $res = $opr->sqlSelect('SELECT userid,hash,timestamp FROM validation_requests WHERE id=? AND type=0', 'i', $request_id);
        if ($res && $res->num_rows === 1) {
            $request = $res->fetch_assoc();
            return $request;
            $res->free_result();
        }
        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }  
}

function verifyUser($user_id) {

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        // Set the user to verified if valid
        if ($opr->sqlUpdate('UPDATE users SET verified=1 WHERE id=?', 'i', $user_id)) {
            // delete all pending requests for the user if successfully validated
            if ($opr->sqlUpdate('DELETE FROM validation_requests WHERE userid=? AND type=0', 'i', $user_id)) {

                // Emit a user verified event using the controller
                // $creator = $id;
                // $timestamp = date('Y-m-d H:i:s', time());
                // $type = "account_verified";                    // request type 3
                // $category = "user_access";
                // $table_str = "user";
                // $xinfo = "";
                // $action = "account_created";
                // $status = "complete";
                // $route = "";
                // addEvent($creator, $timestamp, $type, $category, $table_str, $id, $action, $status, $route, $xinfo); // true on success  

                return 0;   // success
            }
            else {
                return -3;  // unable to delete all linked validation requests for the user
            }       
        }
        else {
            return -2;      // unable to set user to verified
        }
        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }       
}

function runEmailValidation($request_id, $verify) {

    echo '<div class="message">';

    // Find all pending validation requests for the user 
    $request = getPendingValidationRequest($request_id);

    if ($request !== -1) {
        if (!empty($request)) {

            if($request['timestamp'] > time() - 60*60*24) { // verification request expires after 1 day

                if(password_verify(urlSafeDecode($verify), $request['hash'])) {

                    // Set the user to verified if valid
                    $res = verifyUser($request['userid'], $request_id);
                    switch($res) {
                        case 0: 
                            // success
                            echo '<h2>Email Verified</h2><br><p class="m-0 mt-2 text-center"><span><a href="auth.php?page=login">Login</a></span></p>';
                            break;
                        case -1: 
                            // Failed to connect to database
                            break; 
                        case -2: 
                            // unable to set user to verified
                            echo '<h2>Failed to Update Database</h2>';
                            break;
                        case -3: 
                            // unable to delete all linked validation requests for the user
                            echo '<h2>Unable to delete all linked validation requests</h2>';
                            break;
                    }                   
                }
                else {
                    echo '<h2>Invalid Verification Request</h2>';
                }
            }
            else {
                echo '<h2>Verification Request Expired</h2><a href="./validate">Click here to send another one</a>';
            }
        }
        else {
            echo '<h2>Invalid Verification Request</h2>';
        }
    }
    else {
        echo '<h2>Failed to Connect to Database</h2>';
    }

    echo '</div>'; 
}

function getPasswordResetRequestAttemptsForUser($validation_window, $email) {
    $user = array();

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        $res = $opr->sqlSelect('SELECT users.id, name, verified, COUNT(validation_requests.id) 
                                FROM users LEFT JOIN validation_requests
                                ON users.id = validation_requests.userid AND type = 1 AND timestamp > ?   
                                WHERE email = ? GROUP BY users.id', 'is', $validation_window, $email);

        if ($res && $res->num_rows === 1) {
            $user = $res->fetch_assoc();
            return $user;
            $res->free_result();
        }
        
        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }    
}

function logPasswordResetRequest($user_id, $verifyCode) {

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        
        // Hash the verify code
        $hash = password_hash($verifyCode, PASSWORD_DEFAULT);   // prevents theft directly from database

        // insert verification/validation request 
        $insertID = $opr->sqlInsert('INSERT INTO validation_requests VALUES (NULL, ?, ?, ?, 1)', 'isi', $user_id, $hash, time());
        
        // // Emit an account created event using the controller
        // $creator = $id;
        // $timestamp = date('Y-m-d H:i:s', time());
        // $type = "account_create";                    // request type 3
        // $category = "user_access";
        // $table_str = "user";
        // $xinfo = "";
        // $action = "account_created";
        // $status = "complete";
        // $route = "";
        // addEvent($creator, $timestamp, $type, $category, $table_str, $id, $action, $status, $route, $xinfo); // true on success  

        return $insertID;
        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }        
}

function getPendingResetRequest($request_id) {
    $request = array();

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        $res = $opr->sqlSelect('SELECT userid,hash,timestamp FROM validation_requests WHERE id=? AND type=1 LIMIT 1', 'i', $request_id);
        if ($res && $res->num_rows === 1) {
            $request = $res->fetch_assoc();
            return $request;
            $res->free_result();
        }
        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }  
}

function updatePassword($user_id, $password) {

    // hash the update password
    $hash = password_hash($password, PASSWORD_DEFAULT);

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {
        // update the password
        if ($opr->sqlUpdate('UPDATE users SET password=? WHERE id=?', 'si', $hash, $user_id)) {
            // delete all password reset requests for user
            if ($opr->sqlUpdate('DELETE FROM validation_requests WHERE userid=? AND type=1', 'i', $user_id)) {

                // Emit a password reset event using the controller (if necessary)
                // $creator = $id;
                // $timestamp = date('Y-m-d H:i:s', time());
                // $type = "password_reset";                    // request type 3
                // $category = "user_access";
                // $table_str = "user";
                // $xinfo = "";
                // $action = "password_reset";
                // $status = "complete";
                // $route = "";
                // addEvent($creator, $timestamp, $type, $category, $table_str, $id, $action, $status, $route, $xinfo); // true on success  

                return 0;   // success
            }
            else {
                return -3;  // unable to delete all linked reset requests for the user
            }       
        }
        else {
            return -2;      // unable to update the password
        }
        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }       
}


function getUserFromLoginAttemptEmail($validation_window, $email) {
    $user = array();

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        // $res = $opr->sqlSelect('SELECT users.id, password, groupid, verified, domain, COUNT(loginattempts.id) 
        //                         FROM users LEFT JOIN loginattempts ON users.id = userid AND timestamp>? 
        //                         WHERE email=? GROUP BY users.id', 'is', $validation_window, $email);

        $sql = "SELECT users.id, users.password, users.groupid, domain_q.domain, users.verified, COUNT(loginattempts.id) 
                FROM users INNER JOIN groups INNER JOIN
                (SELECT subdomains_users.user_id,
                    (SELECT name FROM `domains` WHERE subdomains.parent_domain_id = `domains`.`id`) as domain, 
                    (SELECT name FROM `users` WHERE subdomains_users.user_id = `users`.id) as username 
                    FROM `subdomains_users` INNER JOIN `subdomains` 
                    ON `subdomains_users`.`sub_dom_id` = `subdomains`.id 
                    GROUP BY domain, username) as domain_q
                ON users.groupid = groups.id 
                AND `users`.id = domain_q.user_id";

        $sql .= " LEFT JOIN loginattempts ON users.id = loginattempts.userid AND timestamp>? 
                    WHERE email=? GROUP BY users.id";

        $res = $opr->sqlSelect($sql, 'is', $validation_window, $email);

        if ($res && $res->num_rows === 1) {
            $user = $res->fetch_assoc();
            return $user;
            $res->free_result();
        }
        
        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }    
}

function manageLoginAttempts($action, $user_id) {

    // Prepare to emit a login attempt event using the controller if necessary
    // $creator = $id;
    // $timestamp = date('Y-m-d H:i:s', time());
    // $type = "login_attempt";                    // request type 4
    // $category = "user_access";
    // $table_str = "user";
    // $xinfo = "";
    // $action = "login_attempt";
    // $status = "complete";
    // $route = "";

    //Connect to database
    $opr = new DBOperation();
    if ($opr->dbConnected()) {

        if ($action === 'add_to_attempts') {
            // insert verification/validation request 
            $insertID = $opr->sqlInsert(  'INSERT INTO loginattempts VALUES (NULL, ?, ?, ?)', 
                                                'isi', $user_id, $_SERVER['REMOTE_ADDR'], time());

            // addEvent($creator, $timestamp, $type, $category, $table_str, $id, $action, $status, $route, $xinfo); // true on success  
            return $insertID;
        }

        else if ($action === 'clear_all_attempts') {
            $opr->sqlUpdate('DELETE FROM loginattempts WHERE userid=?', 'i', $user_id);

            // addEvent($creator, $timestamp, $type, $category, $table_str, $id, $action, $status, $route, $xinfo); // true on success  
        }

        $opr->close();
    }
    else {
        return -1;      // Failed to connect to database
    }        
}

?>