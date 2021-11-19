<?php 
include_once('../../security.php');
include_once('db_functions.php');

// Fetch Group By Id
if (isset($_GET["getGroupById"])) {
    if (isset($_GET["groupid"])) {
        $result = getGroupById($_GET['groupid']); // returns array of groups
        echo json_encode($result);
    }
    else {
        echo json_encode(array());  // return empty
    }
}

// Fetch Group Role By Id
if (isset($_GET["getGroupRoleById"])) {
    if (isset($_GET["groupid"]) && isset($_GET["roleid"])) {
        $result = getGroupRoleById($_GET['groupid'], $_GET['roleid']); // returns array of group roles items
        echo json_encode($result);
    }
    else {
        echo json_encode(array());  // return empty
    }
}

// Create New Group
if (isset($_POST["createNewGroup"])) {
    
    // capture the variables            // print_r($_POST);
    $group_name = $_POST['group_name'];
    $group_description = $_POST['group_description'];
    
    $id = createNewGroup($group_name, $group_description);

    if ($id > 0) {
        $result = array( 'code' => 0, 'message' => 'New Group successfully created.', 'id' => $id );
    }
    else {
        $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
    }

    echo json_encode($result);
}

// Add a Role to a Group
if (isset($_POST["addRoleToGroup"])) {
    
    // capture the variables //print_r($_POST);
    $groupId = $_POST['groupId'];
    $roleId = $_POST['targetGroupRoleId'];
    $groupRoleLabel = $_POST['targetGroupRoleLabel'];
    $groupRoleDescr = $_POST['targetGroupRoleDescr'];
    
    $res = addRoleToGroup($groupId, $roleId, $groupRoleLabel, $groupRoleDescr);
    if ($res === 0) {
        $result = array( 'code' => 0, 'message' => 'Role successfully added.', 'groupid' => $groupId );
    }
    else {
        if ($res == -1) {
            $result = array( 'code' => 1, 'message' => 'Failed to insert new role.', 'groupid' => $groupId );
        }
        else {
            $result = array( 'code' => 2, 'message' => 'Failed to connect to database.', 'groupid' => $groupId );
        }
    }

    echo json_encode($result);
}

// Update Group
if (isset($_POST["updateGroup"]) && isset($_POST["group_id"])) {

    // capture the variables  // print_r($_POST);
    $group_id = $_POST['group_id'];
    $group_name = $_POST['group_name'];
    $group_description = $_POST['group_description'];
    
    $success = updateGroup($group_id, $group_name, $group_description);
    if ($success === 0) {
        $result = array( 'code' => 0, 'message' => 'Group successfully updated.' );
    }
    else {
        if ($success === -1) {
            $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
        }
        else if ($success === -2) {
            $result = array( 'code' => 2, 'message' => 'Unable to update group.' );
        }
        else {
            $result = array( 'code' => 3, 'message' => 'Unknown error.' );
        }
    }

    echo json_encode($result);
}

// Update Group Role
if (isset($_POST["updateGroupRole"]) && isset($_POST["group_id"]) && isset($_POST["role_id"])) {

    // capture the variables  //print_r($_POST);
    $group_id = $_POST['group_id'];
    $role_id = $_POST['role_id'];
    $group_role_label = $_POST['group_role_label'];
    $group_role_descr = $_POST['group_role_descr'];
    
    $success = updateGroupRole($group_id, $role_id, $group_role_label, $group_role_descr);
    if ($success === 0) {
        $result = array( 'code' => 0, 'message' => 'Group successfully updated.', 'groupid' => $group_id );
    }
    else {
        if ($success === -1) {
            $result = array( 'code' => 1, 'message' => 'Failed to connect to database.', 'groupid' => $group_id );
        }
        else if ($success === -2) {
            $result = array( 'code' => 2, 'message' => 'Unable to update group.', 'groupid' => $group_id );
        }
        else {
            $result = array( 'code' => 3, 'message' => 'Unknown error.', 'groupid' => $group_id );
        }
    }

    echo json_encode($result);
}

// Delete Group
if (isset($_POST["deleteGroup"]) && isset($_POST["groupid"])) {

    // capture the variables  print_r($_POST);
    $group_id = $_POST['groupid'];

    $success = deleteGroup($group_id);
    if ($success === 0) {
        $result = array( 'code' => 0, 'message' => 'Group successfully deleted.' );
    }
    else {
        if ($success === -1) {
            $result = array( 'code' => 1, 'message' => 'Failed to connect to database.' );
        }
        else if ($success === -2) {
            $result = array( 'code' => 2, 'message' => 'Unable to delete group.' );
        }
        else {
            $result = array( 'code' => 3, 'message' => 'Unknown error.' );
        }
    }

    echo json_encode($result);
}

// Delete Group Role
if (isset($_POST["deleteGroupRole"]) && isset($_POST["groupid"]) && isset($_POST["roleid"])) {

    // capture the variables  print_r($_POST);
    $group_id = $_POST['groupid'];
    $role_id = $_POST['roleid'];

    $success = deleteGroupRole($group_id, $role_id);
    if ($success === 0) {
        $result = array( 'code' => 0, 'message' => 'Role successfully deleted from group.', 'groupid' => $group_id );
    }
    else {
        if ($success === -1) {
            $result = array( 'code' => 1, 'message' => 'Failed to connect to database.', 'groupid' => $group_id );
        }
        else if ($success === -2) {
            $result = array( 'code' => 2, 'message' => 'Unable to delete role group.', 'groupid' => $group_id );
        }
        else {
            $result = array( 'code' => 3, 'message' => 'Unknown error.', 'groupid' => $group_id );
        }
    }

    echo json_encode($result);
}


?>